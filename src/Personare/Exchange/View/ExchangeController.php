<?php

namespace Personare\Exchange\View;


class ExchangeController
{
    protected $from;
    protected $to;
    protected $value;
    protected $exchange;

    public function __construct($exchange)
    {
        header('Content-Type: application/json');
        if (!$this->validateArgs()) {
            $this->raiseHttp400();
        }

        $this->from = $_GET['from'];
        $this->to = $_GET['to'];
        $this->value = str_replace(',', '.', $_GET['value']);

        $this->exchange = $exchange;
    }

    private function validateArgs() {
        foreach(array('from', 'to', 'value') as $arg) {
            if(!array_key_exists($arg, $_GET)) {
                return false;
            }
        }

        return true;
    }

    private function raiseHttp400()
    {
        http_response_code(400);

        die('{"errors": [{"status": 400, "title": "Bad Request", "detail": "The request could not be understood by ' .
            'the server due to malformed syntax. The client SHOULD NOT repeat the request without modifications."}]}');
    }

    public function convert()
    {
        $currency = $this->exchange
            ->from($this->from)
            ->to($this->to)
            ->convertValue($this->value);

        echo json_encode(array(
            "symbol" => $currency->getSymbol(),
            "value" => $currency->getValue()
        ), JSON_UNESCAPED_UNICODE);
    }
}
