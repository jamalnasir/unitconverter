<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Units;

use Jamal\UnitConverter\Contracts\UnitCategory;

enum Volume: string implements UnitCategory
{
    case liter = 'liter';
    case milliliter = 'milliliter';
    case cubic_meter = 'cubic_meter';
    case cubic_centimeter = 'cubic_centimeter';
    case cubic_inch = 'cubic_inch';
    case cubic_foot = 'cubic_foot';
    case us_gallon = 'US_gallon';
    case us_quart = 'US_quart';
    case us_pint = 'US_pint';
    case us_fluid_ounce = 'US_fluid_ounce';
    case imperial_gallon = 'imperial_gallon';
    case imperial_pint = 'imperial_pint';
    case imperial_fluid_ounce = 'imperial_fluid_ounce';

    public static function category(): string { return 'volume'; }
    public function code(): string { return self::category().'.'.$this->value; }
}
