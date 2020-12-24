import json

class Currency():
    currency_map = {}

    def __init__(self, currency_map):
        json_data = json.load(currency_map)
        curr = {}
        for key in json_data:
            mean = self.mean(float(json_data[key]['high']), float(json_data[key]['high']))
            curr[key] = mean
        self.currency_map = curr

    def mean(self, v_1, v_2):
        m = (v_1 + v_2)/2
        return float("{:.2f}".format(m))

    def floatfy(self, val):
        if isinstance(val, str):
            comma_pos = val.find(',')
            if comma_pos != -1:
                return float(val.replace(',', '.'))
        return float(val)

    def toEUR(self, brl):
        return 'EUR$' + str(self.currency_map['EUR'] * self.floatfy(brl))

    def toUSD(self, brl):
        return 'USD$' + str(self.currency_map['USD'] * self.floatfy(brl))

    def fromEUR(self, eur):
        return 'BRL$' + str(self.floatfy(eur) / self.currency_map['EUR'])

    def fromUSD(self, usd):
        return 'BRL$' + str(self.floatfy(usd) / self.currency_map['USD'])

if __name__ == '__main__':
    print('Initiating...')

