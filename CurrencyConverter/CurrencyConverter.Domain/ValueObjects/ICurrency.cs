using CurrencyConverter.Domain.Enums;

namespace CurrencyConverter.Domain.ValueObjects;

public interface ICurrency
{
    CurrencyTypes CurrencyType { get; }
    decimal ConvertionRate { get; }
}
