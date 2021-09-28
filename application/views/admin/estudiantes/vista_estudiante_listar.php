<script type="text/javascript" src="../js/estudiante.js?rev=<?php echo time();?>"></script>
 
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="../Plantilla/plugins/select2/select2.min.css">
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">BIENVENIDO AL CONTENIDO DE ESTUDIANTES</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
              <!-- /.box-tools -->
        </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="form-group">
                <div class="col-lg-10">
                    <div class="input-group">
                        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-danger" style="width:100%" onclick="AbrirModalRegistro()"><i class="glyphicon glyphicon-plus"></i>Nuevo Registro</button>
                </div>
            </div>
             <!-- /.tabla usuario -->
            <table id="tabla_estudiante" class="display responsive nowrap" style="width:100% ">
                <thead >
                    <tr >
                        <th>#</th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Sexo</th> 
                        <th>Email</th>                         
                        <th>Institucion</th>
                        <th>Grado</th>
                        <th>usuario</th>
                        <th>Puntos de Exp</th>
                        <th>Puntos semanales</th>
                         <th>nivel</th>
                        <th>Acci&oacute;n</th>

                    </tr>
                </thead>
                <tfoot>
                        <th>#</th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Sexo</th>
                        <th>Email</th>                         
                        <th>Institucion</th>
                       <th>Grado</th>
                        <th>usuario</th>
                        <th>Puntos de Exp</th>
                        <th>Puntos semanales </th>
                        <th>nivel</th>
                        <th>Acci&oacute;n</th>

                    </tr>
                </tfoot>
            </table>
            </div>
            <!-- /.box-body -->
    </div>
          <!-- /.box -->
</div>
 <form autocomplete="false" onsubmit="return false" id="modal1">
    <div class="modal fade" id="modal_registro_estudiante" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="text-align: center;"><b>Registrar Estudiante</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
               <div class="col-lg-12">
                    <label for="">Nombre Completo</label>
                    <input type="text" class="form-control" id="txt_nombre" id="bloquear" placeholder="Ingrese Nombre Completo" onkeypress="solotextos(); "   ><br>
                     
                </div> 
                   <div class="col-lg-6">
                    
                    <label for="">Cedula</label>
                    <input type="text" class="form-control" id="txt_cedula" placeholder="Ingrese la Cedula" onkeypress="SoloNumeros();"><br>

                </div>
               
                    <div class="col-lg-6">
                    <label for="">Sexo</label>
                    <select class="js-example-basic-single" name="state" id="cbm_sexo" style="width:100%;  ">
                        <option value="M">MASCULINO</option>
                        <option value="F">FEMENINO</option>
                    </select><br><br>
                </div> 
                <div class="col-lg-6">
                    <label for="">Institucion</label>
                    <select class="js-example-basic-single" name="state"id="comb_inst"  style="width:100%; height: 35px;">
                        
                    </select><br><br>
                </div>
                  <div class="col-lg-6" style="margin-top: -73px;">
                    <label for="">Grado</label>
                    <select class="js-example-basic-single" name="state"id="comb_grado"  style="width:100%; height: 35px;">
                        
                    </select><br><br>
                </div>
                
                 <div class="col-lg-12" style="text-align: center;">
                     
                     <b >DATOS DEL USUARIO</b><br><br>
                 </div>
                 <div class="col-lg-4">
                    <label for="">Usuario</label>
                    <input type="text" class="form-control" id="txt_user" placeholder="Ingrese el Usario"><br>
                </div>
                    <div class="col-lg-4">
                    <label for="">Contrase&ntilde;a</label>
                    <input type="password" class="form-control" id="txt_con" placeholder="Ingrese la Contraseña"><br>
                </div>
                 <div class="col-lg-4">
                    <label for="">Rol</label>
                    <select class="js-example-basic-single" name="state" id="cbm_rol" style="width:100%; height: 35px;">
                        
                    </select><br><br>
                </div>
                <div class="col-lg-12">
                 <label for="">Email</label>
                    <input type="text" class="form-control" id="txt_email" placeholder="Ingrese Email"> 
                    <label for="" id="emailval" style="color: red;"></label>
                    <input type="text" id="validar_email" hidden>
                </div>

                  </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="Registrar_Estudiante()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
 </form>

                 
