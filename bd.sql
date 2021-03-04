-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2020 a las 13:47:11
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(10) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `cantidad`, `producto`, `usuario`) VALUES
(2, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(64) DEFAULT NULL,
  `icono` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `icono`) VALUES
(1, 'Juegos de Tablero', 'images/icon_boardgames.png'),
(2, 'Juegos de Cartas', 'images/icon_cards.png'),
(3, 'Juegos de Rol', 'images/icon_dice.png'),
(4, 'Miniaturas', 'images/icon_meeple.png'),
(5, 'Puzzles', 'images/icon_puzzle.png'),
(6, 'Accesorios', 'images/icon_accessories.png'),
(7, 'Libros', 'images/icon_book.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `calle` text NOT NULL,
  `portal` text NOT NULL,
  `piso` text NOT NULL,
  `puerta` text NOT NULL,
  `cp` int(5) NOT NULL,
  `poblacion` text NOT NULL,
  `provincia` text NOT NULL,
  `comentarios` text NOT NULL,
  `nombre` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `usuario_id`, `calle`, `portal`, `piso`, `puerta`, `cp`, `poblacion`, `provincia`, `comentarios`, `nombre`) VALUES
(1, 2, 'Jacinto Benavente', '3', '3', '5', 46100, 'Burjassot', 'Valencia', '', 'Mi casa'),
(2, 2, 'Llidoners', '18, Bajo', '', '', 46026, 'Valencia', 'Valencia', 'Es una empresa llamada Diselcom', 'Mi trabajo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `referencia` text NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `fecha_envio` date DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `usuario_nombre` text DEFAULT NULL,
  `usuario_cif` text DEFAULT NULL,
  `calle` text NOT NULL,
  `portal` text NOT NULL,
  `piso` text NOT NULL,
  `puerta` text NOT NULL,
  `cp` int(5) NOT NULL,
  `poblacion` text NOT NULL,
  `provincia` text NOT NULL,
  `comentarios` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `referencia`, `fecha_creacion`, `fecha_envio`, `estado`, `usuario_id`, `usuario_nombre`, `usuario_cif`, `calle`, `portal`, `piso`, `puerta`, `cp`, `poblacion`, `provincia`, `comentarios`) VALUES
(1, 'P2020/001', '2020-10-26', '0000-00-00', 1, 2, 'Raúl Pastor Clemente', '48443620P', 'Jacinto Benavente', '3', '3', '5', 46100, 'Burjassot', 'Valencia', ''),
(2, 'P2020/002', '2020-10-28', '0000-00-00', 2, 2, 'Raúl Pastor Clemente', '48443620P', 'Llidoners', '18', '', 'Bajo', 46026, 'Valencia', 'Valencia', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_lineas`
--

CREATE TABLE `pedidos_lineas` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` int(11) NOT NULL,
  `precio_total` int(11) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos_lineas`
--

INSERT INTO `pedidos_lineas` (`id`, `pedido_id`, `producto_id`, `cantidad`, `precio_unitario`, `precio_total`, `estado`) VALUES
(1, 1, 1, 1, 10, 10, 1),
(2, 1, 2, 2, 12, 24, 1),
(3, 2, 3, 1, 25, 25, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `referencia` varchar(128) NOT NULL,
  `fabricante` varchar(64) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `anyo` int(11) DEFAULT NULL,
  `categoria_1` int(11) DEFAULT NULL,
  `categoria_2` int(11) DEFAULT NULL,
  `categoria_3` int(11) DEFAULT NULL,
  `imagen_1` varchar(256) DEFAULT NULL,
  `imagen_2` varchar(256) DEFAULT NULL,
  `imagen_3` varchar(256) DEFAULT NULL,
  `precio` float NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `contenido` text NOT NULL,
  `jugadores` text NOT NULL,
  `duracion` text NOT NULL,
  `complejidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `referencia`, `fabricante`, `descripcion`, `anyo`, `categoria_1`, `categoria_2`, `categoria_3`, `imagen_1`, `imagen_2`, `imagen_3`, `precio`, `stock`, `fecha_alta`, `contenido`, `jugadores`, `duracion`, `complejidad`) VALUES
