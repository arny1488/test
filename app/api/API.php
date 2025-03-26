<?php

/**
 * This file is part of the dashboard.rgbvision.net package.
 *
 * (c) Alex Graham <contact@rgbvision.net>
 *
 * @package    dashboard.rgbvision.net
 * @author     Alex Graham <contact@rgbvision.net>
 * @copyright  Copyright 2017-2022, Alex Graham
 * @license    https://dashboard.rgbvision.net/license.txt MIT License
 * @version    4.0
 * @link       https://dashboard.rgbvision.net
 * @since      File available since Release 2.0
 */

class API
{

    private ?string $authorization_token = null;

    private ?string $user_id = null;
    private ?string $organization_id = null;

    private bool $is_mobile_app = false;

    /**
     * Constructor
     * Set auth token and user ID if available
     */
    public function __construct()
    {
        if (
            ($auth = preg_replace('/^Bearer\s+(\w+)$/', '$1', $_SERVER['HTTP_AUTHORIZATION'])) &&
            ($user = DB::row(
                "
                SELECT users.id, users.role_id, user_roles.permissions FROM api_users 
                INNER JOIN users ON api_users.user_id = users.id 
                INNER JOIN user_roles ON users.role_id = user_roles.id 
                WHERE api_users.auth_token = ? AND api_users.auth_token_expire > ? AND users.blocked IS NULL AND users.deleted IS NULL
            ",
                $auth,
                date(DB_DATETIME_FORMAT)
            )) &&
            ($user_id = $user['id']) &&
            ($role_id = $user['role_id'])
        ) {
            $this->authorization_token = $auth;
            $this->user_id = $user_id;

            define('USERID', $user_id);
            define('USERROLE', $role_id);

            Permissions::set(Json::decode($user['permissions'] ?? '[]'));
            DB::update("users", ["last_activity" => date(DB_DATETIME_FORMAT)], ["id" => $user_id]);
        } else {
            if (
                (empty(Permissions::getList())) &&
                ($anonymous_permissions = DB::cell('SELECT permissions FROM user_roles WHERE id = ?', UserRoles::ANONYMOUS))
            ) {
                Permissions::set(Json::decode($anonymous_permissions) ?? []);
            }
        }

        $this->is_mobile_app = str_starts_with($_SERVER['HTTP_USER_AGENT'], 'TM4RENT_MobileApp');
    }

