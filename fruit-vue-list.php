<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

/**
 * @var CMain $APPLICATION
 */

$APPLICATION->IncludeComponent('otus:simple.fruit-list', '');

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
