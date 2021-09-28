var table;
function listar_tabla_clasificacion(){
    table = $("#tabla_clasificacion").DataTable({
       "ordering":false,   
       "bLengthChange":false,
       "searching": { "regex": false },
       "lengthMenu": [ [10, 25, 50, 100,10, 25, 50, 100, -1], [10, 25, 50, 100, 10, 25, 50, 100,"All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax":{
           "url":"../controlador/tabla_clasificacion/controlador_listar_tabla_de_clasificacion.php",
           type:'POST'
       },

       "columns":[
              {"data":"posicion"},
             {"data":"usu_nombre"},
            {"data":"usu_puntos_sem"},  
          {"data":"usu_nivel"}
       
          
         
     
       ],

       "language":idioma_espanol,
       select: true
   });
   document.getElementById("tabla_clasificacion_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });

 tabla_clasificacion.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_clasificacion').DataTable().page.info();
        tabla_clasificacion.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
}

 

function filterGlobal() {
    $('#tabla_clasificacion').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}