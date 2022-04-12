using AutoFixture.Idioms;
using CurrencyConverter.Api.Contracts.Request;
using CurrencyConverter.Api.Contracts.Response;
using CurrencyConverter.Api.Controllers;
using CurrencyConverter.Domain.Dtos;
using CurrencyConverter.Domain.ValueObjects;
using CurrencyConverter.UnitTests.FixtureConfiguration;
using FluentAssertions;
using Microsoft.AspNetCore.Mvc;
using NSubstitute;
using Xunit;

namespace CurrencyConverter.UnitTests.Api.Controllers;

public class CurrencyConverterControllerTests
{
    [Theory, AutoNSubstituteData]
    public void CurrencyConverterController_Should_Implements_Its_ParentClass(CurrencyConverterController sut)
    {
        sut.Should().BeAssignableTo<ControllerBase>();
    }

    [Theory, AutoNSubstituteData]
    public void CurrencyConverterController_Should_Guard_Its_Clauses(GuardClauseAssertion assertion)
    {
        assertion.Verify(typeof(CurrencyConverterController).GetConstructors());
    }

    [Theory, AutoNSubstituteData]
    public void GetConvertedCurrency(
        Amount amount,
        CurrencyConverterRequestModel model,
        CurrencyConverterController sut)
    {
        // Arrange

        sut.CurrencyConverterOrchestrator.Run(Arg.Any<CurrencyConverterRequestDto>()).Returns(amount);

        var expectedResponseAmount = sut.Mapper.Map<AmountResponse>(amount);

        // Act

        var result = sut.GetConvertedCurrency(model);
        var resultResponse = (OkObjectResult)result;

        // Assert

        result.Should().BeOfType<OkResult>();
        resultResponse.Value.Should().BeEquivalentTo(expectedResponseAmount);
    }
}
