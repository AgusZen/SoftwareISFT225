-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2024 a las 02:00:05
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `c1602068_isft225`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `ciclo_lectivo` int(5) NOT NULL,
  `carrera` varchar(30) NOT NULL,
  `dni_estudiante` int(11) NOT NULL,
  `nombres` varchar(20) NOT NULL,
  `id_asistencia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_docente` int(11) NOT NULL,
  `nombre_apellido` varchar(20) NOT NULL,
  `tipo_asistencia` varchar(20) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `denominacion_materia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id_carrera` int(10) UNSIGNED NOT NULL,
  `cod_carrera` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nro_resolucion` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_carrera` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `titulo_otorgado` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `duracion` int(2) UNSIGNED NOT NULL,
  `modalidad` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `carga_horaria` int(4) UNSIGNED DEFAULT NULL,
  `estado_carrera` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_duracion` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nivel` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id_carrera`, `cod_carrera`, `nro_resolucion`, `nombre_carrera`, `titulo_otorgado`, `duracion`, `modalidad`, `carga_horaria`, `estado_carrera`, `tipo_duracion`, `nivel`) VALUES
(12, '001', 'rm001', 'Tecnicatura en desarrollo de software', 'Teccnico superior en desarrollo de software', 3, 'presencial', 350, 'activo', 'año', '0'),
(32, '0023', 'rm0023', 'Tecnicatura superior de redes informÃ¡ticas', 'Tecnico superior en redes informaticas', 2, 'hibrido', 340, 'activo', 'año', NULL),
(33, '122141343', '12323214', '123232131', '4134342', 4324324, '32432423', 4294967295, 'activo', NULL, NULL),
(34, '1232312123', '321123', '13123232', '123232', 1332312132, '3213212323', 1233232213, 'activo', NULL, NULL),
(35, '056648', '5564844', 'Tecnico superior en Analisis de sistema', 'Analista de sistema', 3, 'hibrida', 450, 'activo', NULL, NULL),
(36, 'asdasd', 'asdasd', 'asdasd', 'asdasd', 1, 'asdasd', 2, 'activo', NULL, NULL),
(41, 'tabla2', 'tabla-221', 'Prueba tabla', 'Tablas', 5, 'presencial', 250, 'activo', 'mes', 'segundaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras_adicionales`
--

