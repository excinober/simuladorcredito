$(document).ready(function(){

	$(".agregarPdt").click(function(){

		var idpdt = $(this).attr("idpdt");
		var cantidad = 0;
		var referencia = '';

		if ($("#referencia").length > 0) {

			referencia = $("#referencia").val();

			if (referencia == '' || referencia === null) {

				alert('Por favor seleccione una referencia del producto');
				
				$("#referencia").focus();

				return false;				
			}
		}

		cantidad = $("#cantidad").val();

		if (cantidad == 0 || cantidad === null) {

			alert('Por favor seleccione la cantidad');
				
			$("#referencia").focus();

			return false;				
		}
		
		$.ajax({

			type: 'POST',
			url: "Carrito/AgregarPdt",
			data: {	idpdt:idpdt, cantidad:cantidad, referencia:referencia },
			dataType: 'json',
			async: false,
			success: function(response) {
				//$("#total-carrito").text("Total a pagar $"+response.total);
				//console.log(response.cantidad);

				//alert(response.referencia);
				$("#cantidad-carrito").text(response.cantidad);				

				//alert('El producto se agrego al carrito');	
				window.location="Carrito/";

			},
			error: function() {
				alert('El producto no se agrego');
			}
		});
	});

	$('.cambiarCantidad').change(function() {
	
		idpdt = $(this).attr("idpdt");
		cantidad = $(this).val();
		referencia = $(this).attr("referencia");
		
		$.ajax({
			type: 'POST',
			url: "Carrito/ActualizarCantidadPdt",
			data: {	idpdt:idpdt, cantidad:cantidad, referencia:referencia },
			dataType: 'json',
			async: false,
			success: function(response) {

				if (response==="OK") {
					window.location="Carrito/";
				}
			},
			error: function() {
				alert('No fue posible cambiar la cantidad');
			}
		});
	});

	$(".eliminarPdtCarrito").click(function(){

		var idpdt = $(this).attr("idpdt");
		
		$.ajax({
			type: 'POST',
			url: "Carrito/EliminarPdtCarrito",
			data: {	idpdt:idpdt },
			dataType: 'json',
			async: false,
			success: function(response) {
				if (response=="OK") {
					window.location="Carrito/";
				}
			},
			error: function() {
				alert('No fue posible eliminar el producto');
			}
		});
	});

	$('.upselling').click(function(){

		var idpdt = $(this).attr('idpdt');
		var cantidad = $(this).attr('cantidad');
		var referencia = $(this).attr('referencia');

		$.ajax({

			type: 'POST',
			url: "Carrito/AgregarPdt",
			data: {	idpdt:idpdt, cantidad:cantidad, referencia:referencia },
			dataType: 'json',
			async: false,
			success: function(response) {

				
				$("#cantidad-carrito").text(response.cantidad);				
				window.location="Carrito/";

			},
			error: function() {
				alert('Lo sentimos. No logramos actualizar la cantidad');
			}
		});
	});

	$('[name="modalidad"]').click(function(){

		var modalidad = $(this).val();

		if (modalidad == 'NORMAL') {

			//$('#panel-metodologia-normal').show();
			//$('#panel-metodologia-dropshipping').hide();

			window.location.href='Carrito/?modalidad=1';

		}else if (modalidad == 'DROPSHIPPING'){

			//$('#panel-metodologia-normal').hide();
			//$('#panel-metodologia-dropshipping').show();

			window.location.href='Carrito/?modalidad=2';
		}
	});

	$('#guardarDropshipping').click(function(){

		var nombredp = $('#nombre_dp').val();
		var emaildp = $('#email_dp').val();
		var telefonodp = $('#telefono_dp').val();
		var movildp = $('#telefono_m_dp').val();
		var direcciondp = $('#direccion_dp').val();
		var ciudaddp = $('#ciudad_dp').val();


		if (nombredp == '') {

			alert('Por favor ingresa el nombre de tu cliente');
			$('#nombre_dp').focus();

		}else if(emaildp == ''){

			alert('Por favor ingresa el email de tu cliente');
			$('#email_dp').focus();

		}else if (telefonodp == '' && movildp == ''){

			alert('Por favor ingresa al menos un número telefónico de tu cliente');
			$('#telefono_m_dp').focus();

		}else if(direcciondp == ''){

			alert('Por favor ingresa la dirección de tu cliente');
			$('#direccion_dp').focus();

		}else if(ciudaddp == ''){

			alert('Por favor ingresa la ciudad de tu cliente');
			$('#ciudad_dp').focus();

		}else if (!$('#autorizacion_datos_dp').is(':checked')) {

			alert('Por favor autoriza el uso de datos personales');
			$('#autorizacion_datos_dp').focus();

		}else {

			$('#form-modalidad-dropshipping').submit();
		}
	});
})

function epayco(name, description, amount, tax_base, tax, confirmation, respuesta, nombre, telefono, telefono_m, email, direccion, idciudad){

	if (nombre != '' && telefono_m !='' && email !='' && direccion !='' && idciudad !='') {

		if (amount > 0) {
		toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-top-full-width",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "3000",
          "hideDuration": "20000",
          "timeOut": "20000",
          "extendedTimeOut": "5000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }

        toastr["success"]("<h4>Cargando pasarela de pago </h4>");

		$.ajax({

			type: 'POST',
			url: "GenerarOrden",
			dataType: 'json',
			async: true,
			beforeSend: function() {
				$('#btn-epayco').attr('disabled','disabled');
				$('#btn-epayco').text('Procesando pago...');
			},
			success: function(response) {
				
				if (response != '') {
					toastr.clear();
				
					var handler = ePayco.checkout.configure({
		  				key: '756be77e981fbfad17b5e7387a8e72a8',
		  				test: false
		  			});
			
					var data={

				          //Parametros compra (obligatorio)
				          name: name,
				          description: description,
				          invoice: response,
				          currency: "COP",
				          amount: amount,
				          tax_base: tax_base,
				          tax: tax,
				          country: "CO",
				          lang: "es",

				          //Onpage="false" - Standard="true"
				          external: "false",

				          //Atributos opcionales
				          confirmation: confirmation,
				          response: respuesta         
				    }

				    handler.open(data);

				}else{

					alert('Lo sentimos, ha ocurrido un error. Por favor intenta nuevamente.');
				}

				
			},
			error: function() {
				alert('Lo sentimos, no fue posible crear el pedido. Por favor intenta nuevamente.');
			}
		});

		}else{

			alert('El total a pagar no puede ser cero.');
		}

	}else{

		alert('Por favor ingrese primero todos las datos de envío');
	}
}