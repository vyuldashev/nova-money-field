# Money Field for Laravel Nova

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vyuldashev/nova-money-field.svg?style=flat-square)](https://packagist.org/packages/vyuldashev/nova-money-field)
[![Total Downloads](https://img.shields.io/packagist/dt/vyuldashev/nova-money-field.svg?style=flat-square)](https://packagist.org/packages/vyuldashev/nova-money-field)

![screenshot 1](https://raw.githubusercontent.com/vyuldashev/nova-money-field/master/docs/user-details.png)

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require vyuldashev/nova-money-field
```

## Usage

In resource:

```php
// ...
use Vyuldashev\NovaMoneyField\Money;

public function fields(Request $request)
{
    return [
        // ...
        Money::make('Balance'),
    ];
}
```

USD currency is used by default, you can change this by passing second argument:

```php
Money::make('Balance', 'EUR'),
```

You may use `locale` method to define locale for formatting value, by default value will be formatted using browser locale:

```php
Money::make('Balance')->locale('ru-RU'),
```

If you store money values in database in minor units use `storedInMinorUnits` method. Field will automatically convert minor units to base value for displaying and to minor units for storing:

```php
Money::make('Balance', 'EUR')->storedInMinorUnits(),
```

If you need to use a name that doesn't convert to the column name (eg 'Balance' as name and `remaining_balance` as column) you can pass this as the 3rd argument to the make/constructor. 

Please Note: that this, along with all field column names, should be present and usable within your model class else you may encounter SQL errors.

```php
Money::make('Balance', 'EUR', 'remaining_balance'),
```

