<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Units;

use Jamal\UnitConverter\Contracts\UnitCategory;

enum Mass: string implements UnitCategory
{
    case kilogram = 'kilogram';
    case gram = 'gram';
    case milligram = 'milligram';
    case microgram = 'microgram';
    case ton = 'ton';
    case pound = 'pound';
    case ounce = 'ounce';

    public static function category(): string { return 'mass'; }
    public function code(): string { return self::category().'.'.$this->value; }
}
