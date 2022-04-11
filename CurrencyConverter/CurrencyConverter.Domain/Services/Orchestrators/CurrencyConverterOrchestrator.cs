using CurrencyConverter.Domain.Dtos;
using CurrencyConverter.Domain.Services.ExtensionMethods;
using CurrencyConverter.Domain.Services.Factories.Interfaces;
using CurrencyConverter.Domain.Services.Orchestrators.Interfaces;
using CurrencyConverter.Domain.ValueObjects;

namespace CurrencyConverter.Domain.Services.Orchestrators;

public class CurrencyConverterOrchestrator : ICurrencyConverterOrchestrator
{
    public IEnumerable<ICurrency> CurrencyList { get; }
    public IAmountFactory AmountFactory { get; }

    public CurrencyConverterOrchestrator(IEnumerable<ICurrency> currencyList, IAmountFactory amountFactory)
    {
        CurrencyList = currencyList ?? throw new ArgumentNullException(nameof(currencyList));
        AmountFactory = amountFactory ?? throw new ArgumentNullException(nameof(amountFactory));
    }

    public Amount Run(CurrencyConverterRequestDto currencyConverterRequestDto)
    {
        var inputCurrency = CurrencyList.FirstOrDefault(x => x.CurrencyType.Equals(currencyConverterRequestDto.InputCurrency)) ?? throw new ArgumentNullException("inputCurrency");
        var outputCurrency = CurrencyList.FirstOrDefault(x => x.CurrencyType.Equals(currencyConverterRequestDto.OutputCurrency)) ?? throw new ArgumentNullException("outputCurrency");

        var amountValue = outputCurrency.ConvertCurrency(inputCurrency, currencyConverterRequestDto.Amount);

        var amount = AmountFactory.Assemble(amountValue, outputCurrency.CurrencyType);

        return amount;
    }
}
