<?php

declare(strict_types=1);

namespace DistriMedia\SoapClient\Struct;

use DistriMedia\SoapClient\InvalidCustomerException;
use DistriMedia\SoapClient\Traits\ArgumentValidatorTrait;

class Customer extends AbstractStruct implements StructInterface
{
    use ArgumentValidatorTrait;

    const EXTERNAL_ID = 'ExternalID';
    const NAME = 'Name';
    const NAME2 = 'Name2';
    const ADDRESS_1 = 'Address1';
    const ADDRESS_2 = 'Address2';
    const POSTAL_CODE_1 = 'PostalCode1';
    const POSTAL_CODE_2 = 'PostalCode2';
    const CITY = 'City';
    const COUNTRY = 'Country';
    const MOBILE = 'Mobile';
    const TELEPHONE = 'Telephone';
    const EMAIL = 'eMail';
    const SERVICE_POINT = 'ServicePoint';

    private $externalId;
    private $name;
    private $name2;
    private $address1;
    private $address2;
    private $postcode1;
    private $postcode2;
    private $city;
    private $country;
    private $mobile;
    private $telephone;
    private $email;
    private $servicePoint;

    /**
     * Default empty, only fill out in agreement with Distrimedia
     * @return string|null
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * Default empty, only fill out in agreement with Distrimedia
     * @param string $externalId
     * @return Customer
     */
    public function setExternalId(string $externalId)
    {
        self::validateLength(self::EXTERNAL_ID, $externalId, 20);
        $this->externalId = $externalId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Customer
     */
    public function setName(string $name)
    {
        self::validateLength(self::NAME, $name, 60);
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName2()
    {
        return $this->name2;
    }

    /**
     * @param string $name2
     * @return Customer
     */
    public function setName2(string $name2)
    {
        self::validateLength(self::NAME2, $name2, 60);
        $this->name2 = $name2;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     * @return Customer
     */
    public function setAddress1(string $address1)
    {
        self::validateLength(self::ADDRESS_1, $address1, 40);
        $this->address1 = $address1;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     * @return Customer
     */
    public function setAddress2($address2)
    {
        self::validateLength(self::ADDRESS_2, $address2, 40);
        $this->address2 = $address2;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostcode1()
    {
        return $this->postcode1;
    }

    /**
     * @param string $postcode1
     * @return Customer
     */
    public function setPostcode1(string $postcode1)
    {
        self::validateLength(self::POSTAL_CODE_1, $postcode1, 11);

        $this->postcode1 = $postcode1;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostcode2()
    {
        return $this->postcode2;
    }

    /**
     * @param string $postcode2
     * @return Customer
     */
    public function setPostcode2(string $postcode2)
    {
        self::validateLength(self::POSTAL_CODE_2, $postcode2, 11);

        $this->postcode2 = $postcode2;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Customer
     */
    public function setCity(string $city)
    {
        self::validateLength(self::CITY, $city, 40);
        $this->city = $city;
        return $this;
    }

    /**
     * ISO2 code
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * ISO2 code
     * @param string $country
     * @return Customer
     */
    public function setCountry($country)
    {
        self::validateLength(self::COUNTRY, $country, 2);
        $this->country = $country;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     * @return Customer
     */
    public function setMobile(string $mobile)
    {
        self::validateLength(self::MOBILE, $mobile, 19);
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     * @return Customer
     */
    public function setTelephone(string $telephone)
    {
        self::validateLength(self::TELEPHONE, $telephone, 19);
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Customer
     */
    public function setEmail(string $email)
    {
        self::validateLength(self::EMAIL, $email, 150);
        $this->email = $email;
        return $this;
    }

    /**
     * For BPost-Delivery
     * @return string|null
     */
    public function getServicePoint()
    {
        return $this->servicePoint;
    }

    /**
     * For BPost-Delivery
     * @param string $servicePoint
     * @return Customer
     */
    public function setServicePoint(string $servicePoint)
    {
        self::validateLength(self::SERVICE_POINT, $servicePoint, 50);
        $this->servicePoint = $servicePoint;
        return $this;
    }

    public function __toArray(): array
    {
        $this->validate();

        $data = [
            self::EXTERNAL_ID => $this->getExternalId(),
            self::NAME => $this->getName(),
            self::NAME2 => $this->getName2(),
            self::ADDRESS_1 => $this->getAddress1(),
            self::ADDRESS_2 => $this->getAddress2(),
            self::POSTAL_CODE_1 => $this->getPostcode1(),
            self::POSTAL_CODE_2 => $this->getPostcode2(),
            self::CITY => $this->getCity(),
            self::COUNTRY => $this->getCountry(),
            self::MOBILE => $this->getMobile(),
            self::TELEPHONE => $this->getTelephone(),
            self::EMAIL => $this->getEmail(),
            self::SERVICE_POINT => $this->getServicePoint()
        ];

        $data = array_filter($data);

        return $data;
    }

    public function validate(): bool
    {
        if (empty($this->getName())) {
            throw new InvalidCustomerException("Name is a required Customer field");
        }

        if (empty($this->getAddress1())) {
            throw new InvalidCustomerException("Address1 is a required Customer field");

        }

        if (empty($this->getCity())) {
            throw new InvalidCustomerException("City is a required Customer field");
        }

        return true;
    }
}
