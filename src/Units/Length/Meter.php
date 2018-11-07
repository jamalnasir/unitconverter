<?php
/**
 * Created by PhpStorm.
 * User: jamal
 * Date: 9/17/18
 * Time: 6:34 PM
 */

namespace Jamal\UnitConverter\Units\Length;


class Meter {

    public function toKilometer($value) {
        return $value / 1000;
    }

    public function toMile($value) {
        return $value / 1.609;
    }

    public function toCentiMeter($value) {
        return $value * 100000;
    }

    public function toMilliMeter($value) {
        return $value * 1000000;
    }

    public function toMicroMeter($value) {
        return $value * 1000000000;
    }

    public function toNanoMeter($value) {
        return $value * 1000000000000;
    }

    public function toYard($value) {
        return $value * 1093.613;
    }

    public function toFoot($value) {
        return $value * 3280.84;
    }

    public function toInch($value) {
        return $value * 39370.079;
    }

    public function toNauticalMile($value) {
        return $value / 1.852;
    }

    public function toAll($value) {

        return [

            'kilometers' => $this->toKilometer($value),
            'miles' => $this->toMile($value),
            'centiMeters' => $this->toCentiMeter($value),
            'milliMeters' => $this->toMilliMeter($value),
            'microMeters' => $this->toMicroMeter($value),
            'nanoMeters' => $this->toNanoMeter($value),
            'yards' => $this->toYard($value),
            'feet' => $this->toFoot($value),
            'inches' => $this->toInch($value),
            'nauticalMile' => $this->toNauticalMile($value)

        ];

    }

}