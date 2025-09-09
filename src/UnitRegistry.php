<?php
declare(strict_types=1);

namespace Jamal\UnitConverter;

use Closure;
use Jamal\UnitConverter\Contracts\UnitCategory;
use Jamal\UnitConverter\Exceptions\ConversionException;

/**
 * Registry for units and conversion factors/functions.
 * For each category we register:
 * - base unit (enum case)
 * - factors array mapping unit case to multiplicative factor to base
 * - optional functions for non-linear conversions (temperature, fuel economy)
 */
final class UnitRegistry
{
    /** @var array<string, array{base: UnitCategory, factors: array<string, string|float|int>, toBase?: Closure, fromBase?: Closure}> */
    private array $categories = [];

    public function __construct()
    {
        $this->bootstrapDefaults();
    }

    public function registerCategory(string $category, UnitCategory $base, array $factors, ?Closure $toBase = null, ?Closure $fromBase = null): void
    {
        $this->categories[$category] = [
            'base' => $base,
            'factors' => $factors,
            'toBase' => $toBase,
            'fromBase' => $fromBase,
        ];
    }

    public function hasCategory(string $category): bool
    {
        return isset($this->categories[$category]);
    }

    public function getCategory(string $category): array
    {
        if (!$this->hasCategory($category)) {
            throw new ConversionException("Unknown unit category: {$category}");
        }
        return $this->categories[$category];
    }

