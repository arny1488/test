<?php

namespace TM4RENT;

use Arrays;
use DB;
use Dir;
use File;
use IP;
use Json;
use Loader;
use Permissions;
use Secure;
use UUID;
use Valid;

class User
{

    private string $photo;

    static array $role_ids = [4];
    static string $edit_permission = 'users_edit';

    public function __construct(
        private readonly string $id,
        private int $roleId,
        private ?string $email,
        private bool $emailVerified,
        private ?string $countryCode,
        private ?string $phone,
        private bool $phoneVerified,
        private string $password,
        private string $salt,
        private string $hash,
        private ?string $hashExpire,
        private string $verificationCode,
        private ?string $verificationCodeExpire,
        private ?string $lastname,
        private ?string $firstname,
        private ?string $patronymic,
        private ?string $ip,
        private ?string $lastActivity,
        private ?string $updated,
        private ?string $regIp,
        private ?string $registered,
        private ?string $blocked,
        private ?string $deleted,
        private int $failedLoginCount,
        private array|string|null $settings,
        private array|string|null $data,
    ) {
        $this->hashExpire = $hashExpire ? date('c', strtotime($hashExpire)) : null;
        $this->verificationCodeExpire = $verificationCodeExpire ? date('c', strtotime($verificationCodeExpire)) : null;
        $this->lastActivity = $lastActivity ? date('c', strtotime($lastActivity)) : null;
        $this->updated = $updated ? date('c', strtotime($updated)) : null;
        $this->registered = $registered ? date('c', strtotime($registered)) : null;
        $this->blocked = $blocked ? date('c', strtotime($blocked)) : null;
        $this->deleted = $deleted ? date('c', strtotime($deleted)) : null;
        $this->settings = is_string($settings) ? Json::decode($settings) : $this->settings;
        $this->data = is_string($data) ? Json::decode($data) : $data;
        if ($id && ($file = File::find(DASHBOARD_DIR . UPLOAD_DIR . '/avatars/' . File::hashPath(md5($id)) . '_*.jpg')[0] ?? null)) {
            $this->photo = HOST . ABS_PATH . trim(UPLOAD_DIR, '/') . '/avatars/' . File::hashPath(md5($id), true) . '/' . File::basename($file);
        } else {
            $this->photo = HOST . ABS_PATH . trim(UPLOAD_DIR, '/') . '/avatars/default.jpg';
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function isEmailVerified(): bool
    {
        return $this->emailVerified;
    }

    public function setEmailVerified(bool $emailVerified): void
    {
        $this->emailVerified = $emailVerified;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function isPhoneVerified(): bool
    {
        return $this->phoneVerified;
    }

    public function setPhoneVerified(bool $phoneVerified): void
    {
        $this->phoneVerified = $phoneVerified;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getSalt(): string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): void
    {
        $this->salt = $salt;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    public function getHashExpire(): ?string
    {
        return $this->hashExpire;
    }

    public function setHashExpire(?string $hashExpire): void
    {
        $this->hashExpire = $hashExpire ? date('c', strtotime($hashExpire)) : null;
    }

    public function getVerificationCode(): string
    {
        return $this->verificationCode;
    }

    public function setVerificationCode(string $verificationCode): void
    {
        $this->verificationCode = $verificationCode;
    }

    public function getVerificationCodeExpire(): ?string
    {
        return $this->verificationCodeExpire;
    }

    public function setVerificationCodeExpire(?string $verificationCodeExpire): void
    {
        $this->verificationCodeExpire = $verificationCodeExpire ? date('c', strtotime($verificationCodeExpire)) : null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function setPatronymic(?string $patronymic): void
    {
        $this->patronymic = $patronymic;
    }

    public function getFullName(): string
    {
        return trim(implode(' ', array_filter([$this->lastname, $this->firstname, $this->patronymic])));
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): void
    {
        $this->ip = $ip;
    }

    public function getLastActivity(): ?string
    {
        return $this->lastActivity;
    }

    public function setLastActivity(?string $lastActivity): void
    {
        $this->lastActivity = $lastActivity ? date('c', strtotime($lastActivity)) : null;
    }

    public function getUpdated(): ?string
    {
        return $this->updated;
    }

    public function setUpdated(?string $updated): void
    {
        $this->updated = $updated ? date('c', strtotime($updated)) : null;
    }

    public function getRegIp(): ?string
    {
        return $this->regIp;
    }

    public function setRegIp(?string $regIp): void
    {
        $this->regIp = $regIp;
    }

    public function getRegistered(): ?string
    {
        return $this->registered;
    }

    public function setRegistered(?string $registered): void
    {
        $this->registered = $registered ? date('c', strtotime($registered)) : null;
    }

    public function getBlocked(): ?string
    {
        return $this->blocked;
    }

    public function setBlocked(?string $blocked): void
    {
        $this->blocked = $blocked ? date('c', strtotime($blocked)) : null;
    }

    public function getDeleted(): ?string
    {
        return $this->deleted;
    }

    public function setDeleted(?string $deleted): void
    {
        $this->deleted = $deleted ? date('c', strtotime($deleted)) : null;
    }

    public function isActive(): bool
    {
        return !$this->blocked && !$this->deleted;
    }

    public function activate(): void
    {
        $this->setBlocked(null);
    }

    public function block(): void
    {
        $this->setBlocked(date('c'));
    }

    public function delete(): void
    {
        $this->setBlocked(date('c'));
        $this->setDeleted(date('c'));
    }

    public function getFailedLoginCount(): int
    {
        return $this->failedLoginCount;
    }

    public function setFailedLoginCount(int $failedLoginCount): void
    {
        $this->failedLoginCount = $failedLoginCount;
    }

    public function getSettings(): ?string
    {
        return $this->settings;
    }

    public function setSettings(string|array|null $settings): void
    {
        $this->settings = is_string($settings) ? Json::decode($settings) : $settings;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string|array|null $data): void
    {
        $this->data = is_string($data) ? Json::decode($data) : $data;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public static function get(string $id): ?static
    {
        $statement = DB::statement()->with("`id` = ?", $id);

        if (!empty(static::$role_ids)) {
            $statement->andIn("`role_id` IN (?*)", static::$role_ids);
        }

        if (
            ($row = DB::row("SELECT * FROM `users` WHERE $statement", ...$statement->values()))
        ) {
            return new static(
                $row['id'],
                $row['role_id'],
                $row['email'],
                $row['email_verified'],
                $row['country_code'],
                $row['phone'],
                $row['phone_verified'],
                $row['password'],
                $row['salt'],
                $row['hash'],
                $row['hash_expire'],
                $row['verification_code'],
                $row['verification_code_expire'],
                $row['lastname'],
                $row['firstname'],
                $row['patronymic'],
                $row['ip'],
                $row['last_activity'],
                $row['updated'],
                $row['reg_ip'],
                $row['registered'],
                $row['blocked'],
                $row['deleted'],
                $row['failed_login_count'],
                $row['settings'],
                $row['data']
            );
        }

        return null;
    }

    public function toArray(string $date_format = 'c'): array
    {
        return [
            'id' => $this->id,
            'role_id' => $this->roleId,
            'email' => $this->email,
            'email_verified' => $this->emailVerified,
            'country_code' => $this->countryCode,
            'phone' => $this->phone,
            'phone_verified' => $this->phoneVerified,
            'password' => $this->password,
            'salt' => $this->salt,
            'hash' => $this->hash,
            'hash_expire' => $this->hashExpire ? date($date_format, strtotime($this->hashExpire)) : null,
            'verification_code' => $this->verificationCode,
            'verification_code_expire' => $this->verificationCodeExpire ? date($date_format, strtotime($this->verificationCodeExpire)) : null,
            'lastname' => $this->lastname ?: null,
            'firstname' => $this->firstname ?: null,
            'patronymic' => $this->patronymic ?: null,
            'fullname' => $this->getFullName(),
            'ip' => $this->ip,
            'last_activity' => $this->lastActivity ? date($date_format, strtotime($this->lastActivity)) : null,
            'updated' => $this->updated ? date($date_format, strtotime($this->updated)) : null,
            'reg_ip' => $this->regIp,
            'registered' => $this->registered ? date($date_format, strtotime($this->registered)) : null,
            'blocked' => $this->blocked ? date($date_format, strtotime($this->blocked)) : null,
            'deleted' => $this->deleted ? date($date_format, strtotime($this->deleted)) : null,
            'active' => $this->isActive(),
            'failed_login_count' => $this->failedLoginCount,
            'settings' => $this->settings ? Json::encode($this->settings) : null,
            'data' => $this->data ? Json::encode($this->data) : null,
            'photo' => $this->photo,
            'is_editable' => Permissions::has(static::$edit_permission) && ($this->id !== USERID),
            'is_deletable' => Permissions::has(static::$edit_permission) && ($this->id !== USERID),
        ];
    }

    public function save(): bool
    {
        $this->setUpdated(date('c'));
        $update_data = self::toArray(DB_DATETIME_FORMAT);
        Arrays::filterKeys($update_data, ['id', 'fullname', 'photo', 'active', 'is_editable', 'is_deletable'], true);
        return DB::update('users', $update_data, ['id' => $this->id]);
    }

    public function uploadPhoto(string $base64photo): bool
    {
        if ($this->id && ($img_decoded = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64photo)))) {
            Loader::addDirectory(DASHBOARD_DIR . '/libraries/ImageProcessing/');

            $_tmp_file = DASHBOARD_DIR . TEMP_DIR . UPLOAD_DIR . '/' . md5($this->id) . '.jpg';
            $_new_file = DASHBOARD_DIR . UPLOAD_DIR . '/avatars/' . File::hashPath(md5($this->id) . '_' . sprintf('%08x', time()) . '.jpg');

            Dir::create(File::path($_new_file));

            File::putContents($_tmp_file, $img_decoded);

            if (File::mime($_tmp_file) === 'image/jpeg') {
                // Delete all old photos
                foreach (File::find(DASHBOARD_DIR . UPLOAD_DIR . '/avatars/' . File::hashPath(md5($this->id) . '_*.jpg')) as $file) {
                    File::delete($file);
                }

                $_new_img = \WideImage\WideImage::loadFromString($img_decoded);
                $_new_img
                    ->resize(1000, 1000, 'outside')
                    ->saveToFile($_new_file, 80);

                File::delete($_tmp_file);

                return true;
            }

            File::delete($_tmp_file);
        }

        return false;
    }

    public static function create(
        string $email,
        string $countryCode,
        string $phone,
        string $password,
        ?string $lastname,
        ?string $firstname,
        ?string $patronymic,
    ): ?static {
        if (
            (Valid::email($email)) &&
            (Valid::phone($phone, $countryCode)) &&
            ($password) &&
            (!\User::isEmailUsed($email)) &&
            (!\User::isPhoneUsed($phone, $countryCode)) &&
            ($salt = Secure::randomString()) &&
            ($password_hash = password_hash(hash_hmac("sha256", $password, $salt . PWD_PEPPER), PASSWORD_ARGON2ID)) &&
            ($id = DB::insertGet(
                "users",
                [
                    "role_id" => 4,
                    "email" => $email,
                    "country_code" => $countryCode,
                    "phone" => $phone,
                    "password" => $password_hash,
                    "salt" => $salt,
                    "lastname" => $lastname,
                    "firstname" => $firstname,
                    "patronymic" => $patronymic,
                    "registered" => date(DB_DATETIME_FORMAT),
                    "reg_ip" => IP::getIp(),
                ],
                "id"
            ))
        ) {
            return static::get($id);
        }

        return null;
    }

}
