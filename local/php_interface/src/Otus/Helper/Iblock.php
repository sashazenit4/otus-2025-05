<?php
namespace Otus\Helper;

use Bitrix\Iblock\IblockTable;

class Iblock
{
    public static function getIblockIdByCode(string $code): int
    {
        return IblockTable::getList([
            'filter' => [
                'CODE' => $code,
            ],
            'limit' => 1,
            'cache' => [
                'ttl' => 360000,
            ],
        ])->fetch()['ID'];
    }
}
