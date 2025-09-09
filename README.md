# Unit Converter

A modern, well‑tested unit conversion library for PHP 8.1+ with first‑class Laravel 10 integration.

## Requirements

- PHP: ^8.1
- Laravel: ^10.0 (for the Laravel integration)

## Installation

Install via Composer:

```
composer require jamal/unit-converter
```

Laravel package auto‑discovery will register the service provider and facade automatically.

Optionally publish the config:

```
php artisan vendor:publish --tag=unit-converter-config
```

## Quick start

- Convert with the fluent Converter API (enums):

```php
use Jamal\UnitConverter\Converter;
use Jamal\UnitConverter\Units\Length;

$converter = new Converter();
$feet = $converter->from(Length::meter, 10)->to(Length::foot); // 32.8084...
```

- Convert with the global helper:

```php
$inches = unit_convert(2.5, 'length.meter', 'length.inch');
```

- Value object conversions:

```php
use Jamal\UnitConverter\Measurement;
use Jamal\UnitConverter\Units\Temperature;

$m = new Measurement(100, Temperature::celsius);
$asF = $m->to(Temperature::fahrenheit); // Measurement(amount: 212, unit: fahrenheit)
```

- Laravel Facade:

```php
use Jamal\UnitConverter\Laravel\UnitConverter as LC; // or alias "UnitConverter"

$mph = app('unit-converter')->from(\Jamal\UnitConverter\Units\Speed::kilometer_per_hour, 100)
    ->to(\Jamal\UnitConverter\Units\Speed::mile_per_hour);
```

## Supported categories and units

- Length: meter, kilometer, centimeter, millimeter, micrometer, nanometer, mile, yard, foot, inch, nautical_mile
- Mass: kilogram, gram, milligram, microgram, ton, pound, ounce
- Temperature: celsius, fahrenheit, kelvin
- Volume: liter, milliliter, cubic_meter, cubic_centimeter, cubic_inch, cubic_foot, US_gallon, US_quart, US_pint, US_fluid_ounce, imperial_gallon, imperial_pint, imperial_fluid_ounce
- Area: square_meter, square_kilometer, square_centimeter, square_inch, square_foot, acre, hectare
- Speed: meter_per_second, kilometer_per_hour, mile_per_hour, knot
- Time: second, millisecond, microsecond, minute, hour, day, week
- Digital Storage: bit, kilobit, megabit, gigabit, terabit, byte, kB, MB, GB, TB, KiB, MiB, GiB, TiB
- Pressure: pascal, kilopascal, bar, millibar, psi, atmosphere
- Energy: joule, kilojoule, calorie, kilocalorie, watt_hour, kilowatt_hour, btu
- Power: watt, kilowatt, horsepower
- Frequency: hertz, kilohertz, megahertz, gigahertz
- Fuel Economy: liter_per_100km, mpg_US, mpg_UK

Notes:
- Temperature and fuel economy use exact formulas (not factors).
- High precision arithmetic will use bcmath if the extension is available (configurable).

## Configuration

Publish config creates config/unit-converter.php with:
- precision (default 9)
- rounding mode (PHP_ROUND_HALF_UP)
- prefer_bcmath (bool)
- decimal_separator, thousands_separator for formatting

## Validation and Eloquent cast

- Validation rule:

```php
use Jamal\UnitConverter\Rules\ValidUnit;
$request->validate([
    'from' => [new ValidUnit('length')],
    'to'   => [new ValidUnit('length')],
]);
```

- Eloquent cast (stores value and unit code in separate columns):

```php
use Jamal\UnitConverter\Casts\AsMeasurement;
use Jamal\UnitConverter\Units\Mass;

protected $casts = [
    'weight' => AsMeasurement::class,
];

// When saving
$model->weight = new \Jamal\UnitConverter\Measurement(72.5, Mass::kilogram);
// Will also set weight_unit = "mass.kilogram"
```

## Extensibility

You can register custom categories and units at runtime via UnitRegistry.

## Upgrading from v1

- PHP and Laravel requirements have changed to PHP 8.1+ and Laravel 10.
- API now uses enums and a Converter service. The old UC::kilometers()->toMile() style is deprecated.
- See UPGRADE.md for migration details (coming with the next release).

## License

This project is licensed under the MIT License - see the LICENSE file for details.
