<?php

declare(strict_types=1);

namespace DistriMedia\SoapClient\Struct;

use DistriMedia\SoapClient\Traits\ArgumentValidatorTrait;

class LabelText extends AbstractStruct implements StructInterface
{
    use ArgumentValidatorTrait;

    const DESCRIPTION = 'Description';

    private $description;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return LabelText
     */
    public function setDescription($description)
    {
        self::validateLength(self::DESCRIPTION, $description, 80);

        $this->description = $description;
        return $this;
    }

    /**
     * @return array
     */
    public function __toArray(): array
    {
        $this->validate();

        $data = [
            self::DESCRIPTION  => $this->getDescription()
        ];

        $data = array_filter($data);

        return $data;
    }

    public function validate(): bool
    {
        return true;
    }
}
