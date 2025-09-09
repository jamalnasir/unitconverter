<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Units;

use Jamal\UnitConverter\Contracts\UnitCategory;

enum Energy: string implements UnitCategory
{
    case joule = 'joule';
    case kilojoule = 'kilojoule';
    case calorie = 'calorie';
    case kilocalorie = 'kilocalorie';
    case watt_hour = 'watt_hour';
    case kilowatt_hour = 'kilowatt_hour';
    case btu = 'btu';

    public static function category(): string { return 'energy'; }
    public function code(): string { return self::category().'.'.$this->value; }
}
