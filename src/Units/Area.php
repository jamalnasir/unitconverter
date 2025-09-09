<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Units;

use Jamal\UnitConverter\Contracts\UnitCategory;

enum Area: string implements UnitCategory
{
    case square_meter = 'square_meter';
    case square_kilometer = 'square_kilometer';
    case square_centimeter = 'square_centimeter';
    case square_inch = 'square_inch';
    case square_foot = 'square_foot';
    case acre = 'acre';
    case hectare = 'hectare';

    public static function category(): string { return 'area'; }
    public function code(): string { return self::category().'.'.$this->value; }
}
