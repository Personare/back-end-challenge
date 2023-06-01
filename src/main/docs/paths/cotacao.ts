// import { baseCurrency } from "../params/cotacao";

export const cotacaoPath = {
    get: {
        tags: ['Currency Rates'],
        summary: 'Get a currancy rate',
        parameters: [
            {
            in: 'path',
            name: 'baseCurrency',
            required: true,
            schema: {
                type: 'string',
                },
            description: "Example: USD to"
        },
        {
            in: 'path',
            name: 'targetCurrency',
            required: true,
            schema: {
                type: 'string',
            },
            description: "Example: EUR"
        }
        ],
        responses: {
            200: {
                description: 'Success',
                content: {
                    'aplication/json': {
                        schema: {
                            $ref: '#/schemas/cotacaoSchema'
                        }

                    }
                }
            },
            400: {
                description: 'Bad Request: The currency must be one of this: USD, EUR or BRL',
                content: {
                    'aplication/json': {
                        schema: {
                            $ref: '#/schemas/badRequest'
                        }

                    }
                }
            }
        }
    },
}
