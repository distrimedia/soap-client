<?php

declare(strict_types=1);

namespace DistriMedia\SoapClient\Struct;

use DistriMedia\SoapClient\InvalidOrderLineException;
use DistriMedia\SoapClient\Traits\ArgumentValidatorTrait;

class OrderLine extends AbstractStruct implements StructInterface
{
    use ArgumentValidatorTrait;

    const PRODUCT_ID = 'ProductID';
    const PIECES = 'Pieces';
    const CARRIER = 'Carrier';
    const SUPPLIER = 'Supplier';
    const PRODUCT = 'Product';
    const LINE_VALUE_HANDLING = 'LineValueAddedHandling';
    private $productId;
    private $pieces;
    private $carrier;
    private $supplier;
    private $product;
    private $lineValueAddedHandlings;

    /**
     * @return ValueAddedHandlingItem[]
     */
    public function getLineValueAddedHandlings()
    {
        return $this->lineValueAddedHandlings;
    }

    /**
     * @param ValueAddedHandlingItem[] $lineValueAddedHandlings
     * @return OrderLine
     */
    public function setLineValueAddedHandlings(array $lineValueAddedHandlings)
    {
        foreach ($lineValueAddedHandlings as $lineValueAddedHandling) {
            $lineValueAddedHandling->validate();
        }

        $this->lineValueAddedHandlings = $lineValueAddedHandlings;
        return $this;
    }

    /**
     * @param ValueAddedHandlingItem $lineValueAddedHandling
     * @return OrderLine
     */
    public function addLineValueAddedHandlings(ValueAddedHandlingItem $lineValueAddedHandling)
    {
        if ($lineValueAddedHandling->validate()) {
            $this->lineValueAddedHandlings[] = $lineValueAddedHandling;
        }

        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return OrderLine
     */
    public function setProduct(Product $product)
    {
        if ($product->validate()) {
            $this->product = $product;
        }

        return $this;
    }

    /**
     * EAN or External Ref code
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * EAN or External Ref code
     * @param string $productId
     * @return OrderLine
     */
    public function setProductId(string $productId)
    {
        self::validateLength(self::PRODUCT_ID, $productId, 20);
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return int
     */
    public function getPieces()
    {
        return $this->pieces;
    }

    /**
     * @param int $pieces
     * @return OrderLine
     */
    public function setPieces(int $pieces)
    {
        self::validateInteger(self::PIECES, $pieces, 9999);
        $this->pieces = $pieces;
        return $this;
    }

    /**
     * If another carrier must be used for this item than for the rest of the order
     * @return mixed
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * If another carrier must be used for this item than for the rest of the order
     * @param mixed $carrier
     * @return OrderLine
     */
    public function setCarrier($carrier)
    {
        self::validateLength(self::CARRIER, $carrier, 10);
        $this->carrier = $carrier;
        return $this;
    }

    /**
     * Indicates the supplier of the product. If not filled in, the standard Supplier for the web shop will be used.
     * @return mixed
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * Indicates the supplier of the product. If not filled in, the standard Supplier for the web shop will be used.
     * @param mixed $supplier
     * @return OrderLine
     */
    public function setSupplier($supplier)
    {
        self::validateLength(self::SUPPLIER, $supplier, 10);
        $this->supplier = $supplier;
        return $this;
    }

    public function __toArray(): array
    {
        $this->validate();

        $data = [
            self::PRODUCT_ID => $this->getProductId(),
            self::PIECES => $this->getPieces(),
            self::CARRIER => $this->getCarrier(),
            self::SUPPLIER => $this->getSupplier(),
            self::PRODUCT => $this->getProduct()->__toArray(),
            self::LINE_VALUE_HANDLING => []
        ];

        $handlings = $this->getLineValueAddedHandlings();
        if (!empty($handlings)) {
            foreach ($handlings as $key => $handling) {
                $index = self::CUSTOM_TAG .':' . ValueAddedHandlingItem::VALUE_ADDED_HANDLING_ITEM . ':' . $key;
                $data[self::LINE_VALUE_HANDLING][$index] = $handling->__toArray();
            }
        }

        $data = array_filter($data);

        return $data;
    }

    /**
     * @return bool
     * @throws InvalidOrderLineException
     */
    public function validate(): bool
    {
        if (empty($this->getProductId())) {
            throw new InvalidOrderLineException("Product Id is a required field");
        }

        if (empty($this->getPieces())) {
            throw new InvalidOrderLineException("Pieces is a required field");
        }

        if (empty($this->getProduct())){
            throw new InvalidOrderLineException("Order is a required field");
        }

        return true;
    }
}
