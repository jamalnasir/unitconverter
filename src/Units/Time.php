<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Units;

use Jamal\UnitConverter\Contracts\UnitCategory;

enum Time: string implements UnitCategory
{
    case second = 'second';
    case millisecond = 'millisecond';
    case microsecond = 'microsecond';
    case minute = 'minute';
    case hour = 'hour';
    case day = 'day';
    case week = 'week';

    public static function category(): string { return 'time'; }
    public function code(): string { return self::category().'.'.$this->value; }
}
