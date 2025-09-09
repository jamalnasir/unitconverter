<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Jamal\UnitConverter\UnitRegistry;

class ValidUnit implements ValidationRule
{
    public function __construct(private readonly ?string $expectedCategory = null) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value) || strpos($value, '.') === false) {
            $fail($attribute.' must be a unit string like "length.meter"');
            return;
        }
        [$category, $unit] = explode('.', $value, 2);
        if ($this->expectedCategory && $category !== $this->expectedCategory) {
            $fail($attribute.' must be a unit of '.$this->expectedCategory);
            return;
        }
        $registry = new UnitRegistry();
        if (!$registry->hasCategory($category)) {
            $fail('Unknown unit category: '.$category);
            return;
        }
        $meta = $registry->getCategory($category);
        $enumClass = $meta['base']::class;
        try {
            $enumClass::from($unit);
        } catch (\ValueError) {
            $fail('Unknown unit: '.$value);
        }
    }
}
