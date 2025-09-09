<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Units;

use Jamal\UnitConverter\Contracts\UnitCategory;

/**
 * Length units. Base unit: meter.
 */
enum Length: string implements UnitCategory
{
    case meter = 'meter';
    case kilometer = 'kilometer';
    case centimeter = 'centimeter';
    case millimeter = 'millimeter';
    case micrometer = 'micrometer';
    case nanometer = 'nanometer';
    case mile = 'mile';
    case yard = 'yard';
    case foot = 'foot';
    case inch = 'inch';
    case nautical_mile = 'nautical_mile';

    public static function category(): string { return 'length'; }
    public function code(): string { return self::category().'.'.$this->value; }
}
