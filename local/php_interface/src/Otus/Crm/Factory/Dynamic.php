<?php
namespace Otus\Crm\Factory;

use Bitrix\Crm\Item;
use Bitrix\Crm\Service\Context;
use Bitrix\Crm\Service\Factory\Dynamic as DynamicFactory;
use Bitrix\Crm\Service\Operation;
use Bitrix\Crm\Service\Operation\Action;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Result;
use Otus\Crm\Acts\Events;

class Dynamic extends DynamicFactory
{
    /**
     * @throws ArgumentException
     */
    public function getAddOperation(Item $item, Context $context = null): Operation\Add
    {
//        $item = ((new Events)->beforeAddAction($item))->getData()['item'];
        $operation = parent::getAddOperation($item, $context);
        $operation->addAction($operation::ACTION_BEFORE_SAVE, new class extends Action {
            public function process(Item $item): Result
            {
                return (new Events)->beforeAddAction($item);
            }
        });

        return $operation;
    }
}
