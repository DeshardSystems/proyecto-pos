<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Registrar Pago Venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Registrar Pago Venta</li>
    
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
          
              <!--=====================================
              REGISTRAR NUEVO PAGO
              ======================================-->

                <div class="col-xs-12 pull-left">
                  
                  <table class="table">

                    <thead>

                      <tr>
                        <th>Anticipo</th>
                        <th>Adeudo</th>
                        <th>Pago</th> 
                        <th>Registrar</th>   
                      </tr>

                    </thead>

                    <tbody>

                      <tr>

                         <td style="width: 25%">
                          
                          <div class="input-group">
                         
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                            <input type="text" class="form-control input-sm" id = "anticipo" name="anticipo" total="" placeholder="00000" readonly value="<?php echo $venta["anticipo"]; ?>"> 
                     
                          </div>

                        </td>                      
                      
                        <td style="width: 25%">
                          
                          <div class="input-group">
                         
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                            <input type="text" class="form-control input-sm" id = "adeudo_" name="adeudo_" total="" placeholder="00000" readonly value="<?php echo $venta["adeudo"]; ?>"> 
                     
                          </div>

                        </td>

                         <td style="width: 25%">
                          
                          <div class="input-group">
                         
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                            <input type="text" class="form-control input-sm" id = "registro_pago" name="registro_pago" placeholder="0" required>                             
                            <input type="hidden" name="nuevo_adeudo" id="nuevo_adeudo"> 
                     
                          </div>

                        </td>

                          <td style="width: 25%">

                            <!-- <button type="submit" class="btn btn-primary pull-right">Guardar venta</button> -->

                            <button type="submit" class="btn btn-primary nuevo_Pago">Registrar pago</button>
              
                          </td>

                      </tr>

                    </tbody>

                  </table>

                </div>

                <!-- ________fin de registro nuevo pago______________--- -->
            </div>

            <?php

              $registrarPago = new ControladorVentas();
              $registrarPago -> ctrRegistrarPago();

            ?>

          </form>

        </div>
            
      </div>          

    </div>
   
  </section>

</div>


