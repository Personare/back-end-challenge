import { Prices } from './prices'

describe('Convert Lib', () => {
    test('should call convert with correct value ', async () => {
        const sut = new Prices()
        const response = {
            base: 'any_base',
            target: 'any_target',
            conversion_rate: 'any_value',
            date: 'any_date'
        }
        jest.spyOn(sut, 'convert').mockReturnValueOnce(
            new Promise(resolve => resolve(response))
        )

        const currency = {
            baseCurrency: 'any_base',
            targetCurrency: 'any_target'
        }
        const convertPromiseReturns = await sut.convert(currency)
        expect(convertPromiseReturns).toEqual(response)
    })

    test('should throw exception if convert fails ', async () => {
        const sut = new Prices()
        jest.spyOn(sut, 'convert').mockReturnValueOnce(
            new Promise((resolve, reject) => reject(new Error()))
        )

        const currency = {
            baseCurrency: 'any_base',
            targetCurrency: 'any_target'
        }

        const convertRturnPromise = sut.convert(currency)
        await expect(convertRturnPromise).rejects.toThrow()
    })
})
