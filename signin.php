<?php
require_once './classes/database.php';

// handle user login

if ($_POST) {
	$dbCon = dbConnect();
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordHash = md5($password);
	$error = false;

	$records = $dbCon->query("select * from users where email like '{$email}' and password = '{$passwordHash}'");
	if ($records->num_rows == 0) {
		$error = true;
		$authError = 'Sorry, your e-mail or password is incorrect.';
	}

	// if there is no errors, login user
	if (!$error) {
		session_start();
		$user = $records->fetch_assoc();
		// var_dump($user).die();
		$_SESSION['user_id'] = $user['id'];
		$_SESSION['email'] = $user['email'];
		$_SESSION['user_type'] = $user['user_type'];
		$_SESSION['is_first_login'] = $user['is_first_login'];

		if ($user['user_type'] == 'musician') {
			if ($user['is_first_login']) {
				header('Location: /src/musician/setting.php');
			} else {
				header('Location: /src/musician/profile.php');
			}
		} else {
			header('Location: /src/customer/profile.php');
		}
	}
}


$css = ['signin-page.css'];

include './src/layout/header.php';
?>
<div class="sighnin-container">
	<div class="row align-items-center w-100 height-100">
		<div class="col signin-bg"></div>
		<div class="col">
			<div class="col-8 align-self-center">
				<h1>Sign In</h1>
				<form method="post" action="/signin.php">
					<div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input name="email" type="email" class="form-control"  aria-describedby="emailHelp">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input name="password" type="password" class="form-control" >
					</div>
					<small id="auth-error" class="form-text text-danger error">
							<?php echo isset($authError) ? $authError : null; ?>	
					</small>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
include './src/layout/footer.php';
?>