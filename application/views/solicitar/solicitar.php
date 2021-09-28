<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Solicitud</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="images/taller-jovenes-programadores-1.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assests/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assests/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assests/fonts/iconic/css/material-design-iconic-font.min.css">
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
 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assests/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assests/css/stilos.css">
    </head>

<body>
  <div class="limiter">
        <div class="container-login100" style="background-image: url('<?php echo base_url();?>assests/img/fondo.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <h4>
                    <b>Solicitar</b>Usuario
                </h4>
            <div >
                <img src="<?php echo base_url();?>assests/imagenes/documento (1).png" id ="icon" alt="User Icon" />
            </div>

                     
            <input class="input100" type="text" name="username" placeholder="Nº: Documento" id="txt_doc" autocomplete="new-password">
                     
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <a href="<?php echo base_url();?>Usuarios"><button class="login100-form-btn" type="submit" onclick="Verificar_usuario()">
                                Solicitar
                            </button></a>
                        </div>
                    </div><br>
                 <div id="formFooter">
               
                <a class="underlineHover" href="<<?php  base_url();?>Login">¿Iniciar Sesión?</a>
                    
                   
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
 
    <script src="<?php echo base_url();?>assests/js/jquery-1.11.1.js"></script>
    <script src="../js/usuario.js"></script>

  
</body>
<script>
txt_doc.focus();
</script>
</html>