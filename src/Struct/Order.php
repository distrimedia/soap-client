<?php

declare(strict_types=1);

namespace DistriMedia\SoapClient\Struct;

use DistriMedia\SoapClient\InvalidOrderException;

class Order extends AbstractStruct implements StructInterface
{
    const ORDER = 'Order';
    const ORDER_VALUE_ADDED_HANDLING = 'OrderValueAddedHandling';
    const ORDER_LINE = 'OrderLine';
    const ADDITIONAL_DOCUMENTS = 'AdditionalDocuments';
    const ADDITIONAL_DOCUMENT = 'AdditionalDocument';
    const LABEL_TEXT = 'LabelText';
    const CUSTOMER = 'Customer';

    private $orderItem;
    private $customer;
    private $orderValueAddedHandlings;
    private $orderLines;
    private $additionalDocuments;
    private $labelTexts;

    /**
     * @return OrderItem
     */
    public function getOrderItem()
    {
        return $this->orderItem;
    }

    /**
     * @param OrderItem $orderItem
     * @return Order
     */
    public function setOrderItem(OrderItem $orderItem)
    {
        $this->orderItem = $orderItem;
        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return Order
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return ValueAddedHandlingItem[]|null
     */
    public function getOrderValueAddedHandlings()
    {
        return $this->orderValueAddedHandlings;
    }

    /**
     * @param ValueAddedHandlingItem[] $orderValueAddedHandlings
     * @return Order
     */
    public function setOrderValueAddedHandlings(array $orderValueAddedHandlings)
    {
        $this->orderValueAddedHandlings = $orderValueAddedHandlings;
        return $this;
    }

    /**
     * @return OrderLine[]|null
     */
    public function getOrderLines()
    {
        return $this->orderLines;
    }

    /**
     * @param OrderLine[] $orderLines
     * @return Order
     */
    public function setOrderLines(array $orderLines)
    {
        foreach ($orderLines as $orderLine) {
            $orderLine->validate();
        }

        $this->orderLines = $orderLines;
        return $this;
    }

    public function addOrderLine(OrderLine $orderLine)
    {
        $orderLine->validate();
        $this->orderLines[] = $orderLine;
    }

    /**
     * @return AdditionalDocument[]|null
     */
    public function getAdditionalDocuments()
    {
        return $this->additionalDocuments;
    }

    /**
     * @param AdditionalDocument[] $additionalDocuments
     * @return Order
     */
    public function setAdditionalDocuments(array $additionalDocuments)
    {
        $this->additionalDocuments = $additionalDocuments;
        return $this;
    }

    /**
     * @return LabelText[]|null
     */
    public function getLabelTexts()
    {
        return $this->labelTexts;
    }

    /**
     * @param LabelText[] $labelText
     * @return Order
     */
    public function setLabelTexts(array $labelTexts)
    {
        $this->labelTexts = $labelTexts;
        return $this;
    }

    /**
     * @return array
     */
    public function __toArray(): array
    {
        $this->validate();

        $data = [];

        $data = array_merge($data, $this->getOrderItem()->__toArray());
        $data[self::CUSTOMER] = $this->getCustomer()->__toArray();

        $handlings = $this->getOrderValueAddedHandlings();
        $orderLines = $this->getOrderLines();
        $docs = $this->getAdditionalDocuments();
        $labelTexts = $this->getLabelTexts();

        if (!empty($handlings)) {
            foreach ($handlings as $key => $handling) {
                $index = self::CUSTOM_TAG . ':' . ValueAddedHandlingItem::VALUE_ADDED_HANDLING_ITEM . ':' . $key;
                $data[self::ORDER_VALUE_ADDED_HANDLING][$index] = $handling->__toArray();
            }
        }

        if (!empty($orderLines)) {
            foreach ($orderLines as $key => $orderLine) {
                $index = self::CUSTOM_TAG . ':' . self::ORDER_LINE . ':' . $key;
                $data[$index] = $orderLine->__toArray();
            }
        }

        if (!empty($docs)) {
            $data[self::ADDITIONAL_DOCUMENTS] = [];
            foreach ($docs as $key => $doc) {
                $index = self::CUSTOM_TAG . ':' . self::ADDITIONAL_DOCUMENT . ':' . $key;
                $data[self::ADDITIONAL_DOCUMENTS][$index] = $doc->__toArray();
            }
        }

        if (!empty($labelTexts)) {
            foreach ($labelTexts as $key => $labelText) {
                $index = self::CUSTOM_TAG . ':' . self::LABEL_TEXT . ':' . $key;
                $data[$index] = $labelText->__toArray();
            }
        }

        $data = array_filter($data);

        return $data;
    }

    /**
     * @return bool
     * @throws InvalidOrderException
     */
    public function validate(): bool
    {
        if (!$this->getOrderItem()) {
            throw new InvalidOrderException("Required Order Item not defined");
        }

        if (!$this->getOrderLines() || empty($this->getOrderLines())) {
            throw new InvalidOrderException("Required Order Lines not defined");
        }

        if (!$this->getCustomer()) {
            throw new InvalidOrderException("Required Customer not defined");
        }

        return true;
    }
}
