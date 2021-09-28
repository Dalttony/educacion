-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2021 a las 21:08:16
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `academia.db`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_COMBO_ROL` ()  SELECT
rol.rol_id,
rol.rol_nombre
FROM
rol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_COMBO_ROL_ESTUDIANTE` ()  SELECT
rol.rol_id,
rol.rol_nombre
FROM
rol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_ESTUDIANTES` ()  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=0;
SELECT
@CANTIDAD:=@CANTIDAD + 1 AS posicion,
usuario.usu_id, 
usuario.cedula,
usuario.usu_nombre_completo,
usuario.usu_sexo,
usuario.usu_email,
institucion.nombre,
grado.grado,
usuario.usu_nombre,
usuario.usu_puntos_ex,
usuario.usu_puntos_sem,
usuario.usu_nivel

 
FROM
usuario
INNER JOIN rol ON usuario.rol_id = rol.rol_id
INNER JOIN institucion ON usuario.id_institucion = institucion.id_institucion
INNER JOIN grado ON usuario.id_grado = grado.id_grado
WHERE rol.rol_id = 2;
 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_GRADOS` ()  SELECT
grado.id_grado,
grado.grado
FROM
grado$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_INSTITUCIONES` ()  SELECT
institucion.id_institucion,
institucion.nombre
FROM
institucion$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_TABLA_CLASIFICACION` ()  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=0;
SELECT
@CANTIDAD:=@CANTIDAD + 1 AS posicion,
usuario.usu_nombre,
usuario.usu_puntos_sem,
usuario.usu_nivel
FROM
usuario
INNER JOIN rol ON usuario.rol_id = rol.rol_id
WHERE rol.rol_id = 2   
ORDER BY usuario.usu_puntos_sem DESC LIMIT 20;
 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LISTAR_USUARIO` ()  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=0;
SELECT
@CANTIDAD:=@CANTIDAD + 1 AS posicion,
usuario.usu_id,
usuario.usu_nombre,
usuario.usu_sexo,
usuario.usu_status,
usuario.usu_email,
rol.rol_nombre
FROM
usuario
INNER JOIN rol ON usuario.rol_id = rol.rol_id
WHERE usuario.rol_id = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_CONTRASEÑA_USUARIO` (IN `IDUSUARIO` INT, IN `CONTRA` VARCHAR(255))  UPDATE usuario SET
usu_contraseña=CONTRA
WHERE usu_id = IDUSUARIO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_DATOS_ESTUDIANTES` (IN `IDUSUARIO` INT, IN `SEXO` CHAR(1), IN `IDROL` INT, IN `EMAIL` VARCHAR(255), IN `NOMBRE` VARCHAR(50), IN `CEDULA` INT, IN `NOM_INST` INT, IN `CURSO` INT)  UPDATE usuario SET
usu_sexo = SEXO,
usu_email = EMAIL,
rol_id= IDROL,
usu_nombre_completo= NOMBRE,
cedula = CEDULA,
id_institucion = NOM_INST,
id_grado = CURSO
WHERE usu_id = IDUSUARIO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_Datos_USUARIO` (IN `IDUSUARIO` INT, IN `SEXO` CHAR(1), IN `IDROL` INT, IN `EMAIL` VARCHAR(255))  UPDATE usuario SET
usu_sexo = SEXO,
rol_id = IDROL,
usu_email = EMAIL

WHERE usu_id = IDUSUARIO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ESTATUS_USUARIO` (IN `IDUSUARIO` INT, IN `ESTATUS` VARCHAR(50))  UPDATE usuario SET
usu_status=ESTATUS
WHERE usu_id = IDUSUARIO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_ESTUDIANTES` (IN `USUARIO` VARCHAR(50), IN `CONTRA` VARCHAR(255), IN `SEXO` CHAR(1), IN `ROL` INT, IN `EMAIL` VARCHAR(255), IN `NOMBRE` VARCHAR(50), IN `CEDULA` INT, IN `INST` INT, IN `GRADO` INT)  BEGIN
DECLARE CANTIDAD INT; 
SET @CANTIDAD:=(SELECT count(*) from usuario where usu_nombre =  USUARIO or usu_email = EMAIL );
IF @CANTIDAD=0 THEN
INSERT INTO usuario(usu_nombre,usu_contraseña,usu_sexo,rol_id,usu_status,usu_email ,usu_nombre_completo, cedula,id_institucion,id_grado , usu_puntos_ex,usu_puntos_sem,usu_nivel) VALUES (USUARIO,CONTRA,SEXO,ROL,'ACTIVO' , EMAIL , NOMBRE , CEDULA ,  INST , GRADO , 1, 1 , 1 );
 
