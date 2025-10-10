<?php
namespace Otus\Crm\Service;

use Bitrix\Crm\Model\Dynamic\TypeTable;
use Bitrix\Crm\Service\Container;
use Bitrix\Crm\Service\Factory;
use Otus\Crm\Factory\Dynamic;

final class CustomContainer extends Container
{
    public const ACTS_ENTITY_CODE = 'CRM_DYNAMIC_ACTS';
    public function getFactory(int $entityTypeId): ?Factory
    {
        if ($this->getEntityTypeIdBeCode(self::ACTS_ENTITY_CODE) === $entityTypeId) {
            return new Dynamic($this->getTypeByEntityTypeId($entityTypeId));
        }

        return parent::getFactory($entityTypeId);
    }

    public static function getEntityTypeIdBeCode(string $code): int
    {
        return TypeTable::getList([
            'filter' => [
                'CODE' => $code,
            ],
            'cache' => [
                'ttl' => 3600000,
            ],
            'select' => [
                'ENTITY_TYPE_ID',
            ],
        ])->fetch()['ENTITY_TYPE_ID'] ?? 0;
    }
}
