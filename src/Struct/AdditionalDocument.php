<?php

declare(strict_types=1);

namespace DistriMedia\SoapClient\Struct;

use DistriMedia\SoapClient\InvalidAdditionalDocumentException;
use DistriMedia\SoapClient\Traits\ArgumentValidatorTrait;

class AdditionalDocument  extends AbstractStruct implements StructInterface
{
    use ArgumentValidatorTrait;

    const FILE_TAG = 'FileTag';
    const BIN_DATA = 'BinData';

    private $fileTag;
    private $binData;

    /**
     * @return string|null
     */
    public function getFileTag()
    {
        return $this->fileTag;
    }

    /**
     * @param string $fileTag
     * @return AdditionalDocument
     */
    public function setFileTag(string $fileTag)
    {
        self::validateLength(self::FILE_TAG, $fileTag, 20);

        $this->fileTag = $fileTag;
        return $this;
    }

    /**
     * @return string
     */
    public function getBinData()
    {
        return $this->binData;
    }

    /**
     * @param mixed $binData
     * @return AdditionalDocument
     */
    public function setBinData(string $binData)
    {
        self::validateBase64encode(self::BIN_DATA, $binData);
        $this->binData = $binData;
        return $this;
    }

    /**
     * @return array
     * @throws InvalidAdditionalDocumentException
     */
    public function __toArray(): array
    {
        $this->validate();

        $data = [
            self::FILE_TAG => $this->getFileTag(),
            self::BIN_DATA => $this->getBinData()
        ];

        $data = array_filter($data);

        return $data;
    }

    /**
     * @return bool
     * @throws InvalidAdditionalDocumentException
     */
    public function validate(): bool
    {
        if (empty($this->getBinData())) {
            throw new InvalidAdditionalDocumentException("BinData is a required field");
        }

        return true;
    }
}
