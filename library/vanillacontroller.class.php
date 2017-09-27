<?php

class VanillaController {
	
	protected $_controller;
	protected $_action;
	protected $_template;

	public $doNotRenderHeader;
	public $render;

	function __construct($controller, $action) {
		
		global $inflect;

		$this->_controller = ucfirst($controller);
		$this->_action = $action;
		
		$model = ucfirst($inflect->singularize($controller));
		$this->doNotRenderHeader = 0;
		$this->render = 1;
        $this->$model = new $model;

		$this->_template = new Template($controller,$action);

	}

	function set($name,$value) {
		$this->_template->set($name,$value);
	}

	function beforeAction(){

    }

    function afterAction(){

    }

	function __destruct() {
		if ($this->render) {
			$this->_template->render($this->doNotRenderHeader);
		}
	}

	function validate_method($methods){
        if (!in_array($_SERVER['REQUEST_METHOD'], $methods)) {
            echo json_encode(array("Error" => "Requisição inválida os métodos aceitos são ". implode(', ', $methods)));
            exit;
        }
    }
		
}