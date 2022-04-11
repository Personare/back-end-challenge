using AutoMapper;
using CurrencyConverter.Api.Contracts.Request;
using CurrencyConverter.Domain.Dtos;

namespace CurrencyConverter.Api.AutoMapper;

public class CurrencyModelProfile : Profile
{
    public CurrencyModelProfile()
    {
        CreateMap<CurrencyConverterRequestModel, CurrencyConverterRequestDto>()
            .ForMember(s => s.InputCurrency, o => o.MapFrom(s => s.InputCurrency))
            .ForMember(s => s.OutputCurrency, o => o.MapFrom(s => s.OutputCurrency))
            .ForMember(s => s.Amount, o => o.MapFrom(s => s.Amount));
    }
}
