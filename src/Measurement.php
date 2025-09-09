<?php
declare(strict_types=1);

namespace Jamal\UnitConverter;

use Jamal\UnitConverter\Contracts\UnitCategory;
use Jamal\UnitConverter\Exceptions\ConversionException;

final class Measurement
{
    public function __construct(
        public readonly float $amount,
        public readonly UnitCategory $unit
    ) {}

    public function to(UnitCategory $to, ?Converter $converter = null): self
    {
        if ($this->unit::category() !== $to::category()) {
            throw new ConversionException('Cannot convert between different categories.');
        }
        $converter ??= new Converter();
        $value = $converter->convert($this->amount, $this->unit, $to);
        return new self($value, $to);
    }
}
