// Script para mostrar/cerrar la caja de comentarios
function mostrarComentarios(){
	// Obtener la caja de los comentarios
	var caja = document.getElementById("misComentarios");

	// Obtener el enlace que abre los comentarios
	var enlace = document.getElementById("enlaceComentarios");

	// Obtener el elemento que cierra la caja
	var cerrar = document.getElementsByClassName("cerrar")[0];

	// Cuando el usuario pulsa en el enlace, mostrar la caja
	enlace.onclick = function() {
	    caja.style.display = "block";
	}

	// Cuando el usuario hace click en el elemento cerrar, se cierra la caja
	cerrar.onclick = function() {
	    caja.style.display = "none";
	}
}

function enviarComentario(){
	
	$('#miFormularioComentarios').on("submit",function(e) {
		e.preventDefault();
		aniadirComentario();
		var data = $('#miFormularioComentarios').serialize();
		var id_noticia = $('#id_noticia').val();
		
		$.post({
			url: 'noticia.php?id='+id_noticia+'',
			type: "POST",
			data: data,
			success: function(){}               
		});
	});
	
	
}

// Función para prevenir code injection
function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };

  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

/* Añadir dentro del div "misComentarios" un nuevo div de clase .comentario con la siguiente estructura:
<div class="comentario">
	<h1>Autor: 
		<span class="nombreComentario">s</span>
		</h1>
	<h2>
		Fecha: <span class="fechaComentario"></span> | 
		Hora: <span class="horaComentario"></span>
	</h2>
	<p class="textoComentario"></p>
</div>*/
function aniadirComentario(){
	
	var caja = document.getElementById("miDivComentariosContenido");
	var autor = document.getElementsByName("nombreComentario")[0].value;
	var texto = document.getElementsByName("textoComentario")[0].value;
	var campoCorreo = document.getElementsByName("emailComentario")[0];
	var correo = campoCorreo.value;
	
	var fecha = new Date();

	if (texto != "" && autor != "" && correo != "" && campoCorreo.checkValidity())
	{
		var autor_seguro = escapeHtml(autor);
		var texto_seguro = escapeHtml(texto);
		var correo_seguro = escapeHtml(correo);
		texto_seguro = texto_seguro.replace(/\r?\n/g, '<br />');
		
		var nuevoComentario = '<div class="comentario">'+
		'<h1>Autor: '+ 
		'<span class="nombreComentario">'+autor_seguro+'</span>'+
		'</h1>'+
		'<h2>'+
		'Fecha: <span class="fechaComentario">'+ ("0" + fecha.getUTCDate()).slice(-2) + '-' 
		+ ("0" + (fecha.getUTCMonth()+1)).slice(-2) + '-' + fecha.getUTCFullYear()
		+'</span> | Hora: <span class="horaComentario">'+ ("0" + fecha.getHours()).slice(-2) 
		+ ':' + ("0" + fecha.getUTCMinutes()).slice(-2) + ":" 
		+ ("0" + fecha.getUTCSeconds()).slice(-2)
		+'</span>'+
		'</h2>'+
		'<p class="textoComentario">'+texto_seguro+'</p>'+
		'</div>';
		caja.insertAdjacentHTML('beforeend', nuevoComentario);
	}
}

function comprobarComentario(lista){
	window.onload = function() {  
		var 	input = document.getElementsByName("textoComentario")[0],
				output = document.getElementsByName("textoComentario")[0],
				badwords = lista;
				
		input.addEventListener('keyup', function() { 
			output.value = this.value.replace(badwords, function (fullmatch, badword) {
				return new Array(badword.length + 1).join('*');  
			});
		});

		input.focus();
	};
}

// Script para mostrar/cerrar el div de nuevo comentario del gestor de comentarios.
function mostrarNuevoComentario(){
	// Obtener la caja de los comentarios
	var caja = document.getElementsByClassName("nuevo_comentario")[0];

	// Obtener el boton que abre los comentarios
	var boton = document.getElementById("boton_nuevo_comentario");

	// Obtener el elemento que cierra la caja
	var ocultar = document.getElementsByClassName("ocultar")[0];

	// Cuando el usuario pulsa en el enlace, mostrar la caja
	boton.onclick = function() {
	    caja.style.display = "block";
	}

	// Cuando el usuario hace click en el elemento ocultar, se cierra la caja
	ocultar.onclick = function() {
	    caja.style.display = "none";
	}
}

function mostrarEdicionComentario(id_li, id_comentario){
	
	var li_seleccionado = $('#' + id_li)
	
	var autor = li_seleccionado.find($('.nombreComentario')).text();
	li_seleccionado.find($('.nombreComentario')).replaceWith('<input name="nombreModificar" type="text" value="'+autor+'">');

	var correo = li_seleccionado.find($('.emailComentario')).text();
	li_seleccionado.find($('.emailComentario')).replaceWith('<input name="correoModificar" type="email" value="'+correo+'">');
	
	var partes_fecha = li_seleccionado.find($('.fechaComentario')).text().split("-");
	var fecha_sin_formatear = new Date(partes_fecha[2], partes_fecha[1] - 1, partes_fecha[0]);
	var fecha_formateada = fecha_sin_formatear.toString('yyyy-MM-dd');

	li_seleccionado.find($('.fechaComentario')).replaceWith('<input name="fechaModificar" type="date" value="'+fecha_formateada+'">');
	
	var hora = li_seleccionado.find($('.horaComentario')).text();
	li_seleccionado.find($('.horaComentario')).replaceWith('<input name="horaModificar" type="time" step="1" value="'+hora+'">');
	
	var texto = li_seleccionado.find($('.textoComentario')).text();
	li_seleccionado.find($('.textoComentario')).replaceWith('<p><textarea name="textoModificar">'+texto+'</textarea></p>');

	li_seleccionado.append('<button type="submit" id="enviarComentarioMod" name="accion" value="modificar" form="formGestionComentarios">Confirmar</button>');
	li_seleccionado.append('<a class="cancelar" href="gestor_comentarios.php"><button>Cancelar</button></a>');
	li_seleccionado.append('<input type="hidden" name="id_comentario" value="'+id_comentario+'">');

	$('a.enlace_editar').remove();
}

	
	
