# personare-converter

An API that converts currencies

## Getting started

After cloning this repository, follow the instructions to get started

 ```
cd back-end-challenge
npm install
npm start
```

## Running tests

 ```
npm run test
```

## Endpoints

### GET /convert

Currency conversion endpoint, which can be used to convert currencies.

Example: [http://localhost:3000/convert?from=USD&to=BRL&amount=1](http://localhost:3000/convert?from=USD&to=BRL&amount=1)

#### Parameters

* `from` (required): The three-letter currency code of the currency you would like to convert from.
* `to` (required): The three-letter currency code of the currency you would like to convert to.
* `amount` (required): The amount to be converted.

The currencies enabled on the API are:

- **BRL**: Brazilian real
- **USD**: United States dollar
- **EUR**: Euro

| Code | Description |
| --- | ----------- |
| BRL | Brazilian real |
| USD | United States dollar |
| EUR | Euro |