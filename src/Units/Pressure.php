<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Units;

use Jamal\UnitConverter\Contracts\UnitCategory;

enum Pressure: string implements UnitCategory
{
    case pascal = 'pascal';
    case kilopascal = 'kilopascal';
    case bar = 'bar';
    case millibar = 'millibar';
    case psi = 'psi';
    case atmosphere = 'atmosphere';

    public static function category(): string { return 'pressure'; }
    public function code(): string { return self::category().'.'.$this->value; }
}
