<?php
declare(strict_types=1);

namespace Jamal\UnitConverter\Laravel;

use Illuminate\Support\Facades\Facade;

class UnitConverterFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'unit-converter';
    }
}
