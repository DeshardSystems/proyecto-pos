<?php

require_once "conexion.php";

class ModeloVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla
			(codigo, 
			id_cliente, 
			id_vendedor, 
			productos, 
			nota_venta, 
			anticipo, 
			impuesto, 
			neto, 
			total, 
			metodo_pago, 
			fecha_entrega, 
			descuento,
			entrega,
			acabado,
			laser_corte,
			laser_grabado,
			laser_detalles,
			plasma_corte,
			plasma_detalles,
			router_corte,
			router_grabado,
			router_tallado,
			router_diamante,
			router_detalles,
			serv_prod,
			servicio_detalles,
			material,
			material_detalles,
			nota_produccion,
			responsable,
			progreso
			)
			VALUES 
			(:codigo,
			:id_cliente,
			:id_vendedor,
			:productos,
			:nota_venta,
			:anticipo,
			:impuesto,
			:neto,
			:total,
			:metodo_pago,
			:fecha_entrega,
			:descuento,
			:entrega,
			:acabado,
			:laser_corte,
			:laser_grabado,
			:laser_detalles,
			:plasma_corte,
			:plasma_detalles,
			:router_corte,
			:router_grabado,
			:router_tallado,
			:router_diamante,
			:router_detalles,
			:serv_prod,
			:servicio_detalles,
			:material,
			:material_detalles,
			:nota_produccion,
			:responsable,
			:progreso
		)");

		var_dump($datos);

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":nota_venta", $datos["nota_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":anticipo", $datos["anticipo"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_entrega", $datos["fecha_entrega"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":entrega", $datos["entrega"], PDO::PARAM_INT);
		$stmt->bindParam(":acabado", $datos["acabado"], PDO::PARAM_INT);
		$stmt->bindParam(":laser_corte", $datos["laser_corte"], PDO::PARAM_INT);
		$stmt->bindParam(":laser_grabado", $datos["laser_grabado"], PDO::PARAM_INT);
		$stmt->bindParam(":laser_detalles", $datos["laser_detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":plasma_corte", $datos["plasma_corte"], PDO::PARAM_INT);
		$stmt->bindParam(":plasma_detalles", $datos["plasma_detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":router_corte", $datos["router_corte"], PDO::PARAM_INT);
		$stmt->bindParam(":router_grabado", $datos["router_grabado"], PDO::PARAM_INT);
		$stmt->bindParam(":router_tallado", $datos["router_tallado"], PDO::PARAM_INT);
		$stmt->bindParam(":router_diamante", $datos["router_diamante"], PDO::PARAM_INT);
		$stmt->bindParam(":router_detalles", $datos["router_detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":serv_prod", $datos["serv_prod"], PDO::PARAM_INT);
		$stmt->bindParam(":servicio_detalles", $datos["servicio_detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":material", $datos["material"], PDO::PARAM_INT);
		$stmt->bindParam(":material_detalles", $datos["material_detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":nota_produccion", $datos["nota_produccion"], PDO::PARAM_STR);
		$stmt->bindParam(":responsable", $datos["responsable"], PDO::PARAM_INT);
		$stmt->bindParam(":progreso", $datos["progreso"], PDO::PARAM_INT);

		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla

			(codigo, 
			id_cliente, 
			id_vendedor, 
			productos, 
			nota_venta, 
			anticipo, 
			impuesto, 
			neto, 
			total, 
			metodo_pago, 
			fecha_entrega, 
			descuento,
			entrega,
			acabado,
			laser_corte,
			laser_grabado,
			laser_detalles,
			plasma_corte,
			plasma_detalles,
			router_corte,
			router_grabado,
			router_tallado,
			router_diamante,
			router_detalles,
			serv_prod,
			servicio_detalles,
			material,
			material_detalles,
			nota_produccion,
			responsable,
			progreso
			)
			VALUES 
			(:codigo,
			:id_cliente,
			:id_vendedor,
			:productos,
			:nota_venta,
			:anticipo,
			:impuesto,
			:neto,
			:total,
			:metodo_pago,
			:fecha_entrega,
			:descuento,
			:entrega,
			:acabado,
			:laser_corte,
			:laser_grabado,
			:laser_detalles,
			:plasma_corte,
			:plasma_detalles,
			:router_corte,
			:router_grabado,
			:router_tallado,
			:router_diamante,
			:router_detalles,
			:serv_prod,
			:servicio_detalles,
			:material,
			:material_detalles,
			:nota_produccion,
			:responsable,
			:progreso
		)");

		// var_dump($tabla, $datos);

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":nota_venta", $datos["nota_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":anticipo", $datos["anticipo"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_entrega", $datos["fecha_entrega"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":entrega", $datos["entrega"], PDO::PARAM_INT);
		$stmt->bindParam(":acabado", $datos["acabado"], PDO::PARAM_INT);
		$stmt->bindParam(":laser_corte", $datos["laser_corte"], PDO::PARAM_INT);
		$stmt->bindParam(":laser_grabado", $datos["laser_grabado"], PDO::PARAM_INT);
		$stmt->bindParam(":laser_detalles", $datos["laser_detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":plasma_corte", $datos["plasma_corte"], PDO::PARAM_INT);
		$stmt->bindParam(":plasma_detalles", $datos["plasma_detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":router_corte", $datos["router_corte"], PDO::PARAM_INT);
		$stmt->bindParam(":router_grabado", $datos["router_grabado"], PDO::PARAM_INT);
		$stmt->bindParam(":router_tallado", $datos["router_tallado"], PDO::PARAM_INT);
		$stmt->bindParam(":router_diamante", $datos["router_diamante"], PDO::PARAM_INT);
		$stmt->bindParam(":router_detalles", $datos["router_detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":serv_prod", $datos["serv_prod"], PDO::PARAM_INT);
		$stmt->bindParam(":servicio_detalles", $datos["servicio_detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":material", $datos["material"], PDO::PARAM_INT);
		$stmt->bindParam(":material_detalles", $datos["material_detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":nota_produccion", $datos["nota_produccion"], PDO::PARAM_STR);
		$stmt->bindParam(":responsable", $datos["responsable"], PDO::PARAM_INT);
		$stmt->bindParam(":progreso", $datos["progreso"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentas($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	
}