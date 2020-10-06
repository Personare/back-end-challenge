class CovertMoedaUseCase(object):

    def __init__(self, repo, tipo_moeda, valor, tipo_destino, cotacao):
        self.repo = repo
        self.tipo_moeda = tipo_moeda
        self.valor = valor
        self.tipo_destino = tipo_destino
        self.cotacao = cotacao

    def execute(self, *args):
        conversor = self.repo.get_conversor_moeda(self.tipo_moeda)   # esse vai pegar o conversor do tipo da moeda
        return conversor.converte(self.cotacao, self.valor)     # o conversor vai ser quem sabe olhar pra moeda destino e dar o preço