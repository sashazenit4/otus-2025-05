<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;

if (!Loader::includeModule('highloadblock')) {
    return;
}
$connection = Application::getConnection();

$connection->startTracker();

$ColorsHlBlock = HL\HighloadBlockTable::getList([
    'filter' => [
        'NAME' => 'Colors',
    ],
    'cache' => [
        'ttl' => 36000,
    ],
])->fetch();
$ColorsEntity = HL\HighloadBlockTable::compileEntity($ColorsHlBlock);
$ColorsEntityClass = $ColorsEntity->getDataClass();

$rawColors = $ColorsEntityClass::getList([
    'select' => [
        'UF_NAME',
        'ID',
    ],
    'cache' => [
        'ttl' => 36000,
    ],
])->fetchAll();
$connection->stopTracker();
$tracker = $connection->getTracker();
echo 'Выполненные запросы: <br>';
dump($tracker->getQueries());

echo 'Элементы HL-блока Типы материалов: <br>';
foreach ($rawColors as $rawMaterialType) {
    dump($rawMaterialType);
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
