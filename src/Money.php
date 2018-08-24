<?php

namespace Vyuldashev\NovaMoneyField;

use Money\Currency;
use Laravel\Nova\Fields\Number;
use Money\Currencies\ISOCurrencies;
use Laravel\Nova\Http\Requests\NovaRequest;

class Money extends Number
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-money-field';

    public $inMinorUnits;

    public function __construct($name, $currency = 'USD', $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->withMeta(['currency' => $currency]);

        $this
            ->resolveUsing(function ($value) use ($currency) {
                return $this->inMinorUnits ? $value / $this->minorUnit($currency) : $value;
            })
            ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) use ($currency) {
                $value = $request[$requestAttribute];

                if ($this->inMinorUnits) {
                    $value *= $this->minorUnit($currency);
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

    public function locale($locale)
    {
        return $this->withMeta(['locale' => $locale]);
    }

    public function minorUnit($currency)
    {
        $subunit = (new ISOCurrencies())->subunitFor(new Currency($currency));

        return 10 ** $subunit;
    }
}
