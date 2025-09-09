<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Units;

use Jamal\UnitConverter\Contracts\UnitCategory;

enum DigitalStorage: string implements UnitCategory
{
    case bit = 'bit';
    case kilobit = 'kilobit';
    case megabit = 'megabit';
    case gigabit = 'gigabit';
    case terabit = 'terabit';
    case byte = 'byte';
    case kilobyte = 'kB';
    case megabyte = 'MB';
    case gigabyte = 'GB';
    case terabyte = 'TB';
    case kibibyte = 'KiB';
    case mebibyte = 'MiB';
    case gibibyte = 'GiB';
    case tebibyte = 'TiB';

    public static function category(): string { return 'digital_storage'; }
    public function code(): string { return self::category().'.'.$this->value; }
}
