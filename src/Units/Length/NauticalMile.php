<?php
/**
 * Created by PhpStorm.
 * User: jamal
 * Date: 9/17/18
 * Time: 6:34 PM
 */

namespace Jamal\UnitConverter\Units\Length;


class NauticalMile {

    public function toKilometer($value) {
        return $value * 1.852;
    }

    public function toMile($value) {
        return $value * 1.15078;
    }

    public function toCentiMeter($value) {
        return $value * 185200;
    }

    public function toMilliMeter($value) {
        return $value * 1852000;
    }

    public function toMicroMeter($value) {
        return $value * 1852000000;
    }

    public function toNanoMeter($value) {
        return $value * 1852000000000;
    }

    public function toYard($value) {
        return $value * 2025.372;
    }

    public function toFoot($value) {
        return $value * 6076.115;
    }

    public function toInch($value) {
        return $value * 72913.386;
    }

    public function toMeter($value) {
        return $value * 1852;
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
            'nauticalMile' => $this->toMeter($value)

        ];

    }

}