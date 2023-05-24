describe('Convert currency', () => {
  test('should call api with correct value', async () => {
    const convertCurrency = new ConvertCurrency()
    const currencyValue = 'any_value'
    await convertCurrency.currencyValueConvert(currencyValue)
    expect(convertCurrency).toHaveBeenCalledWith('any_value')
  })
})
