<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Units;

use Jamal\UnitConverter\Contracts\UnitCategory;

enum Speed: string implements UnitCategory
{
    case meter_per_second = 'meter_per_second';
    case kilometer_per_hour = 'kilometer_per_hour';
    case mile_per_hour = 'mile_per_hour';
    case knot = 'knot';

    public static function category(): string { return 'speed'; }
    public function code(): string { return self::category().'.'.$this->value; }
}
