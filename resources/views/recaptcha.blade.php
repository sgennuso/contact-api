<!DOCTYPE html>
<html>
	<head>
		<title>ReCaptcha Test</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">			
			<form id="contactForm" action="https://contact.ubiweb.ca/mail" method="post">
				<div class="form-group">
					<label for="formName">Name</label>
					<input id="formName" type="text" name="_name" value="" class="form-control" />
				</div>
				<div class="form-group">
					<label for="formEmail">Email</label>
					<input id="formEmail" type="email" name="_email" value="" class="form-control" />
				</div>
				<div class="form-group">
					<label for="formMessage">Message</label>
					<textarea id="formMessage" name="_message" class="form-control"></textarea>
				</div>

				<input type="hidden" name="donotfill" value="" />
				<input type="hidden" name="redirect" value="http://ubiweb.ca" />
				<input type="hidden" name="to" value="{{ isset($_GET['to']) ? $_GET['to'] : 'freshbrewedweb@gmail.com' }}" />
				<input type="hidden" name="subject" value="Contact from test captcha" />
				<button class="btn btn-primary g-recaptcha" data-sitekey="6Lcb8SwUAAAAAAtlDuXw_5PRC3_xZ6ZVE7FkVcen"
				data-callback="onSubmit">Submit</button>
			</form>
		</div>

		<script>
	       function onSubmit(token) {
	         document.getElementById("demo-form").submit();
	       }
	     </script>
		<script src="https://www.google.com/recaptcha/api.js"></script>

	</body>
</html>
