
// $(".formularioCaja").on("change", "input#monto", function(){

// alert("formularioCaja es la clase del formulario y monto es el id del objeto");

// })

// $("#nota_factura").click(function () {

// alert("nota_factura es el 'id' del objeto")	 

// });

// $(".formularioCaja").on("click", ".generarCaja", function(){

// alert(".generarCaja es parte de la clase del objeto")	

// });

/*=============================================
AL DAR CLICK EN GUARDAR OPERACION
=============================================*/

$(".formularioCaja").on("click", ".generarCaja", function(){

calcularCaja();

	// $('.guardarCaja').click();
});


/*=============================================
CALCULAR CAMBIOS EN CAJA
=============================================*/
function calcularCaja(){

	var monto = Number($('#monto').val());

	if($("#ingreso_egreso").val() == "Ingreso") {

		var nueva_caja =  Number(monto) + Number($('#viejaCaja').val());
		$("#nuevaCaja").val(nueva_caja);
		$('.guardarCaja').click();

	}else if($("#ingreso_egreso").val() == "Egreso") {

		if (Number($('#viejaCaja').val()) >= Number(monto)) {
		var nueva_caja = Number($('#viejaCaja').val()) - Number(monto);
		$("#nuevaCaja").val(nueva_caja);
		$('.guardarCaja').click();
		}else{alert("Parece que la caja no tiene suficientes fondos!!!");}
	
	}

}







