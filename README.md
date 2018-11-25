**QuotationConverter**
----
  API to convert between currencies. Currencies supported: 'BRL', 'USD', 'EUR'.

* **URL**

  /converter/{from}/{to}?value={value}

* **Method:**
  

  `GET` 
  
*  **URL Params**


   **Required:**
 
   `
   from=[string]
   to=[string]
   value=[number]
   `

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{"converted":"$ 1.42","original":"R$ 5.45","rate":0.26}`
 
* **Error Response:**

  * **Code:** 400 BAD REQUEST <br />
    **Content:** `{"error":"Missing 'value' parameter"}`

  OR

  * **Code:** 400 BAD REQUEST <br />
    **Content:** `{"error":"Not supported currency on 'from' parameter"}`

  OR

  * **Code:** 400 BAD REQUEST <br />
    **Content:** `{"error":"Not supported currency on 'to' parameter"}`

  

* **Requirements:** <br />
    `docker,` <br/>
    `"php": ">=7.1.3",` <br/>
    `"laravel/lumen-framework": "5.7.*",` <br/>
    `"vlucas/phpdotenv": "~2.2"`
    

* **Building and Running:**

    ```
        docker-compose build && docker-compose up
    ```
