$(document).ready(function(){
	$('.cambiarCantidadPedido').change(function() {
	
		var precio = $(this).attr("precio");
		var cantidad = $(this).val();
		var iddetalle = $(this).attr("iddetalle");
		var pedido = $(this).attr("pedido");
		$.ajax({
			type: 'POST',
			url: "Usuario/ActualizarCtd/"+iddetalle,
			data: {	precio:precio, cantidad:cantidad},
			dataType: 'json',
			async: false,
			success: function(response) {

				if (response==="OK") {
					window.location="Usuario/DetallePedido/Editar/"+pedido;
				}
			},
			error: function() {
				alert('No fue posible cambiar la cantidad');
			}
		});
	});

	$('.cambiarReferenciaPedido').change(function() {
	
		var nombre = $(this).children("option:selected").attr("nombre");
		var idreferencia = $(this).val();
		var iddetalle = $(this).attr("iddetalle");
		var pedido = $(this).attr("pedido");
		$.ajax({
			type: 'POST',
			url: "Usuario/ActualizarRef/"+iddetalle,
			data: {	nombre:nombre, idreferencia:idreferencia},
			dataType: 'json',
			async: false,
			success: function(response) {

				if (response==="OK") {
					window.location="Usuario/DetallePedido/Editar/"+pedido;
				}
			},
			error: function() {
				alert('No fue posible cambiar la cantidad');
			}
		});
	});

	

});

function agregarProductoCarrito(idpdt,cantidad,referencia_nombre){

		var referencia = '';
		if (referencia_nombre != 'none') {
			referencia = referencia_nombre;
		}
		$.ajax({

			type: 'POST',
			url: "Carrito/AgregarPdt",
			data: {	idpdt:idpdt, cantidad:cantidad, referencia:referencia },
			dataType: 'json',
			async: false,
			success: function(response) {
				/*$("#cantidad-carrito").text(response.cantidad);	*/
				/*window.location="Carrito/";*/
			},
			error: function() {
				alert('El producto no se agrego');
			}
		});
	}

	function agregarPedidoSesion(idpedido){
		
			$.ajax({
				type: 'POST',
				url: "Usuario/AgergarPedido/"+idpedido,
				data: {	idpedido:idpedido},
				dataType: 'json',
				async: false,
				success: function(response) {
					/*if (response==="OK") {
						alert('El producto ha sido eliminado con éxito.');
						location.reload();
					}*/
				},
				error: function() {
					alert('El producto no se pudo eliminar.');
				}
			});
	}

	function agregarPedidoCarrito(idpedido){

		var cantidades = [];
		var referencias = [];
		var counter = 0;
		
		agregarPedidoSesion(idpedido);

		$('input[name^="cantidades"]').each(function() {
		   cantidades.push($(this).val());
		});
		$('input[name^="referencias"]').each(function() {
		    referencias.push($(this).val());
		});
		$('input[name^="idproductos"]').each(function() {
		   agregarProductoCarrito($(this).val(),cantidades[counter],referencias[counter]);
		   counter++;
		});
		
		window.location="Carrito/";
	}

	function eliminarPedido(idpedido){
		
		if (confirm('Está seguro de que desea ELIMINAR este pedido? Esta acción no podrá ser deshecha.')) {
			$.ajax({

				type: 'POST',
				url: "Usuario/EliminarPedido/"+idpedido,
				data: {	idpedido:idpedido},
				dataType: 'json',
				async: false,
				success: function(response) {
					if (response==="OK") {
						alert('El pedido ha sido eliminado con éxito');
						window.location="Usuario/Pedidos";
					}
				},
				error: function() {
					alert('El pedido no se pudo eliminar');
				}
			});
		}

	}

	function eliminarDetallePedido(iddetalle){
		
		if (confirm('Está seguro de que desea ELIMINAR este producto del pedido? Esta acción no podrá ser deshecha.')) {
			$.ajax({

				type: 'POST',
				url: "Usuario/EliminarItem/"+iddetalle,
				data: {	iddetalle:iddetalle},
				dataType: 'json',
				async: false,
				success: function(response) {
					if (response==="OK") {
						alert('El producto ha sido eliminado con éxito.');
						location.reload();
					}
				},
				error: function() {
					alert('El producto no se pudo eliminar.');
				}
			});
		}

	}


