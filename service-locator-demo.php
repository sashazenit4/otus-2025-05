<?php

use Bitrix\Main\DI\ServiceLocator;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle('Демо работы Service Locator');

try {
    $userController = ServiceLocator::getInstance()->get('user.controller');

    echo $userController->handle('holinshura@gmail.com');
} catch (Exception $e) {
    echo 'Ошибка: ' . $e->getMessage();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
