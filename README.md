# SIBW Sistemas de Información Basados en Web
Prácticas de Sistemas de Información Basados en Web (SIBW), Grado en Ingeniería Informática, UGR 2016-2017.

## Descripción de las prácticas

La práctica final, desarrollada en sucesivas entregas durante el curso, es un periódico online instalado en un servidor web XAMPP.
Se incluyen diseños para la portada, las noticias y una versión de impresión para la noticia. También para registro e identificación de usuarios y para la administración de la página (inserción/edición de noticias, modificación de la portada, datos estadísticos de anuncios, inserción/modificación/borrado de secciones/subsecciones...)

Cada noticia sigue un diseño similar al de la siguiente imagen:

![alt text](https://1stwebdesigner.com/wp-content/uploads/2013/06/wireframe.png)

El contenido (noticias, comentarios, portada) se carga dinámicamente desde una base de datos MySQL. Se usa el patrón MVC (modelo-vista-controlador) como diseño del software (ver carpeta "doc").

## Lista de funcionalidades

- Anuncios publicitarios y estadísticas acerca de los mismos.
- Ventanas emergentes para los botones de Compartir en Facebook y Compartir en Twitter.
- Galería de fotos.
- Inserción de vídeos en las noticias.
- En cada noticia, en el sidebar, hay noticias relacionadas.
- Uso de sesiones (HTML5 storage).
- Secciones y subsecciones.
- Comentarios en cada noticia (de los usuarios registrados) usando javascript.
- Filtrado de palabras prohibidas en los comentarios.
- Registro/identificación de usuarios, distinguiendo roles (cada uno con sus privilegios): colaborador/redactor, lector y editor jefe.
- El editor jefe puede: Gestionar comentarios, noticias, publicidad, secciones y subsecciones y organizar la página de inicio.
- Los colaboradores pueden incluir noticias pendientes de verificación por parte del editor jefe (redactan noticias).
- Los lectores pueden escribir comentarios.
- En el gestor de comentarios se puede: Incluir, eliminar, modificar o ver un listado de comentarios.
- En el gestor de noticias se puede: Incluir noticias asociadas a una sección y subsección, eliminar, modificar, ver un listado de noticias o cambiar el estado de una noticia (publicada/no publicada).
- En el gestor de publicidad se puede: Incluir texto e imagen para un anuncio, modificarlo, eliminarlo o ver el listado de anuncios.
- En el gestor de secciones y subsecciones se pueden: Incluir, eliminar y modificar secciones y subsecciones.
- Inserción dinámica de comentarios.
- Control de clicks sobre anuncios.

## Muestras de la web

Se puede ver una muestra de algunos HTML generados por el sistema (sin funcionalidad) en la carpeta "html_muestra". 

A continuación se adjuntan algunas imágenes de muestra:






