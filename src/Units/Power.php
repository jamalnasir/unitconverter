<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Units;

use Jamal\UnitConverter\Contracts\UnitCategory;

enum Power: string implements UnitCategory
{
    case watt = 'watt';
    case kilowatt = 'kilowatt';
    case horsepower = 'horsepower';

    public static function category(): string { return 'power'; }
    public function code(): string { return self::category().'.'.$this->value; }
}
