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

   **Optional:**
   - `message=[alphanumeric]`
   - `from=[alphanumeric]`
   - `g-recaptcha-response=[alphanumeric]`
