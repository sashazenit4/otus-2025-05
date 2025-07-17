<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
$cacheTime = 100 * 60; // время кеширования, указывается в секундах
$cacheId = 'not_so_random_page_cache_' . \Bitrix\Main\Engine\CurrentUser::get()->getId(); // формируем идентификатор кеша взависимости от параметров
$obCache = Bitrix\Main\Data\Cache::createInstance(); // создаем объект
if ($obCache->InitCache($cacheTime, $cacheId)) {
    $obCache->Output();
    echo 'Выше кэш!';
} elseif($obCache->StartDataCache($cacheTime, $cacheId)) {
    echo "<div style='background: green; width: 100px; height: 100px; color: white'>Hello, HTML cache!</pre>";
// записываем предварительно буферизированный вывод в файл кеша
    $obCache->EndDataCache();
}

//$obCache->CleanDir(); //сброс
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
