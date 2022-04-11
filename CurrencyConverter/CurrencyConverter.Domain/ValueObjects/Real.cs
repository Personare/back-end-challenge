using CurrencyConverter.Domain.Enums;

namespace CurrencyConverter.Domain.ValueObjects
{
    public class Real : ICurrency
    {
        public CurrencyTypes CurrencyType => CurrencyTypes.Real;

        public decimal ConvertionRate => 1;
    }
}
