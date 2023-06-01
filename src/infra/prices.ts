import { type CurrencyModel } from '../domain/models/currency'
import { type Currency } from '../domain/usecases/convert-price'
import { http } from './configs/http'
import { type ConvertPrices } from './protocols/prices-interface'

export class Prices implements ConvertPrices {
  async convert(currency: Currency): Promise<CurrencyModel> {
    const {
      data: { base_code, conversion_rates, time_last_update_utc }
    } = await http.get(`/${currency}`)

    return {
      base: base_code,
      rates: {
        BRL: conversion_rates.BRL,
        EUR: conversion_rates.EUR,
        USD: conversion_rates.USD
      },
      date: time_last_update_utc
    }
  }
}
