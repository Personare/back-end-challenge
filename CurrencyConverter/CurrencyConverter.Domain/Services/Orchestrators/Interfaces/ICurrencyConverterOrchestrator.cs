using CurrencyConverter.Domain.Dtos;
using CurrencyConverter.Domain.ValueObjects;

namespace CurrencyConverter.Domain.Services.Orchestrators.Interfaces
{
    public interface ICurrencyConverterOrchestrator
    {
        Amount Run(CurrencyConverterRequestDto currencyConverterRequestDto);
    }
}
