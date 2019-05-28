<!DOCTYPE html>
<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Login | Bolloré - Logistics</title>

	<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<style type="text/css">
		input.log{
			height: 34px;
			}
	</style>
	
	<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/login.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/loader.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome/font-awesome.min.css') }}">
</head>

<body class="login">
<br><br><br><br><br>
	<div class="box">
		<div class="content">
			<div class="logo">
		<img style="width: 350px;height: 100px;margin-top: -40px;margin-bottom: -10px;" src="{{ asset('assets/image/log.png')}}" alt="logo" />
	</div>
			<form id="authentif" class="form-vertical login-form" action="{{ route('login') }}" method="post">
				{{ csrf_field() }}
				<div id="log" class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
					<div class="input-icon">
						<i class="icon-user"></i>
						<input type="text" name="username" class="form-control log" placeholder="Username" autofocus="autofocus" value="{{ old('username') }}" />
					</div>
					<strong><span class="help-block nom">
						@if ($errors->has('username'))
                                 &nbsp;<i class="icon-info-sign">&nbsp;{{ $errors->first('username') }}</i>
                                @endif
					</span></strong>
				</div>
				<div id="pass" class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<div class="input-icon">
						<i class="icon-lock"></i>
						<input type="password" name="password" class="form-control log" placeholder="Password"/>
					</div>
					<strong><span class="help-block motdepass">
						@if ($errors->has('password'))
                                &nbsp;<i class="icon-info-sign">&nbsp;{{ $errors->first('password') }}</i>
                                @endif
					</span></strong>					
				</div>
	
				<div class="form-actions">
					<label class="checkbox pull-left">

						<input type="checkbox" class="uniform" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me</label>
					<button type="submit" class="submit btn btn-primary pull-right">
						Se connecter <i class="icon-angle-right"></i>
					</button>
				</div>
			</form>
			<!-- /Login Formular -->

			<!-- Register Formular (hidden by default) -->
			<form id="regist" class="form-vertical register-form" action="{{ route('register') }}" method="post" style="display: none;">
			
				<h3 class="form-title">Inscription</h3>
				 {{ csrf_field() }}
		
				<div id="a" class="form-group">
					<div class="input-icon">
						<i class="icon-user"></i>
						<input type="text" name="Username" class="form-control log" placeholder="Username" autofocus="autofocus" data-rule-required="true"  value="{{ old('Username') }}" />
					</div>
					<strong><span class="help-block" id="name-error"></span></strong>
				</div>

				<div id="b" class="form-group">
					<div class="input-icon">
						<i class="icon-lock"></i>
						<input type="password" name="Password" class="form-control log" placeholder="Password" />
					</div>
					<strong><span class="help-block" id="password-error"></span></strong>
				</div>

				<div class="form-group">
					<div class="input-icon">
						<i class="icon-ok"></i>
						<input type="password" name="Password_confirmation" class="form-control log" placeholder="Confirm Password" />
					</div>
				</div>

				<div id="c" class="form-group">
					<div class="input-icon">
						<i class="icon-envelope"></i>
						<input type="email" name="Email" class="form-control log" placeholder="Email address" value="{{ old('Email') }}" />
					</div>
					<strong><span class="help-block" id="email-error"></span></strong>
				</div>
		
				<div class="form-actions">
					<button id="retour" type="button" class="back btn btn-default pull-left">
						<i class="icon-angle-left"></i> Retour
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
				<div class="spinner">
					  <div class="rect1"></div>
					  <div class="rect2"></div>
					  <div class="rect3"></div>
					  <div class="rect4"></div>
					  <div class="rect5"></div>
					  <div class="rect6"></div>
					  <div class="rect7"></div>
				</div>

				<!-- Forgot Password Formular -->
				<form id="reset_password" class="form-vertical forgot-password-form hide-default" action="{{ route('password.email') }}" method="post">
			
					{{ csrf_field() }}
					<div id="error-reset" class="form-group">
						<div class="input-icon">
							<i class="icon-envelope"></i>
							<input id="champ" type="email" name="email" class="form-control log" placeholder="Enter email address" required="required" />
						</div>
						<strong><span class="help-block" id="reset-error"></span></strong>
					</div>
				
					<button type="submit" class="submit btn btn-default btn-block">
						Réinitialisez votre mot de passe
					</button>
				</form>
				<!-- /Forgot Password Formular -->

				<div class="forgot-password-done hide-default">
					<i class="icon-ok success-icon"></i> 
					<span id="yes"></span>
				</div>
			</div> <!-- /.content -->
		</div>
		<!-- /Forgot Password Form -->
	</div>


	<!-- Footer -->
	<div class="footer">
		<a href="#" style="color: white;" class="sign-up">Vous n'avez pas encore de compte ? <strong>S'inscrire</strong></a>
	</div>
