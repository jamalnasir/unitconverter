<?php
declare(strict_types=1);

namespace Jamal\UnitConverter;

use Jamal\UnitConverter\Contracts\UnitCategory;
use Jamal\UnitConverter\Exceptions\ConversionException;

final class Converter
{
    private UnitRegistry $registry;
    private Math $math;

    public function __construct(?UnitRegistry $registry = null, ?Math $math = null)
    {
        $this->registry = $registry ?? new UnitRegistry();
        $this->math = $math ?? new Math(false, 9);
    }

    public static function for(string $category): self
    {
        return new self();
    }

    public function convert(float|int|string $value, UnitCategory $from, UnitCategory $to): float
    {
        $category = $from::category();
        if ($category !== $to::category()) {
            throw new ConversionException('Cannot convert between different categories.');
        }
        $meta = $this->registry->getCategory($category);

        // functional conversion
        if (isset($meta['toBase'], $meta['fromBase'])) {
            $toBase = $meta['toBase'];
            $fromBase = $meta['fromBase'];
            $baseVal = $toBase($from->value, (string)$value);
            $out = $fromBase($to->value, $baseVal);
            return (float)$out;
        }

        // factor conversion via base unit
        $factors = $meta['factors'];
        if (!isset($factors[$from->value], $factors[$to->value])) {
            throw new ConversionException('Unknown unit in category '. $category);
        }
        $fromFactor = $factors[$from->value];
        $toFactor = $factors[$to->value];
        // Convert to base (value * fromFactorInBase) then divide by toFactor
        $base = $this->math->mul((string)$value, (string)$fromFactor);
        $result = $this->math->div($base, (string)$toFactor);
        return (float)$result;
    }

    public function from(UnitCategory $from, float|int|string $value): PendingConversion
    {
        return new PendingConversion($this, $from, (float)$value);
    }
}

final class PendingConversion
{
    public function __construct(
        private readonly Converter $converter,
        private readonly UnitCategory $from,
        private readonly float $value
    ) {}

    public function to(UnitCategory $to): float
    {
        return $this->converter->convert($this->value, $this->from, $to);
    }
}
