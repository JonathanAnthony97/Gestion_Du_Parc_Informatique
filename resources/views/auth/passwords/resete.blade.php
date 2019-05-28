<!DOCTYPE html>
<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Bolloré</title>

	<!--=== CSS ===-->

	<!-- Bootstrap -->
	<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

	<!-- Theme -->
	<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />

	<!-- Login -->
	<link href="{{ asset('assets/css/login.css') }}" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome/font-awesome.min.css') }}">
	<!--[if IE 7]>
		<link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
	<![endif]-->

	<!--[if IE 8]>
		<link href="assets/css/ie8.css" rel="stylesheet" type="text/css" />
	<![endif]-->

	<!--=== JavaScript ===-->
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
			<!-- Login Formular -->
			<form id="reset_form" class="form-vertical login-form" action="{{ route('password.request') }}" method="post">
				<!-- Title -->
				<h3 class="form-title">Réinitialiser le mot de passe</h3>

				{{ csrf_field() }}
				<input type="hidden" name="token" value="{{ $token }}">
				<!-- Input Fields -->
				<div id="em" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<!--<label for="username">Username:</label>-->
					<div class="input-icon">
						<i class="icon-user"></i>
						<input type="text" name="email" class="form-control" placeholder="E-Mail Address" autofocus="autofocus" value="{{ $email or old('email') }}"/>
					</div>
					<strong><span class="help-block email">
						@if ($errors->has('email'))
                                       {{ $errors->first('email') }}
                                @endif
					</span></strong>
					
				</div>

				<div id="pas" class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<!--<label for="password">Password:</label>-->
					<div class="input-icon">
						<i class="icon-lock"></i>
						<input type="password" name="password" class="form-control" placeholder="Password"/>
					</div>
					<strong><span class="help-block passw">
						@if ($errors->has('password'))                               
                                       {{ $errors->first('password') }}                           
                                @endif
					</span></strong>
					 
				</div>

				<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
					<!--<label for="password">Password:</label>-->
					<div class="input-icon">
						<i class="icon-lock"></i>
						<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" />
					</div>
					@if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
				</div>
				<!-- /Input Fields -->

				<!-- Form Actions -->
				<div class="form-actions">
					
					<button type="submit" class="submit btn btn-primary pull-right">
						Réinitialiser <i class="icon-angle-right"></i>
					</button>
				</div>
			</form>
			<!-- /Login Formular -->

			<!-- Register Formular (hidden by default) -->
			
			<!-- /Register Formular -->
		</div> <!-- /.content -->
	</div>
	<!-- /Login Box -->

	<!-- /Single-Sign-On (SSO) -->

	<!-- Footer -->
	<div class="footer">
		
	</div>
	<!-- /Footer -->

			<!--=== JavaScript ===-->

	
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	<script>
	$(document).ready(function(){
			$(document).on('keyup','input[name="email"]',function(){
				if($(this).val() !== ""){
				$('.email').html("");
				$('#em').removeClass('has-error');
				}
			});
			$(document).on('keyup','input[name="password"]',function(){
				if($(this).val() !== ""){
				$('.passw').html("");
				$('#pas').removeClass('has-error');
				}
			});
	});
	</script>
</body>
</html>