<?php

require_once('CurrencyConverter.class.php');

    $currency_converter = new \Currency\Converter($_GET['from'], $_GET['to'], $_GET['value']);

    echo $currency_converter->convert();
