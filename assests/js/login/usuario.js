function VerificarUsuario(){
    var usu = $("#txt_usu").val();
    var con = $("#txt_con").val();
    let base_url = $("#base_url").val();
    if(usu.length==0 || con.length==0){
        return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");
    }
    $.ajax({
        url: base_url+'verificar-usuario',
        type:'POST',
        data:{
            user:usu,
            pass:con
        }
    }).done(function(resp){
        resp = JSON.parse(resp);
        if(resp.error){
            Swal.fire("Mensaje De Error",'Usuario y/o contrase\u00f1a incorrecta',"error");
        }else{
            if(resp.status ==='INACTIVO'){
                return Swal.fire("Mensaje De Advertencia","Lo sentimos el usuario "+resp.nombre+" se encuentra suspendido, comuniquese con el administrador","warning");
            }
            $.ajax({
                url:'../controlador/usuario/controlador_crear_session.php',
                type:'POST',
                data:{
                    idusuario: data[0][0],
                    user: data[0][1],
                    sexo: data[0][3],
                    email:data[0][6],
                    rol:data[0][7],
                    nombre:data[0][8],
                    cedula:data[0][9],
                    institucion:data[0][10],
                    curso:data[0][11],
                    punto_ex:data[0][12],
                    punto_sem:data[0][13],
                    nivel:data[0][14]  
                }
            }).done(function(resp){
                let timerInterval
                Swal.fire({
                title: 'BIENVENIDO AL SISTEMA',
                html: 'Usted sera redireccionado en <b></b> segundos.',
                timer: 2000,
                timerProgressBar: true,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                    const content = Swal.getContent()
                    if (content) {
                        const b = content.querySelector('b')
                        if (b) {
                        b.textContent = Swal.getTimerLeft()
                        }
                    }
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                }
})
            })
           
        }
    })
}
 
var table;
function listar_usuario(){
    table = $("#tabla_usuario").DataTable({
       "ordering":false,   
       "bLengthChange":false,
       "searching": { "regex": false },
       "lengthMenu": [ [10, 25, 50, 100,10, 25, 50, 100, -1], [10, 25, 50, 100, 10, 25, 50, 100,"All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax":{
           "url":"../controlador/usuario/controlador_usuario_listar.php",
           type:'POST'
       },
       "columns":[
           {"data":"posicion"},
           {"data":"usu_nombre"},
            {"data":"rol_nombre"}, 
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

           {"data":"usu_status",
             
             render: function (data, type, row ) {
               if(data=='ACTIVO'){
                   return "<span class='label label-success'>"+data+"</span>";                   
               }else{
                 return "<span class='label label-danger'>"+data+"</span>";                 
               }
             }
           },  

               
           {"defaultContent":"<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'><i class='fa fa-trash'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success'><i class='fa fa-check'></i></button>&nbsp;<button style='font-size:13px; margin-right:50px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
     
       ],

       "language":idioma_espanol,
       select: true
   });
   document.getElementById("tabla_usuario_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });

}

$('#tabla_usuario').on('click','.activar',function(){
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }
    Swal.fire({
        title: 'Esta seguro de activar al usuario?',
        text: "Una vez hecho esto el usuario  tendra acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value) {
            Modificar_Estatus(data.usu_id,'ACTIVO');
        }
      })
})

$('#tabla_usuario').on('click','.desactivar',function(){
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }
    Swal.fire({
        title: 'Esta seguro de desactivar al usuario?',
        text: "Una vez hecho esto el usuario no tendra acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value) {
            Modificar_Estatus(data.usu_id,'INACTIVO');
        }
      })
})

$('#tabla_usuario').on('click','.editar',function(){
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }
       $("#modal_editar").modal({backdrop:'static',keyboard:false})
       $("#modal_editar").modal('show');
       $("#txtidusuario").val(data.ID).hide();
       $("#txt_usu_editar").val(data.usu_nombre);
       $("#cbm_sexo_editar").val(data.usu_sexo).trigger("changer");
       $("#cbm_rol_editar").val(data.rol_id).trigger("changer");
})

function Modificar_Estatus(idusuario,estatus){
    var mensaje ="";
    if(estatus=='INACTIVO'){
        mensaje="desactivo";
    }else{
        mensaje="activo";
    }
    $.ajax({
        "url":"../controlador/usuario/controlador_modificar_estatus_usuario.php",
        type:'POST',
        data:{
            idusuario:idusuario,
            estatus:estatus
        }
    }).done(function(resp){
        if(resp>0){
            Swal.fire("Mensaje De Confirmacion","El usuario se "+mensaje+" con exito","success")            
            .then ( ( value ) =>  {
                table.ajax.reload();
            }); 
        }
    })


}


