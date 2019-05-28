<!DOCTYPE html>
<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Login | Melon - Flat &amp; Responsive Admin Template</title>

	<!--=== CSS ===-->

	<!-- Bootstrap -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- Theme -->
	<link href="assets/css/main.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />

	<!-- Login -->
	<link href="assets/css/login.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="assets/css/fontawesome/font-awesome.min.css">
	<!--[if IE 7]>
		<link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
	<![endif]-->

	<!--[if IE 8]>
		<link href="assets/css/ie8.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	

	
</head>

<body class="login">
	<!-- Logo -->
	<div class="logo">
		<img src="assets/img/logo.png" alt="logo" />
		<strong>ME</strong>LON
	</div>
	<!-- /Logo -->

	<!-- Login Box -->
	<div class="box">
		<div class="content">
			
			
			<!-- Register Formular (hidden by default) -->
			<form class="form-vertical register-form" action="{{ route('register') }}" method="post" style="display: none;">
				<!-- Title -->
				<h3 class="form-title">Inscription</h3>
				 {{ csrf_field() }}
				<!-- Input Fields -->
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<div class="input-icon">
						<i class="icon-user"></i>
						<input type="text" name="name" class="form-control" placeholder="Username" autofocus="autofocus"  value="{{ old('name') }}" />
					</div>
					
				</div>

				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<div class="input-icon">
						<i class="icon-lock"></i>
						<input type="password" name="password" class="form-control" placeholder="Password" />
					</div>
					
				</div>

				<div class="form-group">
					<div class="input-icon">
						<i class="icon-ok"></i>
						<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" />
					</div>
				</div>

				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<div class="input-icon">
						<i class="icon-envelope"></i>
						<input type="text" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" />
					</div>
					
				</div>
				<!-- /Input Fields -->

				<!-- Form Actions -->
				<div class="form-actions">
					<button type="button" class="back btn btn-default pull-left">
						<i class="icon-angle-left"></i> Retour</i>
					</button>
					<button type="submit" class="submit btn btn-primary pull-right">
						S'inscrire <i class="icon-angle-right"></i>
					</button>
				</div>
			</form>
			<!-- /Register Formular -->
		</div> <!-- /.content -->

		<!-- Forgot Password Form -->
		<div class="inner-box">
			<div class="content">
				<!-- Close Button -->
				<i class="icon-remove close hide-default"></i>

				<!-- Link as Toggle Button -->
				<a href="#" class="forgot-password-link">Mot de passe oublié?</a>

				<!-- Forgot Password Formular -->
				<form class="form-vertical forgot-password-form hide-default" action="login.html" method="post">
					<!-- Input Fields -->
					<div class="form-group">
						<!--<label for="email">Email:</label>-->
						<div class="input-icon">
							<i class="icon-envelope"></i>
							<input type="email" name="email" class="form-control" placeholder="Enter email address" required="required" />
						</div>
					</div>
					<!-- /Input Fields -->

					<button type="submit" class="submit btn btn-default btn-block">
						Réinitialisez votre mot de passe
					</button>
				</form>
				<!-- /Forgot Password Formular -->

				<!-- Shows up if reset-button was clicked -->
				<div class="forgot-password-done hide-default">
					<i class="icon-ok success-icon"></i> <!-- Error-Alternative: <i class="icon-remove danger-icon"></i> -->
					<span>Génial. Nous vous avons envoyé un email.</span>
				</div>
			</div> <!-- /.content -->
		</div>
		<!-- /Forgot Password Form -->
	</div>
	<!-- /Login Box -->

	<!-- Single-Sign-On (SSO) 
	<div class="single-sign-on">
		<span>or</span>

		<button class="btn btn-facebook btn-block">
			<i class="icon-facebook"></i> Sign in with Facebook
		</button>

		<button class="btn btn-twitter btn-block">
			<i class="icon-twitter"></i> Sign in with Twitter
		</button>

		<button class="btn btn-google-plus btn-block">
			<i class="icon-google-plus"></i> Sign in with Google
		</button>
	</div>
	 /Single-Sign-On (SSO) -->

	<!-- Footer -->
	<div class="footer">
		<a href="#" class="sign-up">Vous n'avez pas encore de compte? <strong>S'inscrire</strong></a>
	</div>
	<!-- /Footer -->
		<!--=== JavaScript ===-->

	<script type="text/javascript" src="assets/js/libs/jquery-1.10.2.min.js"></script>

	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/libs/lodash.compat.min.js"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="assets/js/libs/html5shiv.js"></script>
	<![endif]-->

	<!-- Beautiful Checkboxes -->
	<script type="text/javascript" src="plugins/uniform/jquery.uniform.min.js"></script>

	<!-- Form Validation --> 
	<script type="text/javascript" src="plugins/validation/jquery.validate.min.js"></script>

	<!-- Slim Progress Bars -->
	<script type="text/javascript" src="plugins/nprogress/nprogress.js"></script>

	<!-- App -->
	<script type="text/javascript" src="assets/js/login.js"></script>
	<script type="text/javascript" src="jquery.js"></script>
	
	<script>
	$(document).ready(function(){
		
		Login.init(); // Init login JavaScript	
	});
	</script>
</body>
</html>