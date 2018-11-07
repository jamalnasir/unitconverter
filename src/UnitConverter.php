<?php
/**
 * Created by PhpStorm.
 * User: jamal
 * Date: 9/17/18
 * Time: 3:53 PM
 */

namespace Jamal\UnitConverter;

class UnitConverter {

    public function kilometers() {
        return UnitFactory::make('km');
    }

    public function miles() {
        return UnitFactory::make('miles');
    }

    public function meters() {
        return UnitFactory::make('meters');
    }

    public function nauticalMiles() {
        return UnitFactory::make('nautical-miles');
    }

}