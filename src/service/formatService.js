
class FormatService {
    formatCash(fromCurrency, toCurrency, value, tax) {
        let formated = "";
        let convertedValue = 0;

        const { symbol: symbolTo, digits: digitsTo } = toCurrency;

        if (fromCurrency.number == toCurrency.number) {
            convertedValue = value.toFixed(digitsTo);
        }
        else {
            convertedValue = (value * tax).toFixed(digitsTo);
        }

        formated = `${symbolTo}${convertedValue}`;

        return {
            symbol: symbolTo,
            value: convertedValue,
            formatedValue: formated
        };
    }
}

module.exports = new FormatService();
