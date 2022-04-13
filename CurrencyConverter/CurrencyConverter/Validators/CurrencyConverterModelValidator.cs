using CurrencyConverter.Api.Contracts.Request;
using CurrencyConverter.Domain.Enums;
using FluentValidation;

namespace CurrencyConverter.Api.Validators;

public class CurrencyConverterModelValidator : AbstractValidator<CurrencyConverterRequestModel>
{
    public CurrencyConverterModelValidator()
    {
        RuleFor(x => x.InputCurrency)
            .IsInEnum()
            .NotEqual(CurrencyTypes.Undefined)
            .WithMessage("Input currency is not valid.");

        RuleFor(x => x.OutputCurrency)
            .IsInEnum()
            .NotEqual(CurrencyTypes.Undefined)
            .WithMessage("Output currency is not valid.");

        RuleFor(x => x)
            .Must(x => AtLeastOneCurrencyIsReal(x))
            .WithMessage("At least one of input currency values, must be Real (R$)");

        RuleFor(x => x.Amount)
            .GreaterThan(decimal.Zero)
            .WithMessage("Please, enter a valid currency amount.");            
    }

    private bool AtLeastOneCurrencyIsReal(CurrencyConverterRequestModel model)
    {
        return model.InputCurrency == CurrencyTypes.Real || model.OutputCurrency == CurrencyTypes.Real;
    }
}

