<?php

declare(strict_types=1);

namespace DistriMedia\SoapClient\Struct\Response;

use DistriMedia\SoapClient\Struct\Response\Inventory\StockItem;

class Inventory extends AbstractResponse
{
    const INVENTORY = 'Inventory';

    private $inventory;

    /**
     * Inventory constructor.
     * @param array $data
     * @throws \Exception
     */
    public function __construct(array $data = [])
    {
        if (isset($data[self::INVENTORY])) {
            $this->setInventory($data[self::INVENTORY]);
        } else {
            throw new \Exception("Missing inventory data");
        }
        parent::__construct($data);
    }

    /**
     * @return StockItem[]
     */
    public function getInventory(): array
    {
        return $this->inventory;
    }

    /**
     * @param array $inventoryItems
     * @return $this
     */
    public function setInventory(array $inventoryItems)
    {
        $result = [];
        foreach ($inventoryItems as $inventoryItem) {
            $result[] = new StockItem($inventoryItem);
        }

        $this->iventory = $result;

        return $this;
    }
}
