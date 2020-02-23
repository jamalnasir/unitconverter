<?php
/**
 * Created by PhpStorm.
 * User: jamal
 * Date: 9/17/18
 * Time: 6:19 PM
 */

namespace Jamal\UnitConverter\Units\Length;


class Centimeter {

    public function toMile($value) {
        return $value / 160934;
    }

    public function toMeter($value) {
        return $value / 100;
    }

    public function toKilometer($value) {
        return $value / 100000;
    }

    public function toMilliMeter($value) {
        return $value / 10;
    }

    public function toMicroMeter($value) {
        return $value * 10000;
    }

    public function toNanoMeter($value) {
        return $value * 1000000;
    }

    public function toYard($value) {
        return $value / 91.44;
    }

    public function toFoot($value) {
        return $value / 30.48;
    }

    public function toInch($value) {
        return $value / 2.54;
    }

    public function toNauticalMile($value) {
        return $value / 185200;
    }

    public function toAll($value) {

        return [

            'miles' => $this->toMile($value),
            'meters' => $this->toMeter($value),
            'kiloMeters' => $this->toKilometer($value),
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