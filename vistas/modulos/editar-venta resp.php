<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Editar venta
    
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

                    // ----------------------------------------------------------------
                    // ESTA PENDIENTE CARGAR LOS VALORES DE LOS RADIO Y DE LOS CHECK
                    // ----------------------------------------------------------------

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
                    
                    <select class="js-example-basic-single form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                    <option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>

                    <?php

                      $item = null;
                      $valor = null;

                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($categorias as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                       }

                    ?>

                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                  
                  </div>
                
                </div>


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
                
                            <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                            <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>

                          </div>

                        </div>

                        <div class="col-xs-3">
              
                          <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>

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

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

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
                        <td style="width: 30%"> 
                          <div> 
                          <!-- <input name="radio" id="radio" type="radio" value="1" /></td>                          -->
                          <input type="radio" checked class="flat-red" name="entrega_" id="ordinario" > <label>Ordinario</label>
                          <br>
                          <input type="radio" class="flat-red" name="entrega_"id="dia_siguiente"> <label>Dia Siguiente</label>
                          <br>
                          <input type="radio" class="flat-red" name="entrega_"id="urgente"> <label>Urgente</label>
                          <input type="hidden" name="entrega" id="entrega">
                          </div> 
                        </td>                            
                          <!-- fecha de entrega -->
                        <td style="width: 30%"> 
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input type="text" class="datepicker col-xs-12 center-block" id="datepicker" name="fechaEntrega" value="<?php echo $venta["fecha_entrega"]; ?>" data-date-format="yyyy-mm-dd">
                        </td>
                          <!-- acabado del trabajo -->
                        <td style="width: 40%"> 
                          <div>                             
                          <input type="radio" checked class="flat-red" name ="acabado_" id="bruto"> <label>Bruto</label>
                          <br>
                          <input type="radio" class="flat-red "name ="acabado_" id="limpio"> <label>Limpio</label>
                          <br>
                          <input type="radio" class="flat-red "name ="acabado_" id="terminado"> <label>Terminado</label>
                          <input type="hidden" name="acabado" id="acabado">
                          </div> 
                        </td>                       
                      </tr>
                    </tbody>
                  </table>
                </div>
                <input type="text" class="form-control" rows="3" placeholder="Observaciónes de Venta" name="nota_venta" id="nota_venta" value="<?php echo $venta["nota_venta"]; ?>" required ></input>
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

                              <input type="text" class="form-control input-lg" id = "descuento" name="descuento" total="" placeholder="00000" value="<?php echo $venta["descuento"]; ?>"> 
                       
                            </div>

                          </td>                      
                        
                          <td style="width: 20%">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="<?php echo $porcentajeImpuesto; ?>" required>

                               <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value="<?php echo $venta["impuesto"]; ?>" required>

                               <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["neto"]; ?>" required>

                              <!-- <span class="input-group-addon"><i class="fa fa-percent"></i></span> -->
                        
                            </div>

                          </td>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="<?php echo $venta["neto"]; ?>"  value="<?php echo $venta["total"]; ?>" readonly required>

                              <input type="hidden" name="totalVenta" value="<?php echo $venta["total"]; ?>" id="totalVenta">
                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">
                  
                  <div class="col-xs-6" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>                  
                      </select>    

                    </div>

                  </div>

                  <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>

                <br>
      
              </div>

          
                <!-- PAGOS Y GENERAR VENTA -->
                <table class="table">

                  <td style="width: 33%"> 
                    <div class="input-group">
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input type="text" class="input-sm col-xs-12 center-block" border = "1" id="anticipo" name = "anticipo" placeholder="Anticipo" value="<?php echo $venta["anticipo"]; ?>" required>
                  </div>
                  </td>
                  <td style="width: 33%"> 
                    <div class="input-group">
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input type="text" class="input-sm col-xs-12 center-block" border = "1" id="restante" name = "restante" placeholder="Restante" readonly >
                    </div> 
                  </td>
                  <td style="width: 34%">
                    <input type="button" class="btn btn-primary center-block" id="boton" value="Guardar venta">                 
                    <button type="submit" class="btn btn-primary hidden guardar" id= "guardar" >Guardar venta</button>
                  </td>

                </table>
                <!-- FIN PAGOS Y GENERAR VENTA -->

                <!-- ORDEN DE PRODUCCION  -->
                <hr>
                <hr>
                <h3> Orden de producción o venta de almacen</h3>                
            
                <label><input type="checkbox" class="flat-red"> LASER</label> 
                <label><input type="checkbox" class="minimal laser_corte_" name ="laser_corte_" id= "laser_corte_"> corte</label> 
                <label><input type="checkbox" class="minimal laser_grabado_"> grabado</label>
                <input type="hidden" name="laser_corte" id="laser_corte"> 
                <input type="hidden" name="laser_grabado" id="laser_grabado">
                <input type="text" class="form-control" rows="2" placeholder="Detalles" name="laser_detalles" value="<?php echo $venta["laser_detalles"]; ?>"></input>

                <hr>            
    
                <label><input type="checkbox" class="flat-red plasma"> PLASMA</label> 
                <input type="hidden" name="plasma_corte" id="plasma_corte"> 
                <input type="text" class="form-control" rows="2" placeholder="Detalles" name="plasma_detalles" value="<?php echo $venta["plasma_detalles"]; ?>"></input> 

                <hr>            
    
                <label><input type="checkbox" class="flat-red"> ROUTER</label> 
                <label><input type="checkbox" class="minimal router_corte_"> Corte </label> 
                <label><input type="checkbox" class="minimal router_grabado_"> Grabado / Vector </label> 
                <label><input type="checkbox" class="minimal router_tallado_"> Tallado B-bit </label>
                <label><input type="checkbox" class="minimal router_diamante_"> Punta Diamante </label>
                <input type="hidden" name="router_corte"    id="router_corte">  
                <input type="hidden" name="router_grabado"  id="router_grabado"> 
                <input type="hidden" name="router_tallado"  id="router_tallado"> 
                <input type="hidden" name="router_diamante" id="router_diamante"> 
                <input type="text" class="form-control" rows="2" placeholder="Detalles" name="router_detalles" value="<?php echo $venta["router_detalles"]; ?>"></input>

                <hr>

                <label><input type="checkbox" class="flat-red serv_prod_"> SERVICIO / PRODUCTO</label> 
                <input type="hidden" name="serv_prod" id="serv_prod">
                <input type="text" class="form-control" rows="2" placeholder="Detalles" name="servicio_detalles" value="<?php echo $venta["servicio_detalles"]; ?>"></input>

                <hr>

                <label>Material aportado por....</label>
                <label><input type="radio" checked class="flat-red" name="material_" id="el_cliente">El Cliente</label> 
                <label><input type="radio" class="flat-red" name="material_" id="la_empresa">La Empresa</label>
                <input type="hidden" name="material" id="material">  
                <input type="text" class="form-control" rows="2" placeholder="Detalles" name="material_detalles" value="<?php echo $venta["material_detalles"]; ?>"></input>
                
                <hr>
                 
                <h4> OBSERVACIONES</h4>
              
                <input type="text" class="form-control" rows="3" placeholder="Observaciónes de Producción" name="nota_produccion" required value="<?php echo $venta["nota_produccion"]; ?>" ></input>

                <!--=====================================
                ASIGNAR ORDEN A:
                ======================================--> 
                <hr>
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $responsable["nombre"]; ?>" readonly>

                    <input type="hidden" name="responsable" value="<?php echo $venta["responsable"]; ?>">

                  </div>

                </div> 

                <hr>
                <!-- <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarArchivos" data-dismiss="modal">Agregar Archivo</button> -->
                <input type="hidden" name="progreso" id="progreso ">  

            </div>

                
          <?php

            $guardarVenta = new ControladorVentas();
            $guardarVenta -> ctrEditarVenta();
                      
          ?>
          </form>

        </div>
            
      </div>          

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
              
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th>Precio</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>
