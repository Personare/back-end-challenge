<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Converter;

class ConverterController extends Controller
{

    private $SUPPORTED_CURRENCIES;
    private $RATES;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function converter(Request $request, $from, $to)
    {

        try {
            $value = $request->has('value') ? $request->value : null;
            $converter = new Converter($from, $to, $value);

            $original = $converter->getFormatted('from');
            $converted = $converter->getFormatted('to');
            $rate = $converter->getRate();

            return response()->json([
                "converted" => $converted,
                "original" => $original,
                "rate" => $rate
            ]);

        }catch(\InvalidArgumentException $e){
            return response()->json([
                'error' => $e->getMessage()
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
