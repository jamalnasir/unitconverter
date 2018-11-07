<?php
/**
 * Created by PhpStorm.
 * User: jamal
 * Date: 9/17/18
 * Time: 4:24 PM
 */

namespace Jamal\UnitConverter;


use Illuminate\Support\Facades\Facade;

class UnitConverterFacade extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'unit-converter';
    }


}