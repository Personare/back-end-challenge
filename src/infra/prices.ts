import { type CurrencyModel } from '../domain/models/currency'
import { type Currency } from '../domain/usecases/convert-price'
import { pairSymbolToCurrency } from '../utils/pair-symbol'
import { http } from './configs/http'
import { type ConvertPrices } from './protocols/prices-interface'

export class Prices implements ConvertPrices {
  async convert(currency: Currency): Promise<CurrencyModel> {
    const {
      data: { base_code, target_code, conversion_rate, time_last_update_utc }
    } = await http.get(`/${currency.baseCurrency}/${currency.targetCurrency}`)

    const result = pairSymbolToCurrency(currency.targetCurrency)

    return {
      base: base_code,
      target: target_code,
      conversion_rate: `${result.symbol}${conversion_rate}`,
      date: time_last_update_utc
    }
  }
}
