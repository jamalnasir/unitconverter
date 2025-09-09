<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Units;

use Jamal\UnitConverter\Contracts\UnitCategory;

enum Temperature: string implements UnitCategory
{
    case celsius = 'celsius';
    case fahrenheit = 'fahrenheit';
    case kelvin = 'kelvin';

    public static function category(): string { return 'temperature'; }
    public function code(): string { return self::category().'.'.$this->value; }
}
