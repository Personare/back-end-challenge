interface PairSymbol {
  symbol: string
}

// Verifying the currency to return the correct symbol
export const pairSymbolToCurrency = (targetCurrency: string): PairSymbol => {
  let pairSymboll = { symbol: '$' }

  if (targetCurrency === 'USD') {
    return pairSymboll
  }

  if (targetCurrency === 'EUR') {
    pairSymboll = { symbol: '€' }
  }

  if (targetCurrency === 'BRL') {
    pairSymboll = { symbol: 'R$' }
  }

  return pairSymboll
}
