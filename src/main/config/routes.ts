import { type Express, Router } from 'express'
import fastGlob from 'fast-glob'

export default (app: Express): void => {
  const router = Router()
  app.use('/api', router)
  fastGlob
    .sync('**/src/main/routes/**routes.ts')
    .map(async item => (await import(`../../../${item}`)).default(router))
}
