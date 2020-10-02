from personare.domain.moeda import Moeda


def testar_o_model_moeda_init():
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


@classmethod
def from_dict(cls, adict):
    moeda = Moeda(
        valor=200, 
        tipo_de='Real', 
        tipo_para='Dolar', 
        cotacao=5.64
        )
    return moeda