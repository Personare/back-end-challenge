FROM node:12.16.1

LABEL maintainer 'Lucas Alves Marcello https://github.com/lucasmarcello/'

ENV HOME=/home/app

ENV PORT=3000

RUN apt-get update

COPY package.json package-lock.json $HOME/

WORKDIR $HOME

RUN npm install --silent

COPY . $HOME/

CMD ["npm", "start"]
