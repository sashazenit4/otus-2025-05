<?php
use Otus\Iblock\Events\IblockEventHandler;
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

$eventManager->addEventHandler('iblock', 'OnBeforeIBlockElementAdd', function (&$fields) {
    IblockEventHandler::onBeforeAddDispatcher($fields);
    return $fields;
});

$eventManager->addEventHandler('iblock', 'OnAfterIBlockElementAdd', function (&$fields) {
    IblockEventHandler::onAfterAddDispatcher($fields);
    return $fields;
});