    private function bootstrapDefaults(): void
    {
        // Length, base meter
        $this->registerCategory(
            Units\Length::category(),
            Units\Length::meter,
            [
                Units\Length::meter->value => 1.0,
                Units\Length::kilometer->value => 1000.0,
                Units\Length::centimeter->value => 0.01,
                Units\Length::millimeter->value => 0.001,
                Units\Length::micrometer->value => 1.0e-6,
                Units\Length::nanometer->value => 1.0e-9,
                Units\Length::inch->value => 0.0254,
                Units\Length::foot->value => 0.3048,
                Units\Length::yard->value => 0.9144,
                Units\Length::mile->value => 1609.344,
                Units\Length::nautical_mile->value => 1852.0,
            ]
        );

        // Mass, base kilogram
        $this->registerCategory(
            Units\Mass::category(),
            Units\Mass::kilogram,
            [
                Units\Mass::kilogram->value => 1.0,
                Units\Mass::gram->value => 0.001,
                Units\Mass::milligram->value => 1.0e-6,
                Units\Mass::microgram->value => 1.0e-9,
                Units\Mass::ton->value => 1000.0,
                Units\Mass::pound->value => 0.45359237,
                Units\Mass::ounce->value => 0.028349523125,
            ]
        );

        // Area, base square_meter
        $this->registerCategory(
            Units\Area::category(),
            Units\Area::square_meter,
            [
                Units\Area::square_meter->value => 1.0,
                Units\Area::square_kilometer->value => 1_000_000.0,
                Units\Area::square_centimeter->value => 0.0001,
                Units\Area::square_inch->value => 0.00064516,
                Units\Area::square_foot->value => 0.09290304,
                Units\Area::acre->value => 4046.8564224,
                Units\Area::hectare->value => 10000.0,
            ]
        );

        // Volume, base liter (but we will internally convert to cubic meters for factors accuracy)
        // We'll base on liter directly for simplicity where 1 L = 0.001 m^3
        $this->registerCategory(
            Units\Volume::category(),
            Units\Volume::liter,
            [
                Units\Volume::liter->value => 1.0,
                Units\Volume::milliliter->value => 0.001,
                Units\Volume::cubic_meter->value => 1000.0,
                Units\Volume::cubic_centimeter->value => 0.001,
                Units\Volume::cubic_inch->value => 0.016387064,
                Units\Volume::cubic_foot->value => 28.316846592,
                Units\Volume::us_gallon->value => 3.785411784,
                Units\Volume::us_quart->value => 0.946352946,
                Units\Volume::us_pint->value => 0.473176473,
                Units\Volume::us_fluid_ounce->value => 0.0295735295625,
                Units\Volume::imperial_gallon->value => 4.54609,
                Units\Volume::imperial_pint->value => 0.56826125,
                Units\Volume::imperial_fluid_ounce->value => 0.0284130625,
            ]
        );

        // Speed, base meter_per_second
        $this->registerCategory(
            Units\Speed::category(),
            Units\Speed::meter_per_second,
            [
                Units\Speed::meter_per_second->value => 1.0,
                Units\Speed::kilometer_per_hour->value => 1000.0/3600.0,
                Units\Speed::mile_per_hour->value => 1609.344/3600.0,
                Units\Speed::knot->value => 1852.0/3600.0,
            ]
        );

        // Time, base second
        $this->registerCategory(
            Units\Time::category(),
            Units\Time::second,
            [
                Units\Time::second->value => 1.0,
                Units\Time::millisecond->value => 0.001,
                Units\Time::microsecond->value => 1.0e-6,
                Units\Time::minute->value => 60.0,
                Units\Time::hour->value => 3600.0,
                Units\Time::day->value => 86400.0,
                Units\Time::week->value => 604800.0,
            ]
        );

        // Digital storage, base byte (not bit) - easier
        $this->registerCategory(
            Units\DigitalStorage::category(),
            Units\DigitalStorage::byte,
            [
                Units\DigitalStorage::byte->value => 1.0,
                Units\DigitalStorage::bit->value => 1.0/8.0,
                Units\DigitalStorage::kilobit->value => 1000.0/8.0,
                Units\DigitalStorage::megabit->value => 1_000_000.0/8.0,
                Units\DigitalStorage::gigabit->value => 1_000_000_000.0/8.0,
                Units\DigitalStorage::terabit->value => 1_000_000_000_000.0/8.0,
                Units\DigitalStorage::kilobyte->value => 1000.0,
                Units\DigitalStorage::megabyte->value => 1_000_000.0,
                Units\DigitalStorage::gigabyte->value => 1_000_000_000.0,
                Units\DigitalStorage::terabyte->value => 1_000_000_000_000.0,
                Units\DigitalStorage::kibibyte->value => 1024.0,
                Units\DigitalStorage::mebibyte->value => 1024.0**2,
                Units\DigitalStorage::gibibyte->value => 1024.0**3,
                Units\DigitalStorage::tebibyte->value => 1024.0**4,
            ]
        );

        // Pressure, base pascal
        $this->registerCategory(
            Units\Pressure::category(),
            Units\Pressure::pascal,
            [
                Units\Pressure::pascal->value => 1.0,
                Units\Pressure::kilopascal->value => 1000.0,
                Units\Pressure::bar->value => 100000.0,
                Units\Pressure::millibar->value => 100.0,
                Units\Pressure::psi->value => 6894.757293168,
                Units\Pressure::atmosphere->value => 101325.0,
            ]
        );

        // Energy, base joule
        $this->registerCategory(
            Units\Energy::category(),
            Units\Energy::joule,
            [
                Units\Energy::joule->value => 1.0,
                Units\Energy::kilojoule->value => 1000.0,
                Units\Energy::calorie->value => 4.184,
                Units\Energy::kilocalorie->value => 4184.0,
                Units\Energy::watt_hour->value => 3600.0,
                Units\Energy::kilowatt_hour->value => 3_600_000.0,
                Units\Energy::btu->value => 1055.05585262,
            ]
        );

        // Power, base watt
        $this->registerCategory(
            Units\Power::category(),
            Units\Power::watt,
            [
                Units\Power::watt->value => 1.0,
                Units\Power::kilowatt->value => 1000.0,
                Units\Power::horsepower->value => 745.6998715822702,
            ]
        );

        // Frequency, base hertz
        $this->registerCategory(
            Units\Frequency::category(),
            Units\Frequency::hertz,
            [
                Units\Frequency::hertz->value => 1.0,
                Units\Frequency::kilohertz->value => 1000.0,
                Units\Frequency::megahertz->value => 1_000_000.0,
                Units\Frequency::gigahertz->value => 1_000_000_000.0,
            ]
        );

        // Temperature - functional (base celsius)
        $this->registerCategory(
            Units\Temperature::category(),
            Units\Temperature::celsius,
            [
                Units\Temperature::celsius->value => 1.0,
                Units\Temperature::fahrenheit->value => 1.0, // placeholder not used for factor
                Units\Temperature::kelvin->value => 1.0,
            ],
            toBase: function(string $unit, string $value): string {
                $x = (float)$value;
                return match($unit) {
                    Units\Temperature::celsius->value => (string)$x,
                    Units\Temperature::fahrenheit->value => (string)(($x - 32.0) * 5.0/9.0),
                    Units\Temperature::kelvin->value => (string)($x - 273.15),
                    default => throw new ConversionException('Unknown temperature unit: '.$unit),
                };
            },
            fromBase: function(string $unit, string $value): string {
                $x = (float)$value;
                return match($unit) {
                    Units\Temperature::celsius->value => (string)$x,
                    Units\Temperature::fahrenheit->value => (string)($x * 9.0/5.0 + 32.0),
                    Units\Temperature::kelvin->value => (string)($x + 273.15),
                    default => throw new ConversionException('Unknown temperature unit: '.$unit),
                };
            }
        );

        // Fuel economy - functional (base liter_per_100km). Higher MPG means lower L/100km
        $this->registerCategory(
            Units\FuelEconomy::category(),
            Units\FuelEconomy::liter_per_100km,
            [
                Units\FuelEconomy::liter_per_100km->value => 1.0,
                Units\FuelEconomy::mpg_US->value => 1.0,
                Units\FuelEconomy::mpg_UK->value => 1.0,
            ],
            toBase: function(string $unit, string $value): string {
                $x = (float)$value;
                return match($unit) {
                    Units\FuelEconomy::liter_per_100km->value => (string)$x,
                    Units\FuelEconomy::mpg_US->value => (string)(235.214583/$x),
                    Units\FuelEconomy::mpg_UK->value => (string)(282.480936/$x),
                    default => throw new ConversionException('Unknown fuel economy unit: '.$unit),
                };
            },
            fromBase: function(string $unit, string $value): string {
                $x = (float)$value;
                return match($unit) {
                    Units\FuelEconomy::liter_per_100km->value => (string)$x,
                    Units\FuelEconomy::mpg_US->value => (string)(235.214583/$x),
                    Units\FuelEconomy::mpg_UK->value => (string)(282.480936/$x),
                    default => throw new ConversionException('Unknown fuel economy unit: '.$unit),
                };
            }
        );
    }
}
