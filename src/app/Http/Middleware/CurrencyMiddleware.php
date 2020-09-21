<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use App\Http\Resources\ResponseErrorResource;


class CurrencyMiddleware
{
    
    public function handle($request, Closure $next)
    {
        $uri = explode('/' , $request->path());
        $this->validateUri($uri);

        $params['amount']       = (float) $uri[1];
        $params['currencyFrom'] = strtoupper($uri[2]);
        $params['currencyTo']   = strtoupper($uri[3]);
        
        if (isset($uri[4]) && $uri[4] != '') {
            $params['rate'] = (float) $uri[4];
        }

        return $next($request->merge($params));
    }

    private function validateUri($uri) 
    {
        $countParams = count($uri);
        if ($countParams != 4 && $countParams != 5) {
            throw new InvalidArgumentException(
                'Erro na requisição. Verifique se os parâmetros estão sendo informados: http://localhost:8000/currency/100/brl/eur',
            );
        }
    }
}