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
        $date = 'latest';
        $apiVersion = 'v1';
        $response = Http::get("https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@$date/$apiVersion/currencies/eur.json");

        return $response['eur'][$curr];
    }
}