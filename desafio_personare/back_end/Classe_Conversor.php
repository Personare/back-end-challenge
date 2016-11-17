<?php

class Conversor {
	private $valor;
	private $cotacao;
	private $tipo_de;
	private $tipo_para;
	
	public function __set($atrib, $valor) {
		$this->$atrib = $valor;
	}
	
	public function __get($atrib) {
		return $this->$atrib;
	}
	
	public function converter() {
		if ($this->tipo_de == "real" && $this->tipo_para == "real") {
		    return $this->valor;
		}
		if ($this->tipo_de == "dolar" && $this->tipo_para == "dolar") {
			return $this->valor;
		}
		if ($this->tipo_de == "euro" && $this->tipo_para == "euro") {
			return $this->valor;
		}
		if ($this->tipo_de == "real" && $this->tipo_para == "dolar") {
			return $this->valor * $this->cotacao;
		}
		if ($this->tipo_de == "real" && $this->tipo_para == "euro") {
			return $this->valor * $this->cotacao;
		}
		if ($this->tipo_de == "dolar" && $this->tipo_para == "real") {
		    return $this->valor * $this->cotacao;
		}
		if ($this->tipo_de == "dolar" && $this->tipo_para == "euro") {
			return $this->valor * $this->cotacao;
		}
		if ($this->tipo_de == "euro" && $this->tipo_para == "real") {
		    return $this->valor * $this->cotacao;
		}
		if ($this->tipo_de == "euro" && $this->tipo_para == "dolar") {
			return $this->valor * $this->cotacao;
		}
	}
	
	public function simbolo() {
		if ($this->tipo_para == "real") {
			return 'R$';
		}
		if ($this->tipo_para == "euro") {
			return '€';
		}
		if ($this->tipo_para == "dolar") {
			return '$';
		}
	}
}
?>