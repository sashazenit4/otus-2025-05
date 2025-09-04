<?php

use Bitrix\Main\DI\ServiceLocator;
use Otus\Service\Crm\CustomContainer;

if (file_exists(__DIR__ . '/../../vendor/autoload.php')) {
    require_once __DIR__ . '/../../vendor/autoload.php';
}
if (file_exists(__DIR__ . '/src/autoloader.php')) {
    require_once __DIR__ . '/src/autoloader.php';
}
if (file_exists(__DIR__ . '/events.php')) {
    require_once __DIR__ . '/events.php';
}

\Bitrix\Main\UI\Extension::load([
    'otus.slider.bindSlider'
]);
