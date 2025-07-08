<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$cacheTime = 31 * 60;
$cacheId = $_REQUEST['CACHE_ID'];
$cacheDir = '/';

$cache = Bitrix\Main\Data\Cache::createInstance();
if ($cache->initCache($cacheTime, $cacheId, $cacheDir)) {
    $result = $cache->getVars();
    echo 'Происходит чтение из кэша';
} elseif ($cache->startDataCache()) {
    $result = [
        'Kurt Cobain',
        'Krist Novoselic',
        'Dave Grohl'
    ];
    echo 'Происходит первичная запись данных';
    $cache->endDataCache($result);
}

dump($result);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