CREATE TABLE `carreras_adicionales` (
  `id_estudiante` int(10) UNSIGNED NOT NULL,
  `carrera` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `institucion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estudio_finalizado` tinyint(1) DEFAULT NULL,
  `anio_de_egreso` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `titulo_academico` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `carrera_2` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `institucion_2` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estudio_finalizado_2` tinyint(1) DEFAULT NULL,
  `anio_de_egreso_2` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `titulo_academico_2` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `carreras_adicionales`
--

INSERT INTO `carreras_adicionales` (`id_estudiante`, `carrera`, `institucion`, `estudio_finalizado`, `anio_de_egreso`, `titulo_academico`, `carrera_2`, `institucion_2`, `estudio_finalizado_2`, `anio_de_egreso_2`, `titulo_academico_2`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Tarde', 'Pero Seguro', 1, '2024', 'pruebas unitarias', NULL, NULL, NULL, NULL, NULL),
(5, 'Carrera', 'Institucion', 0, '2019', 'Titulo', NULL, NULL, NULL, NULL, NULL),
(6, 'Carrera', 'Institucion', 1, '2019', 'Titulo', NULL, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo_electivo`
--

CREATE TABLE `ciclo_electivo` (
  `id_ciclo_Electivo` int(10) UNSIGNED NOT NULL,
  `nombre_ciclo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativas`
--

CREATE TABLE `correlativas` (
  `id_correlativa` int(6) UNSIGNED NOT NULL,
  `id_materia` int(6) UNSIGNED NOT NULL,
  `materia_correlativa` int(6) UNSIGNED NOT NULL,
  `tipo_aprobacion_correlativa` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `correlativas`
--

INSERT INTO `correlativas` (`id_correlativa`, `id_materia`, `materia_correlativa`, `tipo_aprobacion_correlativa`) VALUES
(1, 13, 12, 2),
(2, 27, 2, 1),
(3, 27, 26, 1),
(4, 27, 26, 1),
(5, 13, 2, 1),
(6, 13, 2, 1),
(7, 13, 13, 2),
(8, 13, 13, 2),
(9, 13, 14, 1),
(13, 28, 14, 1),
(14, 12, 2, 1),
(15, 29, 27, 1),
(16, 30, 2, 2),
(17, 29, 2, 2),
(18, 30, 14, 1),
(20, 31, 14, 1),
(21, 29, 28, 1),
(49, 2, 15, 1),
(50, 2, 33, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursada`
--

CREATE TABLE `cursada` (
  `id_cursada` int(10) UNSIGNED NOT NULL,
  `id_estudiante` int(10) UNSIGNED NOT NULL,
  `id_ciclo_electivo` int(10) UNSIGNED NOT NULL,
  `estado_inscripcion` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado_materia` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `horario_cursada` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_materia` int(10) UNSIGNED DEFAULT NULL,
  `id_Carrera` int(10) UNSIGNED NOT NULL,
  `fecha_estado_materia` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursada_estudiante`
--

CREATE TABLE `cursada_estudiante` (
  `id_cursada_estudiante` int(10) UNSIGNED NOT NULL,
  `id_estudiante` int(10) UNSIGNED NOT NULL,
  `id_cursada` int(10) UNSIGNED NOT NULL,
  `nota_primer_cuatrimestre` float DEFAULT NULL,
  `nota_segundo_cuatrimestre` float DEFAULT NULL,
  `fecha_recuperatorio` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nota_recuperatorio` float DEFAULT NULL,
  `fecha_nota_final` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nota_final` float DEFAULT NULL,
  `estado_aprobacion_cursada` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doc_check`
--

CREATE TABLE `doc_check` (
  `id_estudiante` int(10) UNSIGNED NOT NULL,
  `doc_dni` tinyint(1) NOT NULL,
  `doc_medica` tinyint(1) NOT NULL,
  `analitico` tinyint(1) NOT NULL,
  `doc_nacimiento` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `doc_check`
--

INSERT INTO `doc_check` (`id_estudiante`, `doc_dni`, `doc_medica`, `analitico`, `doc_nacimiento`) VALUES
(1, 3, 1, 1, 1),
(2, 1, 0, 0, 0),
(3, 1, 0, 0, 0),
(4, 1, 0, 0, 0),
(5, 0, 0, 0, 0),
(6, 1, 1, 0, 0),
(7, 1, 1, 1, 1),
(8, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE `domicilio` (
  `id_domicilio` int(6) UNSIGNED NOT NULL,
  `calle` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `altura` int(6) NOT NULL,
  `edificio` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `piso` int(6) DEFAULT NULL,
  `departamento` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cp` int(5) NOT NULL,
  `localidad` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `partido` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `provincia` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id_estudiante` int(10) UNSIGNED NOT NULL,
  `nro_legajo` varchar(25) DEFAULT NULL,
  `tipo_documento` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `dni_estudiante` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `genero` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `pais_nacimiento` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lugar_nacimiento` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `familia_a_cargo` varchar(2) DEFAULT NULL,
  `hijos` varchar(2) DEFAULT NULL,
  `trabaja` varchar(2) DEFAULT NULL,
  `pais_dom` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `calle` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `numero` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `piso` int(2) DEFAULT NULL,
  `departamento` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `edificio` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `localidad` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `partido` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codigo_postal` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_escuela` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `titulo_secundario` varchar(2) DEFAULT NULL,
  `anio_de_egreso` int(4) NOT NULL,
  `titulo_certificado` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `titulo_tecnico` tinyint(1) NOT NULL,
  `titulo_hab` varchar(2) DEFAULT NULL,
  `documentacion_completa` varchar(12) DEFAULT NULL,
  `repositorio_documentacion` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `plan_carrera` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado_inscripcion` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado_estudiante` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `doc_dni` varchar(2) DEFAULT NULL,
  `doc_medico` varchar(2) DEFAULT NULL,
  `analitico` varchar(2) DEFAULT NULL,
  `doc_nacimiento` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_estudiante`, `nro_legajo`, `tipo_documento`, `dni_estudiante`, `nombre`, `apellido`, `email`, `telefono`, `genero`, `fecha_nacimiento`, `pais_nacimiento`, `lugar_nacimiento`, `familia_a_cargo`, `hijos`, `trabaja`, `pais_dom`, `provincia`, `calle`, `numero`, `piso`, `departamento`, `edificio`, `localidad`, `partido`, `codigo_postal`, `nombre_escuela`, `titulo_secundario`, `anio_de_egreso`, `titulo_certificado`, `titulo_tecnico`, `titulo_hab`, `documentacion_completa`, `repositorio_documentacion`, `plan_carrera`, `estado_inscripcion`, `estado_estudiante`, `observaciones`, `doc_dni`, `doc_medico`, `analitico`, `doc_nacimiento`) VALUES
(1, '24-001', 'DNI', '123456789', 'Juan', 'De ediciÃ³n', 'email@correo.com.ar', '123456789', 'Masculino', '2024-01-01', 'Argentina', 'Buenos Aires', '1', '0', '1', 'Argentina', 'Buenos Aires', 'Central', '330', 0, 'Departamen', 'GranEdificio', 'San Martin', 'General San Martin', '1655', 'Tupac', 'Eg', 2019, 'TÃ­tulo legalizado', 1, '1', '1', 'https://drive.google.com/open?id=', 'Seleccione', 'Completo', 'Activo', '', NULL, NULL, NULL, NULL),
(2, '24-002', 'DNI', '123456789', 'Pedro', 'Funcionamiento', 'prueba@unitaria.com', '123456789', 'Masculino', '2024-01-01', 'Argentina', 'Buenos Aires', '1', '0', '1', 'Argentina', 'Buenos Aires', 'Central', '330', 0, 'Departamen', 'GranEdificio', 'San Martin', 'General San Martin', '1655', 'Tupac', 'Eg', 2019, 'TÃ­tulo legalizado', 1, '1', '1', 'https://drive.google.com/open?id=1pRQPQP0FJsE-y4tjXx_TybzD10IivGT-', 'Seleccione', 'Completo', 'Activo', '', NULL, NULL, NULL, NULL),
(3, '24-003', 'DNI', '123456789', 'my full name', 'my apellido', 'email@correo.com', '123456789', 'Masculino', '2024-01-01', 'Argentina', 'Buenos Aires', '1', '0', '1', 'Argentina', 'Buenos Aires', 'Central', '330', 0, 'Departamen', 'GranEdificio', 'San Martin', 'General San Martin', '1655', 'Tupac', 'Eg', 2019, 'TÃ­tulo legalizado', 1, '1', '1', 'https://drive.google.com/open?id=1cWfwQoKkNKjOsxZP9-veCxHgCBHLP7Yp', 'Seleccione', 'Completo', 'Activo', '', NULL, NULL, NULL, NULL),
(4, '24-004', 'DNI', '123456789', 'Ya esta', 'Funcionando', 'elocho@deenero.com', '123456789', 'Masculino', '2024-01-01', 'Argentina', 'Buenos Aires', '1', '0', '1', 'Argentina', 'Buenos Aires', 'Central', '330', 0, 'Departamen', 'GranEdificio', 'San Martin', 'General San Martin', '1655', 'Tupac', 'Eg', 2019, 'Titulo legalizado', 1, '1', '0', 'https://drive.google.com/open?id=1YXXms6fQ1H7URbow3URQv88NOCjEUxA_', 'Seleccione', 'Completo', 'Activo', 'HELLO WORLD', NULL, NULL, NULL, NULL),
(5, '24-005', 'DNI', '331231231', 'my full name', 'my apellido', 'email@correo.com', '123456789', 'Masculino', '2024-01-01', 'Argentina', 'Buenos Aires', '1', '0', '1', 'Argentina', 'Buenos Aires', 'Central', '330', 0, 'Departamen', 'GranEdificio', 'San Martin', 'General San Martin', '1655', 'Tupac', 'Eg', 2019, 'TÃ­tulo legalizado', 1, '1', '0', 'https://drive.google.com/open?id=1vl8lQqgCy0gWMZJXl-zCc4Oj6KvUD9nc', 'Seleccione', 'Completo', 'Activo', '', NULL, NULL, NULL, NULL),
(6, '24-006', 'DNI', '123456789', 'my full name', 'my apellido', 'email@correo.com', '123456789', 'Masculino', '1988-06-15', 'Argentina', 'Buenos Aires', '1', '0', '1', 'Argentina', 'Buenos Aires', 'Central', '330', 0, 'Departamen', 'GranEdificio', 'San Martin', 'General San Martin', '1655', 'Tupac', 'Eg', 2019, 'TÃ­tulo legalizado', 1, '1', '1', 'https://drive.google.com/open?id=1qTTgnthUgp4b_3LC9MVy4sxQxhL004df', 'Seleccione', 'Completo', 'Activo', '', NULL, NULL, NULL, NULL),
(7, '24-007', 'DNI', '123456789', 'Febrero', 'Primero', 'email@correo.com', '123456789', 'Masculino', '1988-06-15', 'Argentina', 'Buenos Aires', '1', '0', '1', 'Argentina', 'Buenos Aires', 'Central', '330', 0, 'Departamen', 'GranEdificio', 'San Martin', 'General San Martin', '1655', 'Tupac', 'Eg', 2019, 'Titulo legalizado', 1, '1', '1', 'https://drive.google.com/open?id=1RqS0ljJhhOy0FQniZNbqmWFHOlzHMKCo', 'Seleccione', 'Completo', 'Activo', 'HELLO WORLD', NULL, NULL, NULL, NULL),
(8, '24-008', 'DNI', '123456789', 'my full name', 'my apellido', 'email@correo.com', '123456789', 'Masculino', '1988-06-15', 'Argentina', 'Buenos Aires', '1', '0', '1', 'Argentina', 'Buenos Aires', 'Central', '330', 0, 'Departamen', 'GranEdificio', 'San Martin', 'General San Martin', '1655', 'Tupac', 'Eg', 2019, 'Titulo legalizado', 1, '1', '0', 'https://drive.google.com/open?id=1eZQdmOUppjiKNuooubfMfuriN0zddmFv', 'Seleccione', 'Completo', 'Activo', 'HELLO WORLD', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante_carrera`
--

CREATE TABLE `estudiante_carrera` (
  `id_matricula` int(10) UNSIGNED NOT NULL,
  `id_estudiante` int(10) UNSIGNED NOT NULL,
  `id_carrera` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante_materia`
--

CREATE TABLE `estudiante_materia` (
  `id_matricula` int(10) UNSIGNED NOT NULL,
  `id_estudiante` int(10) UNSIGNED NOT NULL,
  `id_materia` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(10) UNSIGNED NOT NULL,
  `cod_num` int(11) NOT NULL,
  `cod_alpha` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `denominacion_materia` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_aprobacion` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nota_min_aprobacion` float DEFAULT NULL,
  `correlatividades` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado_materia` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `campo_formativo` varchar(50) CHARACTER SET utf16 COLLATE utf16_spanish_ci NOT NULL,
  `carga_horaria_materia` int(10) UNSIGNED NOT NULL,
  `id_carrera` int(10) UNSIGNED NOT NULL,
  `anio_carrera` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `cod_num`, `cod_alpha`, `denominacion_materia`, `tipo_aprobacion`, `nota_min_aprobacion`, `correlatividades`, `estado_materia`, `campo_formativo`, `carga_horaria_materia`, `id_carrera`, `anio_carrera`) VALUES
(2, 1, 'prI', 'Introducción a la programación', 'Promoción', 4, 'No', '1', 'practica', 234, 32, 1),
(12, 1, 'BBD', 'Base de datos', 'Promoción', 4, 'Si', '1', 'fundamento', 23, 35, 1),
(13, 1, 'SIST', 'Sistemas Operativos', 'Promoción', 4, 'No', '1', 'fundamento', 4, 32, 1),
(14, 1, 'AMAT', 'Analisis Matematico', 'Promoción', 4, 'No', '1', 'fundamento', 345, 12, 1),
(15, 1, 'SIDI', 'Sistemas Digitales', 'Promoción', 4, 'No', '1', 'fundamento', 456, 12, 1),
(16, 1, 'LAB', 'Laboratorio de Hardware', 'Final', 4, 'No', '1', 'fundamento', 345, 12, 1),
(27, 1, 'PRAC1', 'Prácticas profecionalizantes', 'Final', 4, 'No', '1', 'fundamento', 123, 12, 1),
(28, 2, 'EST', 'Estadística y probabilidad', 'Promoción', 4, 'Si', '1', 'especifico', 123, 12, 2),
(29, 2, 'PRAC II', 'Prácticas profecionalizantes II', 'Promoción', 4, 'Si', '1', 'practica', 234, 12, 2),
(30, 2, 'APLIC', 'Desarrollo de Aplicativos Móviles ', 'Promoción', 4, 'Si', '1', 'general', 123, 12, 2),
(31, 2, 'ALGE', 'Algebra y Lógica', 'Promoción', 4, 'Si', '1', 'general', 56, 12, 2),
(32, 2, 'ING', 'Ingles I', 'Promoción', 4, 'No', 'Activo', 'fundamento', 60, 12, 2),
(33, 2, 'POO', 'Programación Orientada a Objetos', 'Final', 4, 'Si', 'Activo', 'fundamento', 34, 12, 2),
(34, 2025, 'testssssss', 'carreta', 'Final', 4, 'No', 'Activo', 'especifico', 250, 12, NULL),
(35, 75, 'test', 'Carrera de prueba', 'Promoción', 4, 'Si', 'Activo', 'fundamento', 65, 35, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_carrera`
--

CREATE TABLE `materia_carrera` (
  `id_materia` int(10) UNSIGNED NOT NULL,
  `id_carrera` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `materia_carrera`
--

INSERT INTO `materia_carrera` (`id_materia`, `id_carrera`) VALUES
(12, 12),
(13, 12),
(14, 12),
(14, 35),
(15, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_profesor`
--

CREATE TABLE `materia_profesor` (
  `id_materiaprofesor` int(11) NOT NULL,
  `id_personal` int(10) UNSIGNED NOT NULL,
  `id_materia` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `materia_profesor`
--

INSERT INTO `materia_profesor` (`id_materiaprofesor`, `id_personal`, `id_materia`) VALUES
(1, 12, 2),
(2, 21, 15),
(6, 16, 13),
(8, 16, 14),
(15, 12, 27),
(19, 22, 16),
(23, 16, 2),
(28, 13, 29),
(29, 16, 30),
(30, 22, 28),
(32, 12, 31),
(33, 17, 32),
(34, 23, 33),
(35, 12, 2),
(36, 16, 32),
(37, 21, 34),
(38, 13, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id_modulo` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id_nota` int(11) NOT NULL,
  `id_materia` int(10) UNSIGNED NOT NULL,
  `id_estudiante` int(10) UNSIGNED NOT NULL,
  `anio` enum('primer_anio','segundo_anio','tercer_anio') NOT NULL,
  `nota` decimal(2,1) NOT NULL,
  `tipo_nota` enum('trabajo_practico','parcial','oral') NOT NULL,
  `periodo` enum('cuatrimestral1','cuatrimestral2','bimestral1','bimestral2','bimestral3','bimestral4','semestral1','semestral2','semestral3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id_nota`, `id_materia`, `id_estudiante`, `anio`, `nota`, `tipo_nota`, `periodo`) VALUES
(1, 15, 4, 'primer_anio', 7.0, 'trabajo_practico', 'bimestral1'),
(2, 16, 5, 'segundo_anio', 9.0, 'parcial', 'bimestral3'),
(3, 13, 4, 'segundo_anio', 9.0, 'trabajo_practico', 'bimestral2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `id_periodo` int(10) UNSIGNED NOT NULL,
  `id_ciclo_Electivo` int(10) UNSIGNED DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(10) UNSIGNED NOT NULL,
  `id_rol` int(10) UNSIGNED NOT NULL,
  `id_modulo` int(10) UNSIGNED NOT NULL,
  `lectura` int(2) NOT NULL,
  `escritura` int(2) NOT NULL,
  `actualizar` int(2) NOT NULL,
  `borrar` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_personal` int(10) UNSIGNED NOT NULL,
  `rol_personal` varchar(25) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `password_usuario` varchar(50) NOT NULL,
  `nombre_personal` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido_personal` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email_personal` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono_personal` int(11) NOT NULL,
  `tipodoc_personal` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nrodni_personal` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nrocuil_personal` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `sexo_personal` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechanac_personal` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `paisnac_personal` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lugarnac_personal` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_designacion` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nro_designacion` int(20) DEFAULT NULL,
  `paisdomic_personal` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `provdomic_personal` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `calle_personal` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nro_personal` int(10) NOT NULL,
  `piso_personal` int(5) DEFAULT NULL,
  `depto_personal` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `edificio_personal` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `localidad_personal` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `partido_personal` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cp_personal` int(5) DEFAULT NULL,
  `titulo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `titulo_institucion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `anio_egreso` int(4) NOT NULL,
  `tipo_titulo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `carr1` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `carr1_institucion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `carr1_estado` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `carr1_anioegreso` int(5) DEFAULT NULL,
  `carr1_titulo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `carr2` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `carr2_institucion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `carr2_estado` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `carr2_anioegreso` int(5) DEFAULT NULL,
  `carr2_titulo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado_personal` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `DNIchecked` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `CVchecked` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `CUILchecked` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `TITchecked` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_personal`, `rol_personal`, `nombre_usuario`, `password_usuario`, `nombre_personal`, `apellido_personal`, `email_personal`, `telefono_personal`, `tipodoc_personal`, `nrodni_personal`, `nrocuil_personal`, `sexo_personal`, `fechanac_personal`, `paisnac_personal`, `lugarnac_personal`, `fecha_designacion`, `nro_designacion`, `paisdomic_personal`, `provdomic_personal`, `calle_personal`, `nro_personal`, `piso_personal`, `depto_personal`, `edificio_personal`, `localidad_personal`, `partido_personal`, `cp_personal`, `titulo`, `titulo_institucion`, `anio_egreso`, `tipo_titulo`, `carr1`, `carr1_institucion`, `carr1_estado`, `carr1_anioegreso`, `carr1_titulo`, `carr2`, `carr2_institucion`, `carr2_estado`, `carr2_anioegreso`, `carr2_titulo`, `estado_personal`, `DNIchecked`, `CVchecked`, `CUILchecked`, `TITchecked`) VALUES
(12, '', '', '', 'Jorge Pedro', 'Lopez', 'p_jorge@gmail.com', 1145634567, '', '14234567', '27142345676', '', '0000-00-00', '', '', '0000-00-00', 0, '', '', '', 0, 0, '0', '0', '', '', 0, '1', '1', 0, '', '', '', '', 0, '', '', '', '', 0, '', '', '0', NULL, '0', NULL),
(13, 'ADMINISTRATIVO', 'JPEREZ', 'JPEREZ', 'Jose Maria', 'Perez', 'jmperez@gmail.com', 1156789087, '', '32445678', '27324456785', 'masculino', '26-06-1984', 'Argentina', 'Marcos Paz', '16/02/2022', 324325, '', 'Buenos Aires', 'Ramon Fulano 345', 3456, 0, '-', '-', 'San Martin', 'General San Martin', 0, 'Licenciado en ciencia de datos', 'UNAM', 2019, 'universitario', '', '', '', 0, '', '', '', '', 0, '', 'activo', '0', NULL, '0', NULL),
(16, 'ADMINISTRATIVO', 'CAND', 'CAND', 'Cecilia ', 'And', '', 0, NULL, '32154612', '27321546126', 'Femenino', '', 'Brasil', NULL, '20/10/2022', 12898, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Ingeniera', 'UTN', 2015, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'provisional', '0', NULL, '1', NULL),
(17, '', '', '', 'Andrea', 'Suarez', '', 0, NULL, '', '', NULL, '', '', NULL, '', NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', NULL, '1', NULL),
(18, '', '', '', 'Carolina', 'Pereyra', '', 0, NULL, '', '', NULL, '', '', NULL, '', NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', NULL, '1', NULL),
(19, '', '', '', '', '', '', 0, NULL, '', '', NULL, '', '', NULL, '', NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', NULL, '1', NULL),
(20, '', '', '', '', '', '', 0, NULL, '', '', NULL, '', '', NULL, '', NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0', NULL, '1', NULL),
(21, 'ADMINISTRATIVO', 'HAREV', 'HAREV', 'Hilda ', 'Arev', 'yo@yahoo.com', 1165295555, '', '17897897', '27178897897', NULL, '1970-03-03', 'Argentina', '', '2022-03-03', 12897, 'Argentina', '', '', 0, 0, '', '', '', '', 0, 'tecnico', '225', 2021, '', '', '', '', 0, '', '', '', '', 0, '', 'provisional', '0', NULL, '0', NULL),
(22, '', '', '', 'Hilda', 'Arev', 'yo@yahoo.com', 1165295555, '', '17897897', '27178897897', NULL, '1970-03-03', 'Argentina', '', '2022-03-03', 0, 'Argentina', '', '', 0, 0, '', '', '', '', 0, 'tecnico', '225', 2021, '', '', '', '', 0, '', '', '', '', 0, '', 'provisional', '0', NULL, '0', NULL),
(23, '', '', '', 'Maria', 'Fer', 'yo@yahoo.com.ar', 1165294555, '', '17197897', '27178197897', NULL, '1970-03-03', 'Argentina', '', '2022-03-03', 0, 'Argentina', '', '', 0, 0, '', '', '', '', 0, 'tecnico', 'csd', 2021, '', '', '', '', 0, '', '', '', '', 0, '', 'titular', '0', NULL, '0', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(10) UNSIGNED NOT NULL,
  `rol_nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `rol_descripcion` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol_nombre`, `rol_descripcion`) VALUES
(1, 'administrador', 'aml de modulos'),
(2, 'usuario', 'l de modulos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_aprobacion`
--

CREATE TABLE `tipo_aprobacion` (
  `id_tipo_aprobacion` int(6) UNSIGNED NOT NULL,
  `nombre_tipo_aprobacion` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipo_aprobacion`
--

INSERT INTO `tipo_aprobacion` (`id_tipo_aprobacion`, `nombre_tipo_aprobacion`) VALUES
(1, 'Cursada Aprobada'),
(2, 'Final Aprobado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `nombres` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargo` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_usuario` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contrasenia` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_rol` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombres`, `apellidos`, `cargo`, `nombre_usuario`, `contrasenia`, `id_rol`) VALUES
(10, '', '', '', 'Karina', '$2y$10$zKwYb7/wp5a/TkWX1F71eu00Lmlxn9eOQhZk5kUa4vRdnGRxQzy7C', 1),
(11, 'Karina', '', '', 'KarinaBouza', '$2y$10$xnj.y1E1nOc9jSBXepuAEeEt/9Uu1JWvMNby/X/36CFHQ5ThUN6xa', 1),
(12, 'isft225', '', '', 'isft225', '$2y$10$9wj5h1FQ9z9WnI9xz6UPm.cChnjNxFvN/.BuB4LgKb6HWCXzp8LO.', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id_asistencia`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id_carrera`) USING BTREE;

--
-- Indices de la tabla `carreras_adicionales`
--
ALTER TABLE `carreras_adicionales`
  ADD PRIMARY KEY (`id_estudiante`);

--
-- Indices de la tabla `ciclo_electivo`
--
ALTER TABLE `ciclo_electivo`
  ADD PRIMARY KEY (`id_ciclo_Electivo`);

--
-- Indices de la tabla `correlativas`
--
ALTER TABLE `correlativas`
  ADD PRIMARY KEY (`id_correlativa`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `tipo_aprobacion_correlativa` (`tipo_aprobacion_correlativa`);

--
-- Indices de la tabla `cursada`
--
ALTER TABLE `cursada`
  ADD PRIMARY KEY (`id_cursada`),
  ADD KEY `id_carrera` (`id_Carrera`) USING BTREE,
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `fk_cursada_estudiante` (`id_estudiante`),
  ADD KEY `fk_cursada_ciclo_electivo` (`id_ciclo_electivo`);

--
-- Indices de la tabla `cursada_estudiante`
--
ALTER TABLE `cursada_estudiante`
  ADD PRIMARY KEY (`id_cursada_estudiante`),
  ADD KEY `id_estudiante` (`id_estudiante`),
  ADD KEY `id_cursada` (`id_cursada`);

--
-- Indices de la tabla `doc_check`
--
ALTER TABLE `doc_check`
  ADD PRIMARY KEY (`id_estudiante`);

--
-- Indices de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD PRIMARY KEY (`id_domicilio`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id_estudiante`);

--
-- Indices de la tabla `estudiante_carrera`
--
ALTER TABLE `estudiante_carrera`
  ADD PRIMARY KEY (`id_matricula`),
  ADD KEY `id_estudiante` (`id_estudiante`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `estudiante_materia`
--
ALTER TABLE `estudiante_materia`
  ADD PRIMARY KEY (`id_matricula`),
  ADD KEY `id_estudiante` (`id_estudiante`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`) USING BTREE,
  ADD KEY `fk_materia_carrera` (`id_carrera`);

--
-- Indices de la tabla `materia_carrera`
--
ALTER TABLE `materia_carrera`
  ADD PRIMARY KEY (`id_materia`,`id_carrera`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `materia_profesor`
--
ALTER TABLE `materia_profesor`
  ADD PRIMARY KEY (`id_materiaprofesor`),
  ADD KEY `id_profesor` (`id_personal`),
  ADD KEY `id_materia` (`id_materia`) USING BTREE;

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_estudiante` (`id_estudiante`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`),
  ADD KEY `fk_perioro_ciclo_electivo` (`id_ciclo_Electivo`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `id_modulo` (`id_modulo`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id_personal`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_aprobacion`
--
ALTER TABLE `tipo_aprobacion`
  ADD PRIMARY KEY (`id_tipo_aprobacion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id_carrera` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `carreras_adicionales`
--
ALTER TABLE `carreras_adicionales`
  MODIFY `id_estudiante` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ciclo_electivo`
--
ALTER TABLE `ciclo_electivo`
  MODIFY `id_ciclo_Electivo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `correlativas`
--
ALTER TABLE `correlativas`
  MODIFY `id_correlativa` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `cursada`
--
ALTER TABLE `cursada`
  MODIFY `id_cursada` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cursada_estudiante`
--
ALTER TABLE `cursada_estudiante`
  MODIFY `id_cursada_estudiante` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `doc_check`
--
ALTER TABLE `doc_check`
  MODIFY `id_estudiante` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  MODIFY `id_domicilio` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id_estudiante` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estudiante_carrera`
--
ALTER TABLE `estudiante_carrera`
  MODIFY `id_estudiante` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiante_materia`
--
ALTER TABLE `estudiante_materia`
  MODIFY `id_estudiante` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `materia_profesor`
--
ALTER TABLE `materia_profesor`
  MODIFY `id_materiaprofesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id_modulo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id_periodo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_personal` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_aprobacion`
--
ALTER TABLE `tipo_aprobacion`
  MODIFY `id_tipo_aprobacion` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carreras_adicionales`
--
ALTER TABLE `carreras_adicionales`
  ADD CONSTRAINT `carreras_adicionales_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `correlativas`
--
ALTER TABLE `correlativas`
  ADD CONSTRAINT `correlativas_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `correlativas_ibfk_2` FOREIGN KEY (`tipo_aprobacion_correlativa`) REFERENCES `tipo_aprobacion` (`id_tipo_aprobacion`);

--
-- Filtros para la tabla `cursada`
--
ALTER TABLE `cursada`
  ADD CONSTRAINT `cursada_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia_profesor` (`id_materia`),
  ADD CONSTRAINT `fk_cursada_carrera` FOREIGN KEY (`id_Carrera`) REFERENCES `carrera` (`id_carrera`),
  ADD CONSTRAINT `fk_cursada_ciclo_electivo` FOREIGN KEY (`id_ciclo_electivo`) REFERENCES `ciclo_electivo` (`id_ciclo_Electivo`),
  ADD CONSTRAINT `fk_cursada_estudiante` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`),
  ADD CONSTRAINT `fk_cursada_materia` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`);

--
-- Filtros para la tabla `cursada_estudiante`
--
ALTER TABLE `cursada_estudiante`
  ADD CONSTRAINT `cursada_estudiante_ibfk_4` FOREIGN KEY (`id_cursada`) REFERENCES `cursada` (`id_cursada`);

--
-- Filtros para la tabla `doc_check`
--
ALTER TABLE `doc_check`
  ADD CONSTRAINT `doc_check_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiante_carrera`
--
ALTER TABLE `estudiante_carrera`
  ADD CONSTRAINT `estudiante_carrera_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiante_carrera_ibfk_2` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`);

--
-- Filtros para la tabla `estudiante_materia`
--
ALTER TABLE `estudiante_materia`
  ADD CONSTRAINT `estudiante_materia_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiante_materia_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`);

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `fk_materia_carrera` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`);

--
-- Filtros para la tabla `materia_carrera`
--
ALTER TABLE `materia_carrera`
  ADD CONSTRAINT `materia_carrera_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`),
  ADD CONSTRAINT `materia_carrera_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`);

--
-- Filtros para la tabla `materia_profesor`
--
ALTER TABLE `materia_profesor`
  ADD CONSTRAINT `materia_profesor_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `materia_profesor_ibfk_3` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id_personal`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`);

--
-- Filtros para la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD CONSTRAINT `fk_perioro_ciclo_electivo` FOREIGN KEY (`id_ciclo_Electivo`) REFERENCES `ciclo_electivo` (`id_ciclo_Electivo`);

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id_modulo`),
  ADD CONSTRAINT `permiso_ibfk_3` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
