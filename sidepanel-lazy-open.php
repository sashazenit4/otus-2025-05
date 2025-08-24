<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
\Bitrix\Main\UI\Extension::load('sidepanel');

/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle('Ленивое открытие слайдера');
?>
<script>
    BX.SidePanel.Instance.open('default-slider-content', {
        contentCallback: function (slider) {
            //Callback должен вернуть промис или HTML (строка или DOM-элемент)
            return new Promise(function (resolve, reject) {
                //Эмуляция асинхронной операции. Здесь может быть ajax-запрос
                setTimeout(function () {
                    //Разрешаем промис передав ему содержимое слайдера (строка или DOM-элемент)
                    resolve("content<br>".repeat(100));
                }, 10000);
            });
        }
    });
</script>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
