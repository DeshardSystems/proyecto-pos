<?php

 // var_dump($variable)

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar ventas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-venta">

          <button class="btn btn-primary">
            
            Agregar venta

          </button>

        </a>

         <button type="button" class="btn btn-default pull-right" id="daterange-btn">
           
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

         </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>F.Pago</th>
           <th>Neto</th>
           <th>Total</th>
           <th>Adeudo</th>
           <th>Descuento</th>
           <th>Fecha</th>
           <th>F.Entrega</th>
           <th>Estado</th>
           <th>Ejecutar_Acciones</th>


         </tr> 

        </thead>

        <tbody>

        <?php

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {
           
           echo '<tr>

                  <td>'.($key+1).'</td>

                  <td>'.$value["codigo"].'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_vendedor"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>

                  <td>'.$value["metodo_pago"].'</td>

                  <td>$ '.number_format($value["neto"],2).'</td>

                  <td>$ '.number_format($value["total"],2).'</td>

                  <td>$ '.number_format($value["adeudo"],2).'</td>

                  <td>'.number_format($value["descuento"],2).'</td>

                  <td>'.$value["fecha"].'</td>

                  <td>'.$value["fecha_entrega"].'</td>';

                      if($value["progreso"] == "1"){ echo'<td class="bg-aqua"> Sin Archivo </td>';}
                  elseif($value["progreso"] == "2"){ echo'<td class="bg-red"> Sin Material </td>';}
                  elseif($value["progreso"] == "3"){ echo'<td class="bg-aqua"> Sin Anticipo </td>';}
                  elseif($value["progreso"] == "4"){ echo'<td class="bg-red"> Sin Herramienta </td>';}
                  elseif($value["progreso"] == "5"){ echo'<td class="bg-aqua"> Sin Aprobar </td>';}
                  elseif($value["progreso"] == "6"){ echo'<td class="bg-yellow"> En Proceso </td>';}
                  elseif($value["progreso"] == "7"){ echo'<td class="bg-green"> Terminado </td>';}
                  elseif($value["progreso"] == "8"){ echo'<td class="bg-green"> Entregado </td>';}
                  elseif($value["progreso"] == "9"){ echo'<td class="bg-red"> URGENTE </td>';}
                  else { echo'<td class="bg-red">Sin Definir</td>';}

                  echo'

                  <td>


                    <div class="btn-group">
                      <button type="button" class="btn btn-info">Acciones</button>
                      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a class = "btnImprimirFactura" codigoVenta="'.$value["codigo"].'" href="#">Imprimir Venta</a></li>
                        <li><a class = "btnEditarVenta" idVenta="'.$value["id"].'" href="#">Mostrar Venta</a></li>
                        <li><a class = "btnActualizarEstado" idVenta="'.$value["id"].'" href="#">Cambiar Estado</a></li>
                        <li><a class = "btnRegistrarPago" idVenta="'.$value["id"].'" href="#">Registrar Pago</a></li>
                        <li><a class = "btnEliminarVenta" idVenta="'.$value["id"].'" href="#">Eliminar Venta</a></li>
                      </ul>
                    </div>

 

                  </td>

                </tr>';
            }

        ?>
               
        </tbody>

       </table>

       <?php

      $eliminarVenta = new ControladorVentas();
      $eliminarVenta -> ctrEliminarVenta();

      ?>       

      </div>

    </div>

  </section>

</div>




