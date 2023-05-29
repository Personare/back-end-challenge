import { type CurrencyModel } from '../../domain/models/currency'
import { type Currency } from '../../domain/usecases/convert-price'

export interface ConvertPrices {
  convert(currency: Currency): Promise<CurrencyModel>
}
