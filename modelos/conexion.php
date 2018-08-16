<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=pos",
			            "root",
			            "");

		$link->exec("set names utf8");

		return $link;

	}

}


// <?php

// class Conexion{

// 	static public function conectar(){

// 		$link = new PDO("mysql:host=localhost;dbname=deshards_pos",
// 			            "deshards_luis",
// 			            "5t4r3e2w1q");

// 		$link->exec("set names utf8");

// 		return $link;

// 	}

// }