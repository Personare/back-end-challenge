import { type Request, type Response, type NextFunction } from 'express'


export const noCache = (req: Request, res: Response, next: NextFunction): void => {
    res.set('cache-control', 'no-store, no-cache, must-revalidate, proxy-revalidate')
    res.set('expires', '0')
    res.set('surrogate-control', 'no-store')
    next()
}
