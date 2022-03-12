$(document).ready(function(){
	console.log("ready!");

	$('#user-reg-form').submit(function(event) {

		var email = $('#email').val();
		var password = $('#password').val();
		var confirmPassword = $('#confirm-pw').val();
		var userType = $('input[name="user-type"]:checked').val();
		var error = false
 
		// reset all errors befor validate
		$('.error').text('');

		// check whether email is empty
		if (email == '' ) {
			error = true;
			$('#email-error').text('e-mail address cannot be empty.')
		}

		// check password policy
		// password should contain more than 4 characters
		if (password.length < 4 ) {
			error = true;
			$('#password-error').text('Password must contain at least 4 characters.')
		}
		else if (password !== confirmPassword) {
			error = true;
			$('#confirm-pw-error').text('Both password and confirm password should be macth.')
		}

		// if there is any error occured
		if (error) {
			if (event.preventDefault) {
				event.preventDefault()
			}
			return false;
		}

		return true;
	});

})