using CurrencyConverter.Domain.ValueObjects;

namespace CurrencyConverter.Domain.Services.ExtensionMethods;

public static class CurrencyExtensions
{
    public static decimal ConvertCurrency(this ICurrency output, ICurrency input, decimal inputAmount)
    {
        return (input.ConvertionRate * inputAmount) / output.ConvertionRate;
    }
}
