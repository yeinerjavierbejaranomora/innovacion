<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="{{asset('public/css/app.css')}}">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('public/assets/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/main.css')}}">
<!--===============================================================================================-->
 

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url({{asset('public/assets/images/bg-01.jpg')}});">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" id="miform">
					<span class="login100-form-title p-b-49">
						Sistema de Proyección Ibero
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is required">
						<span class="label-input100">Correo</span>
						<input class="input100" type="text" name="username" placeholder="Ingresa tu usuario" id="mail">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate="Password is required">
						<span class="label-input100">Contraseña</span>
						<br>
						<input class="input100" type="password" name="pass" placeholder="Ingresa tu contraseña" id="pass">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<br>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

					<div class="alert" id="mensaje" style="text-align: center;display: none; width: 100%; font-size: 20px;"></div>
					
					<div class="txt1 text-center p-t-54 p-b-20">
						<h4> Universidad Iberoamericana</h4>
                  		<p>©2023 Todos los derechos reservados.</p>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('public/assets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public/assets/vendor/animsition/js/animsition.min.js')}}"></script>
<!--=============assets/==================================================================================-->
	<script src="{{ asset('public/assets/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public/assets/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public/assets/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{ asset('public/assets/vendor/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public/assets/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public/assets/js/main.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#miform").submit(function(event){
      event.preventDefault();
      $.ajax({
        dataType:"json",
        url:"index.php?action=validar",
        type:"POST",
        data:{usr:$("#mail").val(),pass:$("#pass").val()},
        success: function(data){
          if (data.success==false) {
            $("#mensaje").show();
            $("#mensaje").html(data.msg);
            $('.log-status').addClass('wrong-entry');
            $('.alert').fadeIn(700);
            setTimeout( "$('.alert').fadeOut(1800);",1500 );
          } else {
            window.location=data.link;
          }
        },
        error: function(response) {
          $("#mensaje").show();
          $("#mensaje").html(response.responseText);
        }
      });
    });
    $('.form-control').keypress(function(){
      $('.log-status').removeClass('wrong-entry');
    });
  });
</script>

</body>
</html>