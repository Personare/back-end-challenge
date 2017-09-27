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

    function add()
    {
        header('Content-Type: application/json; charset=utf-8');
        $this->validate_method(array('POST'));
        $results = array();
        $data = $_POST;
        if (!Helper::array_keys_exists($data, array('nome', 'simbolo', 'sigla'))) {
            if (empty($data['nome'])) {
                $results['Erro']['Nome'] = 'Campo Obrigatório';
            }
            if (empty($data['simbolo'])) {
                $results['Erro']['Símbolo'] = 'Campo Obrigatório';
            }
            if (empty($data['sigla'])) {
                $results['Erro']['Sigla'] = 'Campo Obrigatório';
            }
        } else {
            $this->Moeda->where('nome', $data['nome']);
            $moeda = $this->Moeda->search();
            if (!empty($moeda)) {
                $results['Erro']['nome'] = 'Já existe uma moeda com este nome';
            } else {
                $this->Moeda->nome = $data['nome'];
                $this->Moeda->simbolo = $data['simbolo'];
                $this->Moeda->sigla = $data['sigla'];
                if ($this->Moeda->save() == -1) {
                    $results["Erro"][] = "Ocoreu um erro ao cadastrar a moeda tente novamente";
                } else {
                    $this->Moeda->where('nome', $data['nome']);
                    $results = $this->Moeda->search();
                }
            }
        }
        echo json_encode($results);
    }

    function converter($moeda_origem_id = null)
    {
        header('Content-Type: application/json; charset=utf-8');
        $this->validate_method(array('POST'));
        $results = array();
        $data = $_POST;
        if (empty($moeda_origem_id)) {
            $results['Erro']['Moeda Origem'] = "O id da moeda não foi informado";
        } else {
            $this->Moeda->id = $moeda_origem_id;
            $moeda_origem = $this->Moeda->search();
            if (empty($moeda_origem)) {
                $results['Erro']['Moeda Origem'] = "O id informado é inválido";
            } else {
                if (!Helper::array_keys_exists($data, array('moeda_destino', 'valor', 'cotacao'))) {
                    if (empty($data['moeda_destino'])) {
                        $results['Erro']['Moeda Destino'] = 'Campo Obrigatório';
                    }
                    if (empty($data['valor'])) {
                        $results['Erro']['Valor'] = 'Campo Obrigatório';
                    }
                    if (empty($data['cotacao'])) {
                        $results['Erro']['Cotação'] = 'Campo Obrigatório';
                    }
                } else {
                    $this->Moeda->id = $data['moeda_destino'];
                    $moeda_destino = $this->Moeda->search();
                    if (empty($moeda_destino)) {
                        $results['Erro']['Moeda Destino'] = "O id informado é inválido";
                    }
                    if (!is_numeric($data['valor'])) {
                        $results['Erro']['Valor'] = 'Valor inválido. Utilize o seguinte formato: 15.25';
                    }
                    if (!is_numeric($data['cotacao'])) {
                        $results['Erro']['Cotação'] = 'Cotação inválida. Utilize o seguinte formato: 3.16123';
                    }
                    if (empty($results['Erro'])) {
                        $results['moeda_origem'] = $moeda_origem['sigla'] . ' - ' . $moeda_origem['nome'];
                        $results['moeda_destino'] = $moeda_destino['sigla'] . ' - ' . $moeda_destino['nome'];
                        $results['valor'] = $data['valor'];
                        $results['cotacao'] = $data['cotacao'];
                        $results['valor_convertido'] = $moeda_destino['simbolo'] . ' ' . Helper::currency_converter($data['valor'], $data['cotacao']);
                    }
                }
            }
        }
        echo json_encode($results);
    }
}