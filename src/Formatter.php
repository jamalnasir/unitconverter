<?php
declare(strict_types=1);

namespace Jamal\UnitConverter;

use Jamal\UnitConverter\Contracts\UnitCategory;

final class Formatter
{
    public function __construct(
        private readonly string $decimal = '.',
        private readonly string $thousands = ',',
        private readonly int $precision = 2
    ) {}

    public function format(Measurement $m, ?int $precision = null): string
    {
        $p = $precision ?? $this->precision;
        return number_format($m->amount, $p, $this->decimal, $this->thousands) . ' ' . $m->unit->value;
    }
}
