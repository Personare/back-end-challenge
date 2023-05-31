import { type CurrencyModel } from '../models/currency'

export interface Currency {
  symbol: string
}

export interface ConvertCurrency {
  convert: (currency: Currency) => Promise<CurrencyModel>
}
