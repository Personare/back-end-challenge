using AutoMapper;
using CurrencyConverter.Api.Contracts.Response;
using CurrencyConverter.Domain.ValueObjects;

namespace CurrencyConverter.Api.AutoMapper;

public class AmountProfile : Profile
{
    public AmountProfile()
    {
        CreateMap<Amount, AmountResponse>()
            .ForMember(d => d.Value, o => o.MapFrom(s => s.Value))
            .ForMember(d => d.Currency, o => o.MapFrom(s => s.CurrencyType.ToString()));
    }
}
