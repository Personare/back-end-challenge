from personare.shared.domain_model import DomainModel

class Moeda(object):

    def __init__(self, valor, tipo_de, tipo_para, cotacao):
        self.valor = valor
        self.tipo_de = tipo_de
        self.tipo_para = tipo_para
        self.cotacao = cotacao
    
    @classmethod
    def from_dict(cls, adict):
        moeda = Moeda(
            valor = adict['valor'],
            tipo_de = adict['tipo_de'],
            tipo_para = adict['tipo_para'],
            cotacao = adict['cotacao'],
        )
