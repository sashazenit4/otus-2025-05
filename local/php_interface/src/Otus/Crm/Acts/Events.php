<?php
namespace Otus\Crm\Acts;

use Bitrix\Crm\Item;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Result;
use Otus\Crm\Service\CustomContainer;

class Events
{
    /**
     * @throws ArgumentException
     */
    public function beforeAddAction(Item $item): Result
    {
        $result = new Result();
        $item->set('TITLE', $this->replaceItemTitle($item));
        $result->setData([
            'item' => $item,
        ]);

        return $result;
    }

    private function findElementsWithSameName(string $title): int
    {
        $actFactory = CustomContainer::getInstance()->getFactory(
            CustomContainer::getEntityTypeIdBeCode(CustomContainer::ACTS_ENTITY_CODE),
        );

        return $actFactory->getItemsCount([
            '%TITLE' => $title,
        ]);
    }

    private function replaceItemTitle(Item $item): string
    {
        $title = $item->getTitle();
        $sameNameElementsCount = $this->findElementsWithSameName($title);
        if ($sameNameElementsCount > 0) {
            return sprintf('%s (%d)', $title, $sameNameElementsCount);
        } else {
            return $title;
        }
    }
}
