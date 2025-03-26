<?php

namespace TM4RENT;

use Arrays;
use DB;
use Json;
use File;
use Loader;
use Dir;

class Brand
{

    private ?string $logotype = null;

    public function __construct(
        private readonly string $id,
        private string $organizationId,
        private int $countryId,
        private string $name,
        private ?string $document,
        private ?string $description,
        private ?array $notorietyIds,
        private bool $licensor,
        private bool $licensee,
        private bool $fund,
        private bool $top,
        private ?string $created,
        private ?string $deleted,
        private ?string $approved,
        private ?string $archived,
    ) {
        $this->created = $created ? date('c', strtotime($created)) : null;
        $this->deleted = $deleted ? date('c', strtotime($deleted)) : null;
        $this->approved = $approved ? date('c', strtotime($approved)) : null;
        $this->archived = $archived ? date('c', strtotime($archived)) : null;
        if (is_array($notorietyIds)) {
            $this->notorietyIds = array_values(array_map('intval', $notorietyIds));
        }
        if ($id && ($file = File::find(DASHBOARD_DIR . UPLOAD_DIR . '/brands/' . File::hashPath(md5($id)) . '_*.png')[0] ?? null)) {
            $this->logotype = HOST . ABS_PATH . trim(UPLOAD_DIR, '/') . '/brands/' . File::hashPath(md5($id), true) . '/' . File::basename($file);
        } else {
            $this->logotype = HOST . ABS_PATH . 'assets/images/noimage_1x1.png';
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOrganizationId(): string
    {
        return $this->organizationId;
    }

    public function setOrganizationId(string $organizationId): void
    {
        $this->organizationId = $organizationId;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): void
    {
        $this->countryId = $countryId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLogotype(): ?string
    {
        return $this->logotype;
    }

    public function uploadLogotype(string $base64image): bool
    {
        if ($this->id && ($img_decoded = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64image)))) {
            Loader::addDirectory(DASHBOARD_DIR . '/libraries/ImageProcessing/');

            $_tmp_file = DASHBOARD_DIR . TEMP_DIR . UPLOAD_DIR . '/' . md5($this->id) . '.png';
            $_new_file = DASHBOARD_DIR . UPLOAD_DIR . '/brands/' . File::hashPath(md5($this->id) . '_' . sprintf('%08x', time()) . '.png');

            Dir::create(File::path($_new_file));

            File::putContents($_tmp_file, $img_decoded);

            if (File::mime($_tmp_file) === 'image/png') {
                // Delete all old photos
                foreach (File::find(DASHBOARD_DIR . UPLOAD_DIR . '/brands/' . File::hashPath(md5($this->id) . '_*.png')) as $file) {
                    File::delete($file);
                }

                $_new_img = \WideImage\WideImage::loadFromString($img_decoded);
                $_new_img
                    ->resize(1000, 1000, 'inside')
                    ->saveToFile($_new_file);

                File::delete($_tmp_file);

                return true;
            }

            File::delete($_tmp_file);
        }

        return false;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): void
    {
        $this->document = $document;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getNotorietyIds(): ?array
    {
        return $this->notorietyIds;
    }

    public function setNotorietyIds(?array $notorietyIds): void
    {
        if (is_array($notorietyIds)) {
            $this->notorietyIds = array_values(array_map('intval', $notorietyIds));
        } else {
            $this->notorietyIds = null;
        }
    }

    public function isLicensor(): bool
    {
        return $this->licensor;
    }

    public function setLicensor(bool $licensor): void
    {
        $this->licensor = $licensor;
    }

    public function isLicensee(): bool
    {
        return $this->licensee;
    }

    public function setLicensee(bool $licensee): void
    {
        $this->licensee = $licensee;
    }

    public function isFund(): bool
    {
        return $this->fund;
    }

    public function setFund(bool $fund): void
    {
        $this->fund = $fund;
    }

    public function isTop(): bool
    {
        return $this->top;
    }

    public function setTop(bool $top): void
    {
        $this->top = $top;
    }

    public function getCreated(): ?string
    {
        return $this->created;
    }

    public function setCreated(?string $created): void
    {
        $this->created = $created ? date('c', strtotime($created)) : null;
    }

    public function getDeleted(): ?string
    {
        return $this->deleted;
    }

    public function setDeleted(?string $deleted): void
    {
        $this->deleted = $deleted ? date('c', strtotime($deleted)) : null;
    }

    public function isDeleted(): bool
    {
        return (bool)$this->deleted;
    }

    public function getApproved(): ?string
    {
        return $this->approved;
    }

    public function setApproved(?string $approved): void
    {
        $this->approved = $approved ? date('c', strtotime($approved)) : null;
    }

    public function isApproved(): bool
    {
        return (bool)$this->approved;
    }

    public function getArchived(): ?string
    {
        return $this->archived;
    }

    public function setArchived(?string $archived): void
    {
        $this->archived = $archived ? date('c', strtotime($archived)) : null;
    }

    public function isArchived(): bool
    {
        return (bool)$this->archived;
    }

    public static function get(string $id): ?static
    {
        if ($row = DB::row("SELECT * FROM brands WHERE id = ? LIMIT 1", $id)) {
            return new static(
                $row['id'],
                $row['organization_id'],
                $row['country_id'],
                $row['name'],
                $row['document'],
                $row['description'],
                Json::decode($row['notoriety_ids']),
                $row['licensor'],
                $row['licensee'],
                $row['fund'],
                $row['top'],
                $row['created'],
                $row['deleted'],
                $row['approved'],
                $row['archived'],
            );
        }

        return null;
    }

    public function toArray(string $date_format = 'c', bool $forDB = false): array
    {
        return [
            'id' => $this->id,
            'organization_id' => $this->organizationId,
            'country_id' => $this->countryId,
            'name' => $this->name,
            'logotype' => $this->logotype,
            'document' => $this->document,
            'description' => $this->description,
            'notoriety_ids' => $forDB ? Json::encode($this->notorietyIds, JSON_UNESCAPED_UNICODE) : $this->notorietyIds,
            'licensor' => $this->licensor,
            'licensee' => $this->licensee,
            'fund' => $this->fund,
            'top' => $this->top,
            'created' => $this->created ? date($date_format, strtotime($this->created)) : null,
            'deleted' => $this->deleted ? date($date_format, strtotime($this->deleted)) : null,
            'approved' => $this->approved ? date($date_format, strtotime($this->approved)) : null,
            'archived' => $this->archived ? date($date_format, strtotime($this->archived)) : null,
        ];
    }

    public function save(): bool
    {
        $update_data = $this->toArray(DB_DATETIME_FORMAT, true);
        Arrays::filterKeys($update_data, ['id', 'logotype'], true);
        return DB::update('brands', $update_data, ['id' => $this->id]);
    }

    public static function create(
        string $organizationId,
        int $countryId,
        string $name,
        ?string $document,
        ?string $description,
        ?array $notorietyIds,
        bool $licensor,
        bool $licensee,
        bool $fund,
        bool $top,
    ): ?static {
        if (
            ($brand_id = DB::insertGet(
                'brands',
                [
                    'organization_id' => $organizationId,
                    'country_id' => $countryId,
                    'name' => $name,
                    'document' => $document,
                    'description' => $description,
                    'notoriety_ids' => $notorietyIds ? Json::encode(array_values(array_map('intval', $notorietyIds)), JSON_UNESCAPED_UNICODE) : null,
                    'licensor' => $licensor,
                    'licensee' => $licensee,
                    'fund' => $fund,
                    'top' => $top,
                    'created' => date(DB_DATETIME_FORMAT),
                ],
                'id'
            ))
        ) {
            return static::get($brand_id);
        }

        return null;
    }

}