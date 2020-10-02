from personare.shared.domain_model import DomainModel

class Moeda(object):

    def __init__(self, valor, tipo_de, tipo_para, cotacao):
        self.valor = valor
        self.tipo_de = tipo_de
        self.tipo_para = tipo_para
        self.cotacao = cotacao
    
    @classmethod
    def from_dict(cls, adict):
        """
        Método que cria um modelo de dados vindos de outra camada.
        """
        moeda = Moeda(
            valor = adict['valor'],
            tipo_de = adict['tipo_de'],
            tipo_para = adict['tipo_para'],
            cotacao = adict['cotacao'],
        )

        return moeda


    def to_dict(self):
        """
        Método que cria um objeto a partir de um dicionário
        """
        return {
            'valor': self.valor,
            'tipo_de': self.tipo_de,
            'tipo_para': self.tipo_para,
            'cotacao': self.cotacao,
        }

    def __eq__(self, other):
        return self.to_dict() == other.to_dict()

    