<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CurrencyService;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\ResponseErrorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyController extends Controller
{
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }
    
    public function convert(Request $request) : JsonResource
    {
        try {
            $params = $request->all();

            return new CurrencyResource($this->currencyService->convert($params));

        } catch (\Throwable $th) {
            return new ResponseErrorResource($th);
        }
    }
}
