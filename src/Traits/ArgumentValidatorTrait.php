<?php

declare(strict_types=1);

namespace DistriMedia\SoapClient\Traits;

trait ArgumentValidatorTrait
{
    public static function validateLength(string $param, $value, int $size)
    {
        if (strlen($value) > $size) {
            throw new \InvalidArgumentException("Parameter {$param} exceeds the maximum size of {$size}");
        }

        return true;
    }

    public static function validateInteger(string $param, int $value, int $maxValue)
    {
        self::validateNumber($param, $value, $maxValue);
    }

    public static function validateFloat(string $param, float $value, float $maxValue)
    {
        self::validateNumber($param, $value, $maxValue);
    }

    private static function validateNumber(string $param, $value, $maxValue)
    {
        if ($value > $maxValue) {
            throw new \InvalidArgumentException("Parameter {$param} exceeds the maximum of {$maxValue}");
        }
    }

    public static function validateDateInFuture(string $param, \DateTime $dateTime)
    {
        if (strtotime($dateTime) < time()) {
            throw new \InvalidArgumentException("Parameter {$param} must be a day in the future");
        }

        return true;
    }

    public static function validateBase64encode(string $param, string $value)
    {
        $str = base64_decode($value, true);

        // If $input cannot be decoded the $str will be a Boolean “FALSE”
        if ($str === false) {
            throw new \InvalidArgumentException("Parameter {$param} is not valid base64encoded data");
        } else {
            // Even if $str is not FALSE, this does not mean that the input is valid
            // This is why now we should encode the decoded string and check it against input
            $b64 = base64_encode($str);

            // Finally, check if input string and real Base64 are identical
            if ($value !== $b64) {
                throw new \InvalidArgumentException("Parameter {$param} is not valid base64encoded data");
            }
        }
    }
}
