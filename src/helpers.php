<?php
declare(strict_types=1);

use Jamal\UnitConverter\Converter;

if (!function_exists('unit_convert')) {
    function unit_convert(float|int|string $value, string $from, string $to): float {
        [$fromCat, $fromUnit] = explode('.', $from, 2);
        [$toCat, $toUnit] = explode('.', $to, 2);
        $registry = new Jamal\UnitConverter\UnitRegistry();
        if ($fromCat !== $toCat) {
            throw new Jamal\UnitConverter\Exceptions\ConversionException('Cannot convert between different categories.');
        }
        $category = $registry->getCategory($fromCat);
        $enumClass = $category['base']::class;
        /** @var \UnitEnum $fromEnum */
        $fromEnum = $enumClass::from($fromUnit);
        /** @var \UnitEnum $toEnum */
        $toEnum = $enumClass::from($toUnit);
        return (new Converter($registry))->convert($value, $fromEnum, $toEnum);
    }
}
