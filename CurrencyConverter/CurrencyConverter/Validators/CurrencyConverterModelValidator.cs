using CurrencyConverter.Api.Contracts.Request;
using CurrencyConverter.Domain.Enums;
using FluentValidation;

namespace CurrencyConverter.Api.Validators;

public class CurrencyConverterModelValidator : AbstractValidator<CurrencyConverterRequestModel>
{
    public CurrencyConverterModelValidator()
    {
        RuleFor(x => x.InputCurrency)
            .NotNull()
            .WithMessage("InputCurrency field cannot be empty.")
            .IsInEnum()
            .WithMessage("InputCurrency is not valid.");

        RuleFor(x => x.OutputCurrency)
            .NotNull()
            .WithMessage("OutputCurrency field cannot be empty.")
            .IsInEnum()
            .WithMessage("OutputCurrency is not valid.");

        RuleFor(x => x)
            .Must(x => AtLeastOneCurrencyIsReal(x))
            .WithMessage("At least one of currency values, must be Real (R$)");

        RuleFor(x => x.Amount)
            .GreaterThan(decimal.Zero)
            .WithMessage("Please, enter a valid currency amount.");            
    }

    private bool AtLeastOneCurrencyIsReal(CurrencyConverterRequestModel model)
    {
        return model.InputCurrency == CurrencyTypes.Real || model.OutputCurrency == CurrencyTypes.Real;
    }
}

