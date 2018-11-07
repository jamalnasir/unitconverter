<?php
/**
 * Created by PhpStorm.
 * User: jamal
 * Date: 9/17/18
 * Time: 6:34 PM
 */

namespace Jamal\UnitConverter\Units\Length;


class Miles {

    public function toKilometer($value) {
        return $value * 1.609;
    }

    public function toMeter($value) {
        return $value * 1609.34;
    }

    public function toCentiMeter($value) {
        return $value * 160934.4;
    }

    public function toMilliMeter($value) {
        return $value * 1609350;
    }

    public function toMicroMeter($value) {
        return $value * 1609350000;
    }

    public function toNanoMeter($value) {
        return $value * 1609350000000;
    }

    public function toYard($value) {
        return $value * 1760;
    }

    public function toFoot($value) {
        return $value * 5280;
    }

    public function toInch($value) {
        return $value * 63360;
    }

    public function toNauticalMile($value) {
        return $value / 1.151;
    }

    public function toAll($value) {

        return [

            'Kilometers' => $this->toKilometer($value),
            'meters' => $this->toMeter($value),
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