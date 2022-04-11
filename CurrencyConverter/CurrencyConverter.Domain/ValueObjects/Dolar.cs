using CurrencyConverter.Domain.Enums;

namespace CurrencyConverter.Domain.ValueObjects;

public class Dolar : ICurrency
{
    public CurrencyTypes CurrencyType => CurrencyTypes.Usd;
    public decimal ConvertionRate => 5.32M;
}
