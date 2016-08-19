-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.4-m14 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla charlenetas_geekdb.cat_tipos_feedback
CREATE TABLE IF NOT EXISTS `cat_tipos_feedback` (
  `id_tipo_feedback` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_token` varchar(60) NOT NULL,
  `txt_nombre` varchar(50) NOT NULL,
  `txt_descripcion` varchar(500) NOT NULL,
  `b_habilitado` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tipo_feedback`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.cat_tipos_feedback: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `cat_tipos_feedback` DISABLE KEYS */;
INSERT INTO `cat_tipos_feedback` (`id_tipo_feedback`, `txt_token`, `txt_nombre`, `txt_descripcion`, `b_habilitado`) VALUES
	(1, 'fedeb1deb4c28f074dc20b63c287c06c4e557b5018693d22', 'Me gusta', 'Feedback para gustar', 1),
	(2, 'fed0d3818a1e234fabe17754409babbe1d957b501afa5175', 'No me gusta', 'No gustar', 1),
	(3, 'fed2e285e33038940de39040d6babf4688757b501c982669', 'Troll', 'Este es troll', 1);
/*!40000 ALTER TABLE `cat_tipos_feedback` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.cat_tipos_posts
CREATE TABLE IF NOT EXISTS `cat_tipos_posts` (
  `id_tipo_post` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla',
  `txt_nombre` varchar(50) NOT NULL COMMENT 'Nombre del tipo de post',
  `txt_token` varchar(60) NOT NULL,
  `txt_descripcion` varchar(500) DEFAULT NULL COMMENT 'Descripción del tipo de post',
  `txt_color` varchar(25) DEFAULT NULL COMMENT 'Color que identificara el tipo de post. Puede ser hexadecimal, rgba',
  `txt_ico` varchar(25) DEFAULT NULL COMMENT 'Nombre de la imagen (Con extensión) que identificara el tipo de post.',
  `b_habilitado` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Booleano para habilitar o deshabilitar el registro ante el sistema',
  PRIMARY KEY (`id_tipo_post`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.cat_tipos_posts: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `cat_tipos_posts` DISABLE KEYS */;
INSERT INTO `cat_tipos_posts` (`id_tipo_post`, `txt_nombre`, `txt_token`, `txt_descripcion`, `txt_color`, `txt_ico`, `b_habilitado`) VALUES
	(1, 'Espejo', '', NULL, NULL, NULL, 1),
	(2, 'Alquimia', '', NULL, NULL, NULL, 1),
	(3, 'Verdadazos', '', NULL, NULL, NULL, 1),
	(4, 'Hoy pensé', '', NULL, NULL, NULL, 1),
	(5, 'Media', '', NULL, NULL, NULL, 1),
	(6, 'Contexto', '', NULL, NULL, NULL, 1),
	(7, 'Solo por hoy', '', NULL, NULL, NULL, 1);
/*!40000 ALTER TABLE `cat_tipos_posts` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.cat_tipos_usuarios
CREATE TABLE IF NOT EXISTS `cat_tipos_usuarios` (
  `id_tipo_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_nombre` varchar(50) DEFAULT NULL,
  `txt_token` varchar(60) DEFAULT NULL,
  `txt_descripcion` varchar(500) DEFAULT NULL,
  `b_habilitado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.cat_tipos_usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `cat_tipos_usuarios` DISABLE KEYS */;
INSERT INTO `cat_tipos_usuarios` (`id_tipo_usuario`, `txt_nombre`, `txt_token`, `txt_descripcion`, `b_habilitado`) VALUES
	(1, 'Netanauta', NULL, 'Usuario frontend', 1),
	(2, 'Super administrador', NULL, 'Usuario con control total del backend y frontend', 1);
/*!40000 ALTER TABLE `cat_tipos_usuarios` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.ent_alquimias
CREATE TABLE IF NOT EXISTS `ent_alquimias` (
  `id_post` int(10) unsigned NOT NULL COMMENT 'Identificador para hacer relacion a que post le pertenecera',
  `num_calificacion_admin` int(10) unsigned NOT NULL COMMENT 'Calificacion que dara el administrador',
  `num_calificacion_usuario` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Calificación que daran todos los usuarios',
  PRIMARY KEY (`id_post`),
  CONSTRAINT `FK_ent_alquimias_ent_posts` FOREIGN KEY (`id_post`) REFERENCES `ent_posts` (`id_post`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.ent_alquimias: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_alquimias` DISABLE KEYS */;
INSERT INTO `ent_alquimias` (`id_post`, `num_calificacion_admin`, `num_calificacion_usuario`) VALUES
	(3, 5, 5);
/*!40000 ALTER TABLE `ent_alquimias` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.ent_calificacion_alquimias
CREATE TABLE IF NOT EXISTS `ent_calificacion_alquimias` (
  `id_post` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `num_calificacion` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_post`,`id_usuario`),
  KEY `FK_ent_calificacion_alquimias_mod_usuarios_ent_usuarios` (`id_usuario`),
  CONSTRAINT `FK_ent_calificacion_alquimias_ent_alquimias` FOREIGN KEY (`id_post`) REFERENCES `ent_alquimias` (`id_post`) ON DELETE CASCADE,
  CONSTRAINT `FK_ent_calificacion_alquimias_mod_usuarios_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.ent_calificacion_alquimias: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_calificacion_alquimias` DISABLE KEYS */;
/*!40000 ALTER TABLE `ent_calificacion_alquimias` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.ent_comentarios_posts
CREATE TABLE IF NOT EXISTS `ent_comentarios_posts` (
  `id_comentario_post` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_comentario_padre` int(10) unsigned DEFAULT NULL,
  `id_post` int(10) unsigned DEFAULT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `num_likes` int(10) unsigned NOT NULL DEFAULT '0',
  `num_dislikes` int(10) unsigned NOT NULL DEFAULT '0',
  `num_trolls` int(10) unsigned NOT NULL DEFAULT '0',
  `txt_comentario` text NOT NULL,
  `txt_token` varchar(60) DEFAULT NULL,
  `fch_comentario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `b_leido` int(1) unsigned NOT NULL DEFAULT '0',
  `b_habilitado` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_comentario_post`),
  KEY `FK_ent_comentarios_posts_ent_comentarios_posts` (`id_comentario_padre`),
  KEY `FK_ent_comentarios_posts_ent_posts` (`id_post`),
  KEY `FK_ent_comentarios_posts_mod_usuarios_ent_usuarios` (`id_usuario`),
  CONSTRAINT `FK_ent_comentarios_posts_ent_comentarios_posts` FOREIGN KEY (`id_comentario_padre`) REFERENCES `ent_comentarios_posts` (`id_comentario_post`) ON DELETE CASCADE,
  CONSTRAINT `FK_ent_comentarios_posts_ent_posts` FOREIGN KEY (`id_post`) REFERENCES `ent_posts` (`id_post`) ON DELETE CASCADE,
  CONSTRAINT `FK_ent_comentarios_posts_mod_usuarios_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.ent_comentarios_posts: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_comentarios_posts` DISABLE KEYS */;
INSERT INTO `ent_comentarios_posts` (`id_comentario_post`, `id_comentario_padre`, `id_post`, `id_usuario`, `num_likes`, `num_dislikes`, `num_trolls`, `txt_comentario`, `txt_token`, `fch_comentario`, `b_leido`, `b_habilitado`) VALUES
	(7, NULL, 3, 18, 0, 0, 0, 'Un comentario', 'com1490f9df66b6488d2eccf3acce53f71657b500863b8b4', '2016-08-17 19:25:42', 0, 1),
	(8, NULL, 3, 18, 0, 0, 0, 'Este es un comentario nuevo', 'comdcd086e0bd272d9d09e2e0f4ea08fe9257b509b857208', '2016-08-17 20:04:56', 0, 1),
	(9, NULL, 3, 18, 0, 0, 0, 'Este es un comentario nuevo', 'com8237c942c8cf20594879624d734280c057b509c2df689', '2016-08-17 20:05:06', 0, 1),
	(10, NULL, 3, 18, 0, 0, 0, 'Este es un comentario nuevo', 'com4792a1ac1e35b7f6dcffb36d95b5a27257b509c4e25a7', '2016-08-17 20:05:08', 0, 1),
	(11, NULL, 3, 18, 0, 0, 0, 'Este es un comentario nuevo', 'com7b13a8125eea7715389ad3543df49f5657b509d4a1a8d', '2016-08-17 20:05:24', 0, 1),
	(12, NULL, 3, 18, 0, 0, 0, 'Este es un comentario nuevo', 'com21f00294e7104d069b13cef9442c137157b509d9986e5', '2016-08-17 20:05:29', 0, 1),
	(13, NULL, 3, 18, 0, 0, 0, 'Hola todo mundo jejejeje', 'com8beafca53dad4c474592eb8fa674504857b5de00c167c', '2016-08-18 11:10:40', 0, 1),
	(14, NULL, 3, 18, 1, 0, 0, 'Hola de nuevo', 'comabc2bc7afdbd421360fbe33c11fabb3e57b5df8ae1caa', '2016-08-18 11:17:14', 0, 1),
	(15, NULL, 8, 25, 0, 0, 0, 'Estoy comentando un contexto', 'com28da2858f229c6bfd1ba3a38e47640bc57b607b090a1b', '2016-08-18 14:08:32', 0, 1),
	(16, NULL, 8, 25, 0, 0, 0, 'Estoy comentando un contexto', 'com6fc09588766ab81746553b704dfb19a957b607bbdab06', '2016-08-18 14:08:43', 0, 1),
	(17, NULL, 8, 25, 0, 0, 0, 'Otro mensaje', 'com26e74b41835423d00d40189bd75fe1d857b607f9caa25', '2016-08-18 14:09:45', 0, 1),
	(18, NULL, 7, 25, 0, 0, 0, 'Comentario para la constitucion', 'com1bdc56127427a825ab5eb86541e03d7157b6084e004e3', '2016-08-18 14:11:10', 0, 1),
	(19, NULL, 5, 25, 0, 0, 0, 'Comentando mensajes', 'comafc729dd9d32f390ad67c8527f8af39857b6087e91ffd', '2016-08-18 14:11:58', 0, 1),
	(20, NULL, 8, 25, 0, 0, 0, 'Otro mensaje', 'comde866db3811eaefa31dd08b810e2796357b647643c04a', '2016-08-18 18:40:20', 0, 1),
	(21, NULL, 8, 25, 0, 0, 0, 'Mensaje', 'com30a7fd58b190913667e8ac2184533ea057b648230b017', '2016-08-18 18:43:31', 0, 1),
	(22, NULL, 8, 25, 1, 1, 1, 'Otro mensaje ejejejeje', 'com736db30fcb6bd278aea012549cc0870557b6482c87a03', '2016-08-18 18:43:40', 0, 1);
/*!40000 ALTER TABLE `ent_comentarios_posts` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.ent_contextos
CREATE TABLE IF NOT EXISTS `ent_contextos` (
  `id_post` int(10) unsigned NOT NULL,
  `id_contexto_padre` int(10) unsigned NOT NULL,
  `txt_tags` text NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `FK_ent_contextos_ent_contextos` (`id_contexto_padre`),
  CONSTRAINT `FK_ent_contextos_ent_contextos` FOREIGN KEY (`id_contexto_padre`) REFERENCES `ent_contextos` (`id_post`) ON DELETE CASCADE,
  CONSTRAINT `FK_ent_contextos_ent_posts` FOREIGN KEY (`id_post`) REFERENCES `ent_posts` (`id_post`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.ent_contextos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_contextos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ent_contextos` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.ent_espejos
CREATE TABLE IF NOT EXISTS `ent_espejos` (
  `id_post` int(10) unsigned NOT NULL,
  `num_subscriptores` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  CONSTRAINT `FK_ent_espejos_ent_posts` FOREIGN KEY (`id_post`) REFERENCES `ent_posts` (`id_post`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.ent_espejos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_espejos` DISABLE KEYS */;
INSERT INTO `ent_espejos` (`id_post`, `num_subscriptores`) VALUES
	(2, 0);
/*!40000 ALTER TABLE `ent_espejos` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.ent_posts
CREATE TABLE IF NOT EXISTS `ent_posts` (
  `id_post` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de las tabla',
  `id_tipo_post` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned DEFAULT NULL COMMENT 'Identificador del usuario ',
  `id_usuario_administrador` int(10) unsigned DEFAULT NULL COMMENT 'Identificador del usuario administrador',
  `txt_titulo` varchar(100) DEFAULT NULL COMMENT 'Título del post',
  `txt_token` varchar(60) DEFAULT NULL,
  `txt_descripcion` text COMMENT 'Descripción del post',
  `txt_imagen` varchar(100) DEFAULT NULL COMMENT 'Si lleva imagen ira el nombre del archivo',
  `txt_url` varchar(256) DEFAULT NULL,
  `num_likes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'likes para la publicación',
  `fch_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro',
  `fch_publicacion` timestamp NULL DEFAULT NULL COMMENT 'Fecha que se usara para la publicación abierta del post',
  `b_habilitado` int(1) unsigned DEFAULT '1' COMMENT 'Booleano para la habilitación del post',
  PRIMARY KEY (`id_post`),
  UNIQUE KEY `txt_token` (`txt_token`),
  KEY `FK_ent_posts_cat_tipos_posts` (`id_tipo_post`),
  KEY `FK_ent_posts_mod_usuarios_ent_usuarios` (`id_usuario`),
  CONSTRAINT `FK_ent_posts_cat_tipos_posts` FOREIGN KEY (`id_tipo_post`) REFERENCES `cat_tipos_posts` (`id_tipo_post`) ON DELETE CASCADE,
  CONSTRAINT `FK_ent_posts_mod_usuarios_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.ent_posts: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_posts` DISABLE KEYS */;
INSERT INTO `ent_posts` (`id_post`, `id_tipo_post`, `id_usuario`, `id_usuario_administrador`, `txt_titulo`, `txt_token`, `txt_descripcion`, `txt_imagen`, `txt_url`, `num_likes`, `fch_creacion`, `fch_publicacion`, `b_habilitado`) VALUES
	(2, 1, 18, NULL, NULL, 'post_3f6f718c45db9be09ccf7c5a427cb79557b217121b6bc', 'Mi novio y yo llevamos 3 años juntos y me ha pedido un tiempo. Dice que necesita su espacio para replantear su vida pero no quiere perderme porque me ama mucho. A mí no me gusta la idea pero lo amo mucho y no quiero perderlo. Tenemos mucha historia juntos y hasta hemos pensado en casarnos y tener hijos. ¿Qué puedo hacer?', '89430171.image32.jpg', NULL, 0, '2016-08-10 18:13:15', '2016-08-10 18:13:15', 1),
	(3, 2, NULL, NULL, 'Kevin', 'post_311b7f15cd6325f98cc0cce2987fecb857b2170a3703f', 'Esta película trata el importante tema de detectar y atender el comportamiento violento en los niños desde las primeras señales. Es responsabilidad de los padres y madres poner atención a las señales y no justificar actos violentos de los hijos pensando que "es normal porque los niños son curiosos", o "es normal porque los niños juegan pesado", etc. No hacerlo traerá peores consecuencias como se muestra en esta película muy recomendable.', '89430171.image32.jpg', NULL, 0, '2016-08-10 18:39:55', '2016-08-10 18:39:55', 1),
	(4, 3, NULL, NULL, NULL, 'post_4018d935a74d1521c3324b6b84a3794157b21703e4262', '¿Has notado que cuando una mujer pide respeto a un hombre, en lugar de recibir una respuesta favorable o inclusive neutral, usualmente recibe una agresión como respuesta? Frases como "ni que estuvieras tan buena", "por eso nadie te soporta", o inclusive groserías son usualmente las respuestas. No sería una mejor respuesta inclusive guardar silencio en señal de respeto por las decisiones y gustos ajenos?', '89430171.image32.jpg', NULL, 0, '2016-08-11 16:47:03', '2016-08-11 16:47:03', 1),
	(5, 4, NULL, NULL, 'Men are jerks because women let them', 'post_47252123b2fb91be8db0c4a185d965da57b216fd3f779', 'Platicando hace rato con amig@s de los dramas emocionales de la vida, recordé lo que alguna vez escuché decir, de un hombre precisamente: "man are jerks because women let them" que significa "los hombres son patanes porque las mujeres lo toleran". Ahora no dudo que haya excepciones y que existan hombres que amaron mucho y mujeres que no los apreciaron. Pero en la generalidad, somos las mujeres las que, en nuestro afán de encontrar y mantener el tan anhelado amor y cuento de hadas de felices para siempre, las que queremos creer tanto en el cuento y justificaciones que se inventan nuestras pareja para excusar las cosas malas que hacen (que si no sabía lo que hacía, que no pensé que te fueras a enterar, que no imaginé que te fueras a molestar, que es que estoy traumado porque me pasó x cosa, etc.) que nos olvidamos de analizar lo que verdaderamente nos merecemos. Los amamos tanto que nos olvidamos de amarnos a nosotras mismas. Y es que al final del día, por cada mujer que por fin decide quererse y terminar una relación que no le satisface, hay varias otras mujeres dispuestas a ser "el verdadero amor" del galán en cuestión, que inevitablemente contará la amarga historia de cómo su anterior pareja "no lo entendía", "no era la correcta", "era una histérica, celosa, posesiva, bipolar", "siempre tuvo dudas de que ella fuera la indicada", etc. Ósea el clásico "es que ella no era como tú". Y vaya que nos encanta escucharlo! Nos valida los sentimientos de inseguridad y superioridad sobre otras mujeres perfectamente incorporados a nuestro disco duro como una necesidad para el amor propio por esta sociedad patriarcal. Es decir, no vales por tí mujer, sino que vales en la medida que eres más santa, más capaz, vaya, "más perfecta" que la otra. Pero, y si todas las mujeres decidiéramos que antes del final feliz de Disney y la comparación con otras mujeres, nos merecemos todo el respeto y amor propio hacia nosotras mismas? Si nos convenciéramos de que nos merecemos relaciones afectivas en las que seamos valoradas y apreciadas sin necesidad de "demostrar que lo merecemos"? Si dejáramos de justificar las faltas de respeto y desamor de nuestras parejas y simplemente aceptáramos que nos merecemos un buen amor? Uno que no nos haga daño, uno al que le importe que estés feliz en la misma medida en la que a tí te importa que él sea feliz. Que pasaría? Yo creo que si así fuera, si todas las mujeres tuviéramos amor propio y erradicáramos la necesidad de tener un hombre en nuestras vidas como requisito indispensable para sentirnos felices y plenas, eventualmente los hombres tendrían que modificar patrones de conducta y aprender a respetar las necesidades de las mujeres en la misma medida que respetan y valoran las suyas. Los hombres que quisieran tener una pareja (que son la mayoría en mi opinión) tendrían que aprender que los sentimientos y necesidades de las mujeres son igual de importantes que los suyos, que las necesidades de las mujeres no son tonterías propias del género femenino y que sus acciones tienen consecuencias que no se resuelven con "la novia/esposa/amante nueva que es mejor que la anterior porque le aguanta todo". Y también creo que una vez que esas relaciones sentimentales entre hombres y mujeres fueran más equilibradas, nuestra sociedad podría avanzar a pasos agigantados. Por eso con gusto veo con más frecuencia mujeres empoderadas que ya no aceptan relaciones abusivas, que ya no buscan justificar el mal actuar de sus parejas y que deciden disfrutar y gozar su vida, con o sin pareja, por igual. Esas mujeres, muchas siquiera sin saberlo, poco a poco, están formando un nuevo futuro, un nuevo abanico de posibilidades en el que tanto hombres y mujeres, puedan relacionarse con verdadero respeto y amor, el uno por el otro. Y tu, qué opinas?  ', '89430171.image32.jpg', NULL, 0, '2016-08-11 16:47:40', '2016-08-11 16:47:40', 1),
	(6, 5, NULL, NULL, NULL, 'post_927fd38293fd8695c09e4fb13aaec46b57b216f6b9686', 'La Lista Completa de la primera temporada de Atando Cabos que se cargará está en el link: ', '89430171.image32.jpg', 'https://www.youtube.com/watch?v=_tv7RttRQcs&feature=youtu.be&list=PLPfjqq4-lB3R4WJ7U80RgObjR5fcdwQes ', 0, '2016-08-11 16:52:33', '2016-08-11 16:52:33', 1),
	(7, 7, NULL, NULL, NULL, 'post_f670469a9d8e7b36156059095219303a57b216eedeb5d', 'Art. 27 Constitucional:  La propiedad de las tierras y aguas comprendidas dentro de los límites del territorio nacional, corresponde originariamente a la Nación,\r\n la cual ha tenido y tiene el derecho de transmitir el dominio de ellas a los particulares, constituyendo la propiedad privada.  \r\n\r\nEn este video podemos apreciar que se viola el derecho constitucional que tenemos las personas en México a disfrutar de las playas en nuestro país. Sólo se puede restringir el acceso a la propiedad privada y es obligación de las personas con propiedad privada colindante con playas dar acceso a dichos bienes. Además, nuestra constitución dice que la Nación es única, indivisible y  pluricultural con origen indígena. Entonces ¿qué está pasando? Porque sabemos que lo que muestra el video es demasiado común y sabemos lo que dice la Constitución. Pasa, que las autoridades locales no exigen a los dueños de propiedades privadas que respeten el acceso a las playas. Por eso la propuesta es que, \r\n-	Sólo por hoy: las autoridades no autoricen un proyecto de construcción sin acceso a la playa, \r\n-	Sólo por hoy: los dueños de propiedad privada respeten el derecho de las demás personas a disfrutar de la playa \r\n-	Sólo por hoy: los empleados de un hotel no obedezcan órdenes que violen los derechos de las personas en México para acceder libremente a las playas\r\n-	Sólo por hoy: todas las personas en México recordemos que nuestra Nación es única, indivisible y pluricultural con origen indígena. Es de ignorantes discriminar. \r\n', '89430171.image32.jpg', 'https://www.facebook.com/Supercivicosmx/videos/1024540524291270/ ', 0, '2016-08-11 17:06:25', '2016-08-11 17:06:25', 1),
	(8, 6, NULL, NULL, NULL, 'post_9f492bcca04320be74e1289a105c2c4857b216dd7293c', 'La reforma energética prometió bajar los precios de la gasolina y la luz para el consumidor final mediante el fomento de la competencia que no permitía nuestra Constitución cuando sólo el Estado con PEMEX podía explotar petróleo en el país. Seguramente los precios bajarán en 2018 según lo estimado, considerando claro que ya se han incrementado bastante los precios desde que se autorizó la reforma y tomando en cuenta que el incremento se creó artificialmente para 1) justificar una reforma energética y 2) mantener el ingreso alto al presupuesto Federal ante la caída del precio del petróleo. En pocas palabras, te lo subo ahora para luego venderte la idea de que te lo bajé después, al más puro estilo de las ofertas del “buen fin”. Por otro lado, que no te extrañe escuchar que no hay papel para imprimir tu trámite gubernamental porque se recortó el presupuesto en gasto corriente. Mientras tanto, se mantienen sueldos altos de los funcionarios y en duda queda la calidad moral del Congreso para exigir justificación de los incrementos en precios cuando ellos mismos se determinan sus propios y jugosos sueldos. Finalmente queda la pregunta obligada ¿Cómo piensa competir en el mercado del petróleo el Estado con los nuevos proveedores si recortó 40% en la inversión que usualmente arrastra la innovación?', '89430171.image32.jpg', NULL, 0, '2016-08-11 17:50:23', '2016-08-11 17:50:23', 1);
/*!40000 ALTER TABLE `ent_posts` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.ent_respuestas_espejo
CREATE TABLE IF NOT EXISTS `ent_respuestas_espejo` (
  `id_post` int(10) unsigned NOT NULL,
  `txt_respuesta` text NOT NULL,
  `fch_respuesta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fch_publicacion_respuesta` timestamp NULL DEFAULT NULL,
  `b_de_acuerdo` int(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  CONSTRAINT `FK__ent_espejos` FOREIGN KEY (`id_post`) REFERENCES `ent_espejos` (`id_post`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.ent_respuestas_espejo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_respuestas_espejo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ent_respuestas_espejo` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.ent_solo_por_hoys
CREATE TABLE IF NOT EXISTS `ent_solo_por_hoys` (
  `id_post` int(10) unsigned NOT NULL,
  `num_articulo` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_post`),
  CONSTRAINT `FK__ent_posts` FOREIGN KEY (`id_post`) REFERENCES `ent_posts` (`id_post`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.ent_solo_por_hoys: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_solo_por_hoys` DISABLE KEYS */;
INSERT INTO `ent_solo_por_hoys` (`id_post`, `num_articulo`) VALUES
	(7, 7);
/*!40000 ALTER TABLE `ent_solo_por_hoys` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.ent_usuarios_feedbacks
CREATE TABLE IF NOT EXISTS `ent_usuarios_feedbacks` (
  `id_comentario` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_tipo_feedback` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_comentario`,`id_usuario`,`id_tipo_feedback`),
  KEY `FK_ent_usuarios_feedbacks_mod_usuarios_ent_usuarios` (`id_usuario`),
  KEY `FK_ent_usuarios_feedbacks_cat_tipos_feedback` (`id_tipo_feedback`),
  CONSTRAINT `FK_ent_usuarios_feedbacks_ent_comentarios_posts` FOREIGN KEY (`id_comentario`) REFERENCES `ent_comentarios_posts` (`id_comentario_post`) ON DELETE CASCADE,
  CONSTRAINT `FK_ent_usuarios_feedbacks_mod_usuarios_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `FK_ent_usuarios_feedbacks_cat_tipos_feedback` FOREIGN KEY (`id_tipo_feedback`) REFERENCES `cat_tipos_feedback` (`id_tipo_feedback`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.ent_usuarios_feedbacks: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_usuarios_feedbacks` DISABLE KEYS */;
INSERT INTO `ent_usuarios_feedbacks` (`id_comentario`, `id_usuario`, `id_tipo_feedback`) VALUES
	(22, 25, 1),
	(22, 25, 2),
	(22, 25, 3);
/*!40000 ALTER TABLE `ent_usuarios_feedbacks` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.ent_usuarios_like_post
CREATE TABLE IF NOT EXISTS `ent_usuarios_like_post` (
  `id_post` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_post`,`id_usuario`),
  KEY `FK_ent_usuarios_like_post_mod_usuarios_ent_usuarios` (`id_usuario`),
  CONSTRAINT `FK_ent_usuarios_like_post_ent_posts` FOREIGN KEY (`id_post`) REFERENCES `ent_posts` (`id_post`),
  CONSTRAINT `FK_ent_usuarios_like_post_mod_usuarios_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.ent_usuarios_like_post: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_usuarios_like_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `ent_usuarios_like_post` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.ent_usuarios_subscripciones
CREATE TABLE IF NOT EXISTS `ent_usuarios_subscripciones` (
  `id_post` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `b_leido` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_post`,`id_usuario`),
  KEY `FK_ent_usuarios_subscripciones_mod_usuarios_ent_usuarios` (`id_usuario`),
  CONSTRAINT `FK_ent_usuarios_subscripciones_ent_espejos` FOREIGN KEY (`id_post`) REFERENCES `ent_espejos` (`id_post`) ON DELETE CASCADE,
  CONSTRAINT `FK_ent_usuarios_subscripciones_mod_usuarios_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.ent_usuarios_subscripciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_usuarios_subscripciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `ent_usuarios_subscripciones` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.mod_usuarios_cat_status_sesiones
CREATE TABLE IF NOT EXISTS `mod_usuarios_cat_status_sesiones` (
  `id_status` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_nombre` varchar(50) NOT NULL COMMENT 'Estatus de la sesión',
  `txt_descripcion` varchar(500) DEFAULT NULL COMMENT 'Descripción del elemento',
  `b_habilitado` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Booleano para saber si el registro esta habilitado',
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.mod_usuarios_cat_status_sesiones: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_cat_status_sesiones` DISABLE KEYS */;
INSERT INTO `mod_usuarios_cat_status_sesiones` (`id_status`, `txt_nombre`, `txt_descripcion`, `b_habilitado`) VALUES
	(1, 'Sesión iniciada', 'Sesión se ha iniciado y se encuentra activa', 1),
	(2, 'Sesión finalizada', 'Sesión se ha finalizado correctamente', 1),
	(3, 'Sesión finalizada incorrectamente', 'Sesión se ha finalizado por tiempo de expiración u otro problema', 1);
/*!40000 ALTER TABLE `mod_usuarios_cat_status_sesiones` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.mod_usuarios_cat_status_usuarios
CREATE TABLE IF NOT EXISTS `mod_usuarios_cat_status_usuarios` (
  `id_status` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_nombre` varchar(50) NOT NULL COMMENT 'Estatus del usuario',
  `txt_descripcion` varchar(500) DEFAULT NULL COMMENT 'Descripción del elemento',
  `b_habilitado` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Booleano para saber si el registro esta habilitado',
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.mod_usuarios_cat_status_usuarios: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_cat_status_usuarios` DISABLE KEYS */;
INSERT INTO `mod_usuarios_cat_status_usuarios` (`id_status`, `txt_nombre`, `txt_descripcion`, `b_habilitado`) VALUES
	(1, 'Pendiente activacion', 'Usuario se ha registrado pero aún no activa su cuenta', 1),
	(2, 'Usuario activado', 'Usuario ha activado su cuenta', 1),
	(3, 'Usuario bloqueado', 'Usuario bloqueado', 1);
/*!40000 ALTER TABLE `mod_usuarios_cat_status_usuarios` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.mod_usuarios_ent_sesiones
CREATE TABLE IF NOT EXISTS `mod_usuarios_ent_sesiones` (
  `id_sesion` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL COMMENT 'Id del usuario que inicio sesión',
  `id_status` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Status de la sesión',
  `fch_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que el usuario inicio sesión',
  `fch_logout` timestamp NULL DEFAULT NULL COMMENT 'Fecha en la que el usuario finalizo la sesión',
  `num_minutos_sesion` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Minutos que duraro la sesión del usuario',
  `txt_ip` varchar(32) NOT NULL COMMENT 'Ip de donde se conecto el usuario',
  `txt_ip_logout` varchar(32) DEFAULT NULL COMMENT 'Ip de donde el usuario se desconecto',
  PRIMARY KEY (`id_sesion`),
  KEY `FK_ent_sesiones_cat_status_sesiones` (`id_status`),
  KEY `FK_ent_sesiones_ent_usuarios` (`id_usuario`),
  CONSTRAINT `FK_ent_sesiones_cat_status_sesiones` FOREIGN KEY (`id_status`) REFERENCES `mod_usuarios_cat_status_sesiones` (`id_status`),
  CONSTRAINT `FK_ent_sesiones_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.mod_usuarios_ent_sesiones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_ent_sesiones` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_usuarios_ent_sesiones` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.mod_usuarios_ent_usuarios
CREATE TABLE IF NOT EXISTS `mod_usuarios_ent_usuarios` (
  `id_usuario` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_tipo_usuario` int(10) unsigned NOT NULL DEFAULT '1',
  `txt_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `txt_username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `txt_apellido_paterno` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_apellido_materno` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_imagen` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `txt_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `txt_password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fch_creacion` datetime DEFAULT NULL,
  `fch_actualizacion` datetime DEFAULT NULL,
  `id_status` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`txt_email`),
  UNIQUE KEY `txt_token` (`txt_token`),
  UNIQUE KEY `password_reset_token` (`txt_password_reset_token`),
  KEY `FK_ent_usuarios_cat_status_usuarios` (`id_status`),
  KEY `FK_mod_usuarios_ent_usuarios_cat_tipos_usuarios` (`id_tipo_usuario`),
  CONSTRAINT `FK_mod_usuarios_ent_usuarios_cat_tipos_usuarios` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `cat_tipos_usuarios` (`id_tipo_usuario`),
  CONSTRAINT `FK_ent_usuarios_cat_status_usuarios` FOREIGN KEY (`id_status`) REFERENCES `mod_usuarios_cat_status_usuarios` (`id_status`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla charlenetas_geekdb.mod_usuarios_ent_usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios` DISABLE KEYS */;
INSERT INTO `mod_usuarios_ent_usuarios` (`id_usuario`, `id_tipo_usuario`, `txt_token`, `txt_username`, `txt_apellido_paterno`, `txt_apellido_materno`, `txt_imagen`, `txt_auth_key`, `txt_password_hash`, `txt_password_reset_token`, `txt_email`, `fch_creacion`, `fch_actualizacion`, `id_status`) VALUES
	(18, 1, 'usr4b41842f47272f78d0b8dcff7b11f30257abb1fe02b62', 'humberto', 'Antonio', 'Marquez', 'humberto.png', 'HGYeSCW_BQp-CoB3tL0C2IHhXreFwdVC', '$2y$13$HXZ0bqNZ5vps36IpeT7ztuejKLTRGKpIcUVuFhu0m/mzvyT6TDaxO', NULL, '2GomDev@2gom.com.mx', '2016-08-10 18:00:14', NULL, 2),
	(25, 1, 'usra6f65e11a13def539972e900c15c586e57b5ffb576ed8', 'Humberto', 'Antonio', 'Marquez', 'ava127c9f55dbc4839b4894f1732052e24757b5ffb56dfb1.jpg', '10yHObCmcDsrbQsHfZHSUAcy0nLkRTBC', '$2y$13$56K/rEzin8tqYki94MUMTOGVNfvc03C74dKFmD80DlyEeRSBdtqQe', NULL, 'humberto@2gom.com.mx', '2016-08-18 13:34:30', NULL, 2);
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.mod_usuarios_ent_usuarios_activacion
CREATE TABLE IF NOT EXISTS `mod_usuarios_ent_usuarios_activacion` (
  `id_usuario_activacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `txt_token` varchar(60) NOT NULL,
  `txt_ip_activacion` varchar(60) DEFAULT NULL,
  `fch_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fch_activacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario_activacion`),
  UNIQUE KEY `txt_token` (`txt_token`),
  KEY `FK_ent_usuarios_activacion_ent_usuarios` (`id_usuario`),
  CONSTRAINT `FK_ent_usuarios_activacion_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.mod_usuarios_ent_usuarios_activacion: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_activacion` DISABLE KEYS */;
INSERT INTO `mod_usuarios_ent_usuarios_activacion` (`id_usuario_activacion`, `id_usuario`, `txt_token`, `txt_ip_activacion`, `fch_creacion`, `fch_activacion`) VALUES
	(9, 18, 'act260bcc95aebc4b8ea955768d22c98e4557abb1fef1c5a', '::1', '2016-08-10 18:00:14', '2016-08-10 18:03:37'),
	(13, 25, 'act6d1137f8619eb4fde364e4e5235b3ed257b5ffb6c8752', NULL, '2016-08-18 13:34:30', NULL);
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_activacion` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.mod_usuarios_ent_usuarios_cambio_pass
CREATE TABLE IF NOT EXISTS `mod_usuarios_ent_usuarios_cambio_pass` (
  `id_usuario_cambio_pass` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `txt_token` varchar(60) NOT NULL COMMENT 'Token del registro',
  `txt_ip` varchar(20) NOT NULL COMMENT 'Ip del usuario donde pidio el cambio de pass',
  `txt_ip_cambio` varchar(20) DEFAULT NULL COMMENT 'Ip del usuario donde cambio el pass',
  `fch_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creacion de registro',
  `fch_finalizacion` timestamp NULL DEFAULT NULL COMMENT 'Fecha de expiracion de la solicitud de cambio de pass',
  `fch_peticion_usada` timestamp NULL DEFAULT NULL COMMENT 'Fecha en la cual se utilizo la peticion',
  `b_usado` int(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Booleano para saber si el usuario ha usado la peticion',
  PRIMARY KEY (`id_usuario_cambio_pass`),
  KEY `FK_ent_usuarios_cambio_pass_ent_usuarios` (`id_usuario`),
  CONSTRAINT `FK_ent_usuarios_cambio_pass_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.mod_usuarios_ent_usuarios_cambio_pass: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_cambio_pass` DISABLE KEYS */;
INSERT INTO `mod_usuarios_ent_usuarios_cambio_pass` (`id_usuario_cambio_pass`, `id_usuario`, `txt_token`, `txt_ip`, `txt_ip_cambio`, `fch_creacion`, `fch_finalizacion`, `fch_peticion_usada`, `b_usado`) VALUES
	(10, 25, 'sol04a78867f3c0e967f5da36e7800851c857b6000ce6e0e', '::1', NULL, '2016-08-18 13:35:56', '2016-08-20 13:35:56', NULL, 0);
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_cambio_pass` ENABLE KEYS */;


-- Volcando estructura para tabla charlenetas_geekdb.mod_usuarios_ent_usuarios_facebook
CREATE TABLE IF NOT EXISTS `mod_usuarios_ent_usuarios_facebook` (
  `id_usuario_facebook` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_facebook` bigint(20) NOT NULL,
  `txt_url_photo` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_facebook`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  UNIQUE KEY `id_facebook` (`id_facebook`),
  CONSTRAINT `FK_ent_usuarios_facebook_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla charlenetas_geekdb.mod_usuarios_ent_usuarios_facebook: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_facebook` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_facebook` ENABLE KEYS */;


-- Volcando estructura para vista charlenetas_geekdb.view_contador_feedback_comentarios
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_contador_feedback_comentarios` (
	`num_usuarios` BIGINT(21) NOT NULL,
	`id_comentario` INT(10) UNSIGNED NOT NULL,
	`id_tipo_feedback` INT(10) UNSIGNED NOT NULL
) ENGINE=MyISAM;


-- Volcando estructura para vista charlenetas_geekdb.view_contador_feedback_comentarios
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_contador_feedback_comentarios`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `charlenetas_geekdb`.`view_contador_feedback_comentarios` AS select count(*) as num_usuarios, id_comentario, id_tipo_feedback 
from ent_usuarios_feedbacks
group by id_tipo_feedback, id_comentario ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