</body>
<script type="text/javascript" src="{{ asset('assets/js/libs/jquery-1.10.2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/libs/lodash.compat.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('plugins/uniform/jquery.uniform.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('plugins/nprogress/nprogress.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/login.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	
	<script>
	$(document).ready(function(){
		Login.init(); // Init login JavaScript	

		$('.spinner').hide();
		$('#champ').val("");
		$(document).on('submit','#regist',function(e){
			e.preventDefault();

			$('#name-error').html("");
			$('#password').html("");
			$('#email-error').html("");

			$('#a').removeClass('has-error');
			$('#b').removeClass('has-error');
			$('#c').removeClass('has-error');
			$.ajax({
				type:'POST',
				url : $(this).attr('action'),
				data : $(this).serialize(),
				success:function(data){
					if(data.errors){
						if(data.errors.Username){
							$('#a').addClass('has-error');
							$('#name-error').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.Username[0]+'</i>');
						}
						if(data.errors.Password){
							$('#b').addClass('has-error');
							$('#password-error').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.Password[0]+'</i>');
						}
						if(data.errors.Email){
							$('#c').addClass('has-error');
							$('#email-error').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.Email[0]+'</i>');
						}
					}else{
						window.location.replace("{{ route('home') }}");
					}
				}
			});
		});

		$(document).on('click','#retour',function(){
			$('#name-error').html("");
			$('#password').html("");
			$('#email-error').html("");
			$('.form-control').val("");
			$('.help-block').html("");
			$('#log').removeClass('has-error');
			$('#pass').removeClass('has-error');
			$('#a').removeClass('has-error');
			$('#b').removeClass('has-error');
			$('#c').removeClass('has-error');
		});

		$(document).on('keyup','input[name="username"]',function(){
			if($(this).val().trim() !== ""){
				$('#log').removeClass('has-error');
				$('.nom').html("");
			}
		});

		$(document).on('keyup','input[name="password"]',function(){
			if($(this).val() !== ""){
				$('#pass').removeClass('has-error');
				$('.motdepass').html("");
			}
		});

		$(document).on('keyup','input[name="Username"]',function(){
			if($(this).val().trim() !== ""){
				$('#name-error').html("");
				$('#a').removeClass('has-error');
			}
		});

		$(document).on('keyup','input[name="Password"]',function(){
			if($(this).val() !== ""){
				$('#password-error').html("");
				$('#b').removeClass('has-error');
			}
		});

		$(document).on('keyup','input[name="Email"]',function(){
			if($(this).val().trim() !== ""){
				$('#email-error').html("");
				$('#c').removeClass('has-error');
			}
		});

		$(document).on('submit','#reset_password',function(e){
			e.preventDefault();
			$('#error-reset').removeClass('has-error');
			$('#reset-error').html("");
			$('.spinner').show('slow');
			$.ajax({
				type: 'POST',
				url : $(this).attr('action'),
				data : $(this).serialize(),
				success:function(data){
						if(data.error == "false"){
							$('#yes').html(data.msg);
							$('.icon-remove,.forgot-password-link,.forgot-password-form').css('display','none');
							$('.inner-box,.forgot-password-done').css('display','block');
						}else{
							$('#error-reset').addClass('has-error');
							$('#reset-error').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.msg+'</i>');
						}
						$('.spinner').hide();
				}
			});
		});

		$(document).on('click','.icon-remove',function(){
			$('#error-reset').removeClass('has-error');
			$('.spinner').hide();
			$('#reset-error').html("");
			$('#champ').val("");
		});

		$(document).on('click','.forgot-password-link',function(){
			$('#champ').val("");
		});

	
	});
	</script>
</html>