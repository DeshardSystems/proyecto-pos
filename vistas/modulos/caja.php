<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Caja
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar caja</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <?php

          // Cargar valores actuales de caja total

          $item = "id";
          $valor = "1";

          $registro_caja = ControladorCaja::ctrMostrarRegistroCaja($item, $valor);

        ?>
      
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarOperacion">
          
          Agregar Operación

        </button>

        <input type="text" class="input-sm pull-right" value="En Caja: $<?php echo $registro_caja["en_caja"]; ?>" readonly >


      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Id</th>
           <th>Usuario</th>
           <th>Fecha</th>
           <th>Nota/Factura</th>
           <th>Descripción</th>
           <th>Ingreso/Egreso</th>
           <th>Monto</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          // Cargar ultimos movimientos de caja

          $item = null;
          $valor = null;

          $caja = ControladorCaja::ctrMostrarCaja($item, $valor);

         foreach ($caja as $key => $value){
           
            echo ' <tr>
            <td>'.($key+1).'</td>
            <td>'.$value["id"].'</td>
            <td>'.$value["usuario"].'</td>
            <td>'.$value["fecha"].'</td>
            <td>'.$value["nota_factura"].'</td>
            <td>'.$value["descripcion"].'</td>
            <td>'.$value["ingreso_egreso"].'</td>
            <td>'.$value["monto"].'</td>';
          }

        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR OPERACION
======================================-->

<div id="modalAgregarOperacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" class="formularioCaja">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Operación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--=====================================
            ENTRADA DEL USUARIO
            ======================================-->
        
            <div class="form-group">
            
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control" name="nombreVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                <input type="hidden" name="idVendedor_" value="<?php echo $_SESSION["id"]; ?>">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR INGRESO O EGRESO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-sign-out"></i></span> 

                <select class="form-control input-lg" name="ingreso_egreso_" id="ingreso_egreso" required>
                  
                  <option value="Ingreso">Ingreso</option>

                  <option value="Egreso">Egreso</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA LA REFERENCIA NOTA O FACTURA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-shield"></i></span> 

                <input type="text" class="form-control input-lg" name="nota_factura_" id="nota_factura" placeholder="Numero de nota, factura o referencia que respalde la operación" required>

              </div>

            </div>

            <!-- ENTRADA PARA DESCRIPCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-comments-o"></i></span> 

                <input type="text" class="form-control input-lg" name="descripcion_" placeholder="Descripción de la operación" required>

              </div>

            </div>

            <div class="form-group">
            
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

                <input type="number" class="form-control input-lg" id="monto" name="monto_" step=".01" required placeholder="Cantidad">
                
                <input type="hidden" name="viejaCaja" id="viejaCaja" value="<?php echo $registro_caja["en_caja"]; ?>">
                
                <input type="hidden" class="form-control input-lg" name="nuevaCaja" id="nuevaCaja" >
              
              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

          <button type="button" class="btn btn-primary generarCaja" >Generar</button>
               
          <button type="submit" class="btn btn-primary hidden guardarCaja" >Guardar venta</button>

        </div>

        <?php

          $crearCaja = new ControladorCaja();
          $crearCaja -> ctrCrearCaja();

        ?>

      </form>

    </div>

  </div>

</div>
