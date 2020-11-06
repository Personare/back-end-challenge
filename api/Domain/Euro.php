<?php
require_once dirname(__FILE__).'/Moeda.php';

class Euro extends Moeda {
    public function simbolo() : string {
        return "€";
    }
}
