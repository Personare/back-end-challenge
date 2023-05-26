export interface ConvertCurrency {
    convertCurrency:  (currency: string) => Promise<ExchangeResponse>
}