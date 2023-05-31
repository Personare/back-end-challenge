import { type CurrencyModel } from '../domain/models/currency'
import { type Currency } from '../domain/usecases/convert-price'
import { http } from './configs/http'
import { type ConvertPrices } from './protocols/prices-interface'

export class Prices implements ConvertPrices {
  async convert({ symbol }: Currency): Promise<CurrencyModel> {
    const {
      data: {
        base_code,
        conversion_rates,
        time_last_update_utc
      }
    } = await http.get(`/${symbol}`)

    return {
      base: base_code,
      rates: conversion_rates,
      date: time_last_update_utc
    }

    // return {
    //   base: 'base_code',
    //   rates: { BRL: 1, EUR: 1, USD: 1 },
    //   date: 'time_last_update_utc'
    // }
  }
}
