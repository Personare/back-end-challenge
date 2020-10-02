from personare.domain.moeda import Moeda


def test_model_moeda_init():
    moeda = Moeda(
        valor=200, 
        tipo_de='Real', 
        tipo_para='Dolar', 
        cotacao=5.64
        )
    
    assert moeda.valor == 200
    assert moeda.tipo_de == 'Real'
    assert moeda.tipo_para == 'Dolar'
    assert moeda.cotacao == 5.64

def test_moeda_model_from_dict():
    moeda = Moeda.from_dict(
        {
        'valor': 200,
        'tipo_de': 'Real',
        'tipo_para': 'Dolar',
        'cotacao': 5.64,
     }
    )
    assert moeda.valor == 200
    assert moeda.tipo_de == 'Real'
    assert moeda.tipo_para == 'Dolar'
    assert moeda.cotacao == 5.64


def test_moeda_model_to_dict():
    moeda_dict = {
        'valor': 200,
        'tipo_de': 'Real',
        'tipo_para': 'Dolar',
        'cotacao': 5.64
    }

    moeda = Moeda.from_dict(moeda_dict)

    assert moeda.to_dict() == moeda_dict

def test_moeda_model_comparacao():
    moeda_dict = {
        'valor': 200,
        'tipo_de': 'Real',
        'tipo_para': 'Dolar',
        'cotacao': 5.64
    }
    moeda1 = Moeda.from_dict(moeda_dict)
    moeda2 = Moeda.from_dict(moeda_dict)

    assert moeda1 == moeda2