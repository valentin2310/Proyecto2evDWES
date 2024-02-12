<?php

use Illuminate\Support\Facades\Http;

if (! function_exists('currency_value')){
    function currency_value(string $currency){
        $curr = strtolower($currency);
        $response = Http::get("https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies/eur/$curr.json");

        return $response[$curr];
    }
}