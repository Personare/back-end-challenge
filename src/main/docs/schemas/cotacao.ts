export const cotacaoSchema = {
    type: 'object',
    properties: {
        base: {
            type: 'string'
        },
    target: {
            type: 'string'
        },
    conversion_rate: {
            type: 'string'
        },
    date: {
            type: 'string'
        },
    }
}

export const badRequest = {
    type: 'object',
    properties: {
        name: {
            type: 'string'
        },
    msg: {
            type: 'string'
        }
    }
}

