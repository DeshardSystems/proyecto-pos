<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//TRAEMOS LA INFORMACIÓN DEL RESPONSABLE

$itemResponsable = "id";
$valorResponsable = $respuestaVenta["responsable"];

$respuestaResponsable = ControladorUsuarios::ctrMostrarUsuarios($itemResponsable, $valorResponsable);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					RFC:MOHI540314EW0

					<br>
					Periferico Paseo de la República #286-C
					Morelia Michoacan México
					C.P 58070

				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: (443) 353 22 31
					
					<br>
					deshard_systems@hotmail.com
					www.deshardsystems.com

				</div>
				
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>VENTA.<br>$valorVenta</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Cliente: $respuestaCliente[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Fecha: $fecha

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">Vendedor: $respuestaVendedor[nombre]</td>
			<td style="border: 1px solid #666; background-color:white; width:150px;text-align:right">Entrega: $respuestaVenta[fecha_entrega]</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$item[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$valorUnitario
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Neto:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $neto
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Impuesto:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $impuesto
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

// ---------------------------------------------------------
// ---------------------------------------------------------

$bloque6 = <<<EOF

	<table>

		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>
		
		<tr>
			
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					RFC:MOHI540314EW0

					<br>
					Periferico Paseo de la República #286-C
					Morelia Michoacan México
					C.P 58070

				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: (443) 353 22 31
					
					<br>
					deshard_systems@hotmail.com
					www.deshardsystems.com

				</div>
				
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>ORDEN DE TRABAJO.<br>$valorVenta</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');

// ---------------------------------------------------------

$bloque7 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Cliente: $respuestaCliente[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Fecha: $fecha

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">Responsable: $respuestaResponsable[nombre]</td>
			<td style="border: 1px solid #666; background-color:white; width:150px;text-align:right">Entrega: $respuestaVenta[fecha_entrega]</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque7, false, false, false, false, '');

// _________________________________________________________________________________
// ____________________________________________________________--ENTREGA ORDINARIA /URGENTE
if($respuestaVenta["entrega"] == "0") {
$bloque8 = <<<EOF
<h4>Entrega Ordinaria</h4>
EOF;
$pdf->writeHTML($bloque8, false, false, false, false, '');
}
if($respuestaVenta["entrega"] == "1") {
$bloque9 = <<<EOF
<h4>Entrega URGENTE</h4>
EOF;
$pdf->writeHTML($bloque9, false, false, false, false, '');
}
// ____________________________________________________________//selecciones de orden de trabajo

// ____________________________________________________________--laser
if($respuestaVenta["laser_corte"] == "1") {
$bloque10 = <<<EOF
<h4>Corte Laser</h4>
EOF;
$pdf->writeHTML($bloque10, false, false, false, false, '');
}
if($respuestaVenta["laser_grabado"] == "1") {
$bloque11 = <<<EOF
<h4>Grabado Laser</h4>
EOF;
$pdf->writeHTML($bloque11, false, false, false, false, '');
}
if($respuestaVenta["laser_detalles"] != "") {
$bloque12 = <<<EOF
<h4>$respuestaVenta[laser_detalles]</h4>
EOF;
$pdf->writeHTML($bloque12, false, false, false, false, '');
}
// ____________________________________________________________--Plasma
if($respuestaVenta["plasma_corte"] == "1") {
$bloque13 = <<<EOF
<h4>Corte Plasma</h4>
EOF;
$pdf->writeHTML($bloque13, false, false, false, false, '');
}
if($respuestaVenta["plasma_detalles"] != "") {
$bloque14 = <<<EOF
<h4>$respuestaVenta[plasma_detalles]</h4>
EOF;
$pdf->writeHTML($bloque14, false, false, false, false, '');
}
// ____________________________________________________________--Router
if($respuestaVenta["router_corte"] == "1") {
$bloque15 = <<<EOF
<h4>Corte Router</h4>
EOF;
$pdf->writeHTML($bloque15, false, false, false, false, '');
}
if($respuestaVenta["router_grabado"] == "1") {
$bloque16 = <<<EOF
<h4>Grabado Router</h4>
EOF;
$pdf->writeHTML($bloque16, false, false, false, false, '');
}
if($respuestaVenta["router_tallado"] == "1") {
$bloque17 = <<<EOF
<h4>Tallado Router</h4>
EOF;
$pdf->writeHTML($bloque17, false, false, false, false, '');
}
if($respuestaVenta["router_diamante"] == "1") {
$bloque18 = <<<EOF
<h4>Diamante Router</h4>
EOF;
$pdf->writeHTML($bloque18, false, false, false, false, '');
}
if($respuestaVenta["router_3d"] == "1") {
$bloque19 = <<<EOF
<h4>3d Router</h4>
EOF;
$pdf->writeHTML($bloque19, false, false, false, false, '');
}
if($respuestaVenta["router_detalles"] != "") {
$bloque20 = <<<EOF
<h4>$respuestaVenta[router_detalles]</h4>
EOF;
$pdf->writeHTML($bloque20, false, false, false, false, '');
}
// _____________________________________________________________________Acabado

if($respuestaVenta["acabado"] == "0") {
$bloque21 = <<<EOF
<h4>Acabado en bruto</h4>
EOF;
$pdf->writeHTML($bloque21, false, false, false, false, '');
}
if($respuestaVenta["acabado"] == "1") {
$bloque22 = <<<EOF
<h4>Acabado Limpio</h4>
EOF;
$pdf->writeHTML($bloque22, false, false, false, false, '');
}
if($respuestaVenta["acabado"] == "2") {
$bloque23 = <<<EOF
<h4>Acabado Final</h4>
EOF;
$pdf->writeHTML($bloque23, false, false, false, false, '');
}
// ____________________________________________________________________--Material
if($respuestaVenta["material"] == "0") {
$bloque24 = <<<EOF
<h4>Material aportado por el Cliente</h4>
EOF;
$pdf->writeHTML($bloque24, false, false, false, false, '');
}
if($respuestaVenta["material"] == "1") {
$bloque25 = <<<EOF
<h4>Material aportado por la Empresa</h4>
EOF;
$pdf->writeHTML($bloque25, false, false, false, false, '');
}
if($respuestaVenta["material_detalles"] != "") {
$bloque26 = <<<EOF
<h4>NOTA DEL MATERIAL:: $respuestaVenta[material_detalles]</h4>
EOF;
$pdf->writeHTML($bloque26, false, false, false, false, '');
}
// _______________________________________________________________--Nota de venta
if($respuestaVenta["nota_venta"] != "") {
$bloque27 = <<<EOF
<h4>NOTA VENTA: $respuestaVenta[nota_venta]</h4>
EOF;
$pdf->writeHTML($bloque27, false, false, false, false, '');
}
// _______________________________________________________________--Nota de Produccion
if($respuestaVenta["nota_produccion"] != "") {
$bloque28 = <<<EOF
<h4>NOTA PRODUCCION: $respuestaVenta[nota_produccion]</h4>
EOF;
$pdf->writeHTML($bloque28, false, false, false, false, '');
}

// ---------------------------------------------------------
// Clean any content of the output buffer
ob_end_clean();
//SALIDA DEL ARCHIVO 
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>