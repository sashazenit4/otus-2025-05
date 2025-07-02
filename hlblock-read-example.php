<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Config\Option;

if (!Loader::includeModule('highloadblock')) {
    return;
}

$ColorsTypesHlBlock = HL\HighloadBlockTable::getList([
    'filter' => [
        'NAME' => 'Colors',
    ],
    'cache' => [
        'ttl' => 3600,
    ],
])->fetch();
$ColorsTypesEntity = HL\HighloadBlockTable::compileEntity($ColorsTypesHlBlock);
$ColorsTypesEntityClass = $ColorsTypesEntity->getDataClass();

$rawColorsTypes = $ColorsTypesEntityClass::getList([
    'filter' => [
        'LOGIC' => 'OR',
        ['%UF_XML_ID' => '100'],
        ['%UF_XML_ID' => '200'],
    ],
    'select' => [
        'UF_NAME',
        'ID',
        'UF_XML_ID',
    ],
    'order' => [
        'UF_XML_ID' => 'DESC',
    ],
    'limit' => 5,
])->fetchAll();

foreach ($rawColorsTypes as $rawColorsType) {
    dump($rawColorsType);
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
