<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Class CurrencyTransformer
 * @package App\Http\Transformers
 */
class CurrencyTransformer extends TransformerAbstract
{
    /**
     * @param Currency $currency
     * @return array
     */
    public function transform($currency): array
    {
        return [
            'currency' => $currency['currency'],
            'code' => $currency['code'],
        ];
    }
}