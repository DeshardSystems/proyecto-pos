<?php

class ControladorCaja{

	/*=============================================
	MOSTRAR CAJA
	=============================================*/

	static public function ctrMostrarCaja($item, $valor){

		$tabla = "caja";

		$respuesta = ModeloCaja::mdlMostrarCaja($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR REGISTRO DE CAJA
	=============================================*/

	static public function ctrMostrarRegistroCaja($item, $valor){

		$tabla = "registro_caja";

	$respuestaCaja = ModeloCaja::mdlMostrarCaja($tabla, $item, $valor);

		return $respuestaCaja;
	}

	/*=============================================
	CREAR NUEVA OPERACION DE CAJA
	=============================================*/

	static public function ctrCrearCaja(){

		if(isset($_POST["monto_"])){

			$tabla = "caja";

			$datos = array("usuario" => $_POST["nombreVendedor"],
				           "ingreso_egreso" => $_POST["ingreso_egreso_"],
				           "nota_factura" => $_POST["nota_factura_"],
				           "descripcion" => $_POST["descripcion_"],
				           "monto" => $_POST["monto_"]);

			 var_dump($tabla, $datos);

			$respuesta = ModeloCaja::mdlIngresarCaja($tabla, $datos);
		
			if($respuesta == "ok"){

				// _____________________________________________________

				$tabla = "registro_caja";
				$item1 = "en_caja";
				$valor1 = $_POST["nuevaCaja"];

				$item2 = "id";
				$valor2 = "1";

				 var_dump($tabla, $item1, $valor1, $item2, $valor2);

				$RegistroCaja = ModeloCaja::mdlActualizarCaja($tabla, $item1, $valor1, $item2, $valor2);
				
				if($RegistroCaja == "ok"){

				echo '<script>

				swal({

					type: "success",
					title: "¡La operación en caja se ha realizado con exito!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						 window.location = "caja";

					}

				});
			

				</script>';
				}

				// ___________________________________________________

			}

		}

	}

	/*=============================================
	INGRESO A CAJA DESDE VENTA TABLA O REGISTRO DE PAGO
	=============================================*/

	static public function ctrCrearCajaVenta(){

		if(isset($_POST["nuevaVenta"])){

		  if($_POST["nuevoMetodoPago"] == "Efectivo"){

			$tabla = "caja";

			$datos = array("usuario" => $_POST["idVendedorCaja"],
				           "ingreso_egreso" => "ingreso",
				           "nota_factura" => $_POST["nuevaVenta"],
				           "descripcion" => $_POST["nota_venta"],
				           "monto" => $_POST["anticipo"]);

			 // var_dump($tabla, $datos);

			$respuesta = ModeloCaja::mdlIngresarCaja($tabla, $datos);
		
			if($respuesta == "ok"){

				// _____________________________________________________

				$tabla = "registro_caja";
				$item1 = "en_caja";
				$valor1 = $_POST["nuevaCaja"];

				$item2 = "id";
				$valor2 = "1";

				 var_dump($tabla, $item1, $valor1, $item2, $valor2);

				$RegistroCaja = ModeloCaja::mdlActualizarCaja($tabla, $item1, $valor1, $item2, $valor2);
				
				if($RegistroCaja == "ok"){

				echo '<script>

				swal({

					type: "success",
					title: "¡La operación en caja desde venta se ha realizado con exito!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){



				});
			

				</script>';
				}

				// ___________________________________________________

			}

		  }		  	

		}

	}

}


