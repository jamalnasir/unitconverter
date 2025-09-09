<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Units;

use Jamal\UnitConverter\Contracts\UnitCategory;

enum FuelEconomy: string implements UnitCategory
{
    case liter_per_100km = 'liter_per_100km';
    case mpg_US = 'mpg_US';
    case mpg_UK = 'mpg_UK';

    public static function category(): string { return 'fuel_economy'; }
    public function code(): string { return self::category().'.'.$this->value; }
}
