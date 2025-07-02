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

for ($i = 2004; $i > 4; $i--) {
    $ColorsEntityClass = $ColorsEntity->getDataClass();
    $ColorsEntityClass::delete($i);
    echo sprintf('Удален элемент HL блока Типы материалов с ID = %d', $i);

    echo '<br>';
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
