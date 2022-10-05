<?php

namespace Workup\NovaMoneyField;

use Money\Currency;
use Laravel\Nova\Fields\Number;
use Money\Currencies\ISOCurrencies;
use Money\Currencies\BitcoinCurrencies;
use Money\Currencies\AggregateCurrencies;
use Laravel\Nova\Http\Requests\NovaRequest;

class Money extends Number
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-money-field';

    public bool $inMinorUnits;

    public string $currency = 'EUR';

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->withMeta([
            'currency' => $this->currency,
            'subUnits' => $this->subunits($this->currency),
        ]);

        $this->step(1 / $this->minorUnit($this->currency));

        $this
            ->resolveUsing(function ($value) use ($resolveCallback) {
                if ($resolveCallback !== null) {
                    $value = call_user_func_array($resolveCallback, func_get_args());
                }

                return $this->inMinorUnits ? $value / $this->minorUnit($this->currency) : (float) $value;
            })
            ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                $value = $request[$requestAttribute];

                if ($this->inMinorUnits) {
                    $value *= $this->minorUnit($this->currency);
                }

                $model->{$attribute} = $value;
            });
    }

    /**
     * The value in database is store in minor units (cents for dollars).
     */
    public function storedInMinorUnits()
    {
        $this->inMinorUnits = true;

        return $this;
    }

    /**
     * The currency to use
     */
    public function currency(?string $currency = 'EUR')
    {
        $this->currency = $currency;

        return $this;
    }

    public function locale($locale)
    {
        return $this->withMeta(['locale' => $locale]);
    }

    public function subUnits(string $currency)
    {
        return (new AggregateCurrencies([
            new ISOCurrencies(),
            new BitcoinCurrencies(),
        ]))->subunitFor(new Currency($currency));
    }

    public function minorUnit($currency)
    {
        return 10 ** $this->subUnits($currency);
    }
}
