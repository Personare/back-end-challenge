using CurrencyConverter.Domain.Enums;
using CurrencyConverter.Domain.Services.Factories.Interfaces;
using CurrencyConverter.Domain.ValueObjects;

namespace CurrencyConverter.Domain.Services.Factories
{
    public class AmountFactory : IAmountFactory
    {
        public Amount Assemble(decimal value, CurrencyTypes currencyType)
        {
            return new Amount
            {
                Value = value,
                CurrencyType = currencyType
            };
        }
    }
}
