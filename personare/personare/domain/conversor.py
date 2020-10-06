class Coversor(object):

    def __init__(self, tipo_moeda, valor, tipo_destino, cotacao):
        self.tipo_moeda = tipo_moeda
        self.valor = valor
        self.tipo_destino = tipo_destino
        self.cotacao = cotacao
        

    def converte(self):
        return self.valor * self.cotacao