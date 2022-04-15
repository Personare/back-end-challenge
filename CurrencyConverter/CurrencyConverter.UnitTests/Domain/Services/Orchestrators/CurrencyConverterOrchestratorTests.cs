using AutoFixture.Idioms;
using CurrencyConverter.Domain.Dtos;
using CurrencyConverter.Domain.Services.ExtensionMethods;
using CurrencyConverter.Domain.Services.Factories;
using CurrencyConverter.Domain.Services.Orchestrators;
using CurrencyConverter.Domain.Services.Orchestrators.Interfaces;
using CurrencyConverter.Domain.ValueObjects;
using CurrencyConverter.UnitTests.FixtureConfiguration;
using FluentAssertions;
using NSubstitute;
using Xunit;

namespace CurrencyConverter.UnitTests.Domain.Services.Orchestrators
{
    public class CurrencyConverterOrchestratorTests
    {
        [Theory, AutoNSubstituteData]
        public void CurrencyConverterOrchestrator_Should_Guard_Its_Clauses(GuardClauseAssertion assertion)
        {
            assertion.Verify(typeof(CurrencyConverterOrchestrator).GetConstructors());
        }

        [Theory, AutoNSubstituteData]
        public void CurrencyConverterOrchestrator_Should_Implements_Its_Interface(CurrencyConverterOrchestrator sut)
        {
            sut.Should().BeAssignableTo<ICurrencyConverterOrchestrator>();
        }

        [Theory, AutoNSubstituteData]
        public void Run_Should_Return_Amount_With_Correct_Currency_Type(
            IEnumerable<ICurrency> currencyList,
            CurrencyConverterRequestDto dto)
        {
            // Arrange

            //Note - ForPartsOf notation forces the real part of the code to be executed!

            var amountFactory = Substitute.ForPartsOf<AmountFactory>();

            var sut = Substitute.For<CurrencyConverterOrchestrator>(currencyList, amountFactory);

            var currencyOutput = currencyList.FirstOrDefault(x => x.CurrencyType.Equals(dto.OutputCurrency));
            var currencyInput = currencyList.FirstOrDefault(x => x.CurrencyType.Equals(dto.InputCurrency));

            var expectedCurrencyAmount = currencyOutput.ConvertCurrency(currencyInput, dto.Amount);

            var amount = new Amount
            {
                CurrencyType = dto.OutputCurrency,
                Value = expectedCurrencyAmount
            };

            // Act

            var result = sut.Run(dto);

            // Assert

            sut.AmountFactory.Received(1).Assemble(expectedCurrencyAmount, dto.OutputCurrency);
            result.Should().BeEquivalentTo(amount);
        }
    }
}
