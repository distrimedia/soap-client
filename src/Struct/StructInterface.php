<?php

namespace DistriMedia\SoapClient\Struct;

interface StructInterface
{
    public function validate(): bool;

    public function __toArray(): array;
}
