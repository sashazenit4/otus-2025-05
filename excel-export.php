<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle('Выгрузка в эксель');
$APPLICATION->IncludeComponent('otus:book.grid', '', [
    'BOOK_PREFIX' => 'TEST ',
]);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
