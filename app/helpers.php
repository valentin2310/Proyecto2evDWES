<?php
/**
 * @author Valentin Andrei Culea
 * @version 2
 */

use Illuminate\Support\Facades\Http;

/**
 * Crea la función si no exite.
 */
if (! function_exists('currency_value')){
    /**
     * Recibe el código de la moneda actual.
     * Hace una petición con Http a una API para obtener la conversión.
     * 
     * @param string $currency
     * @return mixed
     */
    function currency_value(string $currency){
        $curr = strtolower($currency);
        $response = Http::get("https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/2024-01-05/currencies/eur/$curr.json");

        return $response[$curr];
    }
}