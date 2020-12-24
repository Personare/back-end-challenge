import unittest
import json
from currency import Currency

class TestCurrency(unittest.TestCase):
    curr = None
    eur_unit = float("{:.2f}".format((float('6.3598') + float('6.3572'))/2))
    usd_unit = float("{:.2f}".format((float('5.2168') + float('5.2168'))/2))
    
    def setUp(self):
        with open('usd_eur.json') as curr_map:
            self.curr = Currency(curr_map)

    def test_string_decimal_input_eur_outcome(self):
        brl = '1,20'
        expected = 'EUR$' + str(self.eur_unit * self.curr.floatfy(brl))
        eur = self.curr.toEUR(brl)
        self.assertEqual(expected, eur)

    def test_string_input_eur_outcome(self):
        brl = '1,00'
        expected = 'EUR$' + str(self.eur_unit * self.curr.floatfy(brl))
        eur = self.curr.toEUR(brl)
        self.assertEqual(expected, eur)

    def test_int_input_eur_outcome(self):
        brl = 1
        expected = 'EUR$' + str(self.eur_unit * self.curr.floatfy(brl))
        eur = self.curr.toEUR(brl)
        self.assertEqual(expected, eur)

    def test_float_decimal_input_eur_outcome(self):
        brl = 1.2
        expected = 'EUR$' + str(self.eur_unit * self.curr.floatfy(brl))
        eur = self.curr.toEUR(brl)
        self.assertEqual(expected, eur)

    def test_float_input_eur_outcome(self):
        brl = 1.0
        expected = 'EUR$' + str(self.eur_unit * self.curr.floatfy(brl))
        eur = self.curr.toEUR(brl)
        self.assertEqual(expected, eur)

    def test_string_decimal_input_usd_outcome(self):
        brl = '1,20'
        expected = 'USD$' + str(self.usd_unit * self.curr.floatfy(brl))
        usd = self.curr.toUSD(brl)
        self.assertEqual(expected, usd)

    def test_string_input_usd_outcome(self):
        brl = '1,00'
        expected = 'USD$' + str(self.usd_unit * self.curr.floatfy(brl))
        usd = self.curr.toUSD(brl)
        self.assertEqual(expected, usd)

    def test_int_input_usd_outcome(self):
        brl = 1
        expected = 'USD$' + str(self.usd_unit * self.curr.floatfy(brl))
        usd = self.curr.toUSD(brl)
        self.assertEqual(expected, usd)

    def test_float_input_usd_outcome(self):
        brl = 1.2
        expected = 'USD$' + str(self.usd_unit * self.curr.floatfy(brl))
        usd = self.curr.toUSD(brl)
        self.assertEqual(expected, usd)

    def test_float_input_usd_outcome(self):
        brl = 1.0
        expected = 'USD$' + str(self.usd_unit * self.curr.floatfy(brl))
        usd = self.curr.toUSD(brl)
        self.assertEqual(expected, usd)

    def test_eur_input(self):
        eur = 1.0
        expected = 'BRL$' + str(self.curr.floatfy(eur) / self.eur_unit)
        brl = self.curr.fromEUR(eur)
        self.assertEqual(expected, brl)

    def test_usd_input(self):
        usd = 1.0
        expected = 'BRL$' + str(self.curr.floatfy(usd) / self.usd_unit)
        brl = self.curr.fromUSD(usd)
        self.assertEqual(expected, brl)

    def tearDown(self):
        self.curr = None

if __name__ == '__main__':
    unittest.main();
