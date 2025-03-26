<?php

namespace TM4RENT;

use Arrays;
use DB;
use Json;

class Organization
{

    public function __construct(
        private readonly string $id,
        private readonly string $userId,
        private int $typeId,
        private ?string $name,
        private ?string $inn,
        private string $registered,
        private ?string $verified,
        private ?string $blocked,
        private ?string $deleted,
        private array|string|null $documents,
        private array|string|null $details,
        private array|string|null $banks,
    ) {
        $this->registered = date('c', strtotime($registered));
        $this->verified = $verified ? date('c', strtotime($verified)) : null;
        $this->blocked = $blocked ? date('c', strtotime($blocked)) : null;
        $this->deleted = $deleted ? date('c', strtotime($deleted)) : null;
        $this->documents = is_string($documents) ? Json::decode($documents) : $documents;
        $this->details = is_string($details) ? Json::decode($details) : $details;
        $this->banks = is_string($banks) ? Json::decode($banks) : $banks;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function setTypeId(int $typeId): void
    {
        $this->typeId = $typeId;
    }

    public function getInn(): string
    {
        return $this->inn;
    }

    public function setInn(string $inn): void
    {
        $this->inn = $inn;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string|null $name): void
    {
        $this->name = $name;
    }

    public function getRegistered(): string
    {
        return $this->registered;
    }

    public function setRegistered(string $registered): void
    {
        $this->registered = date('c', strtotime($registered));
    }

    /**
     * @return string|null
     */
    public function getVerified(): ?string
    {
        return $this->verified;
    }

    /**
     * @param string|null $verified
     */
    public function setVerified(?string $verified): void
    {
        $this->verified = $verified ? date('c', strtotime($verified)) : null;
    }

    /**
     * @return string|null
     */
    public function getBlocked(): ?string
    {
        return $this->blocked;
    }

    /**
     * @param string|null $blocked
     */
    public function setBlocked(?string $blocked): void
    {
        $this->blocked = $blocked ? date('c', strtotime($blocked)) : null;
    }

    /**
     * @return string|null
     */
    public function getDeleted(): ?string
    {
        return $this->deleted;
    }

    /**
     * @param string|null $deleted
     */
    public function setDeleted(?string $deleted): void
    {
        $this->deleted = $deleted ? date('c', strtotime($deleted)) : null;
    }

    public function isActive(): bool
    {
        return !$this->blocked && !$this->deleted;
    }

    public function getDocuments(): array|string|null
    {
        return $this->documents;
    }

    public function setDocuments(array|string|null $documents): void
    {
        $this->documents = is_string($documents) ? Json::decode($documents) : $documents;
    }

    /**
     * @return array|null
     */
    public function getDetails(): ?array
    {
        return $this->details;
    }

    /**
     * @param array|string|null $details
     */
    public function setDetails(array|string|null $details): void
    {
        $this->details = is_string($details) ? Json::decode($details) : $details;
    }

    public function getBanks(): array|string|null
    {
        return $this->banks;
    }

    public function setBanks(array|string|null $banks): void
    {
        $this->banks = is_string($banks) ? Json::decode($banks) : $banks;
    }

    public function toArray(string $date_format = 'c', bool $forDB = false): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userId,
            'type_id' => $this->typeId,
            'inn' => $this->inn,
            'name' => $this->name,
            'registered' => date($date_format, strtotime($this->registered)),
            'verified' => $this->verified ? date($date_format, strtotime($this->verified)) : null,
            'blocked' => $this->blocked ? date($date_format, strtotime($this->blocked)) : null,
            'deleted' => $this->deleted ? date($date_format, strtotime($this->deleted)) : null,
            'documents' => $forDB ? ($this->documents ? Json::encode($this->documents, JSON_UNESCAPED_UNICODE) : null) : $this->documents,
            'details' => $forDB ? ($this->details ? Json::encode($this->details, JSON_UNESCAPED_UNICODE) : null) : $this->details,
            'banks' => $forDB ? ($this->banks ? Json::encode($this->banks, JSON_UNESCAPED_UNICODE) : null) : $this->banks,
        ];
    }

    public function save(): bool
    {
        $update_data = $this->toArray(DB_DATETIME_FORMAT, true);
        Arrays::deleteKey($update_data, 'id');
        return DB::update('organizations', $update_data, ['id' => $this->id]);
    }

    public static function create(string $userId, int $typeId, string $name, string $inn, ?array $documents = null, ?array $details = null, ?array $banks = null): ?static
    {
        if (
            ($registration_date = time()) &&
            ($organization_id = DB::insertGet(
                'organizations',
                [
                    'user_id' => $userId,
                    'type_id' => $typeId,
                    'name' => $name,
                    'inn' => $inn,
                    'documents' => $documents ? Json::encode($documents, JSON_UNESCAPED_UNICODE) : null,
                    'details' => $details ? Json::encode($details, JSON_UNESCAPED_UNICODE) : null,
                    'banks' => $banks ? Json::encode($banks, JSON_UNESCAPED_UNICODE) : null,
                    'registered' => date(DB_DATETIME_FORMAT, $registration_date),
                ],
                'id'
            ))
        ) {
            return static::get($organization_id);
        }

        return null;
    }

    public static function get(string $id): ?static
    {
        if ($row = DB::row("SELECT * FROM organizations WHERE id = ? LIMIT 1", $id)) {
            return new static(
                $row['id'],
                $row['user_id'],
                $row['type_id'],
                $row['name'],
                $row['inn'],
                $row['registered'],
                $row['verified'],
                $row['blocked'],
                $row['deleted'],
                $row['documents'],
                $row['details'],
                $row['banks'],
            );
        }

        return null;
    }

}
