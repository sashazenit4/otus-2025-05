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
        'NAME' => 'ColorsTypes',
    ],
])->fetch();
$ColorsTypesEntity = HL\HighloadBlockTable::compileEntity($ColorsTypesHlBlock);
$ColorsTypesEntityClass = $ColorsTypesEntity->getDataClass();

$newColorsTypeElementFields = [
    'UF_NAME' => 'Олово',
    'UF_XML_ID' => 'TIN',
];

$resultAdd = $ColorsTypesEntityClass::add($newColorsTypeElementFields);

echo sprintf('Создан элемент HL блока Типы материалов с ID = %d', $resultAdd->getId());

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
