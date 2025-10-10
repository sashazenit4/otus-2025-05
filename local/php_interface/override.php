<?php

use Bitrix\Main\DI\ServiceLocator;
use Otus\Crm\Service\CustomContainer;

$serviceLocator = ServiceLocator::getInstance();
try {
    $serviceLocator->addInstanceLazy('crm.service.container', [
        'className' => CustomContainer::class,
    ]);
} catch (\Bitrix\Main\SystemException $e) {
    echo $e->getMessage();
}
