<?php

declare(strict_types=1);

namespace DistriMedia\SoapClient\Struct\Response\Inventory;

class StockItem
{
    const EAN = 'EAN';
    const PIECES = 'Pieces';
    const CLAIMED = 'Claimed';
    const CLAIMABLE = 'Claimable';
    const PROBLEM = 'Problem';
    const OVERDUE = 'Overdue';
    const BLOCKED = 'Blocked';

    private $ean;
    private $pieces;
    private $claimed;
    private $claimable;
    private $problem;
    private $overdue;
    private $blocked;

    public function __construct(
        array $data = []
    )
    {
        $this->ean = isset($data[self::EAN]) ? $data[self::EAN] : null;
        $this->pieces = isset($data[self::PIECES]) ? $data[self::PIECES] : null;
        $this->claimed = isset($data[self::CLAIMED]) ? (bool) $data[self::CLAIMED] : null;
        $this->claimable = isset($data[self::CLAIMABLE]) ? (int) $data[self::CLAIMABLE] : null;
        $this->problem = isset($data[self::PROBLEM]) ? $data[self::PROBLEM] : null;
        $this->overdue = isset($data[self::OVERDUE]) ? $data[self::OVERDUE] : null;
        $this->blocked = isset($data[self::BLOCKED]) ? $data[self::BLOCKED] : null;
    }

    /**
     * @return mixed
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @return mixed
     */
    public function getPieces()
    {
        return $this->pieces;
    }

    /**
     * @return mixed
     */
    public function getClaimed()
    {
        return $this->claimed;
    }

    /**
     * @return mixed
     */
    public function getClaimable()
    {
        return $this->claimable;
    }

    /**
     * @return mixed
     */
    public function getProblem()
    {
        return $this->problem;
    }

    /**
     * @return mixed
     */
    public function getOverdue()
    {
        return $this->overdue;
    }

    /**
     * @return mixed
     */
    public function getBlocked()
    {
        return $this->blocked;
    }
}