(1, 'Virus', 'V180020', 'Tranjis Games', 'Consigue un cuerpo sano e inmunizado, con tus cuatro partes de cuerpo: cerebro, corazón, estómagos y huesos libres de infecciones. Los demás jugadores no te lo pondrán fácil, prepara tus medicinas y arroja unos pocos virus a los demás y guárdate tus mejores armas; transplantes de cuerpos, robos de órganos, transmisión comunitaria, errores médicos galopantes... para los momentos más importantes.<br/>Las autoridades sanitarias jamás lo confesarán, pero es un juego tan divertido que deberían recetarlo en la Seguridad Social.', 2018, 2, NULL, NULL, 'virus_1.jpg', 'virus_2.png', NULL, 13.46, 10, '2020-09-28', '', '', '', 0),
(2, 'Gloomhaven', 'G174430', 'Asmodee', '<p>¡Bienvenidos a Gloomhaven! Ser un mercenario en la frontera de la civilización no es nada fácil. A aquellos lo suficientemente estúpidos o valientes como para dejar la relativa seguridad de los muros de Gloomhaven, la aventura, la riqueza y la fama les esperan en los bosques salvajes y sombríos, las cuevas nevadas de las montañas y las criptas largo tiempo olvidadas. Simplemente no esperes que nadie pague por tus servicios por adelantado, porque nadie espera que vuelvas. Gloomhaven es un juego cooperativo de combate táctico en un mundo de fantasía único y en evolución. Cada jugador asumirá el papel de un mercenario curtido con sus propios intereses personales. Juntos, los jugadores lucharán a través de una campaña de escenarios que reaccionan y cambian en función de las acciones de los jugadores, creando un exclusivo tipo de juego lleno de tesoros descubiertos, aventureros retirados y opciones permanentes.</p><p>Cada escenario ofrece a los jugadores decisiones tácticas profundas, donde las cartas de habilidad tienen múltiples usos, y usar la habilidad correcta en el momento adecuado puede significar la diferencia entre el éxito y el fracaso. Gloomhaven ofrece un combate táctico sin dados contra enemigos totalmente automatizados, cada uno con sus propios patrones de comportamiento. </p><p>En esta caja, los jugadores encontrarán una experiencia de campaña de fantasía totalmente desarrollada de un alcance y profundidad sin precedentes.</p>', 2016, 1, 0, 0, 'gloomhaven_1.png', 'gloomhaven_2.png', 'gloomhaven_3.png', 149.95, 5, '2020-09-28', '', '', '', 3),
(3, 'Arkham Horror: El Juego de Cartas', 'A205637', 'Edge Entertainment', 'Arkham Horror: El juego de cartas es un juego cooperativo para 1 o 2 jugadores, en el que cada jugador se convertirá en un intrépido investigador que debe resolver una serie de aterradores misterios arcanos. Se trata de un juego acumulativo, de manera que si te haces con una segunda copia de esta caja básica, podrán jugar hasta 4 jugadores a la vez. Cada partida forma parte de una campaña mayor, donde las decisiones que tomes pueden tener inesperadas consecuencias a largo plazo. De forma regular se publicarán nuevas cartas y aventuras, con las que podrás personalizar el contenido de tu caja.', 2015, 2, NULL, NULL, 'arkham1_1.png', 'arkham1_2.png', 'arkham1_3.png', 39.95, 15, '2020-09-28', '', '', '', 0),
(4, 'Wingspan', 'W266192', 'MalditoGames', 'Wingspan es un juego basado en el coleccionismo de aves. En este juego cooperativo, seréis unos apasionados de las aves (investigadores, observadores de aves, ornitólogos y coleccionistas) que intentan descubrir y atraer a las más interesantes a vuestros aviarios.', 2019, 2, 1, NULL, 'wingspan_1.jpg', NULL, NULL, 49.5, 12, '2020-09-28', '', '', '', 0),
(5, 'Marvel Champions', 'W266192', 'Fantasy Flight', 'Wingspan es un juego basado en el coleccionismo de aves. En este juego cooperativo, seréis unos apasionados de las aves (investigadores, observadores de aves, ornitólogos y coleccionistas) que intentan descubrir y atraer a las más interesantes a vuestros aviarios.', 2019, 2, NULL, NULL, 'marvel_champions_1.jpg', 'marvel_champions_2.jpg', NULL, 59.95, 20, '2020-09-28', '', '', '', 0),
(6, 'El Señor de los Anillos: Viajes por la Tierra Media', 'E269385', 'Fantasy Flight', 'Cada partida de El Señor de los Anillos: Viajes por la Tierra media es una aventura que forma parte de una campaña. Tendrás que explorar los enormes paisajes de la Tierra Media y usar tus habilidades para sobrevivir a los retos que encontrarás en estas peligrosas misiones. Los héroes tendrán que explorar las tierras salvajes y combatir contra las fuerzas oscuras que encuentren, mientras la aplicación digital gratuita les irá mostrando los amenazadores bosques, los claros silenciosos y los antiguos salones de la Tierra Media, al tiempo que controla a los enemigos con los que se encontrarán. Este juego necesita una App gratuita disponible para Steam, iOS y Android.', 2018, 1, 0, 0, 'esdla_1.png', 'esdla_2.png', '', 99.95, 5, '2020-09-28', '', '', '', 2),
(7, 'Star Wars: El Borde Exterior', 'S271896', 'Fantasy Flight', 'En Star Wars: El Borde Exterior, tú y tus amigos asumís el papel de cazarrecompensas, contrabandistas y mercenarios, y os disponéis a dejar huella en la galaxia. Viajarás por el Borde Exterior en tu nave personal, contratarás a legendarios personajes de Star Wars para que se unan a tu tripulación e intentarás convertirte en el forajido más famoso (o infame) de la galaxia. ¿Te harás un nombre cazando recompensas para los Hutts, robando para los sindicatos del crimen o introduciendo mercancías de contrabando a través de las patrullas Imperiales?<br/><br/>Todo esto y mucho más es posible mientras te aventuras por las afueras de la galaxia conocida. ¡Establece tus coordenadas, reúne a tu tripulación y salta al hiperespacio con Star Wars: El Borde Exterior!', 2018, 1, 2, NULL, 'sw_outer_rim_1.png', 'sw_outer_rim_2.png', 'sw_outer_rim_3.png', 64.95, 3, '2020-09-28', '', '', '', 0),
(8, 'Tapestry', 'T286096', 'MalditoGames', 'En una partida de Tapestry, avanzarás en 4 medidores de progreso (ciencia, tecnología, exploración y poder militar) para ir obteniendo beneficios cada vez más potentes. Al mismo tiempo, irás mejorando tus ganancias, construirás tu capital, sacarás partido de habilidades únicas, obtendrás puntos de victoria y colocarás cartas de tapiz que contarán la historia de tu civilización.', 2015, 1, 0, 0, 'tapestry_1.png', '', '', 81, 7, '2020-09-28', '', '', '60', 2),
(9, 'Unlock! Exotic Adventures', 'U254226', 'Asmodee', 'Unlock! Exotic Adventures es un juego cooperativo basado en los Escape Room. En esta edición, tres aventuras te mantendrán totalmente enganchado: - La Noche de los Espantaniños: ¡Los espantaniños han invadido los sueños de William! Unid vuestras fuerzas para ahuyentarlos y permitirle dormir tranquilo. - El Último Cuento de Scheherazade: El cuento definitivo de “Las mil y una noches”. El sultán está a punto de condenar a muerte a Scheherazade. ¡Id volando a rescatarla! - Expedición: Challenger: ¡Explorad un valle repleto de dinosaurios y salvad a los miembros de la última expedición del profesor Challenger! ¡Busca en los escenarios! ¡Combina objetos! ¡Resuelve puzles!', 2017, 2, NULL, NULL, 'unlock_ea_1.png', 'unlock_ea_2.png', NULL, 26.69, 12, '2020-09-28', '', '', '', 0),
(10, 'Campos de Arle: Big Box', 'C159675', 'MalditoGames', 'Nos encontramos en Arle, en los inicios del s. XIX. Tu familia debe hacerse cargo de una gran cantidad de tareas: desecar los humedales, arar los cultivos y criar ganado. Para ello, debes mejorar tus habilidades en el pueblo y construir los edificios apropiados será crucial. Además, se incluye la expansión Té y Comercio con la que podrás jugar partidas a 3 jugadores y añadirás nuevos elementos: el té, para dar fuerza a tus trabajadores, y los barcos, que te servirán tanto para comerciar como para pescar.', 2017, 1, NULL, NULL, 'arle_1.jpg', NULL, NULL, 72, 8, '2020-09-28', '', '', '', 0),
(11, 'Spirit Island', 'S162886', 'Arrakis Games', 'Spirit Island es un juego cooperativo en el que deberás defender tu isla natal frente a la presencia peligrosa de los invasores. Pide ayuda a los espíritus y a sus poderes para poder vencer en la partida.', 2018, 1, 0, 0, 'spirit_1.jpg', '', '', 71.95, 6, '2020-09-28', '', '', '', 0),
(12, 'El Señor de los Anillos LCG', 'E77423', 'Edge Entertainment', 'En El Señor de los Anillos: el Juego de Cartas, los jugadores reúnen un grupo de aventureros que intentan completar peligrosas misiones en la Tierra Media. Desde los alegres campos de la Comarca a los siniestros caminos del Bosque Negro y hasta en los poderosos reinos de Gondor y Rohan, los memorables héroes de esta famosa ambientación se unen para resistir la amenaza de Sauron, el Señor Oscuro. El Señor de los Anillos, el Juego de Cartas es un juego cooperativo para 1 ó 2 jugadores en el que éstos colaboran para competir contra los escenarios controlados por el juego. Añadiendo una segunda copia de la caja básica, hasta 4 jugadores podrán jugar en modo cooperativo. Como Living Card Game, habrá disponibles cartas y misiones adicionales en las expansiones regulares, lo que permite a los jugadores personalizar los contenidos de esta caja o crear sus propios mazos originales.', 2012, 2, 0, 0, 'esdla_lcg_1.png', 'esdla_lcg_2.jpg', 'esdla_lcg_3.jpg', 39.95, 30, '2020-09-28', '', '', '', 1),
(13, 'Dragon Age: Caja Básica (Set 1)', 'D351792', 'Edge Entertainment', 'Bajo la tierra se agitan los engendros tenebrosos. Un nuevo archidemonio ha surgido de la oscuridad y trae con él un tiempo de Ruina que asolará la tierra y ocultará los cielos. Las naciones de Thedas necesitan una nueva generación de héroes, ¿pero quién acudirá a su llamada? Bienvenido a Dragon Age, un juego de rol de aventuras en un mundo de fantasía oscura para 2-6 jugadores. En Dragon Age, tus amigos y tú tomaréis el papel de guerreros, magos y pícaros del mundo de Thedas e intentaréis haceros un nombre en él derrotando a siniestros enemigos y superando inimaginables peligros. Este juego de rol lleva a tu mesa de juego toda la emoción del rico mundo de fantasía creado por BioWare para su popular saga de videojuegos de Dragon Age. Es un juego a la vieja usanza, en el que eres tú quien crea la historia y en el que tu creatividad lleva las riendas de la acción. La caja de Dragon Age: El juego de rol incluye todo lo necesario para jugar: Una Guía del jugador con una introducción a los juegos de rol tradicionales, trasfondo sobre las tierras de Thedas y la nación de Ferelden, una guía completa de creación de personajes, reglas para clases de personaje y talentos, los fundamentos de la magia, y las mecánicas generales del juego. Una Guía del director de juego con una introducción al importante papel que debe desempeñar en las partidas, consejos sobre el arte de la narración de aventuras, reglas de juego avanzadas, y una aventura de inicio que sumerge de golpe a los jugadores en el mundo de Dragon Age. Un mapa de tamaño póster de la nación de Ferelden, la ambientación de inicio en Dragon Age. 3 dados de seis caras. Dragon Age: El juego de rol es el puente ideal a los juegos de rol tradicionales. El sistema de juego es fácil de entender, divertido de usar, e incorpora una innovadora mecánica de maniobras especiales que asegura la emoción en los combates, ya seas guerrero, mago o pícaro. Así que llama a tus amigos, coge los dados, y prepárate para entrar en un mundo de héroes y villanos, caballeros y monstruos, dioses y demonios… ¡el mundo de Dragon Age!', 2014, 3, 7, 0, 'dragon_age_1.jpg', '', '', 29.95, 4, '2020-09-28', '', '', '120', 3),
(14, 'Warhammer: Caja de Iniciación', 'W151523', 'Devir', 'Warhammer: Caja de iniciación te trae todo lo necesario para sumergirte en el universo Warhammer y para dar tus primeros pasos en este impresionante juego de rol. Además, en su libro de aventuras podrás disfrutar de La Guía de Ubersreik, apta para todos los jugadores, independientemente del nivel que tengan.', 2015, 3, 7, NULL, 'warhammer_1.jpg', 'warhammer_2.jpg', NULL, 31.5, 7, '2020-09-28', '', '', '', 0),
(15, 'Bandeja organizadora modular', 'Z212237', 'Juegalandia', '<p>Las medidas son 28,5 x 28,5 cm; profundidad 2,3 cm. Contiene 18 compartimentos separados por una l&iacute;nea grabada. Puede cortarse f&aacute;cilmente y utilizarse los huecos individualmente o en grupos de tama&ntilde;o al gusto.</p>', 2020, 6, 0, 0, 'bandeja_1.jpg', 'bandeja_2.png', '', 2, 50, '2020-09-28', '', '', '', 0),
(16, 'Puzzle Marvel Avengers 4 en 1', 'P2354724', 'Ravensburger', '<ul> <li>Los Vengadores están de vuelta y en toda la fuerza. </li><li>Pieza junta, 4 imágenes coloridas y empaquetadas en acción que estrellan a Ant-Man, Iron Man, Capitán América y Hulk.     </li><li>Cuatro puzles de cartón de alta calidad en 12, 16, 20 y 24 piezas.     </li><li>El puzzle acabado mide 19 x 14 cm cuando está completo.     </li><li>A partir de 3 años.     </li><li>Hecho de cartón de alta calidad resistente, con impresión de acabado de lino para minimizar el deslumbramiento en la imagen del rompecabezas.</li></ul>', 2016, 5, 0, 0, 'puzzle_marvel_1.jpg', '', '', 9.5, 15, '0000-00-00', '<ul class=\"a-unordered-list a-vertical a-spacing-mini\"><li><span class=\"a-list-item\">\r\nLos Vengadores están de vuelta y en toda la fuerza. Pieza junta, 4 \r\nimágenes coloridas y empaquetadas en acción que estrellan a Ant-Man, \r\nIron Man, Capitán América y Hulk.\r\n\r\n</span></li><li><span class=\"a-list-item\">\r\nCuatro puzles de cartón de alta calidad en 12, 16, 20 y 24 piezas.\r\n\r\n</span></li><li><span class=\"a-list-item\">\r\nEl puzzle acabado mide 19 x 14 cm cuando está completo.\r\n\r\n</span></li><li><span class=\"a-list-item\">\r\nA partir de 3 años.\r\n\r\n</span></li><li><span class=\"a-list-item\">\r\nHecho de cartón de alta calidad resistente, con impresión de acabado de \r\nlino para minimizar el deslumbramiento en la imagen del rompecabezas.\r\n\r\n</span></li></ul>', '1', '', 1),
(17, 'Meeples Dinosaur Island', 'M2764658', 'Juegolandia', '<p>Fruto de la colaboración entre Pandasaurus Games y Meeple Source, \r\nespecializados en accesorios de juegos de mesa, se presentan los meeples\r\n pintados para <em>Dinosaur Island</em>. Se trata de una <strong>colección de figuras de madera</strong>, que sustituyen a las rosas del juego original.</p>\r\n<p>Sin pegatinas y con todo lujo de detalle, recurren a <a href=\"https://www.kickstarter.com/projects/meeplesource/dino-meeple-upgrade-for-dinosaur-island-by-meeple?ref=7mcw5h\" target=\"_blank\" rel=\"noopener\">Kickstarter</a>\r\n para convertirse en una realidad. Al alcanzar los 21.169 euros marcados\r\n como objetivo inicial, los mecenas recibirán sus recompensas en \r\nnoviembre de este año. Existen distintos packs, disponibles durante la \r\ncampaña.</p>', 2020, 4, 6, 0, 'meeples-dinosaur-1.jpg', '', '', 15, 0, '0000-00-00', '<p>Fruto de la colaboración entre Pandasaurus Games y Meeple Source, \r\nespecializados en accesorios de juegos de mesa, se presentan los meeples\r\n pintados para <em>Dinosaur Island</em>. Se trata de una <strong>colección de figuras de madera</strong>, que sustituyen a las rosas del juego original.</p>\r\n<p>Sin pegatinas y con todo lujo de detalle, recurren a <a href=\"https://www.kickstarter.com/projects/meeplesource/dino-meeple-upgrade-for-dinosaur-island-by-meeple?ref=7mcw5h\" target=\"_blank\" rel=\"noopener\">Kickstarter</a>\r\n para convertirse en una realidad. Al alcanzar los 21.169 euros marcados\r\n como objetivo inicial, los mecenas recibirán sus recompensas en \r\nnoviembre de este año. Existen distintos packs, disponibles durante la \r\ncampaña.</p>', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `correo` varchar(64) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `nif` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `correo`, `nombre`, `nif`) VALUES
(1, 'Raul', 'rapascle', 'donpastor@gmail.com', 'Raúl Pastor', '48443620P'),
(2, 'admin', 'admin', 'rpastor@diselcom.es', 'Adminstrador web', '48591402B'),
(3, 'usuario', 'usuario', 'usuario@usuario.com', 'Usuario pruebas', '12345678J');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referencia` (`referencia`(3072));

--
-- Indices de la tabla `pedidos_lineas`
--
ALTER TABLE `pedidos_lineas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `linea_pedido` (`pedido_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos_lineas`
--
ALTER TABLE `pedidos_lineas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `accesos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos_lineas`
--
ALTER TABLE `pedidos_lineas`
  ADD CONSTRAINT `linea_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
