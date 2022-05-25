
import settings
from converter import *

currency_map = {
    CurrencyTypes.USD : Currency(0.206),
    CurrencyTypes.EUR : Currency(0.193),
    CurrencyTypes.BRL : Currency(1),
}

c = CurrencyConverter(currency_map)

def test_convert_USD_EUR():
    assert c.convert("USD", "EUR", 1) == 0.94

def test_convert_USD_BRL():
    assert c.convert("USD", "BRL", 1) == 4.85

def test_convert_EUR_USD():
    assert c.convert("EUR", "USD", 1) == 1.07

def test_convert_EUR_BRL():
    assert c.convert("EUR", "BRL", 1) == 5.18

def test_convert_BRL_USD():
    assert c.convert("BRL", "USD", 1) == 0.21

def test_convert_BRL_EUR():
    assert c.convert("BRL", "EUR", 1) == 0.19