SELECT 1;
ELSE
SELECT 2;
END IF;
 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_USUARIOS` (IN `USU` VARCHAR(20), IN `CONTRA` VARCHAR(255), IN `SEXO` CHAR(1), IN `ROL` INT, IN `EMAIL` VARCHAR(255))  BEGIN
DECLARE CANTIDAD INT;  
SET@CANTIDAD:=(SELECT count(*) from usuario where usu_nombre = BINARY USU or usu_email = EMAIL );
IF @CANTIDAD=0 THEN
 INSERT INTO usuario(usu_nombre,usu_contraseña,usu_sexo,rol_id,usu_status,usu_email , id_institucion , id_grado) VALUES (USU,CONTRA,SEXO,ROL,'ACTIVO' , EMAIL , 1 , 1 );


SELECT 1;
ELSE
SELECT 2;
END IF;
 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RESTABLECER_CONTRASEÑA` (IN `EMAIL` VARCHAR(255), IN `CONTRA` VARCHAR(255))  BEGIN
DECLARE CANTIDAD INT ;
SET @CANTIDAD:=(SELECT COUNT(*) from usuario WHERE usu_email = EMAIL);
IF @CANTIDAD > 0 THEN
UPDATE usuario SET
usu_contraseña=CONTRA
WHERE usu_email = EMAIL;
SELECT 1;
ELSE
SELECT 2;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VERIFICAR_ESTUDIANTE` (IN `CEDULA` INT)  SELECT
usuario.usu_id,
usuario.cedula,
usuario.usu_nombre_completo,
usuario.usu_nombre,
rol.rol_nombre
FROM
usuario
 
INNER JOIN rol ON usuario.rol_id = rol.rol_id
WHERE usuario.cedula = BINARY CEDULA AND usuario.rol_id = 2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VERIFICAR_USUARIO` (IN `USUARIO` VARCHAR(50))  SELECT
usuario.usu_id,
usuario.usu_nombre,
usuario.`usu_contraseña`,
usuario.usu_sexo,
usuario.rol_id,
usuario.usu_status,
usuario.usu_email,
rol.rol_nombre,
usuario.usu_nombre_completo,
usuario.cedula,
usuario.usu_puntos_ex,
usuario.usu_puntos_sem,
usuario.usu_nivel,
institucion.nombre,
grado.grado
FROM
usuario
INNER JOIN rol ON usuario.rol_id = rol.rol_id
INNER JOIN institucion ON usuario.id_institucion = institucion.id_institucion
INNER JOIN grado ON usuario.id_grado = grado.id_grado
WHERE usu_nombre = BINARY USUARIO$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desafio`
--

CREATE TABLE `desafio` (
  `id_desafio` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id_grado` int(11) NOT NULL,
  `grado` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `grado`, `fecha_creacion`) VALUES
