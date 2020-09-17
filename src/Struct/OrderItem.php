<?php
/**
 *
 *
 *  NOTICE OF LICENSE
 *
 *  This source file is subject to the Open Software License (OSL 3.0)
 *  that is provided with Magento in the file LICENSE.txt.
 *  It is also available through the world-wide-web at this URL:
 *  http://opensource.org/licenses/osl-3.0.php
 *
 *  DISCLAIMER
 *
 *  Do not edit or add to this file if you wish to upgrade the DistriMediaClient plugin
 *  to newer versions in the future. If you wish to customize the plugin for your
 *  needs please document your changes and make backups before your update.
 *
 *  @category  Baldwin
 *  @package  DistriMediaClient
 *  @author      Tristan Hofman <info@baldwin.be>
 *  @copyright Copyright (c) 2020 Baldwin BV (https://www.baldwin.be)
 *  @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 *  INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
 *  PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 *  HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
 *  ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 *  WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 */

declare(strict_types=1);

namespace DistriMedia\SoapClient\Struct;

use DistriMedia\SoapClient\Traits\ArgumentValidatorTrait;

class OrderItem extends AbstractStruct implements StructInterface
{
    use ArgumentValidatorTrait;

    const ORDER_NUMBER = 'OrderNumber';
    const REFERENCE_NUMBER = 'ReferenceNumber';
    const SITE_INDICATION = 'SiteIndication';
    const LANGUAGE = 'Language';
    const CARRIER = 'Carrier';
    const SHIPPING_METHOD = 'ShipMethod';
    const TRANSPORT_REF = 'TransportRef';
    const TRANSPORT_NOTA_1 = 'TranportNota1';
    const TRANSPORT_NOTA_2 = 'TranportNota2';
    const DAY_OF_DELIVERY = 'DayOfDelivery';
    const DAYS_RETENTION = 'DaysRetention';
    const DAYS_CANCELLATION = 'DaysCancelation'; //typo on the side of distrimedia
    const ORDER_ITEM_MODE = 'OrderItemMode';

    const ORDER_ITEM_MODE_NORMAL = 'N';
    const ORDER_ITEM_MODE_STOCKOUT_OrderItem = 'S';

    const CURRENCY = 'Currency';

    const NO_DELIVERY_DAY_MONDAY = 'NoDelivery_DayMonday';
    const NO_DELIVERY_DAY_TUESDAY = 'NoDelivery_DayTuesday';
    const NO_DELIVERY_DAY_WEDNESDAY = 'NoDelivery_DayWednesday';
    const NO_DELIVERY_DAY_THURSDAY = 'NoDelivery_DayThursday';
    const NO_DELIVERY_DAY_FRIDAY = 'NoDelivery_DayFriday';
    const NO_DELIVERY_DAY_SATURDAY = 'NoDelivery_DaySaturday';
    const NO_DELIVERY_DAY_SUNDAY = 'NoDelivery_DaySunday';

    const REPRESENTATIVE = 'Representative';
    const GOODS_TOTAL_VALUE = 'GoodsTotalValue';

    private $OrderNumber;
    private $referenceNumber;
    private $siteIndication;
    private $language;
    private $carrier;
    private $shipmentMethod;
    private $currency;
    private $transportRef;
    private $transportNota1;
    private $transportNota2;
    private $dayOfDelivery;
    private $daysOfRetention;
    private $daysOfCancellation;
    private $OrderItemMode;
    private $noDeliveryMonday;
    private $noDeliveryTuesday;
    private $noDeliveryWednesDay;
    private $noDeliveryThursday;
    private $noDeliveryFriday;
    private $noDeliverySaturday;
    private $noDeliverySunday;
    private $goodsTotalValue;
    private $representative;

    /**
     * Web shop Order number
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->OrderNumber;
    }

    /**
     * Web shop Order number
     * @param string $OrderNumber
     * @return OrderItem
     */
    public function setOrderNumber(string $OrderNumber)
    {
        $this::validateLength(self::ORDER_NUMBER, $OrderNumber, 15);

        $this->OrderNumber = $OrderNumber;
        return $this;
    }

    /**
     * Extra OrderItem reference
     * @return string|null
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * Extra OrderItem reference
     * @param string $referenceNumber
     * @return OrderItem
     */
    public function setReferenceNumber(string $referenceNumber)
    {
        $this::validateLength(self::REFERENCE_NUMBER, $referenceNumber, 15);

        $this->referenceNumber = $referenceNumber;
        return $this;
    }

    /**
     * Indication of site where OrderItem was placed
     * @return string|null
     */
    public function getSiteIndication()
    {
        return $this->siteIndication;
    }

    /**
     * Indication of site where OrderItem was placed
     * @param string $siteIndication
     * @return OrderItem
     */
    public function setSiteIndication(string $siteIndication)
    {
        $this::validateLength(self::SITE_INDICATION, $siteIndication, 3);

        $this->siteIndication = $siteIndication;
        return $this;
    }

