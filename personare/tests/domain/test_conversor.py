from personare.domain.conversor import Coversor

def test_model_moeda_init():
    conversor = Coversor(
        tipo_moeda='Real',
        valor=200,
        tipo_destino='Dolar',
        cotacao=5.64,
 
        )
    
    assert conversor.valor == 200
    assert conversor.tipo_moeda == 'Real'
    assert conversor.tipo_destino == 'Dolar'
    assert conversor.cotacao == 5.64


def test_converte_moeda():
    converte = Coversor(
        tipo_moeda='Real',
        valor=200,
        tipo_destino='Dolar',
        cotacao=5.64,
    )

    assert converte.cotacao * converte.valor