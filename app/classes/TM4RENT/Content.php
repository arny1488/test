<?php

namespace TM4RENT;

use Arrays;
use DB;
use Dir;
use File;
use Json;

class Content
{

    public $brand;
    private $files;

    public function __construct(
        private readonly string $id,
        private string $brandId,
        private array $typeIds,
        private string $name,
        private ?string $description,
        private ?string $document,
        private ?string $created,
        private ?string $deleted,
        private ?string $approved,
        private ?string $archived,
    ) {
        $this->brand = Brand::get($this->brandId);
        $this->created = $created ? date('c', strtotime($created)) : null;
        $this->deleted = $deleted ? date('c', strtotime($deleted)) : null;
        $this->approved = $approved ? date('c', strtotime($approved)) : null;
        $this->archived = $archived ? date('c', strtotime($archived)) : null;
        $this->typeIds = array_values(array_map('intval', $typeIds));
        $this->files = $this->getFiles([0, 1, 2]);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBrandId(): string
    {
        return $this->brandId;
    }

    public function setBrandId(string $brandId): void
    {
        $this->brandId = $brandId;
    }

    public function getTypeIds(): array
    {
        return $this->typeIds;
    }

    public function setTypeIds(array $typeIds): void
    {
        $this->typeIds = array_values(array_map('intval', $typeIds));
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): void
    {
        $this->document = $document;
    }

    public function getCreated(): ?string
    {
        return $this->created;
    }

    public function setCreated(?string $created): void
    {
        $this->created = $created;
    }

    public function getDeleted(): ?string
    {
        return $this->deleted;
    }

    public function setDeleted(?string $deleted): void
    {
        $this->deleted = $deleted;
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
        $this->approved = $approved;
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
        $this->archived = $archived;
    }

    public function isArchived(): bool
    {
        return (bool)$this->archived;
    }

    public static function get(string $id): ?static
    {
        if ($row = DB::row("SELECT * FROM content WHERE id = ? LIMIT 1", $id)) {
            return new static(
                $row['id'],
                $row['brand_id'],
                Json::decode($row['type_ids']),
                $row['name'],
                $row['description'],
                $row['document'],
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
            'brand_id' => $this->brandId,
            'brand' => $this->brand->toArray(),
            'type_ids' => $forDB ? Json::encode($this->typeIds, JSON_UNESCAPED_UNICODE) : $this->typeIds,
            'name' => $this->name,
            'description' => $this->description,
            'document' => $this->document,
            'created' => $this->created ? date($date_format, strtotime($this->created)) : null,
            'deleted' => $this->deleted ? date($date_format, strtotime($this->deleted)) : null,
            'approved' => $this->approved ? date($date_format, strtotime($this->approved)) : null,
            'archived' => $this->archived ? date($date_format, strtotime($this->archived)) : null,
            'files' => $this->files,
        ];
    }

    public function save(): bool
    {
        $update_data = $this->toArray(DB_DATETIME_FORMAT, true);
        Arrays::filterKeys($update_data, ['id', 'brand', 'files'], true);
        return DB::update('content', $update_data, ['id' => $this->id]);
    }

    public static function create(
        string $brandId,
        array $typeIds,
        string $name,
        ?string $description,
        ?string $document,
    ): ?static {
        if (
            ($content_id = DB::insertGet(
                'content',
                [
                    'brand_id' => $brandId,
                    'type_ids' => $typeIds ? Json::encode(array_values(array_map('intval', $typeIds)), JSON_UNESCAPED_UNICODE) : null,
                    'name' => $name,
                    'description' => $description,
                    'document' => $document,
                    'created' => date(DB_DATETIME_FORMAT),
                ],
                'id'
            ))
        ) {
            return static::get($content_id);
        }

        return null;
    }

    public function getFile(string $id, array $status = [0, 1, 2, 3]): ?array
    {
        $res = null;

        if ($row = DB::row("SELECT * FROM content_files WHERE id = ? AND status IN (" . implode(',', $status) . ") LIMIT 1", $id)) {
            $res = [
                'id' => $row['id'],
                'content_id' => $row['content_id'],
                'filename' => $row['filename'],
                'file' => pathinfo(urldecode($row['original_filename']), PATHINFO_BASENAME),
                'mime' => $row['mime'],
                'hash' => $row['hash'],
                'size' => $row['size'],
                'copyright' => $row['copyright'] ?? '',
            ];
        }

        return $res;
    }

    public function getFiles(array $status = [0, 1, 2, 3]): ?array
    {
        $res = [];

        $rows = DB::query("SELECT * FROM content_files WHERE content_id = ? AND status IN (" . implode(',', $status) . ") ORDER BY position", $this->id);

        foreach ($rows as $row) {
            $res[] = [
                'id' => $row['id'],
                'position' => $row['position'],
                'content_id' => $row['content_id'],
                'filename' => $row['filename'],
                'file' => pathinfo(urldecode($row['original_filename']), PATHINFO_BASENAME),
                'mime' => $row['mime'],
                'hash' => $row['hash'],
                'size' => $row['size'],
                'copyright' => $row['copyright'] ?? '',
                'thumb150' => File::exists(DASHBOARD_DIR . '/uploads/converted/' . File::hashPath($row['filename']) . '_150.jpg') ? ABS_PATH . 'uploads/converted/' . File::hashPath($row['filename']) . '_150.jpg' : null,
                'thumb360' => File::exists(DASHBOARD_DIR . '/uploads/converted/' . File::hashPath($row['filename']) . '_360.jpg') ? ABS_PATH . 'uploads/converted/' . File::hashPath($row['filename']) . '_360.jpg' : null,
                'thumb720' => File::exists(DASHBOARD_DIR . '/uploads/converted/' . File::hashPath($row['filename']) . '_720.jpg') ? ABS_PATH . 'uploads/converted/' . File::hashPath($row['filename']) . '_720.jpg' : null,
                'thumb1280' => File::exists(DASHBOARD_DIR . '/uploads/converted/' . File::hashPath($row['filename']) . '_1280.jpg') ? ABS_PATH . 'uploads/converted/' . File::hashPath($row['filename']) . '_1280.jpg' : null,
                'video1280' => str_starts_with($row['mime'], 'video/')
                    ? File::exists(DASHBOARD_DIR . '/uploads/converted/' . File::hashPath($row['filename']) . '.mp4') ? ABS_PATH . 'uploads/converted/' . File::hashPath($row['filename']) . '.mp4' : null
                    : null,
                'audio1280' => str_starts_with($row['mime'], 'audio/')
                    ? File::exists(DASHBOARD_DIR . '/uploads/converted/' . File::hashPath($row['filename']) . '.mp3') ? ABS_PATH . 'uploads/converted/' . File::hashPath($row['filename']) . '.mp3' : null
                    : null,
            ];
        }

        return $res;
    }

    public function addFile(string $filename, string $mime, string $hash, string $original_filename, int $size = 0, int $status = 0): ?string
    {
        $file_id = DB::insertGet(
            'content_files',
            [
                'content_id' => $this->id,
                'filename' => $filename,
                'original_filename' => $original_filename,
                'mime' => $mime,
                'hash' => $hash,
                'size' => $size,
                'status' => $status,
            ],
            'id'
        );

        return $file_id ?: null;
    }

    public function removeFile(string $id): bool
    {
        if (self::getFile($id)) {
            return (bool)DB::update(
                'content_files',
                ['status' => 3],
                ['id' => $id]
            );
        }

        return false;
    }

    public function deleteFile(string $id): bool
    {
        if ($doc = self::getFile($id)) {
            File::delete([
                DASHBOARD_DIR . '/uploads/content/' . $this->id . '/' . $doc['filename'] . '.file',
                DASHBOARD_DIR . '/uploads/converted/' . File::hashPath($doc['filename']) . '*.jpg',
                DASHBOARD_DIR . '/uploads/converted/' . File::hashPath($doc['filename']) . '*.mp4',
            ]);
        }

        return (bool)DB::delete(
            'content_files',
            ['id' => $id]
        );
    }

    public function deleteAllFiles(): bool
    {
        $files = DB::query("SELECT id FROM content_files WHERE content_id = ?", $this->id);

        foreach ($files as $file) {
            self::deleteFile($file['id']);
        }

        Dir::delete(DASHBOARD_DIR . '/uploads/content/' . $this->id);

        return (bool)DB::delete(
            'content_files',
            ['content_id' => $this->id]
        );
    }

}