function filterGlobal() {
    $('#tabla_usuario').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}


function AbrirModalRegistrousuario(){
    $("#modal_registro").modal({backdrop:'static',keyboard:false})
    $("#modal_registro").modal('show');
}

function listar_combo_rol(){
    $.ajax({
        "url":"../controlador/usuario/controlador_combo_rol_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            for(var i=0; i < data.length; i++){
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $("#cbm_rol").html(cadena);
             $("#cbm_rol_editar").html(cadena);
        }else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
    })
}

function Registrar_Usuario(){
    var usu = $("#txt_usu").val();
    var contra = $("#txt_con1").val();
    var contra2 = $("#txt_con2").val();
    var sexo = $("#cbm_sexo").val();
    var rol = $("#cbm_rol").val();
    var email = $("#txt_email").val();
    var validar_email= $("#validar_email").val(); 
      
 
    if(usu.length==0 || contra.length==0 || contra.length==0 || contra2.length==0 || sexo.length==0 || rol.length==0){
        return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");
    }

    if(contra != contra2){
        return Swal.fire("Mensaje De Advertencia","Las contraseñas deben coincidir","warning");        
    }
  if (validar_email == "incorrecto") {
    return Swal.fire("Mensaje De Advertencia","El formato de Email es incorrecto","warning");        
  }  

    $.ajax({
        "url":"../controlador/usuario/controlador_usuario_registro.php",
        type:'POST',
        data:{
            usuario:usu,
            contrasena:contra,
            sexo:sexo,
            rol:rol,
            email:email
           
          
             
        }
    }).done(function(resp){
      
    if(resp>0){
            if(resp==1){
                $("#modal_registro").modal('hide');
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
function Modificar_Usuario(){
    var idusuario = $("#txtidusuario").val();
    var sexo = $("#cbm_sexo_editar").val();
    var rol = $("#cbm_rol_editar").val();
     var EMaiL = $("#txt_email_editar").val();
    var validar_Email= $("#validar_email_editar").val(); 
      if (idusuario.length==0|| sexo.length ==0) {
        return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");
      }
 
  if (validar_Email == "incorrecto") {
    return Swal.fire("Mensaje De Advertencia","El formato de Email es incorrecto","warning");        
  } 
    $.ajax({
        "url":"../controlador/usuario/controlador_usuario_modificar.php",
        type:'POST',
        data:{
            idusuario:idusuario,
            sexo:sexo,
            rol:rol,
            email:EMaiL
           
          
             
        }
    }).done(function(resp){
        if(resp>0){
         
                $("#modal_editar").modal('hide');
                Swal.fire("Mensaje De Confirmacion","Datos Actualizados Correctamente" , "success")            
                .then ( ( value ) =>  {
               
                    table.ajax.reload();
                }); 
          
        }else{
            Swal.fire("Mensaje De Error","Lo sentimos, no se pudo completar la actualizacion","error");
        }
    })


}

function LimpiarRegistro(){
    $("#txt_usu").val("");
    $("#txt_con1").val("");
    $("#txt_con2").val("");
}

function TraerDatosUsuario(){
var usuarios = $('#usuarioprincipal').val();
$.ajax({
        url:'../controlador/usuario/controlador_traerdatos_usuario.php',
        type:'POST',
        data:{
            usuario:usuarios

        }
      
    }).done(function(resp){

    var data = JSON.parse(resp);
    if(data.length > 0){
        $("#txtcontra_db").val(data[0][2]);
        if( data[0][3]==="M"){
            $('#img_nav').attr("src","../Plantilla/dist/img/avatar5.png");
            $('#img_subnav').attr("src","../Plantilla/dist/img/avatar5.png");
            $('#img_lateral').attr("src","../Plantilla/dist/img/avatar5.png");

        } else{
                         
            $('#img_nav').attr("src","../Plantilla/dist/img/avatar3.png");
            $('#img_subnav').attr("src","../Plantilla/dist/img/avatar3.png");
            $('#img_lateral').attr("src","../Plantilla/dist/img/avatar3.png");

        }

    }
 
    })
}

function Abrir_modal_editar_contra(){

   $("#modal_editar_contra").modal({backdrop:'static',keyboard:false})
    $("#modal_editar_contra").modal('show');
    $("#modal_editar_contra").on('shown.bs.modal',function(){
    $("#txt_con_actual").focus();
        })

}



function Editar_contra(){
    var Idusuario = $("#txtidprincipal").val();
    var contradb = $("#txtcontra_db").val();
    var contraactual = $("#txt_con_actual").val();
    var contranueva = $("#txt_con_nuevo").val();
    var contrarepetir = $("#txt_con_repetir").val();
    if(contraactual.length == 0 || contranueva.length==0 || contrarepetir==0){

        return Swal.fire("Mensaje de Advertencia","llene los campos vacios","warning");
    }
    if(contranueva.length != contrarepetir.length){

    return Swal.fire("Mensaje de Advertencia","la contraseña no coinciden","warning");

    }

    $.ajax({
        "url":"../controlador/usuario/controlador_modificar_contraseña.php",
        type:'POST',
        data:{
            idusuario:Idusuario,
            contradb:contradb,
           contraactual:contraactual,
           contranueva:contranueva
           
          
             
        }
    }).done(function(resp){
        if (resp>0) {
          if(resp==1){
                $("#modal_editar_contra").modal('hide');
                limpiarEditarcontra();
                Swal.fire("Mensaje De Confirmacion","Contrase\u00f1a actualizada correctamente" , "success")            
                .then ( ( value ) =>  {
               
                     TraerDatosUsuario();
                });
          }else{
          Swal.fire("Mensaje de Error" , "la contrase\u00f1a actual no coinciden con su contras\u00f1a antigua" , "error");
          }
        }else{
            Swal.fire("Mensaje de Error" , "no se pudo modificar la contrase\u00f1a" , "error");
        }
    })

}

function limpiarEditarcontra(){
    $("#txt_con_actual").val("");
     $("#txt_con_nuevo").val("");
     $("#txt_con_repetir").val("");
}


function restablecercontra(){
    var email = $("#txt_email").val();
    if(email.length ==0){
            return Swal.fire("Mensaje de Advertencia","Campo vacio Ingrese su Email","warning");
    }
    var caracteres = "abcdefghijkltmnopqrtuvwxyzABCDEFGHIJKLTMNOPQRTUVWXYZ0123456789";
     var contraseña ="";
     for(var i =0;i<6;i++){
       contraseña+=caracteres.charAt(Math.floor(Math.random()*caracteres.length));
     }
   $.ajax({
   url: '../controlador/usuario/controlador_restablecer_contraseña.php',
    type:'POST',
    data:{

   email:email,
        contrasena:contraseña
    }

      

        
   }).done(function(resp){

         if(resp>0){
        if(resp==11){
              Swal.fire("Mensaje de  Confirmaci&#243;n","su contrase&#241;a fue restablecida con exito al correo: "+email+"","success" );
        }
        else{

Swal.fire("Mensaje de  Advertencia","su correo ingresado no se encuentra registrado: "+email+"","warning" );
        }
      
    }else {
         Swal.fire("Mensaje de error","No se pudo restablecer la contrase&#241;a","error");
    }
   })
 

}

function Verificar_usuario(){
    var ver_usu = $("#txt_doc").val();
 
       if(ver_usu.length==0){
        return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");
    }
    $.ajax({
        url:'../controlador/usuario/controlador_Solicitar_usuario.php',
        type:'POST',
        data:{
            usuario:ver_usu
        }
    }).done(function(resp){
        
            var data= JSON.parse(resp);
            if(resp == 0){
               return Swal.fire("Mensaje de  Advertencia","El documento ingresado:"+ver_usu+ " No existe!","warning" );

            }
            $.ajax({
                url:'../controlador/usuario/controlador_crear_session.php',
                type:'POST',
                data:{
                   idusuario:data[0][0],
                    cedula:data[0][1],
                  nombre:data[0][2],
                   user:data[0][3]

                }
            }).done(function(resp){
                let timerInterval
                Swal.fire({
                title: 'Solicitando Usuario',
                html: 'Usted sera redireccionado en <b></b> milisegundos.',
                timer: 2000,
                timerProgressBar: true,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                    const content = Swal.getContent()
                    if (content) {
                        const b = content.querySelector('b')
                        if (b) {
                        b.textContent = Swal.getTimerLeft()
                        }
                    }
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                }
})
            })
           
        
    })
   }

