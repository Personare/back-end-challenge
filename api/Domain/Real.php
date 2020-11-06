<?php
require_once dirname(__FILE__).'/Moeda.php';

class Real extends Moeda {
    public function simbolo() : string {
        return "R$";
    }
}
