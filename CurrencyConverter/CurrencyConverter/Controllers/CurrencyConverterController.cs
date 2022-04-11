using AutoMapper;
using CurrencyConverter.Api.Contracts.Request;
using CurrencyConverter.Api.Contracts.Response;
using CurrencyConverter.Domain.Dtos;
using CurrencyConverter.Domain.Services.Orchestrators.Interfaces;
using Microsoft.AspNetCore.Mvc;

namespace CurrencyConverter.Api.Controllers;

[Route("currency-converter")]
public class CurrencyConverterController : ControllerBase
{
    public IMapper Mapper { get; }
    public ICurrencyConverterOrchestrator CurrencyConverterOrchestrator { get; }
    public CurrencyConverterController(ICurrencyConverterOrchestrator currencyConverterOrchestrator, IMapper mapper)
    {
        CurrencyConverterOrchestrator = currencyConverterOrchestrator ?? throw new ArgumentNullException(nameof(currencyConverterOrchestrator));
        Mapper = mapper ?? throw new ArgumentNullException(nameof(mapper));
    }

    [HttpGet]
    public IActionResult GetConvertedCurrency([FromQuery] CurrencyConverterRequestModel model)
    {
        if(!ModelState.IsValid)
            return BadRequest(ModelState);

        var currencyRequestDto = Mapper.Map<CurrencyConverterRequestDto>(model);

        var amount = CurrencyConverterOrchestrator.Run(currencyRequestDto);

        var response = Mapper.Map<AmountResponse>(amount);

        return Ok(response);
    }
}

