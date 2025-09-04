<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

/**
 * @var CMain $APPLICATION
 */
$APPLICATION->SetTitle('Простая Битрикс форма с стилизованным селектором');
?>
    <form action="">

<?php
$APPLICATION->IncludeComponent(
    'bitrix:main.user.selector',
    ' ',
    [
        'ID' => 'mail_client_config_queue',
        'API_VERSION' => 3,
        'INPUT_NAME' => 'fields[crm_queue][]',
        'USE_SYMBOLIC_ID' => true,
        'BUTTON_SELECT_CAPTION' => 'Выбрать',
        'SELECTOR_OPTIONS' =>
            [
                'departmentSelectDisable' => 'Y',
                'context' => 'MAIL_CLIENT_CONFIG_QUEUE',
                'contextCode' => 'U',
                'enableAll' => 'Y',
                'userSearchArea' => 'I'
            ]
    ]
);
?>
        <input type="submit" value="Отправить">
    </form>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
