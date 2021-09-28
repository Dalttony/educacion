<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Variedades y Comunicaciones |
        
    </title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="<?php echo base_url();?>assests/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="<?php echo base_url();?>assests/css/login.css" rel="stylesheet">
    </head>

<body>
 
    <div class="wrapper1" style="background-image: url('<?php echo base_url();?>assests/img/fondo.jpg');">
        <div id="formContent1">
            <!-- Tabs Titles -->

            <div>
                
            </div>

            <!-- Icon -->
         
            <!-- Login Form -->
            <form method="POST" action="<?php echo base_url();?>assests/login/sendRecoveryCode">
               <div id="main-container">

        <table>
            <thead>
                 <tr >
                    <th></th><th id="user">Usuario</th><th></th><th></th> 
                </tr>
                <tr >
                    <th>Nombre</th>  <th>Apellido</th> <th >Nº Documento</th><th>Usuario</th>
                </tr>
            </thead>

            <tr>
                <td>dino alberto </td><td> palacio pino</td><td>1077466118</td><td>dino</td>
            </tr>
         
        </table>
    </div>
                
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="<?php base_url();?>Login">Volver a iniciar sesión</a>
            </div>

        </div>
    </div>
  

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  
</body>

</html>