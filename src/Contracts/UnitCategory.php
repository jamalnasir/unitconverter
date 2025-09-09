<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Contracts;

interface UnitCategory
{
    /** Returns the category name, e.g., 'length'. */
    public static function category(): string;

    /** Returns the canonical unit code for this enum case, e.g., 'length.meter'. */
    public function code(): string;
}
