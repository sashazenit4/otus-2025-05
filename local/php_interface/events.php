<?php
$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandler('', 'ColorsOnBeforeAdd', [
    '\Otus\Hlblock\Handlers\Element',
    'onBeforeAddHandler',
]);

$eventManager->addEventHandler('', 'ColorsOnBeforeUpdate', [
    '\Otus\Hlblock\Handlers\Element',
    'onBeforeUpdateHandler',
]);

$eventManager->addEventHandler('', 'ColorsOnBeforeDelete', [
    '\Otus\Hlblock\Handlers\Element',
    'onBeforeDeleteHandler',
]);
