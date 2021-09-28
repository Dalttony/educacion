<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Variedades y Comunicaciones |
        
    </title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link href="<?php echo base_url();?>assests/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
       <link href="<?php echo base_url();?>assests/css/stilos.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assests/css/util.css" rel="stylesheet">
    </head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('<?php echo base_url();?>assests/img/fondo.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <h4>
                    <b>Enviar</b>Email!
                </h4>
            <div >
                <img src="<?php echo base_url();?>assests/img/email.png" id ="icon" alt="User Icon" />
            </div>

                     
            <input class="input100" type="text" name="username" placeholder="Escriba el correo" id="txt_email" autocomplete="new-password">
                     
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn" type="submit" onclick="restablecercontra()">
                                Recuperar Contrase&ntilde;a
                            </button>
                        </div>
                    </div><br>
                 <div id="formFooter">
               
                <a class="underlineHover" href="<?php base_url();?>Login">¿Iniciar Sesión?</a>
            </div>
                     
            </div>
        </div>
    </div>

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
    <script src="<?php echo base_url();?>assests/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url();?>assests/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url();?>assests/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url();?>assests/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
   
    <script src="<?php echo base_url();?>assests//js/usuario.js"></script>


    <script src="<?php echo base_url();?>assests/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assests/js/bootstrap.min.js"></script>

  
</body>

</html>
