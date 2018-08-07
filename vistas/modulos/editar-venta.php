<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Mostrar venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Editar venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

                <?php

                    $item = "id";
                    $valor = $_GET["idVenta"];

                    $venta = ControladorVentas::ctrMostrarVentas($item, $valor);

                    $itemUsuario = "id";
                    $valorUsuario = $venta["id_vendedor"];
                    $valorResponsable = $venta["responsable"];

                    $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);
                    $responsable = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorResponsable);

                    $itemCliente = "id";
                    $valorCliente = $venta["id_cliente"];

                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    $porcentajeImpuesto = $venta["impuesto"] * 100 / $venta["neto"] ;

                ?>


               <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]; ?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                   <input type="text" class="form-control" id="editarVenta" name="editarVenta" value="<?php echo $venta["codigo"]; ?>" readonly>
               
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                    <option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>

                    </select>
                    
                  </div>
                
                </div>

                <hr>
                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                <?php

                $listaProducto = json_decode($venta["productos"], true);

                foreach ($listaProducto as $key => $value) {

                  $item = "id";
                  $valor = $value["id"];
                  $orden = "id";

                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                  $stockAntiguo = $respuesta["stock"] + $value["cantidad"];
                  
                  echo '<div class="row" style="padding:5px 15px">
            
                        <div class="col-xs-6" style="padding-right:0px">
            
                          <div class="input-group">
                
                            <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs" ><i class="fa fa-times"></i></button></span>

                            <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>

                          </div>

                        </div>

                        <div class="col-xs-3">
              
                          <input readonly type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>

                        </div>

                        <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">

                          <div class="input-group">

                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                   
                            <input type="text" class="form-control nuevoPrecioProducto" precioReal="'.$respuesta["precio_venta"].'" name="nuevoPrecioProducto" value="'.$value["total"].'" readonly required>
   
                          </div>
               
                        </div>

                      </div>';
                }


                ?>

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg">Agregar producto</button>

                 <!-- FECHA, ACABADOS Y TEXTO -->
                <hr>
                <div class=" col-xs-12 center-block">
                  
                  <table class="table">

                    <thead>

                      <tr>
                        
                        <th>Tipo de Trabajo</th>
                        <th>Fecha de entrega</th>
                        <th>Acabado del trabajo</th>
                        
                      </tr>  
                        
                    </thead>  

                    <tbody>
                      <tr>
                        <!-- ordinario /urgente -->
                        <td style="width: 33%"> 
                          <div> 
                          <!-- <input name="radio" id="radio" type="radio" value="1" /></td>                          -->
                          <input readonly type="text" class="form-control" name="entrega_" id="entrega_" value="<?php 
                          if($venta["entrega"] == "0") {echo "ORDINARIO";}
                          elseif ($venta["entrega"] == "1") {echo "DIA SIGUIENTE";}
                          elseif ($venta["entrega"] == "2") {echo "URGENTE";}?>" > 
                          <br>
                          </div> 
                        </td>                            
                          <!-- fecha de entrega -->
                        <td style="width: 33%"> 
                          <input readonly type="text" class="form-control col-xs-12 center-block" id="datepicker" name="fechaEntrega" value="<?php echo $venta["fecha_entrega"]; ?>"
                        </td>
                          <!-- acabado del trabajo -->
                        <td style="width: 33%"> 
                          <div>                             
                          <input readonly type="text" class="form-control" name="acabado_" id="acabado_" value="<?php 
                          if($venta["acabado"] == "0") {echo "BRUTO";}
                          elseif ($venta["acabado"] == "1") {echo "LIMPIO";}
                          elseif ($venta["acabado"] == "2") {echo "TERMINADO";}?>" >  
                          </div> 
                        </td>                       
                      </tr>
                    </tbody>
                  </table>
                </div>
                <label>Detalles</label>
                <input type="text" class="form-control" rows="3" placeholder="Observaciónes de Venta" name="nota_venta" id="nota_venta" value="<?php echo $venta["nota_venta"]; ?>" readonly ></input>
                <hr>
                <!-- FIN FECHA , ACABADO Y CAJA DE TEXTO -->

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-12 pull-left">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Descuento</th>
                          <th>IVA</th>
                          <th>Total</th>   
                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                           <td style="width: 30%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-sm" id = "descuento" name="descuento" total="" placeholder="00000" readonly value="<?php echo $venta["descuento"]; ?>"> 
                       
                            </div>

                          </td>                      
                        
                          <td style="width: 20%">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control iinput-sm" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="<?php echo $porcentajeImpuesto; ?>" readonly>

                               <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value="<?php echo $venta["impuesto"]; ?>" required>

                               <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["neto"]; ?>" required>

                              <!-- <span class="input-group-addon"><i class="fa fa-percent"></i></span> -->
                        
                            </div>

                          </td>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-sm" id="nuevoTotalVenta" name="nuevoTotalVenta" total="<?php echo $venta["neto"]; ?>"  value="<?php echo $venta["total"]; ?>" readonly>

                              <input type="hidden" name="totalVenta" value="<?php echo $venta["total"]; ?>" id="totalVenta">
                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <label>Metodo de pago: .<?php echo $venta["metodo_pago"]; ?></label>

                <br>
      
              </div>
          
                <!-- PAGOS Y GENERAR VENTA -->
                <table class="table">

                  <td style="width: 33%"> 
                    <div class="input-group">
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input type="text" class="form-control input-sm col-xs-12 center-block" border = "1" id="anticipo" name = "anticipo" placeholder="Anticipo" value="<?php echo $venta["anticipo"]; ?>" readonly>
                    </div>
                  </td>
                  <td style="width: 33%"> 
                    <div class="input-group">
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input type="text" class="form-control input-sm col-xs-12 center-block" border = "1" id="restante" name = "restante" placeholder="Restante" readonly >
                    </div> 
                  </td>

                </table>
                <!-- FIN PAGOS Y GENERAR VENTA -->

                <!-- ORDEN DE PRODUCCION  -->
                <hr>
                <h3> Orden de producción o venta de almacen</h3> 

                <hr>

                <?php 
                if($venta["laser_corte"] == "1") {echo '<h4>Corte Laser_ </h4>';}
                if($venta["laser_grabado"] == "1") {echo '<h4>Grabado Laser</h4><br>';}
                if($venta["laser_detalles"] != "") {echo '<label>'.$venta["laser_detalles"].'</label><br>';}?> 
                <hr>

                <?php 
                if($venta["plasma_corte"] == "1") {echo '<h4>Corte Plasma </h4><br>';}
                if($venta["laser_detalles"] != "") {echo '<label>'.$venta["plasma_detalles"].'</label><br>';}?>     
                <hr>  

                <?php 
                if($venta["router_corte"] == "1") {echo '<h4>Corte Router_ </h4>';}
                if($venta["router_grabado"] == "1") {echo '<h4>Grabado Router_</h4>';}
                if($venta["router_tallado"] == "1") {echo '<h4>Tallado Router_</h4>';}
                if($venta["router_diamante"] == "1") {echo '<h4>Diamante Router</h4><br>';}
                if($venta["router_detalles"] != "") {echo '<label>'.$venta["router_detalles"].'</label><br>';}?>             
                <hr>

                <?php 
                if($venta["serv_prod"] == "1") {echo '<h4>Servicio o Producto </h4><br>';}
                if($venta["servicio_detalles"] != "") {echo '<label>'.$venta["servicio_detalles"].'</label><br>';}?>         
                <hr>  

                <?php 
                if($venta["material"] == "0") {echo '<h4>Material aportado por el Cliente_</h4>';}
                if($venta["material"] == "1") {echo '<h4>Material aportado por la Empresa</h4><br>';}
                if($venta["material_detalles"] != "") {echo '<label>'.$venta["material_detalles"].'</label><br>';}?>         
                <hr>
                
                <h4> Observaciones de produccion</h4>
                <?php if($venta["nota_produccion"] != "") {echo '<label>'.$venta["nota_produccion"].'</label><br>';}?>

                <h4> Orden asignada a:</h4>
                <?php if($venta["nota_produccion"] != "") {echo '<label>'.$responsable["nombre"].'</label><br>';}?>

                <h4>Progreso:</h4>

                <input type="hidden" name="progreso" id="progreso" value="progreso">

                <?php echo '<label>'.$venta["progreso"].' % </label><br>';?>  

            </div>

          </form>

        </div>
            
      </div>          

    </div>
   
  </section>

</div>