<!-- modar para editar usuarios -->
<form autocomplete="false" onsubmit="return false" id="modal1">
    <div class="modal fade" id="modal_editar_estudiante" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Modificar Usuario</b></h4>
            </div>
           
            <div class="modal-body">
                 <div class="row">
               <div class="col-lg-12">
                 
                    <label for="">Nombre Completo</label>
                    <input type="text" class="form-control" id="txt_nombre_editar" id="bloquear" placeholder="Ingrese Nombre Completo" onkeypress="solotextos(); "   ><br>
                     
                </div> 
                   <div class="col-lg-6">
                     <label for="">Cedula</label>
                    <input type="text" class="form-control" id="txt_cedula_editar" placeholder="Ingrese la Cedula" onkeypress="SoloNumeros();"><br>
                    
                                         

                </div>
               
                    <div class="col-lg-6">
                    <label for="">Sexo</label>
                    <select class="js-example-basic-single" name="state" id="cbm_sexo_editar" style="width:100%;  ">
                        <option value="M">MASCULINO</option>
                        <option value="F">FEMENINO</option>
                    </select><br><br>
                </div> 
               
              
               
                 <div class="col-lg-6">
                    <label for="">Institucion</label>
                    <select class="js-example-basic-single" name="state"id="comb_editar_inst"  style="width:100%; height: 35px;">
                        
                    </select><br><br>
                </div>
                  <div class="col-lg-6" style="margin-top: -73px;">
                    <label for="">Grado</label>
                    <select class="js-example-basic-single" name="state"id="comb_editar_grado"  style="width:100%; height: 35px;">
                        
                    </select><br><br>
                </div>
                
                 <div class="col-lg-12" style="text-align: center;">
                     
                     <b >DATOS DEL USUARIO</b><br><br>
                 </div>
                 <div class="col-lg-6">
                   
                    <label for="">Usuario</label>
                    <input type="text" id="txtidusuario">
                    <input type="text" class="form-control" id="txt_user_editar" placeholder="Ingrese el Usario" disabled><br>

                </div>
              
                 <div class="col-lg-6">
                    <label for="">Rol</label>
                    <select class="js-example-basic-single" name="state" id="cbm_rol_editar" style="width:100%; height: 35px;" disabled>
                        
                    </select><br><br>
                </div>
                <div class="col-lg-12">
                

                   <label for="">Email</label>
                    <input type="text" class="form-control" id="txt_email_editar" placeholder="Ingrese Email"> 

                    
                  
                    <label for="" id="emailval_editar" style="color: red;"></label>
                    <input type="text" id="validar_email_editar" hidden>
                </div>

           </div>
     
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="Editar_Estudiante()"><i class="fa fa-check"><b>&nbsp;Modificar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>
<script src="../Plantilla/plugins/select2/select2.min.js"></script>
<script>
$(document).ready(function() {
    listar_estudiantes();
     $('.js-example-basic-single').select2();
    listar_combo_rol();
    listar_combo_grado();
     listar_combo_nombre_institucion();
    $("#modal_registro").on('shown.bs.modal',function(){
        $("#txt_usu").focus();  
    })
} );
document.getElementById('txt_email').addEventListener('input' , function(){
   campo=event.target;
   email = /^[-\w.%+]{1,64}@(?:[A-Z0-9]{1,63}\.){1,125}[A-Z]{2,63}$/i; //formato Gmail
   if (email.test(campo.value)) {
   $(this).css("border","");
   $("#emailval").html("");
    $("#validar_email").val("correcto");

   }else{
       $(this).css("border","1px solid red");
        $("#emailval").html("Email incorrecto");
        $("#validar_email").val("incorrecto");
   }
});

document.getElementById('txt_email_editar_nuevo').addEventListener('input' , function(){
   campo=event.target;
   email = /^[-\w.%+]{1,64}@(?:[A-Z0-9]{1,63}\.){1,125}[A-Z]{2,63}$/i; //formato Gmail
   if (email.test(campo.value)) {
   $(this).css("border","");
   $("#emailval_editar").html("");
    $("#validar_email_editar").val("correcto");

   }else{
       $(this).css("border","1px solid red");
        $("#emailval_editar").html("Email incorrecto");
        $("#validar_email_editar").val("incorrecto");
   }
});
$('.box').boxWidget({
    animationSpeed : 500,
    collapseTrigger:    '[data-widget="collapse"]',
    removeTrigger  :    '[data-widget="remove"]',
    collapseIcon   :    'fa-minus',
    expandIcon     :    'fa-plus',
    removeIcon     :    'fa-times'
})
 $(document).ready(function(){
  $("#txt_nombre ").on('paste', function(e){
    e.preventDefault();
    Swal.fire("Mensaje De Advertencia","Esta acción está prohibida","warning");
  })
  
  $("#txt_nombre").on('copy', function(e){
    e.preventDefault();
    Swal.fire("Mensaje De Advertencia","Esta acción está prohibida","warning");
     
  })
   $("#txt_cedula").on('paste', function(e){
    e.preventDefault();
    Swal.fire("Mensaje De Advertencia","Esta acción está prohibida","warning");
  })
  
  $("#txt_cedula").on('copy', function(e){
    e.preventDefault();
    Swal.fire("Mensaje De Advertencia","Esta acción está prohibida","warning");
     
  })
})
</script>
