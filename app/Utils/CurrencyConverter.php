<?php

namespace App\Utils;

class CurrencyConverter
{
    public static function convert($amount, $toCurrency)
    {
        if ($toCurrency === 'EUR'){
            $rate = 0.85; //TODO: implement parsing actual rates with any API
        } else {
            $rate = 1;
        }

        return round($amount * $rate, 2);
    }
}