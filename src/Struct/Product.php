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

use DistriMedia\SoapClient\InvalidProductException;
use DistriMedia\SoapClient\Traits\ArgumentValidatorTrait;

class Product extends AbstractStruct implements StructInterface
{
    use ArgumentValidatorTrait;

    const EAN_CODE = 'EAN';
    const EXTERNAL_REF = 'ExternalRef';
    const DESCRIPTION_1 = 'Description1';
    const DESCRIPTION_2 = 'Description2';
    const DESCRIPTION_3 = 'Description3';
    const NR_DELIVERY_FOR_DUE_DATE = 'NbrDaysNoDeliveryForDueDate';
    const USE_LOT_NUMBER = 'UseLotNumber';
    const USE_BATCH_NUMBER = 'UseBatchNumber';
    const USE_DUE_DATE = 'UseDueDate';
    const WEIGHT = 'Weight';
    const QUANTITY_FULL_BOX = 'Quantity_Full_Box';
    const QUANTITY_FULL_PALLET = 'Quantity_Full_Pallet';
    const TRANSLATION = 'Translation';
    const TRANSLATION_LANGUAGE = 'Language';
    const TRANSLATION_DESCRIPTION_1 = 'Description1';
    const TRANSLATION_DESCRIPTION_2 = 'Description2';
    const TRANSLATION_DESCRIPTION_3 = 'Description3';

    const USE_EXACT_SIZE = 'UseExactSize';
    const HEIGHT = 'Height';
    const WIDTH = 'Width';
    const LENGTH = 'Length';

    private $ean;
    private $externalRef;
    private $description1;
    private $description2;
    private $description3;
    private $nrDaysNoDeliveryForDueDate;
    private $useLotNumber;
    private $useBatchNumber;
    private $useDueDate;
    private $weight;
    private $qtyFullBox;
    private $qtyFullPallet;
    private $translationLanguage;
    private $translationDescription1;
    private $translationDescription2;
    private $translationDescription3;
    private $useExactSize;
    private $height;
    private $width;
    private $length;


