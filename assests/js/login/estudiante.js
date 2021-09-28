var table;
function listar_estudiantes(){
    table = $("#tabla_estudiante").DataTable({
       "ordering":false,   
       "bLengthChange":false,
       "searching": { "regex": false },
       "lengthMenu": [ [10, 25, 50, 100,10, 25, 50, 100, -1], [10, 25, 50, 100, 10, 25, 50, 100,"All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax":{
           "url":"../controlador/estudiante/controlador_estudiante_listar.php",
           type:'POST'
       },

       "columns":[
              {"data":"posicion"},
             {"data":"cedula"},
            {"data":"usu_nombre_completo"}, 
               {"data":"usu_sexo",
                render: function (data, type, row ) {
                    if(data=='M'){
                        return "Masculino";                   
                    }else{
                        return "Femenino";                 
                    }
                }
           }, 
          {"data":"usu_email"}, 
          {"data":"nombre"},
          {"data":"grado"},
          {"data":"usu_nombre"},  
          {"data":"usu_puntos_ex"},
          {"data":"usu_puntos_sem"},
          {"data":"usu_nivel"},
               
           {"defaultContent":"<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'><i class='fa fa-trash'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success'><i class='fa fa-check'></i></button>&nbsp;<button style='font-size:13px; margin-right:50px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
     
       ],

       "language":idioma_espanol,
       select: true
   });
   document.getElementById("tabla_estudiante_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });

 tableestudiante.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_estudiante').DataTable().page.info();
        tableestudiante.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
}

$('#tabla_estudiante').on('click','.editar',function(){
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }
       $("#modal_editar_estudiante").modal({backdrop:'static',keyboard:false})
       $("#modal_editar_estudiante").modal('show');
        $("#txtidusuario").val(data.usu_id).hide();
        $("#txt_user_editar").val(data.usu_nombre);
       $("#txt_nombre_editar").val(data.usu_nombre_completo);
        
       
 
       $("#txt_cedula_editar").val(data.cedula);
       $("#comb_editar_inst").val(data.id_institucion);
       $("#comb_editar_grado").val(data.id_grado);
        
       $("#txt_email_editar").val(data.usu_email);

       $("#cbm_sexo_editar").val(data.usu_sexo).trigger("changer");
       $("#cbm_rol_editar").val(data.rol_id).trigger("changer");
         listar_combo_rol();
         listar_combo_grado();
          listar_combo_nombre_institucion();
          $('.js-example-basic-single').select2();
})

function filterGlobal() {
    $('#tabla_estudiante').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}
function AbrirModalRegistro(){
    $("#modal_registro_estudiante").modal({backdrop:'static',keyboard:false})
    $("#modal_registro_estudiante").modal('show');
    listar_combo_rol();
    listar_combo_grado();
     listar_combo_nombre_institucion();
     $('.js-example-basic-single').select2();

     
}
 function modal_editar_estudiante(){

     $("modal_editar_estudiante").modal({backdrop:'static',keyboard:false})
    $("#modal_editar_estudiante").modal('show');
      listar_combo_rol();
    listar_combo_grado();
    listar_combo_nombre_institucion();
       $('.js-example-basic-single').select2();
 }

 function listar_combo_rol(){
    $.ajax({
        "url":"../controlador/estudiante/controlador_listar_combo_rol.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            for(var i=0; i < data.length; i++){
                if(data[i][0]== '2' ){
                     cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
                }
               
            }
            $("#cbm_rol").html(cadena);
            $("#cbm_rol_editar").html(cadena);
              
        }else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>";
              $("#cbm_rol").html(cadena);
            $("#cbm_rol_editar").html(cadena);
        }
    })
}

 function listar_combo_nombre_institucion(){
    $.ajax({
        "url":"../controlador/estudiante/controlador_listar_nombre_instituciones.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            for(var i=0; i < data.length; i++){
              
                     cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
                
               
            }
            $("#comb_inst").html(cadena);
            $("#comb_editar_inst").html(cadena);
              
        }else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>";
             $("#comb_inst").html(cadena);
            $("#comb_editar_inst").html(cadena);
        }
    })
}
 function listar_combo_grado(){
    $.ajax({
        "url":"../controlador/estudiante/controlador_listar_combo_grado.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            for(var i=0; i < data.length; i++){
               
                     cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
                
               
            }
            $("#comb_grado").html(cadena);
            $("#comb_editar_grado").html(cadena);
              
        }else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>";
              $("#comb_grado").html(cadena);
           $("#comb_editar_grado").html(cadena);
        }
    })
}
function Registrar_Estudiante(){
    var nom = $("#txt_nombre").val();
    var cedula = $("#txt_cedula").val();  
    var sexo = $("#cbm_sexo").val();
    var nom_int = $("#comb_inst").val();
    var curso = $("#comb_grado").val();
    var user = $("#txt_user").val();
    var contra = $("#txt_con").val();
    var rol = $("#cbm_rol").val();
    var email = $("#txt_email").val();
    var validar_email= $("#validar_email").val();

    if(nom.length==0  ||  cedula.length==0 || nom_int.length==0||  email.length==0 || user.length==0 || contra.length==0 ||  sexo.length==0 || rol.length==0){
        return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");
    }
    
   if (validar_email == "incorrecto") {
    return Swal.fire("Mensaje De Advertencia","El formato de Email es incorrecto","warning");        
  }  

    $.ajax({
        "url":"../controlador/estudiante/controlador_estudiante_registro.php",
        type:'POST',
        data:{
            user:user,
            contra:contra,
            sexo:sexo,
            rol:rol,  
            email:email,
            nom:nom,
            cedula:cedula,
            nom_int:nom_int,
            curso:curso
           
            
            
          
           
           
          
             
        }
    }).done(function(resp){
          if(resp>0){
            if(resp==1){
                $("#modal_registro_estudiante").modal('hide');
                Swal.fire("Mensaje De Confirmacion","Datos correctamente, Nuevo Usuario Registrado","success")            
                .then ( ( value ) =>  {
                    LimpiarRegistro();
                    table.ajax.reload();
                }); 
            }else{
                return Swal.fire("Mensaje De Advertencia","Lo sentimos, el nombre del usuario ya se encuentra en nuestra base de datos","warning");
            }
        }else{
            Swal.fire("Mensaje De Error","Lo sentimos, no se pudo completar el registro","error");
        }

    }) 

}


