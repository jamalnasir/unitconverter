<?php
/**
 * Created by PhpStorm.
 * User: jamal
 * Date: 9/17/18
 * Time: 6:19 PM
 */

namespace Jamal\UnitConverter;

use Illuminate\Support\Facades\Facade;
use Jamal\UnitConverter\Units\Length\Kilometers;
use Jamal\UnitConverter\Units\Length\Meter;
use Jamal\UnitConverter\Units\Length\Miles;
use Jamal\UnitConverter\Units\Length\NauticalMile;

class UnitFactory extends Facade {

    public static function make($unit) {

        switch($unit) {

            case 'km': return new Kilometers();
            case 'miles' : return new Miles();
            case 'meters' : return new Meter();
            case 'nautical-miles' : return new NauticalMile();
            default : return new Kilometers();

        }

    }

}