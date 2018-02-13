-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2017 a las 12:00:43
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `daily_news`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `click_publicidad`
--

CREATE TABLE `click_publicidad` (
  `id_click` int(11) UNSIGNED NOT NULL,
  `id_publicidad` int(11) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `click_publicidad`
--

INSERT INTO `click_publicidad` (`id_click`, `id_publicidad`, `fecha`, `ip`) VALUES
(3, 1, '2017-04-16 03:52:44', '234.48.15.6'),
(4, 1, '2017-04-15 06:07:17', '234.57.8.9'),
(5, 2, '2017-05-16 10:20:09', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) UNSIGNED NOT NULL,
  `id_noticia` int(11) UNSIGNED NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `texto` varchar(3000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `id_noticia`, `ip`, `nombre`, `correo`, `fecha_hora`, `texto`) VALUES
(1, 1, '256.156.46.48', 'Juan Pérez', 'prueba@hotmail.com', '2017-04-11 15:17:25', 'Comentario de prueba.'),
(2, 1, '256.156.48.1', 'Antonio Heredia', 'antonio@gmail.com', '2017-04-05 22:17:15', 'Comentario de prueba 2.'),
(53, 11, '::1', 'jefe', 'editor_jefe@hotmail.com', '2017-02-03 15:00:11', 'afafafsf'),
(87, 1, '::1', 'prueba', 'prueba@hotmail.com', '2017-05-12 04:43:19', 'asafsd'),
(107, 1, '::1', 'prueba', 'prueba@hotmail.com', '2017-05-12 05:22:21', 'fasd'),
(108, 1, '::1', 'prueba', 'prueba@hotmail.com', '2017-05-12 05:22:44', 'd'),
(110, 1, '::1', 'prueba', 'prueba@hotmail.com', '2017-05-12 05:25:56', 'dsaasd'),
(111, 11, '::1', 'prueba', 'prueba@hotmail.com', '2017-02-14 01:54:01', 'afsdfads'),
(112, 4, '::1', 'redactor', 'redactor@gmail.com', '2017-05-15 12:53:08', 'adds');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE `etiqueta` (
  `id_etiqueta` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `etiqueta`
--

INSERT INTO `etiqueta` (`id_etiqueta`, `nombre`) VALUES
(1, 'espacio'),
(2, 'fósil'),
(3, 'Tierra'),
(4, 'Marte'),
(5, 'planeta'),
(6, 'arqueología'),
(7, 'serie'),
(8, 'vida'),
(9, 'medioambiente'),
(10, 'Luna'),
(11, 'agua'),
(12, 'dinosaurio'),
(13, 'NASA'),
(14, 'astronauta'),
(15, 'Orion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_imagen` int(11) UNSIGNED NOT NULL,
  `id_noticia` int(11) UNSIGNED NOT NULL,
  `url` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pie` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id_imagen`, `id_noticia`, `url`, `pie`) VALUES
(1, 1, 'resources/imagenes/trappist.png', 'Ilustración de la estrella enana TRAPPIST-1 y sus siete planetas vistos desde uno de ellos. / ESO/M. Kornmesser/spaceengine.org'),
(2, 2, 'resources/imagenes/39282_1.jpg', 'Sheldon Cooper (Jim Parsons) en The Big Bang Theory'),
(3, 3, 'resources/imagenes/10476_1.jpg', 'Antonio J. Durán'),
(4, 4, 'resources/imagenes/10477_1.jpg', 'Comparacion entre el sistema TRAPPIST-1 y nuestro sistema solar. Foto: NASA'),
(5, 5, 'resources/imagenes/10478_1.jpg', 'Esqueleto de un dinosaurio.'),
(6, 6, 'resources/imagenes/10481_1.jpg', 'Llegada a la Luna, NASA.'),
(7, 7, 'resources/imagenes/10480_1.jpg', 'Ilustración de la cápsula Dragon. / AFP'),
(8, 8, 'resources/imagenes/10503_1.jpg', 'Vista de uno de los fósiles hallados en la investigación. Foto: Mathew S. Dodd'),
(9, 9, 'resources/imagenes/10479_1.jpg', 'Superficie de Marte. / AP'),
(10, 10, 'resources/imagenes/10482_1.jpg', 'Ilustración de la superficie terrestre de unos de los siete planetas que orbitan TRAPPIST-1.'),
(11, 11, 'resources/imagenes/10483_1.jpg', 'Las fechas del primer viaje ruso a la superficie de la Luna anunciado para el año 2031 podrían modificarse en función de la disponibilidad del cohete portador.'),
(12, 1, 'resources/imagenes/10474_1.jpg', 'Pie de prueba'),
(18, 16, 'resources/imagenes/591a8e940527510474_1.jpg', 'cxz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id_noticia` int(11) UNSIGNED NOT NULL,
  `autor` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `titular` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `subtitulo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_seccion` int(11) UNSIGNED DEFAULT NULL,
  `id_subseccion` int(11) UNSIGNED DEFAULT NULL,
  `fecha_publicacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entradilla` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cuerpo` varchar(10000) CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `video` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` enum('pendiente','publicada') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id_noticia`, `autor`, `titular`, `subtitulo`, `id_seccion`, `id_subseccion`, `fecha_publicacion`, `entradilla`, `cuerpo`, `fecha_modificacion`, `video`, `estado`) VALUES
(1, 'Pepito', 'Un sistema extrasolar esconde siete mundos donde buscar vida.', 'La NASA anuncia un gran descubrimiento más allá del sistema solar.', 1, 1, '2017-02-23 10:36:30', 'El año pasado se informó del descubrimiento de tres planetas potencialmente habitables y de dimensiones similares a la Tierra transitando la estrella TRAPPIST-1.', '<p>La NASA llevaba unos d&iacute;as anunciando un gran descubrimiento m&aacute;s all&aacute; del sistema solar y este mi&eacute;rcoles por fin se ha dado a conocer. Un equipo internacional de astr&oacute;nomos informa en la revista Nature de la existencia de siete planetas del tama&ntilde;o de la Tierra transitando por delante de TRAPPIST-1, una estrella ultrafr&iacute;a y enana -poco m&aacute;s grande que J&uacute;piter- situada a 40 a&ntilde;os luz, en la constelaci&oacute;n de Acuario.</p><p>&ldquo;Los siete planetas tienen temperaturas (de entre 0 y 100 &deg;C) lo suficientemente bajas como para hacer posible la presencia de agua l&iacute;quida en sus superficies&rdquo;, destacan los autores en su art&iacute;culo, cuyo hallazgo convierte a este sistema planetario en uno de los mejores candidatos para buscar vida fuera del sistema solar. Incluso tres de los mundos se encuentran en la zona de habitabilidad de su estrella y podr&iacute;an tener oc&eacute;anos de agua.</p><p>&ldquo;Los pr&oacute;ximos pasos ser&aacute;n detectar y medir la atm&oacute;sfera de todos estos planetas, una tarea en la que se involucrar&aacute;n equipos de todo el mundo&rdquo;, adelanta a Sinc Didiier Queloz, coautor del trabajo e investigador del Observatorio de Ginebra, quien explica: &ldquo;Las enanas ultrafr&iacute;as -muy comunes en la V&iacute;a L&aacute;ctea-, con planetas rocosos en tr&aacute;nsito, son los &uacute;nicos objetivos para los que tenemos la capacidad t&eacute;cnica necesaria para estudiar sus atm&oacute;sferas&rdquo;.</p><p>&ldquo;TRAPPIST-1 es el primer objetivo, pero espero que se encuentren otros sistemas planetarios parecidos ya que los estudios estad&iacute;sticos se&ntilde;alan que pueden ser bastante frecuentes&rdquo;, a&ntilde;ade Queloz, una valoraci&oacute;n con la que coincide el astr&oacute;nomo holand&eacute;s Ignas Snelen, que tambi&eacute;n comenta en Nature el descubrimiento del sistema planetario s&eacute;ptuple: &ldquo;Si esta configuraci&oacute;n es com&uacute;n, nuestra galaxia podr&iacute;a estar repleta de planetas como la Tierra&rdquo;.</p><p>El hallazgo actual es fruto de otro anterior. En mayo de 2016, el investigador Micha&euml;l Gillon del instituto STAR de la Universidad de Lieja (B&eacute;lgica) y su equipo ya anunciaron la detecci&oacute;n de tres exoplanetas en la estrella TRAPPIST-1, rebautizada as&iacute; por el TRAnsiting Planets and PlanetesImals Small Telescope (TRAPPIST, en Chile) que se us&oacute; para las observaciones.</p><p>Motivados por este descubrimiento, los autores organizaron una campa&ntilde;a global de monitorizaci&oacute;n fotom&eacute;trica, mediante telescopios terrestres y espaciales, para detectar los tr&aacute;nsitos de los planetas por delante de su estrella, cuyo brillo se debilita ligeramente cada vez que esto sucede.</p>', '2017-05-16 06:56:32', 'resources/videos/test_video.mp4', 'publicada'),
(2, 'Juanito', 'El mundo de The Big Bang Theory', 'The Big Bang Theory', 1, 1, '2017-02-24 02:39:07', 'Juanito dedica su artículo semanal a The Big Bang Theory, la serie televisiva donde los personajes, encabezados por el excéntrico Sheldon Cooper, sobresalen en sus investigaciones pero lo que realmente les apasiona son los juegos de mesa, los cómics y la tecnología más reciente.', '<p>Hace no demasiado tiempo tuve una cura de humildad. Fui a una de las bibliotecas de mi universidad a sacar prestado un libro. Y cuando la persona que me atendió para registrar el préstamo buscó mis datos, al encontrarlos noté una expresión de interés en su cara. Antes de que dijera nada, pensé: “Habrá leído alguno de mis libros, y se alegrará de conocerme en persona”. ¡Vanitas vanitatis! No, lo que había visto era el departamento del que formo parte. “¡Es usted del Departamento de Física Teórica!”, me dijo. “¡Como Sheldon, en la serie The Big Bang Theory!”. Vanidad de vanidades, sí. Pero no me importó, porque yo también soy un buen aficionado a esa serie de televisión.</p>\r\n\r\n<p>Recuerdo ahora esta anécdota porque uno de los artículos del número de enero de la revista Physics Today, órgano del poderoso American Institute of Physics, está dedicado a “La imagen de los científicos en The Big Bang Theory”. La lectura de este artículo me ha animado a tratar de esta magnífica y divertida serie, cuyos personajes iniciales eran cuatro científicos -Sheldon Cooper, físico teórico, Leonard Hofstadter, físico experimental (los dos trabajan en el muy prestigioso California Institute of Technology de Pasadena), Raj Ramayan Koothrappali, astrofísico hindú, y Howard Wolowitz, ingeniero mecánico-, más Penny, aspirante a actriz que trabaja como camarera. Luego fueron incorporándose otros personajes, entre los que destacan dos científicas: Bernardette Rostenkowski, microbióloga (que también fue camarera) y Amy Fowler, neurobióloga.</p>\r\n\r\n<p>En más de un sentido, The Big Bang Theory es una muestra del espíritu del tiempo en que vivimos. En el pasado, lo habitual era presentar a los científicos como seres ajenos a las preocupaciones del común de los mortales, aislados en sus torres de marfil, cuando no locos peligrosos (recuérdese al doctor Frankenstein). Tampoco ha sido raro asociar el genio científico a enfermedades o a persecuciones sociales, es decir, a situaciones trágicas, como ejemplifican algunas películas recientes. Tal es el caso de Una mente maravillosa (2001), en la que el protagonista es el matemático John Nash, que vio interrumpida durante años su carrera científica a causa de una esquizofrenia paranoide, de la que consiguió recuperarse después de sufrir algunos tratamientos terribles (por sus trabajos en teoría de juegos no cooperativos, realizados antes de que su enfermedad se manifestase, recibió el Premio Nobel de Economía en 1994). De igual manera, en La teoría del todo (2014) se narra la vida de Stephen Hawking, prestando especial atención a cómo le fue afectando el mal que padece, la esclerosis lateral amiotrófica, y The imitation game (2014) se centra en el matemático inglés Alan Turing y en los trabajos que llevó a cabo durante la Segunda Guerra Mundial para descifrar los códigos secretos alemanes, pero sin olvidar su trágico final: se suicidó en 1954, dos años después de ser condenado por actos homosexuales y optar, para evitar la cárcel, por someterse a castración química mediante un tratamiento hormonal.</p>\r\n\r\n<p>Frente a presentaciones de este tipo, y con los científicos siendo casi siempre hombres, los personajes The Big Bang Theory son diferentes. Con la excepción de Penny - que en las dos últimas temporadas va demostrando que también ella puede salir adelante en una profesión-, los protagonistas han obtenido una magnífica educación en centros de excelencia. Y todos son doctores, excepto Wolowitz, quien “sólo” posee un máster, detalle que es utilizado por sus amigos para mortificarlo, pese a haber llegado a viajar a la Estación Espacial Internacional. En lugar de la seriedad o de las tragedias asociadas en el pasado a la imagen del científico, el término más apropiado para caracterizar a los cuatro científicos varones de esta serie es el de frikis. Sobresalen en sus investigaciones, sí, pero lo que les apasiona son los juegos de mesa, los comics, las tecnologías más recientes y poseer recuerdos de sus películas favoritas, de Star Trek, por ejemplo.</p>\r\n\r\n<p>Un rasgo particularmente interesante de la serie se encuentra en las muy diferentes personalidades de los protagonistas. Comparten aficiones y amor por la ciencia, pero cada uno es un mundo en sí mismo. Leonard es sociable y sensible, pero inseguro, Raj busca desesperadamente una novia, pero al principio sólo logra hablar delante de una mujer si está bebido, Wolowitz sufre de su dominante madre judía (que nunca aparece, únicamente oímos su chillona voz), Amy puede ser tan racional como Sheldon, pero no es ajena al mundo real: ansía tener relaciones más “íntimas” con él. Bernardette y Penny son las más “normales”. La primera, que se casa con Wolowitz, logra tras su doctorado un empleo en el que gana más dinero que su marido, algo que éste no siempre recibe con satisfacción, y Penny, novia de Leonard, que no sabe nada de ciencia, sirve como un magnífico contrapunto a todos esos científicos.</p>\r\n\r\n<p>Entre tanta rareza, o extravagancia, sobresale Sheldon, el físico teórico, niño superdotado, que tiene dos doctorados y cuyo campo de investigación es el de la teoría de cuerdas (que busca unificar las cuatro fuerzas que se han identificado en la naturaleza, reduciendo los elementos básicos de la materia a vibraciones de sofisticadas cuerdas). Extremadamente seguro de sí mismo, desprecia a los físicos experimentales, como es Leonard, su compañero de apartamento. Es ilustrativo el intercambio entre ambos que tiene lugar en el episodio piloto. Leonard se burla de Sheldon por el elevado número de dimensiones que es preciso postular en la teoría de cuerdas: “Al menos”, dice, “yo no he tenido que inventar 26 dimensiones sólo para que aparezcan las matemáticas”. A lo que Sheldon responde: “Yo no las inventé. Están ahí”. “¿En qué universo?”, pregunta con sorna Leonard: “En todos. Ese el punto”, exclama entonces Sheldon, aludiendo a la teoría de que nuestro universo no es el único existente. Ambos personajes son estereotipos, por supuesto, pero como todos los estereotipos, poseen algún grado de realidad: no pocos físicos teóricos se han sentido, o se sienten, “superiores” a los experimentales.</p>\r\n\r\n<p>En Sheldon también aparece un rasgo que encontramos, con diferencias de grado, en protagonistas de otras series de éxito: en la antropóloga forense Temperance Brennan, de Bones, y en la inspectora Saga Norén, de El puente. Bron. Los tres viven en un mundo dominado por una racionalidad extrema, un mundo en el que penetran con dificultad los sentimientos. Hay quien piensa que padecen el síndrome de Asperger, yo no lo creo, pero lo que es cierto es que muestran algunas de las características de quienes lo sufren: un fuerte egocentrismo, casi imposibilidad de apreciar los puntos de vista de los demás, y gran dificultad para mostrar el interés que pueden sentir por otros.</p>\r\n\r\n<p>The Big Bang Theory es, en resumen, fiel a la ciencia (cuenta con asesores que cuidan que los detalles científicos sean ciertos), pero para mí su verdadera atracción reside en sus personajes, en el plural microcosmos sociológico que nos muestra. Es como la vida misma.</p>', '2017-02-24 09:19:31', 'https://www.youtube.com/embed/E2ZOJfXuU08', 'publicada'),
(3, 'Javier López Rejas', 'Antonio J. Durán: \"La existencia de agua no garantiza la vida\"', 'Subtítulo', 1, 1, '2017-02-23 16:11:24', 'El científico y catedrático de la Universidad de Sevilla nos explica la trascendencia del hallazgo de nuevos exoplanetas en la constelación Acuario.', '<p>El descubrimiento de un sistema solar con siete planetas parecidos a la Tierra en torno a la estrella Trappist-1, en la constelación de Acuario, ha intensificado el interés por encontrar actividad biológica en algún punto del cosmos. Nuevos telescopios como el James Webb podrían rastrear con mayor precisión las características de los exoplanetas y seguir dando buenas noticias a la humanidad. Antonio J. Durán, catedrático de Análisis Matemático de la Universidad de Sevilla y autor de El universo sobre nosotros (Crítica), habla con El Cultural sobre el hito anunciado con cierto sensacionalismo por la NASA y sobre algunos de los grandes científicos que con sus trabajos han contribuido a situar el conocimiento humano en su actual nivel de excelencia.</p>\r\n\r\n<p>Pregunta.- ¿Qué trascendencia tiene para la ciencia el descubrimiento de este nuevo sistema planetario? \r\nRespuesta.- Nos pone en mejor disposición de responder a una pregunta trascendental: ¿Hay vida en algún otro rincón del universo? La catarata de interrogantes que una respuesta afirmativa a esa cuestión genera es colosal, empezando por si será vida inteligente (sea lo que sea lo que podamos entender por inteligencia) y acabando con la angustia de decidir hasta qué punto no sería desastroso para nuestra forma de vida, o la suya, o para las dos, un contacto entre ambos mundos. Cualquier avance en la detección de planetas, especialmente los parecidos al nuestro, o los situados en la zona habitable de su estrella, hay que considerarla importante. </p>\r\n\r\n<p>P.- ¿Qué le hace similar a nuestro sistema solar? \r\nR.- Quizás haya más diferencias que similitudes. Pero estas últimas son importantes: parecen planetas rocosos (con más probabilidad de que contengan agua), de tamaño comparable a los cuatro planetas internos del sistema solar y, sobre todo, tres de ellos parecen estar en la zona habitable de su estrella (la que permite la existencia de agua en estado líquido). </p>\r\n\r\n<p>P.- ¿Qué importancia puede tener el hecho de que la enana roja Trappist-1 sea menor al Sol y más débil? \r\nR.- Cuanta menor masa tiene una estrella más estable es su comportamiento a lo largo del tiempo porque, aunque tiene menos hidrógeno, el combustible que usa para brillar, necesita también menos cantidad para estabilizar la presión gravitatoria generada por su propia masa. El hecho de que Trappist-1 tenga el 8% de la masa solar garantiza que permanecerá estable un periodo de tiempo dos o tres órdenes de magnitud mayor que el periodo de estabilidad de nuestro Sol.</p>\r\n\r\n<p>P.- ¿Cree que abre una nueva etapa en la observación astronómica? \r\nR.- Lo que hace especial a esta estrella y sus planetas es que su posición relativa con la Tierra (y las características de la estrella) ha hecho posible determinar el tránsito de seis de los planetas por delante de la estrella; esto podría permitir determinar si tienen atmósfera y estudiar su composición. Y eso es algo que no se ha podido todavía hacer con ningún planeta fuera del sistema solar. </p>\r\n\r\n<p>P.- ¿Es posible, con las condiciones que se han desvelado (aún no sabemos si tienen atmósfera y campo magnético), que alguno de los siete planetas que orbitan Trappist-1 pueda albergar vida? \r\nR.- Podría ser. Por ejemplo, las sospechas de que alguno de ellos albergara vida aumentarían muchísimo si se detectase oxígeno en su atmósfera (caso de que la tuviera y se pudiera estudiar su composición).</p> \r\n\r\n<p>P.- ¿Cree que encontrar vida en otras constelaciones es cuestión de tiempo? \r\nR.- Lo especial en este caso es la posición relativa del sistema con la Tierra. Ahora bien, esa buena posición relativa es algo así como una casualidad, cuando no se da, aunque haya planetas, es mucho más difícil detectarlos. El que en una de las primeras estrellas estudiada por el proyecto Trappist se haya detectado un sistema con esta poco probable posición relativa parece indicar que va a haber muchísimos más planetas con características similares de lo que hasta ahora se pensaba. Eso aumenta en varios órdenes de magnitud nuestra estimación del número de planetas que existen ahí afuera, y por lo tanto las posibilidades de que alguno de ellos tenga vida.</p>\r\n\r\n<p>P.- El agua por sí misma, ¿es garantía de actividad biológica? \r\nR.- No, no es garantía; por ejemplo, hay agua (en forma de hielo y se sospecha que también en forma líquida) en otros planetas y satélites del sistema solar, lo que no quiere decir que haya vida. El agua parece una condición necesaria para la vida, al menos si se basa en la misma química de la que conocemos en la Tierra.</p>\r\n\r\n<p>P.- ¿Podrá la nueva generación de telescopios como el futuro James Webb de la NASA dar datos con mayor precisión? \r\nR.- Desde luego que sí. No está claro si el telescopio espacial Hubble permitirá observar si los planetas de Trappist-1 tienen atmósfera, cosa que casi con seguridad podrá hacer el James Webb cuando esté disponible (probablemente no antes de dos años).</p>\r\n\r\n<p>P.- ¿De dónde surge el nombre de Trappist-1 para la estrella? \r\nR.- Trappist es un acrónimo de\"Telescopio Pequeño para Planetas en Tránsito y Planetesimales\". El nombre coincide con la tipología de las mejores cervezas belgas: las producidas todavía por monjes trapenses en algunas abadías. Probablemente esto no es casual, porque detrás del descubrimiento de Trappist-1 está un proyecto de la Universidad de Lieja (Bélgica) que rastrea estrellas enanas frías cercanas a la Tierra en busca del tránsito de planetas. Esto se ha reflejado poco en los medios, donde casi únicamente se ha mencionado a la NASA. Hay que reconocer que la NASA ha sabido promocionar a la perfección el descubrimiento con una magnífica mercadotecnia que empezó hace ya días, cuando anunciaron la importancia de las noticias que se iban a desvelar en la rueda de prensa del pasado miércoles. Téngase en cuenta que tres de los siete planetas de Trappist-1 fueron descubiertos en 2015, y que lo que ayer se hizo público es la existencia de cuatro más (eso sí, tres de ellos situados en la zona habitable de la estrella).</p>\r\n\r\n<p>P.- En su último libro, El universo sobre nosotros, aúna física y literatura. ¿Es la misma intuición la que arrastra a la ciencia y a las letras? \r\nR.- No, la búsqueda del conocimiento profundo sobre la naturaleza usa postulados y herramientas científicas, junto con formalismos y técnicas matemáticas. Todo lo cual es muy diferente de las artes narrativas que tratan de ahondar en el conocimiento de la condición humana. Lo que no quita para que bastantes leyes científicas puedan ser, hasta cierto punto, entendidas como metáforas sobre la realidad; metáforas que se concretan cuando se hace entrar en juego las constantes de la naturaleza. No hay que olvidar tampoco que, tanto en ciencia como en literatura, son seres humanos los que buscan, ya sea el conocimiento del universo o de nuestra propia naturaleza humana, y eso establece un vínculo en origen entre ciencia y literatura más importante de lo que habitualmente se piensa.</p>\r\n\r\n<p>P.- ¿Considera que el cerebro humano no puede entender la complejidad del universo? \r\nR.- Nuestro cerebro es producto de la evolución, y como todos los productos evolutivos su propósito es aportar a nuestra especie alguna ventaja adaptativa al medio donde vivimos, hacernos más competitivos en la pelea con otras especies por la búsqueda de alimento. Es, pues, accidental que nuestro cerebro, que no ha evolucionado para hacernos entender mejor la complejidad del cosmos, nos haya permitido también desentrañar algunos de sus misterios. En cualquier caso, bienvenida sea esa contingencia que ha hecho posible la fascinante aventura científica.</p>\r\n\r\n<p>P.- ¿Llegaremos a entendernos totalmente cuando entendamos los mecanismos del universo? \r\nR.- Esto es muy difícil saberlo aunque parecería que no, pues en nuestra conducta como especie, y no digamos ya como individuos, lo contingente e imponderable parece tener un papel mucho más importante del que tiene en las rígidas leyes por las que se rige el universo.</p>\r\n\r\n<p>P.- Si, como dijo Newton, hemos podido ver tan lejos por habernos aupado a hombros de gigantes, ¿cuáles son los más importantes para usted a lo largo de la historia? \r\nR.- En esta cuestión no voy a ser muy original: Einstein, Darwin, Gauss, Newton y Arquímedes. Así que voy a añadir algo que se conoce menos y que tiene que ver con esa frase \"ver tan lejos por habernos aupado a hombros de gigantes\". Newton dedicó esa frase a Robert Hooke que fue uno de sus enemigos científicos. Pero resulta que Hooke fue muy corto de estatura y algo jorobado, por lo que la frase de Newton puede entenderse como una cruel ironía que buscaba humillar a Hooke por ser casi enano en vez de homenajear su altura intelectual. La personalidad de Newton ha sido una de las más fascinantes y complejas, no ya de la historia de la ciencia, sino de la historia de la humanidad; algo que Aldous Huxley explicó muy claramente: \"Newton tuvo que pagar por ser un intelecto supremo: fue incapaz de amistad, amor, paternidad y muchas otras cosas deseables. Como hombre fue un fracaso; como monstruo fue soberbio\".</p>', '2017-02-25 05:09:09', '', 'publicada'),
(4, 'Jose Manuel Sánchez Ron', '¿Tres exoplanetas con vida?', 'Descubrimiento reciente.', 2, 1, '2017-02-23 06:18:44', 'El catedrático de de Historia de la Ciencia de la Universidad Complutense de Madrid y académico de la RAE José Manuel Sánchez Ron pondera la importancia del descubrimiento del sistema TRAPPIST-1 anunciado por la NASA este miércoles, con siete exoplanetas de tamaño similar a la Tierra que podrían albergar agua en sus superficies y, por tanto, formas de vida tal y como la conocemos los humanos.\r\n\r\n', '<p>A estas horas, todo el mundo lo sabe. La noticia ha inundado todos los medios de comunicación, expandiéndose como la pólvora. Se han descubierto siete planetas, exoplanetas, de tamaños parecidos al de la Tierra que orbitan en torno a una estrella bautizada como TRAPPIST-1, cuya masa es el ocho por ciento de la del Sol, situada a 40 millones de años-luz del Sistema Solar. Su tamaño es pequeño -es lo que se denomina una “enana”-, parecido al de Júpiter. La novedad no es que se hayan detectado más exoplanetas: desde que en 1991 Alex Wolszczan, un astrónomo polaco instalado en Estados Unidos (en la Universidad Estatal de Pensilvania), y el canadiense del Observatorio Radioastronómico Nacional de Socorro (Nuevo México) Dale Frail, descubrieron que dos planetas con masas 4,3 y 1,8 veces la de la Tierra orbitan alrededor del púlsar PSR1257+12, son muchos los exoplanetas identificados, algunos con características (tamaño, distancia a su “estrella madre”) similares a las de la Tierra; en la actualidad son algo menos de 3.000 los sistemas planetarios descubiertos que contienen exoplanetas (alrededor de 3.500).</p>\r\n\r\n<p>La gran novedad es que en un mismo sistema solar haya siete planetas parecidos al nuestro; estrictamente, cinco: los dos restantes poseen un tamaño intermedio entre los de Marte y la Tierra. Más aún, las estimaciones de masas que han realizado el grupo de 30 científicos que firman el artículo de tan solo cinco páginas en el que se han presentado estos resultados (“Seven temperate terrestrial planets around the nearby ultracool dwarf star TRAPPIST-1”, publicado en Nature) indican que seis de los siete planetas son seguramente de naturaleza rocosa, mientras que la densidad del restante sugiere una composición gaseosa, del tipo de, por ejemplo, Júpiter, lo que disminuye las probabilidades de que en él pueda haber surgido vida. Utilizando un modelo climático unidimensional, los científicos mencionados señalan que tres de estos exoplanetas podrían albergar océanos de agua en sus superficies, suponiendo que sus atmósferas fuesen parecidas a las de la Tierra, algo todavía por determinar. Para los otros tres exoplanetas, que ocupan órbitas más cercanas a la estrella, el modelo que utilizan -esta vez tridimensional- predice que en ellos tienen lugar efectos invernadero muy pronunciados, como sucede en nuestro Venus.</p>\r\n\r\n<p>No es nuevo decir que la ciencia encuentra cosas que ni la más desbordante imaginación habría imaginado. Este es un ejemplo. ¡Un sistema solar con, acaso, tres planetas que contienen vida! Imaginemos -ya sé que es mucho imaginar- que en uno de ellos haya surgido vida “inteligente” como la nuestra, mientras que en los dos restantes, la vida fuese diferente, “no inteligente” en el sentido que damos a este difícilmente definible término, inteligencia. A esos seres inteligentes les sería posible explorar otros tipos de vida en sus proximidades, algo que nosotros deseamos intensamente, como muestran nuestros esfuerzos por encontrar restos, simplemente restos, de vida en Marte. Lo único que es seguro es que los exoplanetas que se acaban de descubrir permitirán a los astrofísicos explorar en un entorno relativamente reducido el problema de si existe vida en el Universo, algo de lo que yo estoy convencido, ahí o en algún otro lugar. Lo veremos, nuestros hijos o, como mucho, nuestros nietos.</p>\r\n', '2017-02-24 11:43:29', '', 'publicada'),
(5, 'Daily News', 'Los dinosaurios evolucionaron hacia el vuelo sin pretenderlo.', 'La evolución anatómica hacia el vuelo.', 1, 1, '2017-02-27 04:30:28', 'El análisis anatómico sugiere que tal desarrollo probablemente representa un proceso evolutivo hacia el desarrollo del aislamiento para proporcionar calor o para ayudar con el camuflaje', '<p>La evolución anatómica hacia el vuelo en determinadas especies de dinosaurios no estuvo relacionada con ese propósito directamente, sino más bien con otras como obtener calor o ofrecer camuflaje.</p>\r\n\r\n<p>Es la conclusión de Stephen Brusatte, miembro de Vertebrate Paleontology en la Universidad de Edimburgo, que ha publicado una pieza Perspective en la revista Science que describe el estado de la investigación actual sobre el desarrollo del vuelo en los dinosaurios.</p>\r\n\r\n<p>A su juicio, contrariamente a las suposiciones comunes, parece que el camino hacia el vuelo para los dinosaurios fue cualquier cosa menos una línea recta.</p>\r\n\r\n<p>Como señala Brusatte, cuando la mayoría de la gente piensa en la evolución de una característica o habilidad particular, tienden a pensar en una línea recta: una especie desarrolla una característica que le permite hacer algo mejor. Sus descendientes también expresan esa característica, y luego se agrega otra característica hasta que algo como alas para el vuelo se desarrollan.</p>\r\n\r\n<p>Pero como también señala, investigaciones recientes sugieren que no es así como el vuelo en los dinosaurios surgió - en lugar de eso parece que el vuelo se desarrolló en una serie de ajustes y comienza, con múltiples características evolucionando que parecen relacionadas con el vuelo con algunas que realmente no conducen al vuelo.</p>\r\n\r\n<p>Comienza observando que las excavaciones recientes han arrojado fósiles con tejidos blandos y plumas, sin embargo, argumenta que el análisis anatómico sugiere que tal desarrollo probablemente no tiene nada que ver con el vuelo, sino que representa un proceso evolutivo hacia el desarrollo del aislamiento para proporcionar calor o para ayudar con el camuflaje. Brusatte también señala que algunos fósiles que se han encontrado con alas -como estructuras que no fueron pensadas para volar- parecen haber sido utilizadas como forma de ornamentación.</p>\r\n\r\n<p>Para entender verdaderamente la evolución del vuelo en los dinosaurios, se requerirá la fusión de modelos matemáticos utilizados para medir la probabilidad de vuelo en una especie fósil dada y estudios biomecánicos (basados en ingeniería) que toman más en cuenta que las plumas. Se han encontrado fósiles, por ejemplo, que parecen más parecidos a los murciélagos que a los pájaros, con membranas para las alas. El descubrimiento, sugiere, será el desarrollo de modelos anatómicos de dinosaurios que representan verdaderamente la historia evolutiva de las aves tempranas, es decir, criaturas capaces de volar con energía.</p>\r\n\r\n<p>Concluye sugiriendo que a medida que la investigación continúa, parece probable que parte de la evidencia actual atribuida a la evolución del vuelo será desechada incluso a medida que se añada nueva evidencia del verdadero desarrollo, lo que finalmente nos dará una imagen real de lo que ocurrió.</p>', '2017-02-28 00:00:00', '', 'publicada'),
(6, 'Daily News', 'La NASA sopesa enviar dos astronautas a la Luna en 2019 con la Orion.', 'Subtitulo', 1, 1, '2017-04-12 18:33:36', 'La NASA sopesa que el vuelo inaugural del supercohete SLS Y la cápsula Orion sea tripulado y alcance la órbita lunar, como estaba previsto en la planificación inicial con maniquíes, pero en 2019.', '<p>La NASA sopesa que el vuelo inaugural del supercohete SLS Y la cápsula Orion sea tripulado y alcance la órbita lunar, como estaba previsto en la planificación inicial con maniquíes, pero en 2019.</p>\r\n\r\n<p>La denominada Misión de Exploración 1 (EM1), sin tripulación, había sido fijada para noviembre de 2018. Pero el administrador interino de la NASA, Robert Lightfoot, pidió el 15 de febrero estudiar que dicha misión fuera con astronautas a bordo. La agencia espera dar una respuesta en el plazo de un mes.</p>\r\n\r\n<p>La evaluación revisará la factibilidad técnica, los riesgos, los beneficios, el trabajo adicional requerido, los recursos necesarios y los impactos relacionados con el cronograma para agregar la tripulación a la primera misión.</p>\r\n\r\n<p>\"Nuestra prioridad es asegurar la ejecución segura y efectiva de todas nuestras misiones de exploración planificadas con la nave espacial Orion y el cohete Space Launch System\", ha dicho William Gerstenmaier, administrador asociado para el directorio de Exploración Humana espacial. \"Esta es una evaluación y no una decisión, ya que la misión principal de EM-1 sigue siendo una prueba de vuelo sin tripulación\".</p>\r\n\r\n<p>La evaluación está evaluando las ventajas y desventajas de este concepto con respecto a los objetivos a corto y largo plazo de lograr capacidades de exploración espacial profunda para Estados Unidos. Asumirá el lanzamiento de dos miembros de la tripulación a mediados de 2019, y considerará los ajustes al actual perfil de la misión EM-1, explica la NASA en un comunicado.</p>\r\n\r\n<p>Durante la primera misión de SLS y Orion, la NASA planea enviar la nave espacial a una distante órbita lunar retrógrada, lo que requerirá maniobras s adicionales de propulsión, un sobrevuelo de la Luna y encendidor de motores para la trayectoria de retorno. La misión está planeada como una trayectoria desafiante para probar maniobras y el ambiente de espacio esperado en misiones futuras al espacio profundo.</p>\r\n\r\n<p>Si la agencia decide poner a la tripulación en el primer vuelo, es probable que el perfil de misión de Exploration Mission-2 lo reemplace, que es una misión de aproximadamente ocho días con una inyección multi-translunar con una trayectoria de retorno libre.</p>\r\n\r\n<p>La NASA está investigando los cambios de hardware asociados con el sistema que serán necesarios si la tripulación va a ser agregada a EM-1. Como condición inicial, la NASA mantendría la etapa de Propulsión Criogénica Interina para el primer vuelo. La agencia también considerará incluir la prueba de aborto para Orion antes de la misión.</p>\r\n\r\n<p>Independientemente del resultado del estudio, la evaluación de factibilidad no está en conflicto con los programas de trabajo en curso de la NASA para las dos primeras misiones. El hardware para el primer vuelo ya ha comenzado a llegar al Centro Espacial Kennedy de la NASA en Florida, donde las misiones se lanzarán desde el histórico Pad 39B de la agencia.</p>\r\n\r\n<p>La NASA completó recientemente la instalación del último nivel más alto en el Edificio de Ensamblaje de Vehículos en Kennedy, completando los 10 niveles de plataformas de trabajo, 20 mitades de plataforma en total, que rodearán al cohete y la nave espacial Orion y permitirán el acceso durante el procesamiento para misiones.</p>\r\n\r\n<p>En el último mes, la construcción principal se completó en el nuevo puesto de prueba estructural SLS más grande, y los ingenieros ahora están instalando el equipo necesario para probar el tanque de combustible más grande del cohete. El soporte es fundamental para asegurar que el tanque de hidrógeno líquido de SLS pueda soportar las fuerzas extremas de lanzamiento y ascenso en su primer vuelo.</p>\r\n\r\n<p>En un laboratorio del Centro Espacial Johnson de la NASA en Houston, los ingenieros simularon condiciones que los astronautas en trajes espaciales experimentarían cuando la nave espacial Orion estuviera vibrando durante el lanzamiento en su camino hacia destinos espaciales profundos para evaluar cuán bien la tripulación puede interactuar con las pantallas y controles que van a utilizar para monitorear los sistemas de Orion y operar la nave espacial cuando sea necesario.</p>', '2017-04-13 04:24:23', '', 'publicada'),
(7, 'COLPISA / AFP', 'La cápsula Dragon llega a la Estación Espacial Internacional en su segundo intento', 'SpaceX había abortado su primera tentativa por un problema con el sistema GPS', 1, 1, '2017-03-15 11:11:24', 'La cápsula no tripulada Dragon llegó sin problemas este jueves a la Estación Espacial Internacional (ISS, por sus siglas en inglés), después de que 24 horas antes la empresa SpaceX abortara su arribo debido a varios problemas con el sistema de localización GPS.', '<p>En este segundo intento, tal nave que lleva más de 2,2 toneladas de alimentos y equipamiento para los astronautas de la ISS \"llegó de manera perfecta al punto de captura\", según un portavoz de la agencia aeroespacial estadounidense (NASA), y señalando que Dragon fue tomada por el brazo robótico de la estación a las 10:44 GMT.</p>\r\n\r\n<p>Los astronautas Thomas Pesquet (de Francia) y Shane Kimbrough (de Estados Unidos) maniobraron ese brazo robótico de 18 metros para capturar la cápsula, que luego fue descargada.</p>\r\n\r\n<p>\"Tuvimos una gran captura. Thomas [Pesquet] hizo un trabajo formidable\", declaró Kimbrough. \"Felicidades a Dragon por el exitoso viaje desde la Tierra y bienvenida a bordo\", añadió el propio astronauta francés. Se trata de la décima misión de abastecimiento a la ISS de las 20 estipuladas en un contrato de SpaceX con la NASA.</p>\r\n\r\n<p>La cápsula Dragon fue lanzada a bordo del cohete Falcon 9 el pasado domingo desde Cabo Cañaveral (Florida, EE UU). Dicho lanzamiento se realizó en la antigua plataforma 39A, construida para las misiones pioneras a la Luna de la NASA en los años 1960 y 1970, y de donde también partieron los transbordadores estadounidenses hasta el final del programa en 2011.</p>\r\n\r\n<p>Unos 10 minutos después del lanzamiento del Falcon 9, SpaceX logró que regresara a Tierra para un aterrizaje controlado y vertical en un área diferente del Cabo Cañaveral. Era la tercera vez que SpaceX lograba que retornara este cohete a la superficie terrestre.</p>\r\n\r\n<p>En anteriores ocasiones, el Falcon 9 se había posado en plataformas flotantes en el océano, mientras que la compañía perfeccionaba sus técnicas con la intención de reutilizar estos costosos cohetes en lugar de perderlos tras un único uso. Además, SpaceX también desarrolla una versión tripulada de su cápsula Dragon.</p>', '2017-03-15 13:13:11', '', 'publicada'),
(8, 'Daily News', 'Hallados los fósiles más antiguos de la Tierra', 'Restos de microorganismos de 3.770 millones de años han sido descubiertos.', 1, 1, '2017-03-01 08:00:00', 'Los tubos y filamentos microscópicos hallados en muestras tomadas allí se acaban de convertir en la primera evidencia de vida en la Tierra, según el artículo que han publicado en Nature Matthew S. Dodd y Dominic Papineau, investigadores del University College London y del London Centre for Nanotechology, junto a otros seis colegas de distintos países.', '<p>Desde hace tiempo se considera a las fuentes hidrotermales bajo los océanos uno de los primeros entornos que albergaron vida en la Tierra por su contenido rico en hierro. Es en esos lugares donde los científicos se han centrado para encontrar las primeras formas de vida bacteriana en la Tierra. “Tiene sentido que los primeros organismos se preserven en las fuentes hidrotermales. Estos entornos proporcionan la energía y los gradientes químicos necesarios para iniciar los primeros procesos metabólicos”, señala a Dodd a la agencia Sinc.\r\n\r\n<p>El equipo internacional de científicos analizó fragmentos de jaspe, una roca sedimentaria, hallados en la zona mencionada y que posiblemente pertenecieron a antiguas fuentes hidrotermales. Estudios anteriores les otorgaban entre 3.770 y 4.290 millones de años de antigüedad.</p>\r\n\r\n<p>Gracias a una combinación de microscopia óptica y espectroscopia Raman (para estudiar modos de baja frecuencia), los investigadores identificaron y localizaron microfósiles y la mineralogía asociada a ellos. Como la microscopia Raman usa un láser para medir vibraciones en las uniones entre diferentes átomos, el equipo pudo descifrar qué minerales estaban presentes en las rocas.</p>\r\n\r\n<p>Los resultados de la investigación confirman que la vida temprana prosperó en los ambientes hidrotermales poco después de la formación de la Tierra. Microfósiles en forma de tubos de hierro con o sin filamentos internos de hierro, filamentos torcidos de hierro, gránulos de óxido de hierro, rosetas de carbonato cortadas y rodeadas por masas de apatita, entre otros, son algunos de los elementos hallados en las rocas. Hasta ahora, los microfósiles más antiguos databan de hace unos 3.640 millones de años y se hallaron al oeste de Australia, pero algunos científicos consideraban que no había elementos biológicos en las rocas.</p>\r\n\r\n<p>En el nuevo estudio, los investigadores analizaron de manera sistemática la forma en la que los tubos y filamentos, hechos de hematita (una forma de óxido de hierro u óxido), podrían haberse creado con métodos no biológicos como la temperatura y los cambios de presión en la roca durante la deposición de sedimentos. Pero todas las posibilidades fueron poco probables.</p>\r\n\r\n<p>Las estructuras de hematites tienen la misma ramificación característica de las bacterias del hierro que se encuentran cerca de fuentes hidrotermales actuales y obtienen la energía que necesitan para vivir y multiplicarse por oxidación del hierro disuelto. Estas estructuras se encontraron junto con grafito y minerales como la apatita y el carbonato, hallados en huesos y dientes y frecuentemente asociados con fósiles.</p>\r\n\r\n<p>Según Papineau, este hallazgo no solo nos ayuda a unir las piezas de la historia de la vida en nuestro planeta, sino que también \"ayudará a identificar rastros de vida en otras partes del universo”. “Estos descubrimientos demuestran que la vida se desarrolló sobre la Tierra en un momento en el que Marte y la Tierra tenían agua líquida en sus superficies,  lo que plantea preguntas emocionantes sobre la vida extraterrestre. Por lo tanto, esperamos encontrar pruebas de vida pasada en Marte de hace 4.000 millones de años de antigüedad, o sino, la Tierra puede haber sido una excepción especial”, concluye Dodd.</p>', '2017-03-01 11:14:00', '', 'publicada'),
(9, 'Daily News', 'Investigan si las bacterias aumentarían la producción de alimentos en Marte', 'Subtitulo', 1, 1, '2017-04-01 15:24:11', 'Un equipo internacional de científicos indagará sobre cómo desarrollar cultivos de forma eficiente en cualquier planeta o exoplaneta', '<p>Un equipo internacional de científicos va a investigar si las bacterias pueden sobrevivir en suelos simulados de Marte y la Luna, una cuestión clave para desarrollar cultivos de forma eficiente en otros planetas. Pues para vivir en cualquier planeta o exoplaneta, los seres humanos necesitarán cultivar su propia comida y uno de los factores clave en el crecimiento de plantas, y el reciclado de sus partes muertas, son dichas bacterias.</p>\r\n\r\n<p>Rompen las hojas, las raíces y los tallos muertos y, por lo tanto, hacen que los nutrientes, el estiércol, vuelvan a estar disponibles para el crecimiento de las plantas. Completar este ciclo es esencial para el crecimiento sostenible de los cultivos en Marte. \"Con este paso siguiente nos estamos moviendo de apenas cultivar cosechas a construir un ecosistema pequeño pero sostenible\", dijo Wieger Wamelink, científico de la Wageningen University & Research y consejero de Mars One, una iniciativa privada de colonización futura de Marte.</p>\r\n\r\n<p>El trabajo experimental será realizado por Maaike van Agtmaal, asociado de Investigación Postdoctoral en la División de Ecología y Evolución del Imperial College de Londres. Pronto comenzará sus primeras mediciones. En primer lugar, el simulador de suelo de Marte y Luna se esteriliza para asegurarse de que no hay bacterias presentes. Luego, será inoculado con bacterias de diferentes suelos agrícolas y colocados en microcosmos. Se controlará la actividad de las bacterias.</p>\r\n\r\n<p>\"Mi objetivo es estudiar el proceso de terraformación de los suelos, el proceso de hacer el suelo habitable. Por lo tanto, también comparamos los resultados de los simulantes con la arena del Sahara y el suelo Ártico y con el simulador de suelo esterilizado sin bacterias\", dijo Van Agtmaal. El experimento durará un mes durante el cual se tomarán muestras cada semana para observar qué bacterias pueden entrar en el suelo, ver si sobreviven y probar qué funciones esenciales del suelo pueden aportar.</p>\r\n\r\n<p>Uno de los elementos esenciales para el crecimiento de las plantas son nutrientes como nitrógeno, potasio de fósforo o calcio. Estos nutrientes serán absorbidos por las plantas, dando como resultado el crecimiento. Sin embargo, esto agotará el stock de nutrientes en el suelo. Por esta razón, las partes de plantas muertas que no se comen tienen que ser devueltas al suelo, al igual que las heces y la orina de los seres humanos. Los nutrientes en las partes muertas de la planta no serán liberados al suelo, a menos que las bacterias destruyan el material vegetal muerto primero. Se alimentan de las plantas muertas, mientras liberan los nutrientes para las plantas.</p>\r\n\r\n<p>\"Hemos estado cultivando cosechas en suelos simulados de Marte y de la Luna desde hace varios años\", explica Wamelink, \"y hemos demostrado que es posible cosechar más de una docena de cultivos diferentes, incluyendo tomates, judías verdes, patatas, zanahorias y rábanos. Estos son ingredientes importantes para una dieta saludable y sabrosa para los futuros colonos de Marte. Sin embargo, la cosecha es aún menor que la de los cultivos que se producen en el suelo de tierra. Esto podría ser debido a una menor actividad bacteriana y este experimento puede revelar esto\".</p>\r\n\r\n<p>Bas Lansdorp, CEO y cofundador de Mars One: \"Para nuestra misión de asentamiento permanente en Marte, el cultivo de alimentos a nivel local es muy importante. Aunque nuestros astronautas traerán comida almacenable de la Tierra, tratarán de comer el mayor posible alimento fresco que puedan producir, aumentando su independencia de los suministros de la Tierra y el mejorando su calidad de vida. Mars One está particularmente interesado en esta investigación, ya que podría significar un paso importante hacia la producción de alimentos de manera más eficiente en Marte\".</p>', '2017-04-01 23:00:00', '', 'publicada'),
(10, 'Nora Bar', 'Las siete hermanas de la Tierra', 'Por primera vez hallan una estrella con planetas similares al nuestro.', 1, 1, '2017-03-10 17:32:59', '\"Los compañeros de Trappist-1 hacen de la búsqueda de vida en la galaxia algo inminente -dijo a The New York Times Sara Seager, astrónoma del MIT que no participó de la investigación-. Por primera vez, no tenemos que especular. Sólo tenemos que hacer observaciones cuidadosas en sus atmósferas.\"', '<p>Trappist-1 es el nombre de una estrella pequeña y fría que, paradójicamente, se convirtió ayer en la noticia \"caliente\" de la astronomía. Un equipo internacional de astrónomos descubrió que, alrededor de ella, orbitan siete planetas de tamaños similares o más pequeños que el de la Tierra, podrían ser rocosos (como el nuestro) y con temperaturas lo suficientemente bajas como para tener (o haber tenido) agua superficial, lo que se considera un prerrequisito para la vida. Es decir, Trappist-1 y las \"mini- Tierras\" serían un análogo compacto de nuestro sistema solar interior a 39 años luz de distancia. Ignas Snellen, astrónomo del Observatorio de Leyden, que hoy firma un comentario en la revista Nature sobre el descubrimiento, llama a estos exoplanetas \"las siete hermanas de la Tierra\".</p>\r\n\r\n<p>\"Este sistema es nuestra mejor apuesta para buscar vida extraterrestre\", afirma a la nacion por mail Brice-Olivier Demory, profesor del Centro para el Espacio y la Habitabilidad de la Universidad de Berna, coautor del trabajo y encargado de analizar los datos registrados por el Telescopio Spitzer.</p>\r\n\r\n<p>En las últimas décadas, la detección de exoplanetas (es decir, que están fuera del Sistema Solar) ya se convirtió en rutina: el Open Exoplanet Catalogue incluye 3457 confirmados. \"Sin embargo -aclara Mariano Ribas, coordinador del área de divulgación científica del Planetario de Buenos Aires-, en general, lo que predomina no es el modelo del Sistema Solar. Al principio, comenzaron a divisarse planetas muy grandes, del tamaño de Júpiter, que tienen poco y nada que ver con el nuestro. Con los años, el límite de detección de planetas chicos empezó a aumentar. Muchos de ellos, además, se encuentran en lo que se llama «zona habitable», que es la que permitiría agua líquida, y eso agrega interés a las detecciones. Pero en el total, las «exotierras» siguen siendo absoluta minoría. Por eso, este descubrimiento es muy importante: nunca se había anunciado una «ráfaga» de siete planetas potencialmente parecidos al nuestro girando en torno de una estrella. El tema es que la estrella es muy distinta de nuestro Sol.\"</p>\r\n\r\n<p>Los investigadores llegaron a sus conclusiones después de apuntar hacia esa región del espacio telescopios ubicados en el desierto de Atacama, Marruecos, Hawaii, Liverpool, La Palma, España, y, durante 20 días seguidos, el observatorio espacial Spitzer de la NASA.</p>\r\n\r\n<p>Éste pudo cartografiar el paso (tránsito) de los planetas por delante de la estrella a partir de las variaciones en su brillo. De esta información dedujeron que el sistema Trappist-1 es extremadamente compacto, que los seis planetas interiores tienen períodos (lo que tardan en dar una vuelta a su estrella) de entre un día y medio, y 13 días, y que el conjunto es extremadamente similar al de Júpiter y sus lunas galileanas.</p>\r\n\r\n<p>Io, Europa, Ganímedes y Calisto (las lunas de nuestro vecino gigante) también orbitan alrededor de su planeta con períodos que oscilan entre 1,7 y 17 días. Según Snellen, estos detalles, entre otros, sugieren que ambos sistemas se habrían formado y evolucionado de forma parecida.</p>', '2017-03-11 12:00:00', '', 'publicada'),
(11, 'Daily News', 'Una firma rusa planea vuelos turísticos alrededor de la Luna en cinco años', 'La compañía planea firmar un acuerdo en marzo de 2017.', 1, 1, '2017-02-28 23:24:30', 'La corporación espacial rusa Energia planea ofrecer asientos turísticos en desplazamientos a la Estación Espacial a partir de 2021, y en 5 o 6 años en viajes alrededor de la Luna.', '<p>La corporación espacial rusa Energia planea ofrecer asientos turísticos en desplazamientos a la Estación Espacial a partir de 2021, y en 5 o 6 años en viajes alrededor de la Luna.</p>\r\n\r\n<p>\"Estamos hablando de volar alrededor de la Luna, creo que RSC Energía estará lista para ser la primera en ofrecer este servicio en el mercado internacional para 2021-2022\", dijo a Sputniknews.com el director general de la empresa, Vladimir Solntsev, haciendo referencia en primer lugar a los servicios turísticos a la Estación Espacial.</p>\r\n\r\n<p>La compañía planea firmar un acuerdo en marzo de 2017 para usar nueve asientos en la nave espacial Soyuz para vuelos de los llamados turistas espaciales a la Estación Espacial Internacional (ISS).</p>\r\n\r\n<p>\"La renovación de un programa que implica vuelos turísticos espaciales en la nave espacial Soyuz es posible. Creo que en un futuro próximo vamos a firmar un contrato con una de las empresas en la prestación de servicios turísticos. En particular, estamos dispuestos a firmar un acuerdo en marzo de 2017, lo que implica nueve asientos turísticos en la nave espacial Soyuz para los vuelos a la ISS, que se espera que sea implementado en 2021\", dijo Solntsev, agregando que no había rusos entre los potenciales turistas espaciales en este momento.</p>\r\n\r\n<p>De acuerdo con este directivo espacial ruso, \"los vuelos turísticos alrededor de la Luna podrían realizarse en 5-6 años después de firmar un contrato cuyas cláusulas se debaten actualmente con posibles clientes\".</p>\r\n\r\n<p>Para implementar el proyecto sería necesario realizar dos lanzamientos seguidos: primero, poner en órbita la nave Soyuz y luego, el bloque de aceleración con cápsula hermética que se acoplaría, dijo.</p>\r\n\r\n<p>Añadió también que las fechas del primer viaje ruso a la superficie de la Luna anunciado para el año 2031 podrían modificarse en función de la disponibilidad del cohete portador super pesado.</p>', '2017-02-28 23:41:12', '', 'publicada'),
(16, 'cxvzxc', 'asddaads', 'zcx', 5, 1, '2017-05-16 07:31:00', 'cxz', '<p>dfs</p>', '2017-05-16 10:45:52', 'resources/videos/591a8eb4ded4ctest_video.mp4', 'publicada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia_etiqueta`
--

CREATE TABLE `noticia_etiqueta` (
  `id_noticia` int(11) UNSIGNED NOT NULL,
  `id_etiqueta` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `noticia_etiqueta`
--

INSERT INTO `noticia_etiqueta` (`id_noticia`, `id_etiqueta`) VALUES
(1, 1),
(1, 5),
(1, 8),
(2, 7),
(3, 8),
(3, 11),
(4, 1),
(4, 5),
(4, 8),
(5, 2),
(5, 6),
(5, 12),
(6, 1),
(6, 10),
(6, 13),
(6, 14),
(6, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabras_prohibidas`
--

CREATE TABLE `palabras_prohibidas` (
  `id` int(11) NOT NULL,
  `palabra` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `palabras_prohibidas`
--

INSERT INTO `palabras_prohibidas` (`id`, `palabra`) VALUES
(1, 'prohibida1'),
(2, 'prohibida2'),
(3, 'prohibida3'),
(4, 'prohibida4'),
(5, 'prueba1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicidad`
--

CREATE TABLE `publicidad` (
  `id_publicidad` int(11) UNSIGNED NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '#~o',
  `titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `texto` varchar(1000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicidad`
--

INSERT INTO `publicidad` (`id_publicidad`, `imagen`, `url`, `titulo`, `texto`) VALUES
(1, 'resources/banners/vertical.png', 'https://www.google.com', 'Hoteles', 'publi de hoteles'),
(2, 'resources/banners/etsiit.png', 'https://www.google.es', '																		etsiit																										', 'publi de la etsiit');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id_seccion` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id_seccion`, `nombre`) VALUES
(5, 'Arte'),
(1, 'Ciencia'),
(3, 'Cine'),
(4, 'Libros'),
(2, 'Tecnología');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subseccion`
--

CREATE TABLE `subseccion` (
  `id_subseccion` int(11) UNSIGNED NOT NULL,
  `id_seccion` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subseccion`
--

INSERT INTO `subseccion` (`id_subseccion`, `id_seccion`, `nombre`) VALUES
(1, 1, 'Ciencia1																						'),
(3, 3, 'Cine1						'),
(6, 1, 'Ciencia2								'),
(7, 5, 'Arte1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_registrado`
--

CREATE TABLE `usuario_registrado` (
  `correo_electronico` varchar(200) NOT NULL,
  `tipo` enum('normal','redactor','editor_jefe') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'normal',
  `nickname` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` char(128) NOT NULL COMMENT 'encriptado en SHA-512'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_registrado`
--

INSERT INTO `usuario_registrado` (`correo_electronico`, `tipo`, `nickname`, `password`) VALUES
('dani@hotmail.com', 'normal', 'dani', '6754e663df30ebb6aa219b209c37a613f6401f22016695955982c63770d3401d209fb0ae8c7925a1bec8ceb8438d5657ce32834d00d3f1af5fac7ba667a0a2c7'),
('diaz_alr@hotmail.com', 'normal', 'dani', '0f1f1c9453cb8a4af73544594c57ef24ad304ffcd8c49d89b5d74dfc05af63917ce7b790f7cc54c47ad16595ac49b5b1c9851f375e3d6b5700cb52146e10ef1e'),
('jefe@hotmail.com', 'editor_jefe', 'jefe', '063c74dd7786187bd388e2669cc6359c2a93bdddf43f92ef71f598c39902b50c1a900d411f38800403b4db980439884dded6423218255ac1523e53a06118d305'),
('prueba2@hotmail.com', 'normal', 'prueba2', 'ae3b5f6d1ef7d3b013d368271001b963b91f4a1ebd33168294ceef97f2bf67abf6c3fa35a613aa83f208ff00671fa2d72e1531db9a07ab1a5155265c4289347a'),
('prueba@hotmail.com', 'normal', 'prueba', '0439434dae91c10c3bc073af1e76addf8f57a30ce0a7de0438b3aaad34b85200d41d01078f2ee786b3130b4ed4e39e3e26090da5d9f87420454dfdd182761cce'),
('redactor@gmail.com', 'redactor', 'redactor', 'd3863f612d1804580f90eaae99914e055e0696d455c9a8385aabde9b1aa16b48bf55564c2482e1907e315c4a8660b5b6d12d6a356cdbce46c0b14679cfe00403');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `click_publicidad`
--
ALTER TABLE `click_publicidad`
  ADD PRIMARY KEY (`id_click`),
  ADD KEY `id_publicidad` (`id_publicidad`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD UNIQUE KEY `id_comentario` (`id_comentario`),
  ADD KEY `id_noticia` (`id_noticia`);

--
-- Indices de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD PRIMARY KEY (`id_etiqueta`),
  ADD UNIQUE KEY `id_etiqueta` (`id_etiqueta`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_imagen`),
  ADD UNIQUE KEY `id_imagen` (`id_imagen`),
  ADD KEY `id_noticia` (`id_noticia`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id_noticia`),
  ADD UNIQUE KEY `id_noticia` (`id_noticia`),
  ADD KEY `id_seccion` (`id_seccion`),
  ADD KEY `id_seccion_2` (`id_seccion`),
  ADD KEY `id_subseccion` (`id_subseccion`),
  ADD KEY `id_seccion_3` (`id_seccion`),
  ADD KEY `id_subseccion_2` (`id_subseccion`),
  ADD KEY `id_subseccion_3` (`id_subseccion`),
  ADD KEY `id_seccion_4` (`id_seccion`);

--
-- Indices de la tabla `noticia_etiqueta`
--
ALTER TABLE `noticia_etiqueta`
  ADD KEY `id_noticia` (`id_noticia`,`id_etiqueta`),
  ADD KEY `id_etiqueta` (`id_etiqueta`);

--
-- Indices de la tabla `palabras_prohibidas`
--
ALTER TABLE `palabras_prohibidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  ADD PRIMARY KEY (`id_publicidad`),
  ADD UNIQUE KEY `id_publicidad` (`id_publicidad`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id_seccion`),
  ADD UNIQUE KEY `id_seccion` (`id_seccion`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `subseccion`
--
ALTER TABLE `subseccion`
  ADD PRIMARY KEY (`id_subseccion`),
  ADD KEY `id_noticia` (`id_seccion`),
  ADD KEY `id_noticia_2` (`id_seccion`),
  ADD KEY `id_seccion` (`id_seccion`);

--
-- Indices de la tabla `usuario_registrado`
--
ALTER TABLE `usuario_registrado`
  ADD PRIMARY KEY (`correo_electronico`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `click_publicidad`
--
ALTER TABLE `click_publicidad`
  MODIFY `id_click` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
  MODIFY `id_etiqueta` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_imagen` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_noticia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `palabras_prohibidas`
--
ALTER TABLE `palabras_prohibidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  MODIFY `id_publicidad` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id_seccion` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `subseccion`
--
ALTER TABLE `subseccion`
  MODIFY `id_subseccion` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `click_publicidad`
--
ALTER TABLE `click_publicidad`
  ADD CONSTRAINT `click_publicidad_ibfk_1` FOREIGN KEY (`id_publicidad`) REFERENCES `publicidad` (`id_publicidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id_noticia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id_noticia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `noticia_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id_seccion`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `noticia_ibfk_2` FOREIGN KEY (`id_subseccion`) REFERENCES `subseccion` (`id_subseccion`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticia_etiqueta`
--
ALTER TABLE `noticia_etiqueta`
  ADD CONSTRAINT `noticia_etiqueta_ibfk_1` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id_noticia`),
  ADD CONSTRAINT `noticia_etiqueta_ibfk_2` FOREIGN KEY (`id_etiqueta`) REFERENCES `etiqueta` (`id_etiqueta`);

--
-- Filtros para la tabla `subseccion`
--
ALTER TABLE `subseccion`
  ADD CONSTRAINT `subseccion_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