    /**
     * Language of Customer
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Language of Customer
     * @param string $language
     * @return OrderItem
     */
    public function setLanguage(string $language)
    {
        $this::validateLength(self::SITE_INDICATION, $language, 2);

        $this->language = $language;
        return $this;
    }

    /**
     * Carrier preference
     * @return string|null
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Carrier preference
     * @param string $carrier
     * @return OrderItem
     */
    public function setCarrier(string $carrier)
    {
        $this::validateLength(self::CARRIER, $carrier, 10);

        $this->carrier = $carrier;
        return $this;
    }

    /**
     * Shipment method
     * @return string|null
     */
    public function getShipmentMethod()
    {
        return $this->shipmentMethod;
    }

    /**
     * Shipment method
     * @param string $shipmentMethod
     * @return OrderItem
     */
    public function setShipmentMethod($shipmentMethod)
    {
        $this::validateLength(self::SHIPPING_METHOD, $shipmentMethod, 10);

        $this->shipmentMethod = $shipmentMethod;
        return $this;
    }

    /**
     * OrderItem paid in currency
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * OrderItem paid in currency
     * @param string $currency
     * @return OrderItem
     */
    public function setCurrency($currency)
    {
        $this::validateLength(self::SHIPPING_METHOD, $currency, 3);
        $this->currency = $currency;
        return $this;
    }

    /**
     * Carrier Reference, if supported.
     * @return string|null
     */
    public function getTransportRef()
    {
        return $this->transportRef;
    }

    /**
     * Carrier Reference, if supported.
     * @param string $transportRef
     * @return OrderItem
     */
    public function setTransportRef($transportRef)
    {
        $this::validateLength(self::TRANSPORT_REF, $transportRef, 12);
        $this->transportRef = $transportRef;
        return $this;
    }

    /**
     * Carrier Note1, if supported.
     * @return string|null
     */
    public function getTransportNota1()
    {
        return $this->transportNota1;
    }

    /**
     * Carrier Note1, if supported.
     * @param string $transportNota1
     * @return OrderItem
     */
    public function setTransportNota1($transportNota1)
    {
        $this::validateLength(self::TRANSPORT_NOTA_1, $transportNota1, 50);

        $this->transportNota1 = $transportNota1;
        return $this;
    }

    /**
     * Carrier Note2, if supported.
     * @return string|null
     */
    public function getTransportNota2()
    {
        return $this->transportNota2;
    }

    /**
     * Carrier Note2, if supported.
     * @param string $transportNota2
     * @return OrderItem
     */
    public function setTransportNota2($transportNota2)
    {
        $this::validateLength(self::TRANSPORT_NOTA_2, $transportNota2, 50);

        $this->transportNota2 = $transportNota2;
        return $this;
    }

    /**
     * Day of delivery
     * @return string
     */
    public function getDayOfDelivery()
    {
        return $this->dayOfDelivery;
    }

    /**
     * Day of delivery
     * @param \DateTime $daysOfDelivery
     * @return OrderItem
     */
    public function setDayOfDelivery(\DateTime $dayOfDelivery)
    {
        $this::validateDateInFuture(self::DAY_OF_DELIVERY, $dayOfDelivery);

        $result = $dayOfDelivery->format('yyyymmdd');
        $this->daysOfDelivery = $result;
        return $this;
    }

    /**
     * Number of days to wait before a partial delivery is sent
     * @return int|null
     */
    public function getDaysOfRetention()
    {
        return $this->daysOfRetention;
    }

    /**
     * Number of days to wait before a partial delivery is sent
     * @param int $daysOfRetention
     * @return OrderItem
     */
    public function setDaysOfRetention(int $daysOfRetention)
    {
        $this::validateInteger(self::DAYS_RETENTION, $daysOfRetention, 999);

        $this->daysOfRetention = $daysOfRetention;
        return $this;
    }

    /**
     * Number of days before an OrderItem is automatically cancelled
     * @return int|null
     */
    public function getDaysOfCancellation()
    {
        return $this->daysOfCancellation;
    }

