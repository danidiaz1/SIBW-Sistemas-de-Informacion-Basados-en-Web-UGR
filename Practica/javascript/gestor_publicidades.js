// Script para mostrar/cerrar el div de nuevo seccion del gestor de seccions.
function mostrarNuevaPublicidad(){
	// Obtener la caja de los seccions
	var caja = document.getElementsByClassName("nueva_publicidad")[0];

	// Obtener el boton que abre los seccions
	var boton = document.getElementById("boton_nueva_publicidad");

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

function mostrarEdicionPublicidad(id_li, id_publicidad){
	var li_seleccionado = $('#' + id_li);
	
	var titulo = li_seleccionado.find($('h1')).text();
	li_seleccionado.find($('h1')).replaceWith(' <span> Titulo: </span> <input name="tituloModificar" type="text" value="'+titulo+'" required>');
	
	li_seleccionado.find($('a.imagen_publi')).replaceWith('<span>Imagen: </span> <input name="imagenModificar" id="imagenModificar" type="file">');
	
	var texto = li_seleccionado.find($('.span_texto')).text();
	li_seleccionado.find($('.span_texto')).replaceWith(' <input name="textoModificar" type="text" value="'+texto+'" required>');
	
	var enlace = li_seleccionado.find($('.enlace_publicidad')).text();
	li_seleccionado.find($('.enlace_publicidad')).replaceWith(' <input name="enlaceModificar" type="text" value="'+enlace+'" required>');

	li_seleccionado.append('<button type="submit" id="enviarPublicidadMod" name="accion" value="modificar" form="formGestionPublicidades">Confirmar</button>');
	li_seleccionado.append('<a class="cancelar" href="gestor_publicidad.php"><button>Cancelar</button></a>');
	li_seleccionado.append('<input type="hidden" name="id_publicidad" value="'+id_publicidad+'">');

	$('a.enlace_editar').remove();
}