(1, 9, '2021-09-15 00:00:00'),
(2, 10, '2021-09-15 00:00:00'),
(3, 11, '2021-09-15 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id_institucion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id_institucion`, `nombre`, `fecha_creacion`) VALUES
(1, 'IE FEMENINA DE ENSEÑANZA MEDIA IEFEM', '2021-09-15 00:00:00'),
(2, 'TÉCNICA INTEGRADO  CARRASQUILLA INDUSTRIAL CEDE-PR', '2021-09-15 00:00:00'),
(5, 'ANTONIO MARÍA CLARET', '2021-09-15 00:00:00'),
(6, 'ARMANDO LUNA ROA CEDE PRINCIPAL', '2021-09-15 00:00:00'),
(7, 'NORMAL SUPERIOR DE QUIBDO', '2021-09-15 00:00:00'),
(8, 'GIMNASIO DE QUIBDÓ CEDE PRINCIPAL', '2021-09-15 00:00:00'),
(9, 'SANTO DE DOMINGO GUZMÁN CEDE PRINCIPAL', '2021-09-15 00:00:00'),
(10, 'MANUEL AGUSTÍN SATACOLOMA VILLA CEDE PRINCIPAL', '2021-09-15 00:00:00'),
(11, 'JOSÉ CARMEN DEL CUESTA RENTERIA CEDE PRINCIPAL', '2021-09-15 00:00:00'),
(12, 'MÍA ROGELIO VELÁSQUEZ MURILLO CEDE PRINCIPAL', '2021-09-15 00:00:00'),
(13, 'DIOCESANO PEDRO GRAU Y AROLA CEDE PRINCIPAL', '2021-09-15 00:00:00'),
(14, 'ISAAC RODRÍGUEZ MARTÍNEZ', '2021-09-15 00:00:00'),
(15, 'TÉCNICA ANTONIO RICAURTE', '2021-09-15 00:00:00'),
(16, 'MIGUEL ANTONIO CAICEDO MENA ', '2021-09-15 00:00:00'),
(17, 'SANTO DOMINGO SAVIO CEDE PRINCIPAL', '2021-09-15 00:00:00'),
(18, 'NORMAL SUPERIOR MANUEL CAÑIZALES', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego`
--

CREATE TABLE `juego` (
  `id_juego` int(11) NOT NULL,
  `tipo_juego_id` int(11) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `id_nivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego_blockly`
--

CREATE TABLE `juego_blockly` (
  `id_blockly` int(11) NOT NULL,
  `problema` varchar(250) DEFAULT NULL,
  `juego_id` int(11) DEFAULT NULL,
  `archivo` varchar(250) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `id_nivel` int(11) NOT NULL,
  `nivel` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `objetivo` varchar(250) DEFAULT NULL,
  `competencia` varchar(250) DEFAULT NULL,
  `id_desafio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id_pregunta` int(11) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `respuestas_coreccta` int(11) DEFAULT NULL,
  `juego_id` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros_preguntas_sin_responder`
--

CREATE TABLE `registros_preguntas_sin_responder` (
  `ID` int(11) NOT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `id_pregunta` int(11) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_juego`
--

CREATE TABLE `registro_juego` (
  `id_registro` int(11) NOT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `id_pregunta` int(11) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id_respuesta` int(11) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `id_pregunta` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nombre`) VALUES
(1, 'ADMIN'),
(2, 'INVITADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_dato_blockly`
--

CREATE TABLE `tipo_dato_blockly` (
  `id_tipo_blockly` int(11) NOT NULL,
  `bombre` varchar(250) DEFAULT NULL,
  `id_blockly` int(11) DEFAULT NULL,
  `archivo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_juego`
--

CREATE TABLE `tipo_juego` (
  `id_tipo` int(11) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_nombre` varchar(20) DEFAULT NULL,
  `usu_contraseña` varchar(255) DEFAULT NULL,
  `usu_sexo` varchar(1) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `usu_status` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
  `usu_email` varchar(255) DEFAULT NULL,
  `usu_nombre_completo` varchar(20) DEFAULT NULL,
  `cedula` int(10) DEFAULT NULL,
  `id_institucion` int(11) DEFAULT NULL,
  `id_grado` int(11) DEFAULT NULL,
  `usu_puntos_ex` int(11) DEFAULT NULL,
  `usu_puntos_sem` int(11) DEFAULT NULL,
  `usu_nivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_nombre`, `usu_contraseña`, `usu_sexo`, `rol_id`, `usu_status`, `usu_email`, `usu_nombre_completo`, `cedula`, `id_institucion`, `id_grado`, `usu_puntos_ex`, `usu_puntos_sem`, `usu_nivel`) VALUES
(1, 'admin', '$2y$10$WAt8.HqnLLyyYAUyJFdkX.q9kIhA.NA2SaEgU/dQnaVKIGWI2rqte', 'M', 1, 'ACTIVO', 'dinopalacios12@gmail.com', NULL, NULL, 5, 1, NULL, NULL, NULL),
(4, 'dino', '$10$WAt8.HqnLLyyYAUyJFdkX.q9kIhA.NA2SaEgU/dQnaVKIGWI2rqte', 'M', 2, 'ACTIVO', 'dino@gmail.com', 'dino palacio pino', 1077466118, 1, 1, 1, 1, 1),
(5, 'pedro', '$2y$10$MWJo.Y3ViUL74O82W1lgleWibDBbe97l6zdSEoNHfjIrhkg3o6n0a', 'M', 2, 'ACTIVO', 'pedro@gmail.com', 'pedro', 1088466118, 5, 1, 1, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `desafio`
--
ALTER TABLE `desafio`
  ADD PRIMARY KEY (`id_desafio`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id_institucion`);

--
-- Indices de la tabla `juego`
--
ALTER TABLE `juego`
  ADD PRIMARY KEY (`id_juego`),
  ADD KEY `tipo_juego` (`tipo_juego_id`),
  ADD KEY `fk_nivel` (`id_nivel`);

--
-- Indices de la tabla `juego_blockly`
--
ALTER TABLE `juego_blockly`
  ADD PRIMARY KEY (`id_blockly`),
  ADD KEY `fk_juego` (`juego_id`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`id_nivel`),
  ADD KEY `desafio` (`id_desafio`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `fk_juegos` (`juego_id`);

--
-- Indices de la tabla `registros_preguntas_sin_responder`
--
ALTER TABLE `registros_preguntas_sin_responder`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_users` (`usu_id`),
  ADD KEY `FK_preguntas` (`id_pregunta`);

--
-- Indices de la tabla `registro_juego`
--
ALTER TABLE `registro_juego`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `fk_user` (`usu_id`),
  ADD KEY `FK_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `fk_respuestas` (`id_pregunta`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `tipo_dato_blockly`
--
ALTER TABLE `tipo_dato_blockly`
  ADD PRIMARY KEY (`id_tipo_blockly`),
  ADD KEY `fk_blocly` (`id_blockly`);

--
-- Indices de la tabla `tipo_juego`
--
ALTER TABLE `tipo_juego`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `usuario_fk` (`rol_id`),
  ADD KEY `fk_inst` (`id_institucion`),
  ADD KEY `fk_grado` (`id_grado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `desafio`
--
ALTER TABLE `desafio`
  MODIFY `id_desafio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id_institucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `registro_juego`
--
ALTER TABLE `registro_juego`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_dato_blockly`
--
ALTER TABLE `tipo_dato_blockly`
  MODIFY `id_tipo_blockly` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `juego`
--
ALTER TABLE `juego`
  ADD CONSTRAINT `fk_nivel` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id_nivel`),
  ADD CONSTRAINT `tipo_juego` FOREIGN KEY (`tipo_juego_id`) REFERENCES `tipo_juego` (`id_tipo`);

--
-- Filtros para la tabla `juego_blockly`
--
ALTER TABLE `juego_blockly`
  ADD CONSTRAINT `fk_juego` FOREIGN KEY (`juego_id`) REFERENCES `juego` (`id_juego`);

--
-- Filtros para la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD CONSTRAINT `desafio` FOREIGN KEY (`id_desafio`) REFERENCES `desafio` (`id_desafio`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `fk_juegos` FOREIGN KEY (`juego_id`) REFERENCES `juego` (`id_juego`);

--
-- Filtros para la tabla `registros_preguntas_sin_responder`
--
ALTER TABLE `registros_preguntas_sin_responder`
  ADD CONSTRAINT `FK_preguntas` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`),
  ADD CONSTRAINT `FK_users` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`);

--
-- Filtros para la tabla `registro_juego`
--
ALTER TABLE `registro_juego`
  ADD CONSTRAINT `FK_pregunta` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`);

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `fk_respuestas` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`);

--
-- Filtros para la tabla `tipo_dato_blockly`
--
ALTER TABLE `tipo_dato_blockly`
  ADD CONSTRAINT `fk_blocly` FOREIGN KEY (`id_blockly`) REFERENCES `juego_blockly` (`id_blockly`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_grado` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`),
  ADD CONSTRAINT `fk_inst` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id_institucion`),
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
