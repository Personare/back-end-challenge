[![Build Status](https://travis-ci.org/fellipecastro/back-end-challenge.svg?branch=master)](https://travis-ci.org/fellipecastro/back-end-challenge)

**Currency Converter**
----
  Calculate currency exchange rates.

* **URL**

  /?from=&to=&value=

* **Method:**

  `GET`

*  **URL Params**

   **Required:**

   `from=[string]`
   `to=[string]`
   `value=[float]`

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{ original_value: "$ 3.45", converted_value: "R$ 6.90" }`
 
* **Error Response:**

  <_Most endpoints will have many ways they can fail. From unauthorized access, to wrongful parameters etc. All of those should be liste d here. It might seem repetitive, but it helps prevent assumptions from being made where they should be._>

  * **Code:** 400 BAD REQUEST <br />
    **Content:** `{ error: "Valid parameters are: 'from', 'to' and 'value'." }`

  OR

  * **Code:** 404 NOT FOUND <br />
    **Content:** `{ error: "No rate available for the given currencies." }`

* **Sample Call:**

  ```curl -i -H "Accept: application/json" -H "Content-Type: application/json" -X GET http://currency-converter.fellipecastro.com/\?from\=USD\&to\=BRL\&value\=3.45```