function Editar_Estudiante(){
    var idusuario = $("#txtidusuario").val();
    var sexo = $("#cbm_sexo_editar").val(); 
     var email = $("#txt_email_editar").val();
     var rol = $("#cbm_rol_editar").val();
    var nom = $("#txt_nombre_editar").val();
    var cedula = $("#txt_cedula_editar").val(); 
    var institucion = $("#comb_editar_inst").val();
    var curso = $("#comb_editar_grado").val();
   

    if (idusuario.length==0|| sexo.length ==0) {
        return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");
      }
    
 

    $.ajax({
        "url":"../controlador/estudiante/controlador_estudiante_editar.php",
        type:'POST',
        data:{
        idusuario:idusuario,
        sexo:sexo,
        rol:rol,
        email:email,
        nombre:nom,
        cedula:cedula,         
        nom_int:institucion,
        curso:curso
            
          
           
           
          
             
        }
    }).done(function(resp){
          if(resp>0){
         
                $("#modal_editar_estudiante").modal('hide');
                
                Swal.fire("Mensaje De Confirmacion","Datos Actualizados Correctamente" , "success")            
                .then ( ( value ) =>  {
               
                    table.ajax.reload();
                }); 
          
        }else{
            Swal.fire("Mensaje De Error","Lo sentimos, no se pudo completar la actualizacion","error");
        }
       
        
    }) 

}
function SoloNumeros() {
 if ((event.keyCode < 48) || (event.keyCode > 57)) {

    event.returnValue = false;
   $(this).css("border","1px solid red");
        $("#cursoval").html("Solo Numeros");
        $("#validar_curso").val("incorrecto");
 }
else{
      
          $(this).css("border","1px solid green");
   $("#cursoval").html("");
    $("#validar_curso").val("correcto");
   }
  
 
 }

function solotextos() {
 if ((event.keyCode != 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122)){

      event.returnValue = false;
  teclado = String.fromCharCode(key).toLocaleLowerCase();
      teclado_especial = false;
  
 $(this).css("border","1px solid red");
        $("#cursoval").html("Solo Letras");
        $("#validar_curso").val("incorrecto");
    

   }else if (event.indexOf(teclado) == -1 && !teclado_especial){
     return false; 
   }


   else{
      
          $(this).css("border","1px solid green");
   $("#cursoval").html("");
    $("#validar_curso").val("correcto");
   }
}
 

 