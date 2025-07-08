<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

use Bitrix\Main\Application;
use Otus\Helper\Iblock as IblockHelper;
use Otus\Constant\Iblock as IblockConstant;
//use Bitrix\Iblock\IblockTable;
// сброс кэша ОРМ
//IblockTable::cleanCache();
$connection = Application::getConnection();

$connection->startTracker();

$iblockId = IblockHelper::getIblockIdByCode(IblockConstant::CRM_CATALOG);
echo $iblockId . '<br>';
$iblockId = IblockHelper::getIblockIdByCode(IblockConstant::CRM_CATALOG_OFFER);
echo $iblockId . '<br>';
$connection->stopTracker();
$tracker = $connection->getTracker();

dump($tracker->getQueries());

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
