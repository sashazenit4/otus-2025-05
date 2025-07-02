<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Loader;

Loader::includeModule('highloadblock');

/**
ENTITY_ID Строковый идентификатор сущности. Обязательное
FIELD_NAME Код поля. Обязательное
USER_TYPE_ID Код типа поля. Обязательное
XML_ID Внешний строковый идентификатор
SORT Индекс сортировки
MULTIPLE Булевый флаг множественности (N или Y). По умолчанию N
MANDATORY Булевый флаг обязательности (N или Y). По умолчанию N
SHOW_FILTER Булевый флаг наличия поля в фильтре (N или Y). По умолчанию N
SHOW_IN_LIST Булевый флаг наличия поля в списке (N или Y). По умолчанию N
EDIT_IN_LIST Булевый флаг разрешения редактирования в списке (N или Y). По умолчанию N
IS_SEARCHABLE Булевый флаг наличия поиска по этому полю (N или Y). По умолчанию N
SETTINGS Сериализованный (через serialize) массив дополнительных настроек поля, которые зависят от типа
 */

$ColorsHlBlock = HL\HighloadBlockTable::getList([
    'filter' => [
        'NAME' => 'Colors',
    ],
    'cache' => [
        'ttl' => 3600,
    ],
])->fetch();

$newHlblockFieldInfo = [
    'USER_TYPE_ID' => 'string',
    'ENTITY_ID' => 'HLBLOCK_' . $ColorsHlBlock['ID'],
    'FIELD_NAME' => 'UF_USE_CASE',
    'XML_ID' => 'USE_CASE',
    'SORT' => 500,
    'MULTIPLE' => 'Y',
    'MANDATORY' => 'N',
    'SHOW_FILTER' => 'Y',
    'SHOW_IN_LIST' => 'Y',
    'EDIT_IN_LIST' => 'Y',
    'IS_SEARCHABLE' => 'Y',
    'SETTINGS' => [
        'EDIT_FORM_LABEL' => [
            'ru' => 'Когда использовать цвет?'
        ],
    ],
];

dump($newHlblockFieldInfo);

$oUserTypeEntity = new CUserTypeEntity();

$newFieldInfo = $oUserTypeEntity->Add($newHlblockFieldInfo);

echo !empty($newFieldInfo) ? 'Поле создано' : 'Ошибка в создании поля';

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
