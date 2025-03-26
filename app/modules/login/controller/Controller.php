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
 * @since      File available since Release 1.0
 */

class LoginController extends Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        define('FULL_PAGE', true);

        // Add JS dependencies
        $files = [
            ABS_PATH . 'assets/vendors/libphonenumber/libphonenumber-max.js',
            ABS_PATH . 'assets/vendors/jquery.serializejson/jquery.serializejson.min.js',
            $this->module->uri . 'js/login.js',
        ];

        foreach ($files as $i => $file) {
            Dependencies::add(
                $file,
                $i + 100
            );
        }
    }

    /**
     * Displays Login form
     *
     * @param string|null $error error message to display
     */
    private function displayLoginForm(?string $message = null, ?string $error = null): void
    {
        // Template engine instance
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'meta');

        // Page information
        $data = [
            // Page ID
            'page' => 'login',
            // Page Title
            'page_title' => $Template->_get('login_page_title'),
        ];

        if (Request::isAjax()) {
            Router::response(!$error, $error ?? $message, Request::referrer());
        }

        // Push data to template engine
        $Template
            ->assign('data', $data)
            ->assign('message', $message)
            ->assign('error', $error)
            ->assign('content', $Template->fetch($this->module->path . '/view/index.tpl'));
    }

    /**
     * Login page (default route)
     */
    public function index(): void
    {
        // Redirect to Dashboard if already logged in and has permission to view dashboard
        if (Permissions::has('dashboard_view')) {
            Router::response(true, '', ABS_PATH . 'dashboard');
        }

        $this->displayLoginForm();
    }

    /**
     * User authentication
     */
    public function auth(): void
    {
        // Template engine instance
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'content');

        if (($user_email = Request::post('email')) && ($user_password = Request::post('password'))) {
            $keep_in = Request::post('keep_in') && ((int)Request::post('keep_in') === 1);

            switch (Auth::userLogin($user_email, $user_password, LOGIN_USER_IP, $keep_in, 3)) {
                case Auth::LOGIN_SUCCESS:
                    $redirect_link = Session::getvar('redirect_link') ?: ABS_PATH;
                    Session::delvar('redirect_link');
                    Router::response(true, '', $redirect_link);
                    break;
                case Auth::USER_INACTIVE:
                    $error_message = $Template->_get('login_user_inactive');
                    break;
                case Auth::WRONG_LOGIN:
                case Auth::WRONG_PASS:
                    $error_message = $Template->_get('login_wrong_pass');
                    break;
                case Auth::WRONG_PASS_MAX_ATTEMPTS:

                    $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'email');

                    $Template
                        ->assign('max_attempts_subject', sprintf($Template->_get('mail_max_attempts_subject'), MAX_LOGIN_ATTEMPTS))
                        ->assign('max_attempts_message', sprintf($Template->_get('mail_max_attempts_message_1'), IP::getIp(), MAX_LOGIN_ATTEMPTS));

                    $body = $Template->fetch($this->module->path . '/email/max_attempts.tpl');

                    Mailer::send(
                        $user_email,
                        $body,
                        sprintf($Template->_get('mail_max_attempts_subject'), MAX_LOGIN_ATTEMPTS),
                        '',
                        '',
                        'text/html',
                        [],
                        false,
                        false
                    );

                    $error_message = $Template->_get('wrong_pass');
                    break;
                case Auth::BLACKLISTED:
                    $error_message = $Template->_get('login_blacklisted');
                    break;
            }
        }

        $this->displayLoginForm(null, $error_message);
    }

    /**
     * User logout
     */
    public function logout(): void
    {
        Cookie::set(session_name(), '', time() - 42000, Core::getCookieDomain(), ABS_PATH);

        // Инстанс Smarty
        $Template = Template::getInstance();

        // Подгружаем файл переводов
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'main');
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'content');

        // Информация
        $data = [
            // ID навигации
            'page' => 'login',
            // Title
            'page_title' => $Template->_get('logout_title'),
            // Header
            'header' => $Template->_get('logout_title'),
            // Breadcrumbs
            'breadcrumbs' => [],
        ];

        // To Smarty
        $Template
            ->assign('data', $data)
            ->assign('content', $Template->fetch($this->module->path . '/view/logout.tpl'));
    }

    public function after_logout(): void
    {
        Auth::userLogout();
        Router::response(true, '', ABS_PATH);
    }

    /**
     * Send e-mail with password reset link.
     */
    public function reset_request(): void
    {
        $Template = Template::getInstance();
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'content');

        if (
            ($email = Valid::normalizeEmail(Request::post('email'))) &&
            (DB::exists("SELECT COUNT(email) FROM users WHERE email = ?", $email)) &&
            ($user = DB::row("SELECT * FROM users WHERE email = ? LIMIT 1", $email))
        ) {
            $expired = date(DB_DATETIME_FORMAT, strtotime('+1 hours'));
            $hash = md5($user['id'] . $email) . md5($user['id'] . strtotime($expired));

            // Generate password change link and send it to user's email
            if ($this->model->preparePassChange($email, $hash, $expired)) {
                $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'email');

                $Template
                    ->assign('ip', IP::getIp())
                    ->assign('link', sprintf($Template->_get('login_reset_mail_link'), HOST, ABS_PATH, $hash))
                    ->assign('expired', $expired);

                $body = $Template->fetch($this->module->path . '/email/reset_pass.tpl');

                Mailer::send(
                    $email,
                    $body,
                    $Template->_get('login_reset_mail_title'),
                    '',
                    '',
                    'text/html',
                    [],
                    false,
                    false
                );

                $this->displayLoginForm($Template->_get('login_reset_mail_sent'));
            }
        }

        $this->displayLoginForm(null, $Template->_get('login_wrong_email'));
    }


    /**
     * Password change form
     */
    public function change(string $hash = ''): void
    {
        sleep(3);

        if (
            ($hash)
            && ($user = DB::row("SELECT * FROM users WHERE hash = ?", Secure::sanitize($hash)))
            && (strtotime($user['hash_expire']) > time())
            && ($hash === (md5($user['id'] . $user['email']) . md5($user['id'] . strtotime($user['hash_expire']))))
        ) {
            // Template engine instance
            $Template = Template::getInstance();

            // Load i18n variables
            $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'meta');

            // Page information
            $data = [
                // Page ID
                'page' => 'login_reset',
                // Page Title
                'page_title' => $Template->_get('login_reset'),
            ];

            // Load i18n variables
            $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'content');

            // Push data to template engine
            $Template
                ->assign('data', $data)
                ->assign('email', $user['email'])
                ->assign('hash', $hash)
                ->assign('content', $Template->fetch($this->module->path . '/view/reset.tpl'));
        } else {
            Router::response(false, '', ABS_PATH . 'login');
        }
    }


    /**
     * Change password
     */
    public function change_password(): void
    {
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'content');

        if (
            Request::post('email') &&
            ($pass = Request::post('password')) &&
            ($email = Valid::normalizeEmail(Request::post('email'))) &&
            ($hash = Secure::sanitize(Request::post('hash'))) &&
            ($this->model->doPassChange($email, $hash, $pass))
        ) {
            Router::response(true, $Template->_get('login_reset_success'), ABS_PATH . 'login');
        }

        Router::response(false, '', ABS_PATH . 'login');
    }


    /**
     * Форма регистрации.
     */
    public function registration(): void
    {
        // Инстанс Smarty
        $Template = Template::getInstance();

        // Подгружаем файл переводов
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'main');

        // Информация
        $data = [
            // ID навигации
            'page' => 'login',
            // Title
            'page_title' => $Template->_get('registration_page_title'),
        ];

        // Подгружаем файл переводов
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'pages');

        // To Smarty
        $Template
            ->assign('data', $data)
            ->assign('countries', Valid::getAllCountries())
            ->assign('content', $Template->fetch($this->module->path . '/view/registration.tpl'));
    }

    public function captcha(): void
    {
        Json::output(['sid' => Request::isAjax() ? md5(Session::getid()) : '', 'cel' => '<input name="check_captcha" value="" type="hidden">'], true);
    }

    public function inn_suggestions(string $sid, string $query): void
    {
        if (
            Request::isAjax() &&
            ($sid === md5(Session::getid()))
        ) {
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
                    'count' => 10,
                    'status' => ['ACTIVE'],
                ]
            );

            if ($res) {
                $output = [];

                foreach ($res['suggestions'] as $row) {
                    $output[] = [
                        ...$row,
                        'display' => str_ireplace(
                                [
                                    'ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ',
                                    'ЗАКРЫТОЕ АКЦИОНЕРНОЕ ОБЩЕСТВО',
                                    'АКЦИОНЕРНОЕ ОБЩЕСТВО',
                                    'ИНДИВИДУАЛЬНЫЙ ПРЕДПРИНИМАТЕЛЬ',
                                ],
                                [
                                    'ООО',
                                    'ЗАО',
                                    'АО',
                                    'ИП',
                                ],
                                $row['value']
                            ) . ($row['data']['inn'] ? (' (ИНН: ' . $row['data']['inn'] . ')') : ''),
                    ];
                }

                Json::output($output, true);
            }
        }

        Json::output([], true);
    }

    /**
     * Обработка формы регистрации.
     * @throws Exception
     */
    public function register(): void
    {
        if (
            (md5(Session::getid()) === Request::post('captcha_response')) &&
            (!Request::post('check_captcha')) &&
            ($email = Valid::normalizeEmail(Request::post('email'))) &&
            ($phone = Request::post('phone')) &&
            ($code = Request::post('code')) &&
            Valid::phone($phone, $code) &&
            ($password = Request::post('password')) &&
            ($user = TM4RENT\User::create( $email, $code, $phone, $password, Request::post('lastname'), Request::post('firstname'), Request::post('patronymic'))) &&
            ($id = $user->getId())
        ) {

            // Инстанс Smarty
            $Template = Template::getInstance();

            // Подгружаем файл переводов
            $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'email');

            $Template->assign('verify_link_email', $email);
            $Template->assign('verify_link_hash', md5($email . $id));

            Mailer::send($email, $Template->fetch($this->module->path . '/email/verify_email.tpl'), $Template->_get('registration_confirm_email_subject'), '', '', 'text/html', [], false, false);

            Auth::userLogin($email, $password, false, true, 1);
        }

        Router::response(false, '', ABS_PATH);
    }

    public function send_verification_email(): void
    {
        if (Request::isAjax() && defined('USERID') && ($user = TM4RENT\User::get(USERID))) {
            if (!$user->isEmailVerified() && (time() > strtotime($user->getVerificationCodeExpire()))) {
                // Инстанс Smarty
                $Template = Template::getInstance();

                // Подгружаем файл переводов
                $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'email');

                $Template->assign('verify_link_email', $user->getEmail());
                $Template->assign('verify_link_hash', md5($user->getEmail() . $user->getId()));

                Mailer::send($user->getEmail(), $Template->fetch($this->module->path . '/email/verify_email.tpl'), $Template->_get('registration_confirm_email_subject'), '', '', 'text/html', [], false, false);

                $user->setVerificationCodeExpire(date('Y-m-d H:i:s', time() + 3600));
                $user->save();

                Response::shutDown(200);
            }

            Response::shutDown(409);
        }

        Response::shutDown(401);
    }

    public function send_verification_code(): void
    {
        if (Request::isAjax() && defined('USERID') && ($user = TM4RENT\User::get(USERID))) {
            if (!$user->isPhoneVerified() && ($phone = Valid::normalizePhone([$user->getPhone(), $user->getCountryCode()]))) {
                // Send verification code

                $_verification_code = (string)((SYSTEM_ENVIRONMENT === 'public') ? rand(1000, 9999) : 6969);

                $user->setVerificationCode($_verification_code);
                $user->setVerificationCodeExpire(date('Y-m-d H:i:s', time() + VERIFICATION_CODE_LIFETIME));

                $_verification_code_expire = date('Y-m-d H:i:s', time() + VERIFICATION_CODE_LIFETIME);
                $_phone = preg_replace("/\D+/", '', $phone);

                $user->save();

                if (
                    (SYSTEM_ENVIRONMENT !== 'public') ||
                    (
                        ($sms_aero_response = Curl::getJson(
                            'https://gate.smsaero.ru/v2/sms/send',
                            [],
                            ['number' => $_phone, 'text' => "Код: $_verification_code для подтверждения авторизации в Metrolog24", 'sign' => SMSAERO_SIGN],
                            ['user' => SMSAERO_USER, 'password' => SMSAERO_TOKEN]
                        )) &&
                        ($sms_aero_response['success']) && ($sms_aero_response['data']['id'])
                    )
                ) {
                    Response::setStatus(200);
                    Json::output(['verification_code' => $_verification_code, 'verification_code_expire' => $_verification_code_expire], true);
                }
            }

            Response::shutDown(409);
        }

        Response::shutDown(401);
    }

    public function registration_success(): void
    {
        // Инстанс Smarty
        $Template = Template::getInstance();

        // Подгружаем файл переводов
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'main');

        // Информация
        $data = [
            // ID навигации
            'page' => 'login',
            // Title
            'page_title' => $Template->_get('login_page_title'),
        ];

        // Подгружаем файл переводов
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'content');

        // To Smarty
        $Template
            ->assign('data', $data)
            ->assign('content', $Template->fetch($this->module->path . '/view/register_success.tpl'));
    }

    public function check_email(): void
    {
        $res = true;

        if (
            Request::isAjax() &&
            ($sid = Request::post('sid')) &&
            ($sid === md5(Session::getid())) &&
            ($_email = Request::post('email')) &&
            ($email = Valid::normalizeEmail($_email))
        ) {
            $res = !User::isEmailUsed($email, Request::post('user_id'));
        }

        Html::output($res ? 'true' : 'false');
        Response::shutDown();
    }

    public function check_phone(): void
    {
        $res = false;

        if (
            ($sid = Request::post('sid')) &&
            ($sid === md5(Session::getid())) &&
            ($phone = Request::post('phone')) &&
            ($code = Request::post('code')) &&
            (Valid::phone($phone, $code))
        ) {
            $res = !User::isPhoneUsed($phone, $code, Request::post('user_id'));
        }

        Html::output($res ? 'true' : 'false');
        Response::shutDown();
    }

    public function check_inn(): void
    {
        $message = null;

        if (
            Request::isAjax() &&
            ($sid = Request::post('sid')) &&
            ($sid === md5(Session::getid())) &&
            ($inn = Request::post('inn')) &&
            (Valid::inn($inn))
        ) {
            $res = Curl::postJson(
                'https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party',
                [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "Authorization: Token " . DADATA_TOKEN,
                ],
                [],
                [
                    'query' => $inn,
                    'status' => ['ACTIVE'],
                ]
            );

            if (empty($res['suggestions'])) {
                $message = 'Организация не найдена в реестрах ЕГРЮЛ и ЕГРИП налоговой службы';
            }

            if (TM4RENT\Organizations::isVerifiedExists($inn)) {
                $message = 'Организация уже зарегистрирована в системе';
            }
        }

        Html::output($message ?? 'true');
        Response::shutDown();
    }

    public function verify_email(string $email, string $hash): void
    {
        define('FULL_PAGE', true);

        if (
            ($user_id = DB::cell("SELECT id FROM users WHERE email = ? AND email_verified = 0 LIMIT 1", Valid::normalizeEmail($email))) &&
            ($hash === md5($email . $user_id))
        ) {
            DB::update('users', ['email_verified' => 1], ['id' => $user_id]);

            DB::clearCache('users');

            // Инстанс Smarty
            $Template = Template::getInstance();

            // Подгружаем файл переводов
            $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'main');
            $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'pages');

            // Mailer::send($email, $Template->fetch($this->module->path . '/email/email_verified.tpl'), 'Подтверждение email адреса', '', '', 'text/html', [], false, false);

            // Информация
            $data = [
                // ID навигации
                'page' => 'login',
                // Title
                'page_title' => $Template->_get('email_verified_title'),
                // Header
                'header' => $Template->_get('email_verified_title'),
                // Breadcrumbs
                'breadcrumbs' => [],
            ];

            // To Smarty
            $Template
                ->assign('data', $data)
                ->assign('content', $Template->fetch($this->module->path . '/view/email_verified.tpl'));
        } else {
            Router::response(false, '', ABS_PATH);
        }
    }

}