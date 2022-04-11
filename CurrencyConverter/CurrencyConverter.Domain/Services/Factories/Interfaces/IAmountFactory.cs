using CurrencyConverter.Domain.Enums;
using CurrencyConverter.Domain.ValueObjects;

namespace CurrencyConverter.Domain.Services.Factories.Interfaces
{
    public interface IAmountFactory
    {
        Amount Assemble(decimal value, CurrencyTypes currencyType);
    }
}
