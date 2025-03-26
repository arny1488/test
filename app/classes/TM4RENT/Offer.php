<?php

namespace TM4RENT;

use Arrays;
use DB;
use Json;
use Settings;
use Session;

class Offer
{

    public Content $content;

    public function __construct(
        private readonly string $id,
        private string $contentId,
        private string $description,
        private float $price,
        private ?int $termMin,
        private ?int $termMax,
        private bool $termless,
        private ?array $allowedForIds,
        private ?array $applicationIds,
        private int $countryId,
        private ?array $regionIds,
        private ?array $placementIds,
        private bool $exclusive,
        private bool $fastDeal,
        private bool $charity,
        private ?string $fundId,
        private ?float $charityPercent,
        private ?float $charitySum,
        private bool $contractAccepted,
        private int $viewCount,
        private ?string $created,
        private ?string $deleted,
        private ?string $approved,
        private ?string $archived,
    ) {
        $this->content = Content::get($contentId);
        $this->created = $created ? date('c', strtotime($created)) : null;
        $this->deleted = $deleted ? date('c', strtotime($deleted)) : null;
        $this->approved = $approved ? date('c', strtotime($approved)) : null;
        $this->archived = $archived ? date('c', strtotime($archived)) : null;
        if (is_array($allowedForIds)) {
            $this->allowedForIds = array_values(array_map('intval', $allowedForIds));
        }
        if (is_array($applicationIds)) {
            $this->applicationIds = array_values(array_map('intval', $applicationIds));
        }
        if (is_array($regionIds)) {
            $this->regionIds = array_values(array_map('intval', $regionIds));
        }
        if (is_array($placementIds)) {
            $this->placementIds = array_values(array_map('intval', $placementIds));
        }
        if ($termless) {
            $this->termMin = null;
            $this->termMax = null;
        }
        if (!$charity) {
            $this->fundId = null;
            $this->charityPercent = null;
            $this->charitySum = null;
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getContentId(): string
    {
        return $this->contentId;
    }

    public function setContentId(string $contentId): void
    {
        $this->contentId = $contentId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getTermMin(): ?int
    {
        return $this->termMin;
    }

    public function setTermMin(?int $termMin): void
    {
        $this->termMin = $termMin;
    }

    public function getTermMax(): ?int
    {
        return $this->termMax;
    }

    public function setTermMax(?int $termMax): void
    {
        $this->termMax = $termMax;
    }

    public function isTermless(): bool
    {
        return $this->termless;
    }

    public function setTermless(bool $termless): void
    {
        $this->termless = $termless;
    }

    public function getAllowedForIds(): ?array
    {
        return $this->allowedForIds;
    }

    public function setAllowedForIds(?array $allowedForIds): void
    {
        if (is_array($allowedForIds)) {
            $this->allowedForIds = array_values(array_map('intval', $allowedForIds));
        }
    }

    public function getApplicationIds(): ?array
    {
        return $this->applicationIds;
    }

    public function setApplicationIds(?array $applicationIds): void
    {
        if (is_array($applicationIds)) {
            $this->applicationIds = array_values(array_map('intval', $applicationIds));
        }
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): void
    {
        $this->countryId = $countryId;
    }

    public function getRegionIds(): ?array
    {
        return $this->regionIds;
    }

    public function setRegionIds(?array $regionIds): void
    {
        if (is_array($regionIds)) {
            $this->regionIds = array_values(array_map('intval', $regionIds));
        }
    }

    public function getPlacementIds(): ?array
    {
        return $this->placementIds;
    }

    public function setPlacementIds(?array $placementIds): void
    {
        if (is_array($placementIds)) {
            $this->placementIds = array_values(array_map('intval', $placementIds));
        }
    }

    public function isExclusive(): bool
    {
        return $this->exclusive;
    }

    public function setExclusive(bool $exclusive): void
    {
        $this->exclusive = $exclusive;
    }

    public function isFastDeal(): bool
    {
        return $this->fastDeal;
    }

    public function setFastDeal(bool $fastDeal): void
    {
        $this->fastDeal = $fastDeal;
    }

    public function isCharity(): bool
    {
        return $this->charity;
    }

    public function setCharity(bool $charity): void
    {
        $this->charity = $charity;
    }

    public function getFundId(): ?string
    {
        return $this->fundId;
    }

    public function setFundId(?string $fundId): void
    {
        $this->fundId = $fundId;
    }

    public function getCharityPercent(): ?float
    {
        return $this->charityPercent;
    }

    public function setCharityPercent(?float $charityPercent): void
    {
        $this->charityPercent = $charityPercent;
    }

    public function getCharitySum(): ?float
    {
        return $this->charitySum;
    }

    public function setCharitySum(?float $charitySum): void
    {
        $this->charitySum = $charitySum;
    }

    public function isContractAccepted(): bool
    {
        return $this->contractAccepted;
    }

    public function setContractAccepted(bool $contractAccepted): void
    {
        $this->contractAccepted = $contractAccepted;
    }

    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    public function setViewCount(int $viewCount): void
    {
        $this->viewCount = $viewCount;
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
        if ($row = DB::row("SELECT * FROM offers WHERE id = ? LIMIT 1", $id)) {
            return new static(
                $row['id'],
                $row['content_id'],
                $row['description'],
                $row['price'],
                $row['term_min'],
                $row['term_max'],
                $row['termless'],
                Json::decode($row['allowed_for_ids']),
                Json::decode($row['application_ids']),
                $row['country_id'],
                Json::decode($row['region_ids']),
                Json::decode($row['placement_ids']),
                $row['exclusive'],
                $row['fast_deal'],
                $row['charity'],
                $row['fund_id'],
                $row['charity_percent'],
                $row['charity_sum'],
                $row['contract_accepted'],
                $row['view_count'],
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

        $_favorites = defined('USERID')
            ? (Settings::get('user_settings', 'favorites_items') ?? [])
            : Json::decode(Session::getvar('favorites_items') ?? '[]');

        return [
            'id' => $this->id,
            'content_id' => $this->contentId,
            'content' => $forDB ? null : $this->content->toArray(),
            'description' => $this->description,
            'price' => $this->price,
            'term_min' => $this->termMin,
            'term_max' => $this->termMax,
            'termless' => $this->termless,
            'allowed_for_ids' => $forDB ? Json::encode(array_map('intval', $this->allowedForIds)) : $this->allowedForIds,
            'application_ids' => $forDB ? Json::encode(array_map('intval', $this->applicationIds)) : $this->applicationIds,
            'country_id' => $this->countryId,
            'region_ids' => $forDB ? Json::encode(array_map('intval', $this->regionIds)) : $this->regionIds,
            'placement_ids' => $forDB ? Json::encode(array_map('intval', $this->placementIds)) : $this->placementIds,
            'exclusive' => $this->exclusive,
            'fast_deal' => $this->fastDeal,
            'charity' => $this->charity,
            'fund_id' => $this->fundId,
            'charity_percent' => $this->charityPercent,
            'charity_sum' => $this->charitySum,
            'contract_accepted' => $this->contractAccepted,
            'view_count' => $this->viewCount,
            'created' => $this->created ? date($date_format, strtotime($this->created)) : null,
            'deleted' => $this->deleted ? date($date_format, strtotime($this->deleted)) : null,
            'approved' => $this->approved ? date($date_format, strtotime($this->approved)) : null,
            'archived' => $this->archived ? date($date_format, strtotime($this->archived)) : null,
            'favorite' => in_array($this->id, $_favorites)
        ];
    }

    public function save(): bool
    {
        $update_data = $this->toArray(DB_DATETIME_FORMAT, true);
        Arrays::filterKeys($update_data, ['id', 'content', 'favorite'], true);
        return DB::update('offers', $update_data, ['id' => $this->id]);
    }

    public static function create(
        string $contentId,
        string $description,
        float $price,
        ?int $termMin,
        ?int $termMax,
        bool $termless,
        ?array $allowedForIds,
        ?array $applicationIds,
        int $countryId,
        ?array $regionIds,
        ?array $placementIds,
        bool $exclusive,
        bool $fastDeal,
        bool $charity,
        ?string $fundId,
        ?float $charityPercent,
        ?float $charitySum,
    ): ?static {
        if (
            ($offer_id = DB::insertGet(
                'offers',
                [
                    'content_id' => $contentId,
                    'description' => $description,
                    'price' => $price,
                    'term_min' => $termless ? null : $termMin,
                    'term_max' => $termless ? null : $termMax,
                    'termless' => $termless,
                    'allowed_for_ids' => $allowedForIds ? Json::encode(array_map('intval', $allowedForIds)) : null,
                    'application_ids' => $applicationIds ? Json::encode(array_map('intval', $applicationIds)) : null,
                    'country_id' => $countryId,
                    'region_ids' => $regionIds ? Json::encode(array_map('intval', $regionIds)) : null,
                    'placement_ids' => $placementIds ? Json::encode(array_map('intval', $placementIds)) : null,
                    'exclusive' => $exclusive,
                    'fast_deal' => $fastDeal,
                    'charity' => $charity,
                    'fund_id' => $charity ? $fundId : null,
                    'charity_percent' => $charity ? $charityPercent : null,
                    'charity_sum' => $charity ? $charitySum : null,
                    'created' => date(DB_DATETIME_FORMAT),
                ],
                'id'
            ))
        ) {
            return static::get($offer_id);
        }

        return null;
    }

}