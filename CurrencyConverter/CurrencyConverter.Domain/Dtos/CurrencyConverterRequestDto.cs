using CurrencyConverter.Domain.Enums;

namespace CurrencyConverter.Domain.Dtos;

public class CurrencyConverterRequestDto
{
    public CurrencyTypes InputCurrency { get; set; }
    public CurrencyTypes OutputCurrency { get; set; }
    public decimal Amount { get; set; }
}