    /**
     * @return string
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @param string $ean
     * @return Product
     */
    public function setEan(string $ean)
    {
        self::validateLength(self::EAN_CODE, $ean, 20);
        $this->ean = $ean;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExternalRef()
    {
        return $this->externalRef;
    }

    /**
     * @param string $externalRef
     * @return Product
     */
    public function setExternalRef(string $externalRef)
    {
        self::validateLength(self::EXTERNAL_REF, $externalRef, 30);
        $this->externalRef = $externalRef;
        return $this;
    }

    /**
     * Default Description1 of the product
     * @return string
     */
    public function getDescription1()
    {
        return $this->description1;
    }

    /**
     * Default Description1 of the product
     * @param string $description1
     * @return Product
     */
    public function setDescription1(string $description1)
    {
        self::validateLength(self::DESCRIPTION_1, $description1, 60);
        $this->description1 = $description1;
        return $this;
    }

    /**
     * Default Description2 of the product
     * @return string|null
     */
    public function getDescription2()
    {
        return $this->description2;
    }

    /**
     * Default Description2 of the product
     * @param string $description2
     * @return Product
     */
    public function setDescription2(string $description2)
    {
        self::validateLength(self::DESCRIPTION_2, $description2, 40);

        $this->description2 = $description2;
        return $this;
    }

    /**
     * Default Description3 of the product
     * @return string|null
     */
    public function getDescription3()
    {
        return $this->description3;
    }

    /**
     * Default Description3 of the product
     * @param string $description3
     * @return Product
     */
    public function setDescription3($description3)
    {
        self::validateLength(self::DESCRIPTION_3, $description3, 40);
        $this->description3 = $description3;
        return $this;
    }

    /**
     * Number of days before the DueDate on whichthe article can no longer be shipped.
     * @return int|null
     */
    public function getNrDaysNoDeliveryForDueDate()
    {
        return $this->nrDaysNoDeliveryForDueDate;
    }

    /**
     * Number of days before the DueDate on whichthe article can no longer be shipped.
     * @param int $nrDaysNoDeliveryForDueDate
     * @return Product
     */
    public function setNrDaysNoDeliveryForDueDate(int $nrDaysNoDeliveryForDueDate)
    {
        self::validateInteger(self::NR_DELIVERY_FOR_DUE_DATE, $nrDaysNoDeliveryForDueDate, 999);
        $this->nrDaysNoDeliveryForDueDate = $nrDaysNoDeliveryForDueDate;
        return $this;
    }

    /**
     * Indicates whether a LotNo must be used for this product for the stock.
     * @return bool|null
     */
    public function getUseLotNumber()
    {
        return $this->useLotNumber;
    }

    /**
     * Indicates whether a LotNo must be used for this product for the stock.
     * @param bool $useLotNumber
     * @return Product
     */
    public function setUseLotNumber(bool $useLotNumber)
    {
        $this->useLotNumber = $useLotNumber;
        return $this;
    }

    /**
     * Indicates whether a BatchNomust be used for this product for the stock.
     * @return bool|null
     */
    public function getUseBatchNumber()
    {
        return $this->useBatchNumber;
    }

    /**
     * Indicates whether a BatchNomust be used for this product for the stock.
     * @param bool $useBatchNumber
     * @return Product
     */
    public function setUseBatchNumber(bool $useBatchNumber)
    {
        $this->useBatchNumber = $useBatchNumber;
        return $this;
    }

    /**
     * Indicates whether a DueDate must be used for this product for the stock
     * @return bool|null
     */
    public function getUseDueDate()
    {
        return $this->useDueDate;
    }

    /**
     * Indicates whether a DueDate must be used for this product for the stock
     * @param bool $useDueDate
     * @return Product
     */
    public function setUseDueDate(bool $useDueDate)
    {
        $this->useDueDate = $useDueDate;
        return $this;
    }

    /**
     * Weight of product in grams.
     * @return int|null
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Weight of product in grams.
     * @param int $weight
     * @return Product
     */
    public function setWeight(int $weight)
    {
        self::validateInteger(self::WEIGHT, $weight, 999999);
        $this->weight = $weight;
        return $this;
    }

    /**
     * Quantity of single units in one box
     * @return int|null
     */
    public function getQtyFullBox()
    {
        return $this->qtyFullBox;
    }

    /**
     * Quantity of single units in one box
     * @param int $qtyFullBox
     * @return Product
     */
    public function setQtyFullBox(int $qtyFullBox)
    {
        self::validateInteger(self::QUANTITY_FULL_BOX, $qtyFullBox, 999999);

        $this->qtyFullBox = $qtyFullBox;
        return $this;
    }

    /**
     * Quantity of single units in one pallet
     * @return int|null
     */
    public function getQtyFullPallet()
    {
        return $this->qtyFullPallet;
    }

    /**
     * Quantity of single units in one pallet
     * @param int $qtyFullPallet
     * @return Product
     */
    public function setQtyFullPallet(int $qtyFullPallet)
    {
        self::validateInteger(self::QUANTITY_FULL_PALLET, $qtyFullPallet, 999999);

        $this->qtyFullPallet = $qtyFullPallet;
        return $this;
    }

    /**
     * Language to be able to add description per itemper languages(e.g. NL,EN,FR)If these fields are used,
     * these will be used on the packslips, same as the language of the order .
     * If not uses defaultfields will be used
     * @return string|null
     */
    public function getTranslationLanguage()
    {
        return $this->translationLanguage;
    }

    /**
     * Language to be able to add description per itemper languages(e.g. NL,EN,FR)If these fields are used,
     * these will be used on the packslips, same as the language of the order .
     * @param string $translationLanguage
     * @return Product
     */
    public function setTranslationLanguage(string $translationLanguage)
    {
        self::validateLength(self::TRANSLATION . " " . self::TRANSLATION_LANGUAGE, $translationLanguage, 2);
        $this->translationLanguage = $translationLanguage;
        return $this;
    }

    /**
     * Description of the product in chosen language
     * @return string|null
     */
    public function getTranslationDescription1()
    {
        return $this->translationDescription1;
    }

    /**
     * Description of the product in chosen language
     * @param string $translationDescription1
     * @return Product
     */
    public function setTranslationDescription1(string $translationDescription1)
    {
        self::validateLength(self::TRANSLATION . " " . self::TRANSLATION_DESCRIPTION_1, $translationDescription1, 60);
        $this->translationDescription1 = $translationDescription1;
        return $this;
    }

    /**
     * Description2 of the product in chosen language
     * @return string|null
     */
    public function getTranslationDescription2()
    {
        return $this->translationDescription2;
    }

    /**
     * Description2 of the product in chosen language
     * @param string $translationDescription2
     * @return Product
     */
    public function setTranslationDescription2(string $translationDescription2)
    {
        self::validateLength(self::TRANSLATION . " " . self::TRANSLATION_DESCRIPTION_2, $translationDescription2, 40);
        $this->translationDescription2 = $translationDescription2;
        return $this;
    }

    /**
     * Description3 of the product in chosen language
     * @return string|null
     */
    public function getTranslationDescription3()
    {
        return $this->translationDescription3;
    }

    /**
     * Description3 of the product in chosen language
     * @param string $translationDescription3
     * @return Product
     */
    public function setTranslationDescription3($translationDescription3)
    {
        self::validateLength(self::TRANSLATION . " " . self::TRANSLATION_DESCRIPTION_3, $translationDescription3, 40);
        $this->translationDescription3 = $translationDescription3;
        return $this;
    }

    /**
     * Marks a product as UseExactSize-product (value =1).
     * For purposeto always book as separate colli on shipment and to use the provided volume and weight
     * as known for this product (fields weight,height,width and length.)
     * Only use if aligned with Distrimedia
     * @return int|null
     */
    public function getUseExactSize()
    {
        return $this->useExactSize;
    }

    /**
     * Marks a product as UseExactSize-product (value =1).
     * For purposeto always book as separate colli on shipment and to use the provided volume and weight
     * as known for this product (fields weight,height,width and length.)
     * Only use if aligned with Distrimedia
     * @param int $useExactSize
     * @return Product
     */
    public function setUseExactSize(int $useExactSize)
    {
        self::validateInteger(self::USE_EXACT_SIZE, $useExactSize, 999999);
        $this->useExactSize = $useExactSize;
        return $this;
    }

    /**
     * Height of the product in cm
     * @return int|null
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Height of the product in cm
     * @param int $height
     * @return Product
     */
    public function setHeight(int $height)
    {
        self::validateInteger(self::HEIGHT, $height, 999999);
        $this->height = $height;
        return $this;
    }

    /**
     * Width of the product in cm
     * @return int|null
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Width of the product in cm
     * @param int $width
     * @return Product
     */
    public function setWidth(int $width)
    {
        self::validateInteger(self::WIDTH, $width, 999999);
        $this->width = $width;
        return $this;
    }

    /**
     * Length of the product in cm
     * @return int|null
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Length of the product in cm
     * @param int $length
     * @return Product
     */
    public function setLength(int $length)
    {
        self::validateInteger(self::LENGTH, $length, 999999);
        $this->length = $length;
        return $this;
    }

    /**
     * @return array
     */
    public function __toArray(): array
    {
        $this->validate();

        $data = [
            self::EAN_CODE => $this->getEan(),
            self::EXTERNAL_REF => $this->getExternalRef(),
            self::DESCRIPTION_1 => $this->getDescription1(),
            self::DESCRIPTION_2 => $this->getDescription2(),
            self::DESCRIPTION_3 => $this->getDescription3(),
            self::NR_DELIVERY_FOR_DUE_DATE => $this->getNrDaysNoDeliveryForDueDate(),
            self::USE_LOT_NUMBER => $this->getUseLotNumber(),
            self::USE_BATCH_NUMBER => $this->getUseBatchNumber(),
            self::USE_DUE_DATE => $this->getUseDueDate(),
            self::WEIGHT => $this->getWeight(),
            self::QUANTITY_FULL_BOX => $this->getQtyFullBox(),
            self::QUANTITY_FULL_PALLET => $this->getQtyFullPallet(),
            self::USE_EXACT_SIZE => $this->getUseExactSize(),
            self::HEIGHT => $this->getHeight(),
            self::WIDTH => $this->getWidth(),
            self::LENGTH => $this->getLength()
        ];

        if ($this->getTranslationLanguage()) {
            $data[self::TRANSLATION] = [
                self::TRANSLATION_LANGUAGE => $this->getTranslationLanguage()
            ];

            if (!empty($this->getTranslationDescription1())) {
                $data[self::TRANSLATION][self::TRANSLATION_DESCRIPTION_1] = $this->getTranslationDescription1();
            }
            if (!empty($this->getTranslationDescription2())) {
                $data[self::TRANSLATION][self::TRANSLATION_DESCRIPTION_2] = $this->getTranslationDescription2();
            }
            if (!empty($this->getTranslationDescription2())) {
                $data[self::TRANSLATION][self::TRANSLATION_DESCRIPTION_2] = $this->getTranslationDescription3();
            }
        }

        $data = array_filter($data);

        return $data;
    }

    /**
     * @return bool
     * @throws InvalidProductException
     */
    public function validate(): bool
    {
        if (empty($this->getEan())) {
            throw new InvalidProductException("Ean is a required Product field");
        }

        if (empty($this->getDescription1())) {
            throw new InvalidProductException("Description1 is a required Product field");
        }

        return true;
    }
}
