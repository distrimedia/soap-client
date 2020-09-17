<?php

declare(strict_types=1);

namespace DistriMedia\SoapClient\Struct;

use DistriMedia\SoapClient\InvalidCarrierException;

class Carrier extends AbstractStruct implements StructInterface
{
    /**
     * Untracked postal shipment
     */
    const CARRIER_BB = 'BB';

    /**
     * Tracked parcel mailbox Bpost
     * The parcel must fit in mailbox
     */
    const CARRIER_BBUS = 'BBUS';

    /**
     * Tracked parcel mailbox Bpost SAT
     * The parcel must fit in mailbox,delivery on Saturday
     */
    const CARRIER_BBUSSATT = 'BBUSSATT';

    /**
     * Tracked Parcel basic Bpost
     * BE only
     */
    const CARRIER_BP = 'BP';

    /**
     * Tracked parcel basic Bpost outside BE
     * Outside BE
     */
    const CARRIER_BPINT = 'BPINT';

    /**
     * Tracked Parcel Bpost pick-up-lockers
     * (special rules concerning servicepoint address, ask Distrimedia Logistics) BE only
     */
    const CARRIER_BP247 = 'BP247';

    /**
     * Tracked Parcel Bpost pick-up-points
     * special rules concerning servicepoint address, ask Distrimedia Logistics) BE only
     */
    const CARRIER_BPPUGO = 'BPPUGO';

    /**
     * Tracked Parcel basic Bpost SAT
     * BE only, delivery on Saturday
     */
    const CARRIER_BPSAT = 'BPSAT';

    /**
     * Back to returns department
     * See Unexpected Return
     */
    const CARRIER_BTR = 'BTR';

    /**
     * Dachser
     */
    const CARRIER_DACHDM = 'DACHDM';

    /**
     * DHL parcel benelux
     * Only BE,NL,LU
     */
    const CARRIER_DHL = 'DHL';

    /**
     * DHL Express + Insurance
     * OrderValue mandatory
     */
    const CARRIER_DHLINS = 'DHLINS';

    /**
     * Tracked parcel Postnl Extra@Home big sized shipments
     * BENELUX only, 1 or 2 persons delivery
     */
    const CARRIER_EX = 'EX';

    /**
     * tracked Parcel GLS
     * optional Flex Delivery, ask Distrimedia Logistics)
     */
    const CARRIER_GL = 'GL';

    /**
     * Freight GLS (pallets)
     */
    const CARRIER_GLPAL = 'GLPAL';

    /**
     * Tracked parcel Mondial Relay big sized shipments
     * Delivered after appointment by 1 (LD1)or 2(LDS) persons ,BE-FR only
     */
    const CARRIER_MR = 'MR';

    /**
     * Tacked parcel Mondial Relay
     */
    const CARRIER_MRHOME = 'MRHOME';

    /**
     * Tracked parcel Mondial Relay + signature
     */
    const CARRIER_MRHOMEHT = 'MRHOMEHT';

    /**
     * Tracked Parcel basic PostNL
     */
    const CARRIER_PNL = 'PNL';

    /**
     * Tracked Parcel + signature PostNL
     */
    const CARRIER_PNLHT = 'PNLHT';

    /**
     * TNT
     */
    const CARRIER_TNT = 'TNT';

    /**
     * PickupDistrimedia Logistics
     */
    const CARRIER_WA = 'WA';

    private $carrier;
    private $isDefault;
    /**
     * Carrier constructor.
     * @param string $carrier
     * @param bool $isDefault If your carrier code is not a default one, set this flag to false
     */
    public function __construct(
        string $carrier,
        bool $isDefault = true
    )
    {
        $this->carrier = $carrier;
        $this->isDefault = $isDefault;
    }

    /**
     * @return string
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param string $carrier
     * @return bool
     * @throws InvalidCarrierException
     * @throws \ReflectionException
     */
    private function validateCarrier(string $carrier): bool
    {
        $reflectionClass = new \ReflectionClass($this);
        $defaultCarriers = $reflectionClass->getConstants();

        if (!in_array($carrier, $defaultCarriers)) {
            throw new InvalidCarrierException("Invalid carrier {$carrier} defined. For custom carriers, please define isDefault flag");
        }

        return true;
    }

    public function validate(): bool
    {
        if ($this->isDefault === true) {
            $this->validateCarrier($this->getCarrier());
        }

        return true;
    }

    public function __toArray(): array
    {
        // TODO: Implement __toArray() method.
    }
}
