from personare.domain import moeda

class MoedasRepo:

    def __init__(self, entries=None):
        self._entries = []
        if entries:
            self._entries.extend(entries)

    def get_conversor_moeda(sef, tipo_moeda):
        if not tipo_moeda:
            result = self._entries
        else:
            result = []
            result.extend(self._entries)

        return [moeda.Moeda.from_dict(r) for r in result]