    /**
     * Number of days before an OrderItem is automatically cancelled
     * @param int $daysOfCancelation
     * @return OrderItem
     */
    public function setDaysOfCancellation(int $daysOfCancellation)
    {
        $this::validateInteger(self::DAYS_CANCELLATION, $daysOfCancellation, 999);

        $this->daysOfCancellation = $daysOfCancellation;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrderItemMode()
    {
        return $this->OrderItemMode;
    }

    /**
     * @param string $OrderItemMode
     * @return OrderItem
     */
    public function setOrderItemMode(string $OrderItemMode)
    {
        if (in_array($OrderItemMode, [self::ORDER_ITEM_MODE_NORMAL, self::ORDER_ITEM_MODE_STOCKOUT_OrderItem])) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid OrderItem Mode '%s' defined. Should be %s or %s",
                    $OrderItemMode,
                    self::ORDER_ITEM_MODE_NORMAL,
                    self::ORDER_ITEM_MODE_STOCKOUT_OrderItem
                )
            );
        }

        $this->OrderItemMode = $OrderItemMode;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNoDeliveryMonday()
    {
        return $this->noDeliveryMonday;
    }

    /**
     * @param bool $noDeliveryMonday
     * @return OrderItem
     */
    public function setNoDeliveryMonday(bool $noDeliveryMonday)
    {
        $this->noDeliveryMonday = $noDeliveryMonday;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNoDeliveryTuesday()
    {
        return $this->noDeliveryTuesday;
    }

    /**
     * @param bool $noDeliveryTuesday
     * @return OrderItem
     */
    public function setNoDeliveryTuesday(bool $noDeliveryTuesday)
    {
        $this->noDeliveryTuesday = $noDeliveryTuesday;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNoDeliveryWednesDay()
    {
        return $this->noDeliveryWednesDay;
    }

    /**
     * @param bool $noDeliveryWednesDay
     * @return OrderItem
     */
    public function setNoDeliveryWednesDay(bool $noDeliveryWednesDay)
    {
        $this->noDeliveryWednesDay = $noDeliveryWednesDay;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNoDeliveryThursday()
    {
        return $this->noDeliveryThursday;
    }

    /**
     * @param bool $noDeliveryThursday
     * @return OrderItem
     */
    public function setNoDeliveryThursday(bool $noDeliveryThursday)
    {
        $this->noDeliveryThursday = $noDeliveryThursday;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNoDeliveryFriday()
    {
        return $this->noDeliveryFriday;
    }

    /**
     * @param bool $noDeliveryFriday
     * @return OrderItem
     */
    public function setNoDeliveryFriday(bool $noDeliveryFriday)
    {
        $this->noDeliveryFriday = $noDeliveryFriday;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNoDeliverySaturday()
    {
        return $this->noDeliverySaturday;
    }

    /**
     * @param bool $noDeliverySaturday
     * @return OrderItem
     */
    public function setNoDeliverySaturday(bool $noDeliverySaturday)
    {
        $this->noDeliverySaturday = $noDeliverySaturday;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNoDeliverySunday()
    {
        return $this->noDeliverySunday;
    }

    /**
     * @param bool $noDeliverySunday
     * @return OrderItem
     */
    public function setNoDeliverySunday(bool $noDeliverySunday)
    {
        $this->noDeliverySunday = $noDeliverySunday;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getGoodsTotalValue()
    {
        return $this->goodsTotalValue;
    }

    /**
     * @param float $goodsTotalValue
     * @return OrderItem
     */
    public function setGoodsTotalValue(float $goodsTotalValue)
    {
        self::validateFloat(self::GOODS_TOTAL_VALUE, $goodsTotalValue, 9999.99);

        $this->goodsTotalValue = $goodsTotalValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getRepresentative()
    {
        return $this->representative;
    }

    /**
     * @param string $representative
     * @return OrderItem
     */
    public function setRepresentative($representative)
    {
        $this::validateLength(self::REPRESENTATIVE, $representative, 50);
        $this->representative = $representative;
        return $this;
    }

    /**
     * Returns the OrderItem in array format
     * @return array
     */
    public function __toArray(): array
    {
        $this->validate();

        $data = [
            self::ORDER_NUMBER => $this->getOrderNumber(),
            self::REFERENCE_NUMBER => $this->getReferenceNumber(),
            self::SITE_INDICATION => $this->getSiteIndication(),
            self::LANGUAGE => $this->getLanguage(),
            self::CARRIER => $this->getCarrier(),
            self::SHIPPING_METHOD => $this->getShipmentMethod(),
            self::CURRENCY => $this->getCurrency(),
            self::TRANSPORT_REF => $this->getTransportRef(),
            self::TRANSPORT_NOTA_1 => $this->getTransportNota1(),
            self::TRANSPORT_NOTA_2 => $this->getTransportNota2(),
            self::DAY_OF_DELIVERY => $this->getDayOfDelivery(),
            self::DAYS_RETENTION => $this->getDaysOfRetention(),
            self::DAYS_CANCELLATION => $this->getDaysOfCancellation(),
            self::ORDER_ITEM_MODE => $this->getOrderItemMode(),
            self::NO_DELIVERY_DAY_MONDAY => $this->getNoDeliveryMonday(),
            self::NO_DELIVERY_DAY_TUESDAY => $this->getNoDeliveryTuesday(),
            self::NO_DELIVERY_DAY_WEDNESDAY => $this->getNoDeliveryWednesDay(),
            self::NO_DELIVERY_DAY_THURSDAY => $this->getNoDeliveryThursday(),
            self::NO_DELIVERY_DAY_FRIDAY => $this->getNoDeliveryFriday(),
            self::NO_DELIVERY_DAY_SATURDAY => $this->getNoDeliverySaturday(),
            self::NO_DELIVERY_DAY_SUNDAY => $this->getNoDeliverySunday(),
            self::GOODS_TOTAL_VALUE => $this->getGoodsTotalValue(),
            self::REPRESENTATIVE => $this->getRepresentative()
        ];

        $data = array_filter($data);

        return $data;
    }

    public function validate(): bool
    {
        if (empty($this->getOrderNumber())) {
            throw new \Exception("Required Order Item Number not defined");
        }

        return true;
    }
}
