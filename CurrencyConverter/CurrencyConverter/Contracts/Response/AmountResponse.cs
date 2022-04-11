namespace CurrencyConverter.Api.Contracts.Response
{
    public class AmountResponse
    {
        public decimal Value { get; set; }
        public string Currency { get; set; } = string.Empty;
    }
}
