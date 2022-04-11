using CurrencyConverter.Domain.Enums;

namespace CurrencyConverter.Domain.ValueObjects;

public class Amount
{
    public decimal Value { get; set; }
    public CurrencyTypes CurrencyType { get; set; }
}
