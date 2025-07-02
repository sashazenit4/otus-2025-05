<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Config\Option;

if (!Loader::includeModule('highloadblock')) {
    return;
}

$ColorsHlBlock = HL\HighloadBlockTable::getList([
    'filter' => [
        'NAME' => 'Colors',
    ],
])->fetch();
$ColorsEntity = HL\HighloadBlockTable::compileEntity($ColorsHlBlock);
$ColorsEntityClass = $ColorsEntity->getDataClass();

$newMaterialTypeElementFields = [
    'UF_NAME' => 'Золото',
    'UF_XML_ID' => '#00FFFF',
];

$resultUpdate = $ColorsEntityClass::update(66, $newMaterialTypeElementFields);

echo sprintf('Обновлен элемент HL блока Цвета с ID = %d', $resultUpdate->getId());

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
