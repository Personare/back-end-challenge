<?php

namespace Personare\Helpers;

class CalculaCotacao
{
    /**
     * Gera o calculo baseado na cotação passada
     * @param array $request
     * @return array
     */
    public function CalculaValor(array $request)
    {
        $valorFinal = $request['valor_entrada'] * $request['valor_cotacao'];
        $request['valor_final'] = (float) number_format($valorFinal,2,'.','');

        return $request;
    }
}
