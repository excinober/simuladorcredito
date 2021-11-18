$(document).ready(function(){
	$("#copy_to_clipboard").on('click', function(){
		var txt = $('#catalog_link');//#clipboard es el campo de texto por ejemplo
		txt.select();//se selecciona en contenido del campo de texto
		document.execCommand("copy");
	});

	$('.categoria').on('click', function(){
		var url_categoria = $(this).attr('link');
		var url_original = $('#url_original').val();
		var url_nueva = url_original+url_categoria;
		$('#catalog_link').val(url_nueva);
	});

	$('#facebook_share').on('click', function(){
		var link = $('#catalog_link').val();
		var href = 'https://www.facebook.com/sharer/sharer.php?u='+link;
		$(this).attr('href',href);
	});

	$('#twitter_share').on('click', function(){
		var link = $('#catalog_link').val();
		var href = 'https://twitter.com/intent/tweet?source=webclient&amp;original_referer='+link+'&amp;text=Hola, conoce el catálogo más completo del mercado y pide tus productos online! Este es el enlace directo: &amp;url='+link;
		$(this).attr('href',href);
	});

	$('#whatsapp_share').on('click', function(){
		var link = $('#catalog_link').val();
		var href = 'whatsapp://send?text=Hola, conoce el catálogo más completo del mercado y pide tus productos online ! Este es el enlace directo: '+link;
		$(this).attr('href',href);
	});

	$('#email_share').on('click', function(){
		var link = $('#catalog_link').val();
		var href = 'mailto:?subject=Mi catálogo de productos&body=Hola, conoce el catálogo más completo del mercado y pide tus productos online! Este es el enlace directo: '+link;
		$(this).attr('href',href);
	});
});