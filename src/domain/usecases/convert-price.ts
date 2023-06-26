import { type CurrencyModel } from '../models/currency'

export interface Currency {
    baseCurrency: string
    targetCurrency: string
}

export interface ConvertCurrency {
    convert(currency: Currency): Promise<CurrencyModel>
}
