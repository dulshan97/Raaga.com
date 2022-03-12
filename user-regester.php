<?php
require_once './classes/database.php';

// handle form submition only if form is submited
if ($_POST) {
	$dbCon = dbConnect();
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordHash = md5($password);
	$userType = $_POST['user-type'];
	$firstLogin = true;
	$error = false;

	$users = $dbCon->query("select * from users where email like '{$email}'");
	if ($users->num_rows > 0) {
		$error = true;
		$emailError = 'Sorry, this e-mail address has already been taken.';
	}

	// if there is no errors, create user record
	if (!$error) {
		$sql = "insert into users (email, password, user_type, is_first_login) values ('{$email}', '{$passwordHash}', '{$userType}', '{$firstLogin}')";

		if ($dbCon->query($sql)) {
			header('Location: /signin.php');
		} else {
			die('Error occurd while creating user: ' . $dbCon->error);
		}
	}
}




$css = ['signin-page.css'];
$js = ['signin.js'];
include './src/layout/header.php';
?>

<div class="sighnin-container">
	<div class="row align-items-center w-100 height-100">
		<div class="col signin-bg"></div>
		<div class="col">
			<div class="col-8">			
				<h1>Regester</h1>
				<form name="user-reg-form" id="user-reg-form" method="post" action="/user-regester.php">
					<div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input name="email" type="email" class="form-control" id="email">
						<small id="email-error" class="form-text text-danger error">
							<?php echo isset($emailError) ? $emailError : null; ?>	
						</small>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input name='password' type="password" class="form-control" id="password">
						<small id="password-error" class="form-text text-danger error"></small>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Confirm Password</label>
						<input name="confirm-pw" type="password" class="form-control" id="confirm-pw">
						<small id="confirm-pw-error" class="form-text text-danger error"></small>
					</div>
					<div class="form-group">
						<label >Confirm your Account As</label>
						<div class="form-check">
							<div class="form-check-inline">
								<input name="user-type" type="radio" class="form-check-input" value="customer" checked>
								<label class="form-check-label" for="user-type">Customer</label>
							</div>
							<div class="form-check-inline">
								<input name="user-type" type="radio" class="form-check-input" value="musician">
								<label class="form-check-label" for="user-type">Musician</label>
							</div>
						</div>
					</div>
						<button type="submit" class="btn btn-primary">submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
include './src/layout/footer.php';
?>