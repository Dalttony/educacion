<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Variedades y Comunicaciones |
        Iniciar Sesión    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="<?php echo base_url();?>assests/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="<?php echo base_url();?>assests/css/stilos.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assests/css/util.css" rel="stylesheet">
 
    <link rel="shortcut icon" href="img/jovenes_programadore.ico" />
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assests/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assests/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assests/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assests/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assests/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
 <script type="text/javascript" src="<?php base_url(); ?>assests/js/login/usuario.js"></script>
</head>

<body>

<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url();?>assests/img/fondo.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
					<h4>
                    <b>Sistema</b> de Educacion
                </h4>

					<div >
                <img src="<?php echo base_url();?>assests/icon/icon.svg" id ="icon" alt="User Icon" />
            </div>
            <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
			<input class="input100" type="text" name="username" placeholder="Escriba el usuario" id="txt_usu" autocomplete="new-password">
						<input class="input100" type="password" name="pass" placeholder="Escriba la contrase&ntilde;a" id="txt_con">
						<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" onclick="VerificarUsuario()" >
								Iniciar Sesión
							</button>
						</div>
					</div><br>
    <div id="formFooter">
    	    <a class="underlineHover" href="<?=  base_url();?>Administracion">¿Admin?</a>
            <a class="underlineHover" href="<?=  base_url();?>email">¿Olvidaste la contraseña?</a>
             <a class="underlineHover" href="<?= base_url();?>Solicitar_user">¿Solicitar Usuario?</a>
            </div>
	</div>
    </div>
    </div>
	
     

    <script src="<?php echo base_url();?>assests/js/jquery.min.js"></script>
    
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assests/vendor/sweetalert2/sweetalert2.js"></script>
<!--===============================================================================================-->

	
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assests/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assests/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assests/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url();?>assests/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assests/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url();?>assests/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assests/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
     
</body>

</html>
