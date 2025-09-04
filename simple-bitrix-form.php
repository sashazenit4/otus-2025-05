<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

/**
 * @var CMain $APPLICATION
 */
\Bitrix\Main\UI\Extension::load('aclips.ui-selector');
$APPLICATION->SetTitle('Простая Битрикс форма с стилизованным селектором');
?>
<form action="/simple-bitrix-form.php">
    <select name="contractor[]" multiple id="simple-form-contractor">
        <option value="321">1С</option>
        <option value="322">1С-Битрикс</option>
        <option value="323">1 Бит</option>
        <option value="324">Норбит</option>
        <option value="325">Отус</option>
    </select>
</form>
<script>
    BX(() => {
        BX.Plugin.UiSelector.createTagSelector('simple-form-contractor') // or BX.Plugin.UiSelector.createTagSelector(document.getElementById('my_select'));
    });
</script>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
