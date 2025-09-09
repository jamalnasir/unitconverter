<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Units;

use Jamal\UnitConverter\Contracts\UnitCategory;

enum Frequency: string implements UnitCategory
{
    case hertz = 'hertz';
    case kilohertz = 'kilohertz';
    case megahertz = 'megahertz';
    case gigahertz = 'gigahertz';

    public static function category(): string { return 'frequency'; }
    public function code(): string { return self::category().'.'.$this->value; }
}
