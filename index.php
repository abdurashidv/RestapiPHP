<?php
session_start();
$hostname = "http://$_SERVER[HTTP_HOST]";
$errorMessage = '';
$showLogin = "style='display:block;'";
$showSignup = "style='display:none;'";
$_SESSION['signup'] = false;

function processData($url){
	$client = curl_init($url);
   	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
   	$response = curl_exec($client);

   	return json_decode($response);
}


//PROCESS LOGIN
	if(isset($_POST['login'])){
		$login = $_POST['inputLogin'];
		$password = $_POST['inputPassword'];

		$url = $hostname."/CatalogApi/api/login/".$login."/".$password;
		$result = processData($url);

		if($result->data != null){
			$_SESSION['user'] = array('login'=>$login, 'password'=>$password);

			header("Location: ".$hostname."/CatalogApi/catalog.php");
		} else{
			$_SESSION['user'] = array();
			$errorMessage = 'Error! Invalid credentials.';
		}
	}
//END OF PROCESS LOGIN

//PROCESS SIGN UP
	if ((isset($_GET['login']) && $_GET['login'] == 'signup') || $_SESSION['signup'] == true) {
		$showLogin = "style='display:none;'";
		$showSignup = "style='display:block;'";
		$errorMessage = '';

		if(isset($_POST['signup'])){
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$login = $_POST['login'];
			$password = $_POST['password'];
			$password_confirmation = $_POST['password_confirmation'];

			$hasFilled = true;

			if(strlen($firstname) < 1){
				$errorMessage .= 'Firstname should be filled.<br>';
				$hasFilled = false;
			}
			if(strlen($lastname) < 1){
				$errorMessage .= 'lastname should be filled.<br>';
				$hasFilled = false;
			}
			if(strlen($login) < 1){
				$errorMessage .= 'Login should be filled.<br>';
				$hasFilled = false;
			}
			if(strlen($password) < 1){
				$errorMessage .= 'Password should be filled.<br>';
				$hasFilled = false;
			}
			if(strlen($password_confirmation) < 1){
				$errorMessage .= 'Password confirmation should be filled.<br>';
				$hasFilled = false;
			}

			if($hasFilled==true){
				$errorMessage = '';
				if($password == $password_confirmation){
					$url = $hostname."/CatalogApi/api/signup/".$firstname."/".$lastname."/".$login."/".$password;
					$result = processData($url);
					$_SESSION['signup'] = false;				
					
					header("Location: ".$hostname."/CatalogApi/index.php");
				} else{
					$_SESSION['signup'] = true;
					$errorMessage .= 'Password does not match.<br>';
				}
			}
		}
	}
//END OF PROCESS SIGN UP
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
						<span style="color:red; font-weight: bold;"><?php echo $errorMessage ?></span>
						<input type="text" name="inputLogin" class="form-control" placeholder="Login" required="" autofocus="">
						<input type="password" name="inputPassword" class="form-control" placeholder="Password" required="">
						<label>
							<a href="./signup"> Sign up </a>
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
						<span style="color:red; font-weight: bold;"><?php echo $errorMessage ?></span>
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
							<div class="col-xs-12 col-md-12"><input name="signup" type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
