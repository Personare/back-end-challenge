using CurrencyConverter.Domain.Enums;

namespace CurrencyConverter.Api.Contracts.Request;

public class CurrencyConverterRequestModel
{
    public CurrencyTypes? InputCurrency { get; set; }
    public CurrencyTypes? OutputCurrency { get; set; }
    public decimal Amount { get; set; }
}

