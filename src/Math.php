<?php
declare(strict_types=1);

namespace Jamal\UnitConverter;

final class Math
{
    public function __construct(
        private readonly bool $preferBcMath = false,
        private readonly int $precision = 9
    ) {}

    private function useBc(): bool
    {
        return $this->preferBcMath && \extension_loaded('bcmath');
    }

    public function mul(string|int|float $a, string|int|float $b): string
    {
        if ($this->useBc()) {
            return \bccomp('0','0') === 0 ? \bcmul((string)$a, (string)$b, $this->precision) : (string)((float)$a*(float)$b);
        }
        return (string)((float)$a * (float)$b);
    }

    public function div(string|int|float $a, string|int|float $b): string
    {
        if ($this->useBc()) {
            return \bccomp('0','0') === 0 ? \bcdiv((string)$a, (string)$b, $this->precision) : (string)((float)$a/(float)$b);
        }
        return (string)((float)$a / (float)$b);
    }
}
