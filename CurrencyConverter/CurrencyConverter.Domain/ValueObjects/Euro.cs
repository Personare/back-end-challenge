using CurrencyConverter.Domain.Enums;

namespace CurrencyConverter.Domain.ValueObjects
{
    public class Euro : ICurrency
    {
        public CurrencyTypes CurrencyType => CurrencyTypes.Eur;

        public decimal ConvertionRate => 6.50M;
    }
}
