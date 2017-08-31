# Contact API

This is the API for handling contact forms and requests on the Ubiweb network.

- 	**HOST**
	https://contact.ubiweb.ca/

## Send

Sends an email to a specified address.

*  **URL**
   `/send/`

*  **Method**
   `POST`

*  **Data Params**

   **Required:**
   - `subject=[alphanumeric]`
   - `to=[alphanumeric email]`
   - `donotfill=[empty string]` - will validate as SPAM if anything other than empty.

   **Optional:**
   - `message=[alphanumeric]`
   - `from=[alphanumeric]`
   - `html=[boolean]`
   - `g-recaptcha-response=[alphanumeric]`

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{ sentTo : "user@example.com" }`
 
* **Error Response:**

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "Not authorized" }`

  OR

  * **Code:** 400 BAD REQUEST <br />
    **Content:** `{ error : { subject: "Must not be empty." } }`

* **Sample Call:**

  **Sample Form Request**
  ``` html
  <form action="https://contact.ubiweb.ca/mail" method="post">
	<input type="text" name="subject" value="Contact from ExampleSite.com"/>
	<textarea name="message"></textarea>
	<input type="hidden" name="to" value="admin@examplesite.com"/>
	<input type="hidden" name="html" value="true"/>
  </form>
  ```
  
  **Sample cUrl Request**
	```
	curl -X POST \
	  https://contact.ubiweb.ca/send \
	  -H 'cache-control: no-cache' \
	  -H 'content-type: application/json' \
	  -H 'postman-token: 4bf06c09-61d4-3a9c-6fe6-f876c896d84d' \
	  -d '{
	  "to": "admin@examplesite.com",
	  "subject": "Contact from ExampleSite.com",
	  "message": "<h1>Message</h1><p>Body content</p>",
	  "html": true
	}'
	```
