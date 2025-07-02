<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Entity\Query;

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

$q = new Query($ColorsEntityClass);
$q->setSelect(['*']);
$q->setLimit(1);
$q->registerRuntimeField(
    'RAND', [
        'data_type' => 'float',
        'expression' => [
            'RAND()',
        ]
    ],
);
$q->setOrder('RAND', 'ASC');
$result = $q->exec();
while ($arItem = $result->Fetch()) {
    dump($arItem);
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
