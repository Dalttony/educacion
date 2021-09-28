<script type="text/javascript" src="../js/tabla_clasificacion.js?rev=<?php echo time();?>"></script>
<link rel="stylesheet" href="style.css">
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">BIENVENIDO AL CONTENIDO DE TABLA DE CLASIFICACION</h3>

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
               
            </div>
             <!-- /.tabla usuario -->
            <table id="tabla_clasificacion" class="display responsive nowrap" style="width:100% ">
                <thead >
                    <tr >
                        <th>Puesto</th>                    
                        <th>Usuario</th>
                        <th >Puntos</th>
                        <th>Nivel</th>
                         
                    

                    </tr>
                </thead>
                <tfoot>
                         <th>Puesto</th>                     
                        <th>Usuario</th>
                        <th>Puntos</th>
                        <th>Nivel</th>
                     

                    </tr>
                </tfoot>
            </table>
            </div>
            <!-- /.box-body -->
    </div>
          <!-- /.box -->
</div>
 
<script>
$(document).ready(function() {
 listar_tabla_clasificacion();
   
    
} );
 
$('.box').boxWidget({
    animationSpeed : 500,
    collapseTrigger:    '[data-widget="collapse"]',
    removeTrigger  :    '[data-widget="remove"]',
    collapseIcon   :    'fa-minus',
    expandIcon     :    'fa-plus',
    removeIcon     :    'fa-times'
})
</script>