    private function copy_template(string $source, string $destination, string $module_name): void
    {
        $dir = opendir($source);

        if (!Dir::create($destination)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $destination));
        }

        while (false !== ($file = readdir($dir))) {
            if (($file !== '.') && ($file !== '..')) {
                if (is_dir($source . '/' . $file)) {
                    self::copy_template($source . '/' . $file, $destination . '/' . $file, $module_name);
                } else {
                    $new_file = str_replace(
                        'example',
                        preg_replace('/\s+/', '', strtolower($module_name)),
                        $file
                    );

                    $_new_name = explode(' ', $module_name);

                    foreach ($_new_name as &$part) {
                        $part = ucfirst($part);
                    }

                    $content = File::getContents($source . '/' . $file);

                    $new_content = str_replace(
                        [
                            'example',
                            'Example',
                            'EXAMPLE',
                            ':date:',
                        ],
                        [
                            strtolower(implode('', $_new_name)),
                            implode('', $_new_name),
                            implode(' ', $_new_name),
                            date('d.m.Y'),
                        ],
                        $content
                    );

                    File::putContents($destination . '/' . $new_file, $new_content, true, true);
                }
            }
        }

        closedir($dir);
    }

    public function post_create_module(string $name): void
    {
        if (
            ($_name = preg_replace('/[^a-z ]/i', '', $name)) &&
            ($dir_name = preg_replace('/\s+/', '', strtolower($_name))) &&
            (!Dir::exists(DASHBOARD_DIR . MODULES_DIR . DS . $dir_name))
        ) {
            $this->copy_template(DASHBOARD_DIR . "/tmp/module_template", DASHBOARD_DIR . MODULES_DIR . DS . $dir_name, $_name);
            if (Dir::exists(DASHBOARD_DIR . MODULES_DIR . DS . $dir_name)) {
                ApiRouter::response();
            }
            ApiRouter::response(500);
        }
        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function get_app_version(): void
    {
        ApiRouter::response(200, ['version' => '2.0']);
    }

    public function get_wss_credentials(): void
    {
        if (!Permissions::has('dashboard_view')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }
        if ($auth = Cookie::get('auth')) {
            ApiRouter::response(200, [
                'user_id' => USERID,
                'hash' => $auth,
            ]);
        }
        ApiRouter::response(500);
    }

    private function set_auth_tokens(string $user_id, ?string $fcm_token = ''): array
    {
        DB::delete('api_users', ['user_id' => $user_id, 'fcm_token' => $fcm_token]);

        $auth_token = null;
        $refresh_token = null;

        do {
            try {
                $auth_token = bin2hex(random_bytes(32));
                $refresh_token = bin2hex(random_bytes(32));
            } catch (Exception $e) {
            }
        } while (!$auth_token || !$refresh_token || ((int)DB::cell("SELECT COUNT(*) FROM api_users WHERE auth_token = ? OR refresh_token = ?", $auth_token, $refresh_token) > 0));

        $auth_token_expire = time() + AUTH_TOKEN_LIFETIME;

        DB::insert(
            "api_users",
            [
                "user_id" => $user_id,
                "auth_token" => $auth_token,
                "auth_token_expire" => date(DB_DATETIME_FORMAT, $auth_token_expire),
                "refresh_token" => $refresh_token,
                "refresh_token_expire" => date(DB_DATETIME_FORMAT, time() + REFRESH_TOKEN_LIFETIME),
                "fcm_token" => $fcm_token ?: null,
            ]
        );

        return ['auth_token' => $auth_token, 'auth_token_expire' => date('c', $auth_token_expire), 'refresh_token' => $refresh_token];
    }

    public function post_tokens_refresh(string $refresh_token, ?string $fcm_token = ''): void
    {
        if (
            ($auth_token = preg_replace('/^Bearer\s+(\w+)$/', '$1', $_SERVER['HTTP_AUTHORIZATION'])) &&
            ($user_id = DB::cell(
                'SELECT api_users.user_id FROM api_users INNER JOIN users ON api_users.user_id = users.id WHERE auth_token = ? AND refresh_token = ? AND users.deleted IS NULL AND users.blocked IS NULL LIMIT 1',
                $auth_token,
                $refresh_token
            ))
        ) {
            ApiRouter::response(200, $this->set_auth_tokens($user_id, $fcm_token));
        }
        ApiRouter::response(401, ['message' => i18n::_('api.auth.fail')]);
    }

    private function send_verification_code(string $user_id): ?array
    {
        // Send verification code
        $_verification_code = (string)((SYSTEM_ENVIRONMENT === 'public') ? rand(1000, 9999) : 6969);
        $_verification_code_expire = date(DB_DATETIME_FORMAT, time() + VERIFICATION_CODE_LIFETIME);
        DB::update('users', ['verification_code' => $_verification_code, 'verification_code_expire' => $_verification_code_expire], ['id' => $user_id]);
        return ['verification_code' => $_verification_code, 'verification_code_expire' => $_verification_code_expire];
        // return null;
    }

    public function post_reset_request(string $country_code, string $phone, string $email): void
    {
        if ($this->is_mobile_app) {
            // check if valid phone
            if (!Valid::phone($phone, mb_strtoupper($country_code)) || !Valid::email($email)) {
                ApiRouter::response(400, ['message' => i18n::_('api.request.wrong_data'), 'phone' => Valid::phone($phone, mb_strtoupper($country_code)), 'email' => Valid::email($email)]);
            }

            // Delete `verification_code` from DB in case user didn't finish reset steps.
            DB::query(
                "UPDATE users 
                                 SET verification_code = '', verification_code_expire = NULL 
                                 WHERE country_code = ? AND phone = ? AND email = ?
                                   AND verification_code != '' AND verification_code_expire IS NOT NULL AND verification_code_expire < ? AND `blocked` IS NULL AND `deleted` IS NULL",
                mb_strtoupper($country_code),
                $phone,
                Valid::normalizeEmail($email),
                date(DB_DATETIME_FORMAT)
            );

            if (
                $verification_code_expire = DB::cell(
                    "SELECT verification_code_expire FROM users WHERE country_code = ? AND phone = ? AND verification_code != '' AND verification_code_expire IS NOT NULL AND verification_code_expire >= ? LIMIT 1",
                    mb_strtoupper($country_code),
                    $phone,
                    date(DB_DATETIME_FORMAT)
                )
            ) {
                ApiRouter::response(409, ['message' => sprintf(i18n::_('api.user.verification_code.not_expired'), strtotime($verification_code_expire) - time())]);
            }

            if (
                ($user_id = DB::cell("SELECT id FROM users WHERE country_code = ? AND phone = ? AND email = ? AND `deleted` IS NULL AND `blocked` IS NULL LIMIT 1", mb_strtoupper($country_code), $phone, Valid::normalizeEmail($email))) &&
                ($_verification_data = $this->send_verification_code($user_id))
            ) {
                ApiRouter::response(200, $_verification_data);
            }

            ApiRouter::response(500, ['message' => i18n::_('api.common.error')]);
        }

        ApiRouter::response(403, ['message' => i18n::_('api.denied')]);
    }


    public function post_reset_finish(string $country_code, string $phone, string $verification_code, string $password): void
    {
        if ($this->is_mobile_app) {
            // check if valid phone
            if (!Valid::phone($phone, mb_strtoupper($country_code))) {
                ApiRouter::response(400, ['message' => i18n::_('api.request.wrong_data')]);
            }

            if ($user_id = DB::cell(
                'SELECT id FROM users WHERE country_code = ? AND phone = ? AND verification_code = ? AND verification_code_expire > ? LIMIT 1',
                mb_strtoupper($country_code),
                $phone,
                $verification_code,
                date(DB_DATETIME_FORMAT)
            )
            ) {
                $salt = Secure::randomString();
                $password_hash = password_hash(hash_hmac("sha256", $password, $salt . PWD_PEPPER), PASSWORD_ARGON2ID);

                DB::update(
                    'users',
                    [
                        'password' => $password_hash,
                        'salt' => $salt,
                        'verification_code' => '',
                        'verification_code_expire' => null,
                    ],
                    [
                        'id' => $user_id,
                    ]
                );

                DB::delete('api_users', ['user_id' => $user_id]);
                DB::delete('sessions', ['user_id' => $user_id]);
                DB::delete('user_sessions', ['user_id' => $user_id]);

                ApiRouter::response();
            }

            ApiRouter::response(500, ['message' => i18n::_('api.common.error')]);
        }

        ApiRouter::response(403, ['message' => i18n::_('api.denied')]);
    }

    public function post_check_email(string $email, ?string $user_id = null): void
    {
        $res = false;

        if (
            Permissions::has('dashboard_view') &&
            ($_email = Valid::normalizeEmail($email))
        ) {
            $res = !User::isEmailUsed($_email, $user_id);
        }

        Html::output($res ? 'true' : 'false');
        Response::shutDown();
    }

    public function post_check_phone(string $phone, string $country_code, ?string $user_id = null): void
    {
        $res = false;

        if (
            Permissions::has('dashboard_view') &&
            (Valid::phone($phone, mb_strtoupper($country_code)))
        ) {
            $res = !User::isPhoneUsed($phone, mb_strtoupper($country_code), $user_id);
        }

        Html::output($res ? 'true' : 'false');
        Response::shutDown();
    }

    public function get_suggestions_address(string $query): void
    {
        if (defined('USERID')) {
            $res = Curl::postJson(
                'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address',
                [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "Authorization: Token " . DADATA_TOKEN,
                ],
                [],
                [
                    'query' => urldecode($query),
                    'count' => 10,
                ]
            );

            $output = [];

            if ($res) {
                foreach ($res['suggestions'] as $row) {
                    $output[] = [
                        'display' => $row['value'] ?? '',
                        'raw' => $row,
                    ];
                }
            }

            ApiRouter::response(200, $output);
        }

        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function get_suggestions_party_legal(string $query): void
    {
        if (defined('USERID')) {
            $res = Curl::postJson(
                'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/party',
                [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "Authorization: Token " . DADATA_TOKEN,
                ],
                [],
                [
                    'query' => urldecode($query),
                    'type' => 'LEGAL',
                    'status' => ['ACTIVE'],
                    'count' => 10,
                ]
            );

            $output = [];

            if ($res) {
                foreach ($res['suggestions'] as $row) {
                    $output[] = [
                        'display' => ($row['data']['name']['short_with_opf'] ?? $row['value']) . ($row['data']['inn'] ? (' (ИНН: ' . $row['data']['inn'] . ')') : ''),
                        'raw' => $row,
                    ];
                }
            }

            ApiRouter::response(200, $output);
        }

        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function get_suggestions_party_individual(string $query): void
    {
        if (defined('USERID')) {
            $res = Curl::postJson(
                'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/party',
                [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "Authorization: Token " . DADATA_TOKEN,
                ],
                [],
                [
                    'query' => urldecode($query),
                    'type' => 'INDIVIDUAL',
                    'status' => ['ACTIVE'],
                    'count' => 10,
                ]
            );

            $output = [];

            if ($res) {
                foreach ($res['suggestions'] as $row) {
                    $output[] = [
                        'display' => ($row['data']['name']['short_with_opf'] ?? $row['value']) . ($row['data']['inn'] ? (' (ИНН: ' . $row['data']['inn'] . ')') : ''),
                        'raw' => $row,
                    ];
                }
            }

            ApiRouter::response(200, $output);
        }

        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function get_suggestions_bank(string $query): void
    {
        if (defined('USERID')) {
            $res = Curl::postJson(
                'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/bank',
                [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "Authorization: Token " . DADATA_TOKEN,
                ],
                [],
                [
                    'query' => urldecode($query),
                    'status' => ['ACTIVE'],
                    'count' => 10,
                ]
            );

            $output = [];

            if ($res) {
                foreach ($res['suggestions'] as $row) {
                    $output[] = [
                        'display' => ($row['data']['bic'] ?? $row['value']) . ($row['data']['name']['payment'] ? (' (' . $row['data']['name']['payment'] . ')') : ''),
                        'raw' => $row,
                    ];
                }
            }

            ApiRouter::response(200, $output);
        }

        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function put_profile(string $firstname, string $lastname, string $patronymic, string $country_code, string $phone, string $email, ?string $password = null, ?string $photo = null): void
    {
        if (!Permissions::has('profile_edit')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }

        if (
            Valid::phone($phone, $country_code) &&
            Valid::email($email) &&
            ($user = TM4RENT\User::get(USERID))
        ) {
            $user->setLastname($lastname);
            Session::setvar('user_lastname', $user->getLastname());
            $user->setFirstname($firstname);
            Session::setvar('user_firstname', $user->getFirstname());
            $user->setPatronymic($patronymic);

            if (($country_code !== $user->getCountryCode()) || ($phone !== $user->getPhone())) {
                $user->setCountryCode($country_code);
                $user->setPhone($phone);
                $user->setPhoneVerified(false);
            }

            if (Valid::normalizeEmail($email) != $user->getEmail()) {
                $user->setEmail(Valid::normalizeEmail($email));
                $user->setEmailVerified(false);
                Session::setvar('user_email', $user->getEmail());
            }

            if ($password && ($salt = Secure::randomString()) && ($password_hash = password_hash(hash_hmac("sha256", $password, $salt . PWD_PEPPER), PASSWORD_ARGON2ID))) {
                $user->setPassword($password_hash);
                $user->setSalt($salt);
                Session::setvar('user_password', $user->getPassword());
            }

            if ($photo) {
                $user->uploadPhoto($photo);
                Session::setvar('user_avatar', User::getAvatar(USERID));
            }

            DB::clearCache('users');

            Log::log(Log::INFO, 'User', "Обновлены данные профиля");

            ApiRouter::response($user->save() ? 204 : 500);
        }

        ApiRouter::response(500, ['message' => i18n::_('api.common.error')]);
    }

    public function get_profile_organizations(): void
    {
        if (!defined('USERID')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }
        ApiRouter::response(200, TM4RENT\Organizations::get('name', 'ASC', null, null, null, USERID));
    }

    public function get_profile_organization_ARGid(string $id): void
    {
        if (!defined('USERID')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }
        ApiRouter::response(200, TM4RENT\Organization::get($id)->toArray());
    }

    public function post_profile_organization(int $type, string $inn, ?string $name = null, ?array $documents = null, ?array $details = null, ?array $banks = null): void
    {
        if (!defined('USERID')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }
        if (
            in_array($type, [1, 2, 3, 4]) &&
            Valid::inn($inn)
        ) {
            switch ($type) {
                case 1:
                    if (!$name) {
                        ApiRouter::response(400, ['message' => i18n::_('api.request.wrong')]);
                    }
                    break;
                case 2:
                    if (!$details['lastname'] || !$details['firstname']) {
                        ApiRouter::response(400, ['message' => i18n::_('api.request.wrong')]);
                    }
                    $name = implode(" ", ["ИП", $details['lastname'], $details['firstname'], $details['patronymic'] ?? '']);
                    break;
                case 3:
                    if (!$details['lastname'] || !$details['firstname']) {
                        ApiRouter::response(400, ['message' => i18n::_('api.request.wrong')]);
                    }
                    $name = implode(" ", ["Самозанятый", $details['lastname'], $details['firstname'], $details['patronymic'] ?? '']);
                    break;
                case 4:
                    if (!$details['lastname'] || !$details['firstname']) {
                        ApiRouter::response(400, ['message' => i18n::_('api.request.wrong')]);
                    }
                    $name = implode(" ", [$details['lastname'], $details['firstname'], $details['patronymic'] ?? '']);
                    break;
            }

            if ($organization = TM4RENT\Organization::create(USERID, $type, $name, $inn, $documents, $details, $banks ? [...$banks] : null)) {
                ApiRouter::response(201, ['id' => $organization->getId()]);
            }
        }
        ApiRouter::response(400, ['message' => i18n::_('api.request.wrong')]);
    }

    public function patch_profile_organization_ARGid(string $id, int $type, string $inn, ?string $name = null, ?array $documents = null, ?array $details = null, ?array $banks = null): void
    {
        if (!defined('USERID')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }
        if (
            in_array($type, [1, 2, 3, 4]) &&
            Valid::inn($inn) &&
            ($organization = TM4RENT\Organization::get($id))
        ) {
            switch ($type) {
                case 1:
                    if (!$name) {
                        ApiRouter::response(400, ['message' => i18n::_('api.request.wrong')]);
                    }
                    break;
                case 2:
                    if (!$details['lastname'] || !$details['firstname']) {
                        ApiRouter::response(400, ['message' => i18n::_('api.request.wrong')]);
                    }
                    $name = implode(" ", ["ИП", $details['lastname'], $details['firstname'], $details['patronymic'] ?? '']);
                    break;
                case 3:
                    if (!$details['lastname'] || !$details['firstname']) {
                        ApiRouter::response(400, ['message' => i18n::_('api.request.wrong')]);
                    }
                    $name = implode(" ", ["Самозанятый", $details['lastname'], $details['firstname'], $details['patronymic'] ?? '']);
                    break;
                case 4:
                    if (!$details['lastname'] || !$details['firstname']) {
                        ApiRouter::response(400, ['message' => i18n::_('api.request.wrong')]);
                    }
                    $name = implode(" ", [$details['lastname'], $details['firstname'], $details['patronymic'] ?? '']);
                    break;
            }

            if ($name) {
                $organization->setName($name);
            }

            if ($inn) {
                $organization->setInn($inn);
            }

            if ($documents !== null) {
                $organization->setDocuments($documents);
            }

            if ($details !== null) {
                $organization->setDetails($details);
            }

            if ($banks !== null) {
                $organization->setBanks($banks);
            }

            $organization->save();

            ApiRouter::response(201, ['id' => $organization->getId()]);
        }
        ApiRouter::response(400, ['message' => i18n::_('api.request.wrong')]);
    }

    public function delete_profile_organization_ARGid(string $id): void
    {
        if (
            defined('USERID') &&
            ($organization = TM4RENT\Organization::get($id)) &&
            ($organization->getUserId() === USERID)
        ) {
            $organization->setDeleted(date('c'));
            $organization->save();
            ApiRouter::response(200, ['id' => $organization->getId()]);
        }
        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function get_profile_brands(): void
    {
        if (!defined('USERID')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }
        ApiRouter::response(200, TM4RENT\Brands::get('name', 'ASC', null, null, null, USERID));
    }

    public function get_profile_brand_ARGid(string $id): void
    {
        if (!defined('USERID')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }
        if (
            ($brand = TM4RENT\Brand::get($id)) &&
            ($organization = TM4RENT\Organization::get($brand->getOrganizationId())) &&
            ($organization->getUserId() === USERID)
        ) {
            ApiRouter::response(200, $brand->toArray());
        }
        ApiRouter::response(404, i18n::_('api.not_found'));
    }

    public function post_profile_brand(
        string $organization_id,
        string $name,
        int $country_id,
        array $notoriety_ids,
        ?string $logotype = null,
        ?string $document = null,
        string $description = null,
        ?bool $licensor = false,
        ?bool $licensee = false,
        ?bool $fund = false,
        ?bool $top = false,
    ): void {
        if (
            defined('USERID') &&
            ($organization = TM4RENT\Organization::get($organization_id)) &&
            ($organization->getUserId() === USERID) &&
            ($brand = TM4RENT\Brand::create(
                $organization_id,
                $country_id,
                $name,
                $document,
                $description,
                $notoriety_ids,
                $licensor,
                $licensee,
                $fund,
                $top,
            ))
        ) {
            if ($logotype) {
                $brand->uploadLogotype($logotype);
            }
            ApiRouter::response(201, ['id' => $brand->getId()]);
        }
        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function patch_profile_brand_ARGid(
        string $id,
        string $name = null,
        int $country_id = null,
        array $notoriety_ids = null,
        ?string $organization_id = null,
        ?string $logotype = null,
        ?string $document = null,
        ?string $description = null,
    ): void {
        if (
            defined('USERID') &&
            ($brand = TM4RENT\Brand::get($id)) &&
            ($organization = TM4RENT\Organization::get($brand->getOrganizationId())) &&
            ($organization->getUserId() === USERID)
        ) {
            if (
                ($organization_id !== null) &&
                ($_organization = TM4RENT\Organization::get($organization_id)) &&
                ($_organization->getUserId() === USERID)
            ) {
                $brand->setOrganizationId($organization_id);
            }
            if ($name !== null) {
                $brand->setName($name);
            }
            if ($country_id !== null) {
                $brand->setCountryId($country_id);
            }
            if ($notoriety_ids !== null) {
                $brand->setNotorietyIds($notoriety_ids);
            }
            if ($logotype !== null) {
                $brand->uploadLogotype($logotype);
            }
            if ($document !== null) {
                $brand->setDocument($document);
            }
            if ($description !== null) {
                $brand->setDescription($description);
            }
            $brand->save();
            ApiRouter::response(200, ['id' => $brand->getId()]);
        }
        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function delete_profile_brand_ARGid(
        string $id,
    ): void {
        if (
            defined('USERID') &&
            ($brand = TM4RENT\Brand::get($id)) &&
            ($organization = TM4RENT\Organization::get($brand->getOrganizationId())) &&
            ($organization->getUserId() === USERID)
        ) {
            $brand->setDeleted(date('c'));
            $brand->save();
            ApiRouter::response(200, ['id' => $brand->getId()]);
        }
        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function get_profile_contents(): void
    {
        if (!defined('USERID')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }
        ApiRouter::response(200, TM4RENT\Contents::get('name', 'ASC', null, null, null, USERID));
    }

    public function get_profile_content_ARGid(string $id): void
    {
        if (!defined('USERID')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }
        if (
            ($content = TM4RENT\Content::get($id)) &&
            ($brand = TM4RENT\Brand::get($content->getBrandId())) &&
            ($organization = TM4RENT\Organization::get($brand->getOrganizationId())) &&
            ($organization->getUserId() === USERID)
        ) {
            ApiRouter::response(200, $content->toArray());
        }
        ApiRouter::response(404, i18n::_('api.not_found'));
    }

    public function post_profile_content(
        string $name,
        string $brand_id,
        array $type_ids,
        ?string $description = null,
        ?string $document = null,
    ): void {
        if (
            defined('USERID') &&
            ($brand = TM4RENT\Brand::get($brand_id)) &&
            ($organization = TM4RENT\Organization::get($brand->getOrganizationId())) &&
            ($organization->getUserId() === USERID) &&
            ($content = TM4RENT\Content::create(
                $brand_id,
                $type_ids,
                $name,
                $description,
                $document,
            ))
        ) {
            ApiRouter::response(201, ['id' => $content->getId()]);
        }
        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function patch_profile_content_ARGid(
        string $id,
        string $name = null,
        string $brand_id = null,
        ?array $type_ids = null,
        ?string $description = null,
        ?string $document = null,
        ?array $delete_media = null,
    ): void {
        if (
            defined('USERID') &&
            ($content = TM4RENT\Content::get($id)) &&
            ($_brand = TM4RENT\Brand::get($content->getBrandId())) &&
            ($_organization = TM4RENT\Organization::get($_brand->getOrganizationId())) &&
            ($_organization->getUserId() === USERID) &&
            ($brand = TM4RENT\Brand::get($brand_id)) &&
            ($organization = TM4RENT\Organization::get($brand->getOrganizationId())) &&
            ($organization->getUserId() === USERID)
        ) {
            if ($name !== null) {
                $content->setName($name);
            }
            if ($brand_id !== null) {
                $content->setBrandId($brand_id);
            }
            if ($type_ids !== null) {
                $content->setTypeIds($type_ids);
            }
            if ($document !== null) {
                $content->setDocument($document ?: null);
            }
            if ($description !== null) {
                $content->setDescription($description);
            }
            if (is_array($delete_media)) {
                foreach ($delete_media as $file_id) {
                    $content->deleteFile($file_id);
                }
            }
            $content->save();
            ApiRouter::response(200, ['id' => $content->getId()]);
        }
        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function post_profile_content_ARGid_upload(string $id, ?string $dzuuid = null, ?int $dzchunkindex = null, ?string $full_path = null)
    {
        usleep(100000);

        if (
            defined('USERID') &&
            ($content = TM4RENT\Content::get($id)) &&
            ($brand = TM4RENT\Brand::get($content->getBrandId())) &&
            ($organization = TM4RENT\Organization::get($brand->getOrganizationId())) &&
            ($organization->getUserId() === USERID)
        ) {
            Dir::create(DASHBOARD_DIR . '/uploads/content/' . $id);

            // Загрузка большого файла частями
            if ($dzuuid && ($dzchunkindex !== null)) {
                if ($uploaded_chunk = Request::file('file')) {
                    $target_chunk_file = DASHBOARD_DIR . '/uploads/content/' . $id . '/' . $dzuuid . '-' . sprintf('%04d', $dzchunkindex) . '.tmp';

                    File::rename($uploaded_chunk, $target_chunk_file);

                    ApiRouter::response(200, ['id' => $id]);
                }

                ApiRouter::response(400, ['id' => $id]);
            }

            // Загрузка файла одним запросом
            if (
                $full_path &&
                ($uploaded_file = Request::file('file', ['image/jpeg', 'image/tiff', 'video/mp4', 'video/avi', 'video/quicktime', 'audio/mpeg', 'audio/wav', 'audio/x-wav', 'audio/aac', 'audio/ogg', 'audio/flac', 'audio/x-flac']))
            ) {
                $target_file = DASHBOARD_DIR . '/uploads/content/' . $id . '/' . md5($id) . md5(microtime(true)) . '.file';

                File::rename($uploaded_file, $target_file);

                if ($file_id = $content->addFile(File::name($target_file), File::mime($target_file, false), File::hash($target_file, (PHP_OS_FAMILY === "Windows") ? 'md5' : 'stribog'), $full_path, File::size($target_file), 0)) {
                    ApiRouter::response(200, ['id' => $file_id]);
                } else {
                    File::delete($target_file);
                }
            }
        }

        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function patch_profile_content_ARGid_upload(string $id, string $dzuuid, int $dztotalchunkcount, string $full_path)
    {
        usleep(250000);

        if (
            defined('USERID') &&
            ($content = TM4RENT\Content::get($id)) &&
            ($brand = TM4RENT\Brand::get($content->getBrandId())) &&
            ($organization = TM4RENT\Organization::get($brand->getOrganizationId())) &&
            ($organization->getUserId() === USERID)
        ) {
            $target_file = DASHBOARD_DIR . '/uploads/content/' . $id . '/' . md5($id) . md5(microtime(true)) . '.file';

            Dir::create(DASHBOARD_DIR . '/uploads/content/' . $id);

            for ($i = 0; $i < $dztotalchunkcount; $i++) {
                $chunk_file = DASHBOARD_DIR . '/uploads/content/' . $id . '/' . $dzuuid . '-' . sprintf('%04d', $i) . '.tmp';
                $chunk_content = File::getContents($chunk_file);
                File::putContents($target_file, $chunk_content, true, true);
                File::delete($chunk_file);
            }

            if (!in_array(File::mime($target_file, false), ['image/jpeg', 'image/tiff', 'video/mp4', 'video/avi', 'video/quicktime', 'audio/mpeg', 'audio/wav', 'audio/x-wav', 'audio/aac', 'audio/ogg', 'audio/flac', 'audio/x-flac'])) {
                File::delete($target_file);
                ApiRouter::response(400, ['id' => $id]);
            }

            if ($file_id = $content->addFile(File::name($target_file), File::mime($target_file, false), File::hash($target_file, (PHP_OS_FAMILY === "Windows") ? 'md5' : 'stribog'), $full_path, File::size($target_file), 0)) {
                ApiRouter::response(200, ['id' => $file_id]);
            } else {
                File::delete($target_file);
            }
        }

        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function delete_profile_content_ARGid(
        string $id,
    ): void {
        if (
            defined('USERID') &&
            ($content = TM4RENT\Content::get($id)) &&
            ($brand = TM4RENT\Brand::get($content->getBrandId())) &&
            ($organization = TM4RENT\Organization::get($brand->getOrganizationId())) &&
            ($organization->getUserId() === USERID)
        ) {
            $content->setDeleted(date('c'));
            $content->deleteAllFiles();
            $content->save();
            ApiRouter::response(200, ['id' => $content->getId()]);
        }
        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function get_profile_offers(): void
    {
        if (!defined('USERID')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }
        ApiRouter::response(200, TM4RENT\Offers::get('created', 'DESC', null, null, null, ['user_id' => USERID]));
    }

    public function get_profile_offer_ARGid(string $id): void
    {
        if (!defined('USERID')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }
        if (
            ($offer = TM4RENT\Offer::get($id)) &&
            ($content = $offer->content) &&
            ($brand = $content->brand) &&
            ($organization = TM4RENT\Organization::get($brand->getOrganizationId())) &&
            ($organization->getUserId() === USERID)
        ) {
            ApiRouter::response(200, $offer->toArray());
        }
        ApiRouter::response(404, i18n::_('api.not_found'));
    }

    public function post_profile_offer(
        string $content_id,
        string $description,
        float $price,
        int $country_id,
        ?int $term_min = null,
        ?int $term_max = null,
        bool $termless = false,
        ?array $allowed_for_ids = null,
        ?array $application_ids = null,
        ?array $region_ids = null,
        ?array $placement_ids = null,
        bool $exclusive = false,
        bool $fast_deal = false,
        bool $charity = false,
        ?string $fund_id = null,
        ?float $charity_percent = null,
        ?float $charity_sum = null,
    ): void {
        if (
            defined('USERID') &&
            ($content = TM4RENT\Content::get($content_id)) &&
            ($brand = $content->brand) &&
            ($organization = TM4RENT\Organization::get($brand->getOrganizationId())) &&
            ($organization->getUserId() === USERID) &&
            ($offer = TM4RENT\Offer::create(
                $content_id,
                $description,
                $price,
                $term_min,
                $term_max,
                $termless,
                $allowed_for_ids,
                $application_ids,
                $country_id,
                $region_ids,
                $placement_ids,
                $exclusive,
                $fast_deal,
                $charity,
                $fund_id,
                $charity_percent,
                $charity_sum,
            ))
        ) {
            ApiRouter::response(201, ['id' => $offer->getId()]);
        }
        ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
    }

    public function patch_profile_offer_ARGid(
        string $id,
        ?string $content_id = null,
        ?string $description = null,
        ?float $price = null,
        ?int $country_id = null,
        ?int $term_min = null,
        ?int $term_max = null,
        ?bool $termless = false,
        ?array $allowed_for_ids = null,
        ?array $application_ids = null,
        ?array $region_ids = null,
        ?array $placement_ids = null,
        ?bool $exclusive = false,
        ?bool $fast_deal = false,
        ?bool $charity = false,
        ?string $fund_id = null,
        ?float $charity_percent = null,
        ?float $charity_sum = null,
    ): void {
        if (!defined('USERID')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }
        if (
            ($offer = TM4RENT\Offer::get($id)) &&
            ($content = $offer->content) &&
            ($brand = $content->brand) &&
            ($organization = TM4RENT\Organization::get($brand->getOrganizationId())) &&
            ($organization->getUserId() === USERID)
        ) {
            if ($content_id !== null) {
                $offer->setContentId($content_id);
            }
            if ($description !== null) {
                $offer->setDescription($description);
            }
            if ($price !== null) {
                $offer->setPrice($price);
            }
            if ($country_id !== null) {
                $offer->setCountryId($country_id);
            }
            if ($term_min !== null) {
                $offer->setTermMin($term_min);
            }
            if ($term_max !== null) {
                $offer->setTermMax($term_max);
            }
            if ($allowed_for_ids !== null) {
                $offer->setAllowedForIds($allowed_for_ids);
            }
            if ($application_ids !== null) {
                $offer->setApplicationIds($application_ids);
            }
            if ($region_ids !== null) {
                $offer->setRegionIds($region_ids);
            }
            if ($placement_ids !== null) {
                $offer->setPlacementIds($placement_ids);
            }
            if ($fund_id !== null) {
                $offer->setFundId($fund_id);
            }
            if ($charity_percent !== null) {
                $offer->setCharityPercent($charity_percent);
            }
            if ($charity_sum !== null) {
                $offer->setCharitySum($charity_sum);
            }
            $offer->setTermless($termless);
            $offer->setExclusive($exclusive);
            $offer->setFastDeal($fast_deal);
            $offer->setCharity($charity);
            $offer->save();
            ApiRouter::response(200, ['id' => $offer->getId()]);
        }
        ApiRouter::response(404, i18n::_('api.not_found'));
    }

    public function delete_profile_offer_ARGid(string $id): void
    {
        if (!defined('USERID')) {
            ApiRouter::response(403, ['message' => i18n::_('api.auth.fail')]);
        }
        if (
            ($offer = TM4RENT\Offer::get($id)) &&
            ($content = $offer->content) &&
            ($brand = $content->brand) &&
            ($organization = TM4RENT\Organization::get($brand->getOrganizationId())) &&
            ($organization->getUserId() === USERID)
        ) {
            $offer->setDeleted(date('c'));
            $offer->save();
            ApiRouter::response(200, ['id' => $offer->getId()]);
        }
        ApiRouter::response(404, i18n::_('api.not_found'));
    }

    public function get_profile_favorites(): void
    {
        $_favorites = defined('USERID') ? Settings::get('user_settings', 'favorites_items') : Json::decode(Session::getvar('favorites_items') ?? '[]');
        $_favorites = array_unique(array_values($_favorites));

        $favorites = [];

        foreach ($_favorites as $offer_id) {
            if ($offer = TM4RENT\Offer::get($offer_id)) {
                $favorites[] = [...$offer->toArray(), 'favorite' => true];
            }
        }

        ApiRouter::response(200, $favorites);
    }

    public function post_profile_favorite(string $id): void
    {
        if (defined('USERID')) {
            $_favorites = Settings::get('user_settings', 'favorites_items');
            $_favorites[] = $id;
            $_favorites = array_unique(array_values($_favorites));
            Settings::set('user_settings', 'favorites_items', $_favorites);
            Settings::saveUserSettings(USERID);
        } else {
            $_favorites = Json::decode(Session::getvar('favorites_items') ?? '[]');
            $_favorites[] = $id;
            $_favorites = array_unique(array_values($_favorites));
            Session::setvar('favorites_items', Json::encode($_favorites));
        }
        ApiRouter::response(200, ['id' => $id]);
    }

    public function delete_profile_favorite_ARGid(string $id): void
    {
        if (defined('USERID')) {
            $_favorites = Settings::get('user_settings', 'favorites_items');
            $key = Arrays::pathByValue($_favorites, $id);
            Arrays::delete($_favorites, $key);
            $_favorites = array_unique(array_values($_favorites));
            Settings::set('user_settings', 'favorites_items', $_favorites);
            Settings::saveUserSettings(USERID);
        } else {
            $_favorites = Json::decode(Session::getvar('favorites_items') ?? '[]');
            $key = Arrays::pathByValue($_favorites, $id);
            Arrays::delete($_favorites, $key);
            $_favorites = array_unique(array_values($_favorites));
            Session::setvar('favorites_items', Json::encode($_favorites));
        }
        ApiRouter::response(200, ['id' => $id]);
    }

    public function get_offers(string $sort = 'o.created', string $order = 'DESC', int $limit = null, int $start = null, string $search = null, ?array $filters = null): void
    {
        ApiRouter::response(200, TM4RENT\Offers::get($sort, $order, $limit, $start, $search, $filters));
    }

    public function get_categories(): void
    {
        ApiRouter::response(200, TM4RENT\ContentTypes::get(0));
    }

    public function get_brands(string $sort = 'name', string $order = 'ASC', int $limit = null, int $start = null, string $search = null): void
    {
        ApiRouter::response(200, TM4RENT\Brands::get($sort, $order, $limit, $start));
    }

}
