<?php

$showLogin = "style='display:block;'";
$showSignup = "style='display:none;'";


	if(isset($_POST['login'])){
		//
	} else if (isset($_GET['login']) && $_GET['login'] == 'signup') {
		$showLogin = "style='display:none;'";
		$showSignup = "style='display:block;'";

		if(isset($_POST['signup'])){
			//
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign up Page</title>
	<link href="./styles/bootstrap.min.css" rel="stylesheet">
	<link href="./styles/main.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<!-- LogIn -->
		<div <?php echo $showLogin; ?> >
			<div class="row">
				<div class="col-md-4 col-sm-3"></div>
				<div class="col-md-4 col-sm-6 col">
					<form action="" method="post">
						<h2 class="form-signin-heading">Please sign in</h2>

						<label for="inputEmail" class="sr-only">Email address</label>
						<input type="text" name="inputLogin" class="form-control" placeholder="Login" required="" autofocus="">

						<label for="inputPassword" class="sr-only">Password</label>
						<input type="password" name="inputPassword" class="form-control" placeholder="Password" required="">
						
						<label>
							<a href="./user"> Sign up </a>
						</label>

						<button name="login" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
					</form>
				</div>
				<div class="col-md-4 col-sm-3"></div>
			</div>
		</div>

		<!-- SignUp -->
		<div <?php echo $showSignup; ?>>
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
					<form role="form" action="" method="post">
						<h2>Please Sign Up</h2>
						<hr class="colorgraph">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="firstname" id="firstname" class="form-control input-lg" placeholder="First Name" tabindex="1">
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="lastname" id="lastname" class="form-control input-lg" placeholder="Last Name" tabindex="2">
								</div>
							</div>
						</div>
						<div class="form-group">
							<input type="text" name="displayName" id="displayName" class="form-control input-lg" placeholder="Display Name" tabindex="3">
						</div>
						<div class="form-group">
							<input type="text" name="login" id="login" class="form-control input-lg" placeholder="Login" tabindex="4">
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-12"><input name="register" type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
