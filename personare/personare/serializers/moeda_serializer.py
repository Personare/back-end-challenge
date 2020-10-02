import json


class MoedaEncoder(json.JSONEncoder):

    def default(self, m):
        try:
            to_serialize = {
                'valor': m.valor,
                'tipo': str(m.tipo),

            }
            return to_serialize
        except AttributeError:
            return super().default(m)
