<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Jamal\UnitConverter\Measurement;
use Jamal\UnitConverter\UnitRegistry;

class AsMeasurement implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): ?Measurement
    {
        if ($value === null) return null;
        $unit = $attributes[$key.'_unit'] ?? null;
        if (!$unit) return null;
        [$category, $unitValue] = explode('.', $unit, 2);
        $registry = new UnitRegistry();
        $base = $registry->getCategory($category)['base'];
        $enumClass = $base::class;
        $unitEnum = $enumClass::from($unitValue);
        return new Measurement((float)$value, $unitEnum);
    }

    public function set($model, string $key, $value, array $attributes): array
    {
        if ($value instanceof Measurement) {
            return [
                $key => $value->amount,
                $key.'_unit' => $value->unit::category().'.'.$value->unit->value,
            ];
        }
        return [$key => $value];
    }
}
