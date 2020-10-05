from personare.shared.domain_model import DomainModel

class Moeda(object):

    def __init__(self, valor, tipo):
        self.valor = valor
        self.tipo = tipo
    
    @classmethod
    def from_dict(cls, adict):
        """
        Método que cria um modelo de dados vindos de outra camada.
        """
        moeda = Moeda(
            valor = adict['valor'],
            tipo = adict['tipo']
        )

        return moeda


    def to_dict(self):
        """
        Método que cria um objeto a partir de um dicionário
        """
        return {
            'valor': self.valor,
            'tipo': self.tipo,
        }

    def __eq__(self, other):
        return self.to_dict() == other.to_dict()

    