<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    public $additional = [ 'success' => true,
                           'code'   => 200
                         ];

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'amount'        => (int) $this->resource['amount'],
            'currencyFrom'  => $this->resource['currencyFrom'],
            'currencyTo'    => $this->resource['currencyTo'],
            'rate'          => (float) $this->resource['rate'],
            'value'         => (float) $this->resource['value'],
            'symbol'        => $this->resource['symbol']
        ];
    }
}
