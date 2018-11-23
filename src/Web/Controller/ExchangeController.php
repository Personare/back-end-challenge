<?php

namespace Personare\Exchange\Web\Controller;

use Personare\Exchange\Web\Util\ValidationTrait;
use Personare\Exchange\Web\Util\ResponseTrait;
use Personare\Exchange\Application\Service\ExchangeService;

class ExchangeController
{
    use ValidationTrait, ResponseTrait;

    private $exchangeService;

    public function __construct(ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }

    private function validateIndex()
    {
        $messages = $this->validate($_GET, ['from', 'to', 'value']);

        if (count($messages) > 0) {
            return $this->jsonError($messages);
        }
    }

    public function index()
    {
        $this->validateIndex();

        try {
            $currency = $this->exchangeService->convert($_GET['from'], $_GET['to'], $_GET['value']);

            if (!$currency) {
                return $this->jsonError(["'from' or 'to' currency not found."], 404);
            }
        } catch (\Exception $e) {
            return $this->jsonError(['Internal Server Error =/'], 500);
        }

        return $this->json($currency);
    }
}
