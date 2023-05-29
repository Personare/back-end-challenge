export interface CurrencyModel {
  base: string
  date: string
  rates: {
    USD: number
    EUR: number
    BRL: number
  }
}
