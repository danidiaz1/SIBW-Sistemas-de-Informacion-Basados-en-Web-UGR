// Script para mostrar/cerrar el div de nuevo seccion del gestor de seccions.
function mostrarNuevaNoticia(){
	// Obtener la caja de los seccions
	var caja = document.getElementsByClassName("nueva_noticia")[0];

	// Obtener el boton que abre el formulario de nueva noticia
	var boton = document.getElementById("boton_nueva_noticia");

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

function mostrarEditorHTML(){
	CKEDITOR.replace( 'editor' );
}

function modificarImagen(id){
	$('.contenedor_imagenes').append('<input type="hidden" name="ids_modificar_imagenes[]" value="'+id+'">');
	
}