from enum import Enum

class CurrencyTypes(Enum):
    INVALID = 0
    BRL = 1
    USD = 2
    EUR = 3

    def from_string(currency_str):
        try:
            # will try to find an equivalent CurrencyTypes
            return CurrencyTypes[currency_str.upper()]
        except:
            # if an error is raised, return as invalid CurrencyTypes
            return CurrencyTypes.INVALID

class CurrencyConverter:

    def __init__(self, currency_map):
        """
        currency_map is a dictionary with a CurrencyTypes as a key and an 
        instance of a Currency class with the exchange rate.
        Example
        {
            CurrencyTypes.USD : Currency(settings.DOLAR_RATE),
            CurrencyTypes.EUR : Currency(settings.EURO_RATE),
            CurrencyTypes.BRL : Currency(settings.REAL_RATE),
        }
        """
        self.currency_map = currency_map

    def convert(self, input_currency, output_currency, amount, rate):
        input_currency_info = self.currency_map[CurrencyTypes.from_string(input_currency)]
        output_currency_info = self.currency_map[CurrencyTypes.from_string(output_currency)]

        exchange_rate = rate
        
        if exchange_rate == 0:
            exchange_rate = output_currency_info.exchange_rate

        if input_currency.upper() != 'BRL':
            amount = amount / input_currency_info.exchange_rate

        amount = round(amount * exchange_rate, 2)

        return amount

class Currency:

    def __init__(self, exchange_rate):
        #self.currency_type = currency_type
        self.exchange_rate = exchange_rate  
