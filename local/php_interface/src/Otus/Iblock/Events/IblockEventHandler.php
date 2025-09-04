<?php
namespace Otus\Iblock\Events;

class IblockEventHandler
{
    public static function dispatch(string $eventType, array &$element): void
    {
        $handler = EventHandlerFactory::create($element['IBLOCK_ID']);

        if ($handler && method_exists($handler, $eventType)) {
            $handler->$eventType($element);
        }
    }

    public static function onBeforeAddDispatcher(&$element): void
    {
        self::dispatch('onBeforeAdd', $element);
    }

    public static function onAfterAddDispatcher(&$element): void
    {
        self::dispatch('onAfterAdd', $element);
    }
}
