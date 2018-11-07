# Unit Converter

A unit converter package for Laravel.

## Getting Started

These instructions will get you intall the package in your Laravel application.

### Prerequisites

You must have the following things:

```
PHP >= 5.5.9
Laravel >= 5.5
```

### What this package offers

It supports the following types of measurement by default (more measurement types are still to come).

- Length
	- Kilometers
	- Miles
	- Nautical Miles
- Area _Coming Soon!_
- Data Transfer Rates _Coming Soon!_
- Digital Storage _Coming Soon!_
- Energy (Power) _Coming Soon!_
- Frequency _Coming Soon!_
- Fuel Economy _Coming Soon!_
- Mass (Weight) _Coming Soon!_
- Plane Angle (Rotation) _Coming Soon!_
- Pressure _Coming Soon!_
- Speed _Coming Soon!_
- Temperature _Coming Soon!_
- Time _Coming Soon!_
- Volume _Coming Soon!_

### Installing

The only way to install this component is via Composer.

Say what the step will be

```
$ composer require jamal/unit-converter
```

### Setup

Add the following in providers array in app.php file.

```
UnitConverter\UnitConverterServiceProvider::class
```

Add the following in the alias array in app.php file.

```
'UC' => UnitConverter\UnitConverterFacade::class
```

### How to use

```
// this will convert kilometers to miles
UC::kilometers()->toMile(1)

// this will convert miles to kilometers
UC::Miles()->toKilometer(1)

// this will convert kilometers to nautical miles
UC::nauticalMiles()->toKilometer(1)
```

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
