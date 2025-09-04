<?php
namespace Otus\Iblock\Events;

interface OnAfterAddEventHandlerInterface
{
    /**
     * Метод вызывается после добавления элемента
     *
     * @param array $element Ссылка на добавленный элемент
     * @return void
     */
    public function onAfterAdd(array &$element);
}
