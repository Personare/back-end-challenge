<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConverterController extends Controller
{

    private $SUPPORTED_CURRENCIES;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->SUPPORTED_CURRENCIES = ['BRL', 'USD', 'EUR'];
    }

    public function converter(Request $request, $from, $to)
    {

        if(!$request->has('value')){
            return response()->json([
                'error' => "Missing 'value' parameter"
            ], 400);
        }

        if(!in_array($from, $this->SUPPORTED_CURRENCIES)){
            return response()->json([
                'error' => "Not supported currency on 'from' parameter"
            ], 400);
        }

        if(!in_array($to, $this->SUPPORTED_CURRENCIES)){
            return response()->json([
                'error' => "Not supported currency on 'to' parameter"
            ], 400);
        }

        return response()->json([
            'params' => [
                'from' => $from,
                'to' => $to,
                'request' => $request->value
            ]
            ], 200);
    }



}
