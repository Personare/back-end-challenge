export class MissingParamError extends Error {
    private readonly msg: string
    constructor(paramName: string) {
        super(`Invalid param: ${paramName}`)
        this.name = 'MissingParamError'
        this.msg = paramName
    }
}
