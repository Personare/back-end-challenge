import { Prices } from './prices'

describe('Convert Lib', () => {
  test('should call convert with correct value ', async () => {
    const sut = new Prices()
    const response = {
      base: 'any_base',
      date: 'any_date',
      rates: {
        USD: 1,
        EUR: 1,
        BRL: 1,
      },
    }
    jest
      .spyOn(sut, 'convert')
      .mockReturnValueOnce(new Promise((resolve) => resolve(response)))

    const currency = { symbol: 'any_currency' }
    const convertPromiseReturns = await sut.convert(currency)
    expect(convertPromiseReturns).toEqual(response)
  })

  test('should throw exception if convert fails ', async () => {
    const sut = new Prices()
    jest
      .spyOn(sut, 'convert')
      .mockReturnValueOnce(
        new Promise((resolve, reject) => reject(new Error())),
      )

    const currency = { symbol: 'any_currency' }

    const convertRturnPromise = sut.convert(currency)
    await expect(convertRturnPromise).rejects.toThrow()
  })
})
