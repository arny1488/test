<?php

namespace TM4RENT;

use Curl;
use DB;
use Valid;

class Organizations
{

    public const SORTABLE = ['name', 'inn', 'balance', 'plan', 'expire'];
    public const SEARCHABLE = ['name', 'inn'];

    public static function get(string $sort = 'name', string $order = 'ASC', int $limit = null, int $start = null, string $search = null, string $user_id = null): array
    {
        if (!in_array($sort, static::SORTABLE)) {
            $sort = static::SORTABLE[0];
        }

        $limits = '';

        if (!is_null($limit) && !is_null($start)) {
            $limits = "LIMIT $start, $limit";
        }

        $like = '';

        if ($search) {
            $_like = DB::buildSearch(['name', 'inn'], $search);
            $like = ($_like) ? " AND ($_like)" : '';
        }

        $where = 'deleted IS NULL';

        if ($user_id) {
            $where .= " AND user_id = '$user_id'";
        }

        $rows = DB::Query(
            "
				SELECT
					*
				FROM
					organizations
				WHERE $where $like				
				ORDER BY $sort $order, name
                $limits
			"
        );

        $organizations = [];

        foreach ($rows as $row) {
            $organization = new Organization(
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
            $organizations[] = $organization->toArray();
        }

        return $organizations;
    }

    public static function total(string $search = null): int
    {
        $like = '';

        if ($search) {
            $_like = DB::buildSearch(['name', 'inn'], $search);
            $like = ($_like) ? " AND ($_like)" : '';
        }

        $where = 'deleted IS NULL';

        return (int)DB::cell("SELECT COUNT(id) FROM organizations WHERE $where $like");
    }

    public static function detailsByInn(?string $inn): ?array
    {
        if (
            Valid::inn($inn) &&
            ($res = Curl::postJson(
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
            )) &&
            ($org = $res['suggestions'][0]) &&
            ($name = str_ireplace([
                'ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ',
                'ЗАКРЫТОЕ АКЦИОНЕРНОЕ ОБЩЕСТВО',
                'АКЦИОНЕРНОЕ ОБЩЕСТВО',
                'ИНДИВИДУАЛЬНЫЙ ПРЕДПРИНИМАТЕЛЬ',
            ], ['ООО', 'ЗАО', 'АО', 'ИП'], $org['value']))
        ) {
            $org['value'] = $name;
            return $org;
        }

        return null;
    }

    public static function nameByInn(?string $inn): ?string
    {
        return self::detailsByInn($inn)['value'] ?? null;
    }

    public static function isVerifiedExists(?string $inn): bool
    {
        return $inn && DB::exists('SELECT * FROM organizations WHERE inn = ? AND verified IS NOT NULL AND deleted IS NULL', $inn);
    }

}