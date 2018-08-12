<?php

require_once "conexion.php";

class ModeloCaja{


	/*=============================================
	MOSTRAR CAJA
	=============================================*/

	static public function mdlMostrarCaja($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE OPERACION DE CAJA
	=============================================*/

	static public function mdlIngresarCaja($tabla, $datos){

		 // var_dump($tabla, $datos);

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, nota_factura, descripcion, ingreso_egreso, monto)VALUES(:usuario, :nota_factura, :descripcion, :ingreso_egreso, :monto)");

		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":ingreso_egreso", $datos["ingreso_egreso"], PDO::PARAM_STR);
		$stmt->bindParam(":nota_factura", $datos["nota_factura"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	ACTUALIZAR REGISTRO DE CAJA
	=============================================*/

	static public function mdlActualizarCaja($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


}