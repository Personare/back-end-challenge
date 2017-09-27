<?php

class MoedasController extends VanillaController
{

    function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->doNotRenderHeader = 1;
    }

    function view($moedaId = null)
    {
        header('Content-Type: application/json; charset=utf-8');
        $this->validate_method(array('GET'));
        $results = array();
        if (empty($moedaId)) {
            $results[]["Erro"] = "É neceśsario informar o id";
        } else {
            $this->Moeda->id = $moedaId;
            $moeda = $this->Moeda->search();
            if (!$moeda) {
                $results[]["Erro"] = "Id inválido";
            } else {
                $results = $moeda;
            }
        }
        echo json_encode($results);
    }

    function index()
    {
        header('Content-Type: application/json; charset=utf-8');
        $this->validate_method(array('GET'));
        $moedas = $this->Moeda->search();
        $results = array(
            'count' => count($moedas),
            'results' => $moedas
        );
        echo json_encode($results);
    }

    function delete($moedaId = null)
    {
        header('Content-Type: application/json; charset=utf-8');
        $this->validate_method(array('DELETE'));
        $results = array();
        if (empty($moedaId)) {
            $results[]["Erro"] = "É neceśsario informar o id";
        } else {
            $this->Moeda->id = $moedaId;
            $moeda = $this->Moeda->search();
            if (!$moeda) {
                $results[]["Erro"] = "Id inválido";
            } else {
                $this->Moeda->id = $moedaId;
                if ($this->Moeda->delete() == -1) {
                    $results[]["Erro"] = "Ocoreu um erro ao deletar a moeda tente novamente";
                } else {
                    $results[]["Sucesso"] = "Moeda {$moeda['nome']} deletada com sucesso";
                }
            }
        }
        echo json_encode($results);
    }

    function add(){
        header('Content-Type: application/json; charset=utf-8');
        $this->validate_method(array('POST'));
        $results = array();
        $data = $_POST;
        if () {

        }
        echo json_encode($results);
    }
}