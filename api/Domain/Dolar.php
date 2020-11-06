<?php
require_once dirname(__FILE__).'/Moeda.php';

class Dolar extends Moeda {
    public function simbolo() : string {
        return "US$";
    }
}
