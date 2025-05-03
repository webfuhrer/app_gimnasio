-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2025 at 11:24 AM
-- Server version: 8.0.41-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gimnasio`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_ejercicios`
--

CREATE TABLE `t_ejercicios` (
  `id` int NOT NULL,
  `id_parte` int DEFAULT NULL,
  `parte` varchar(2) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_ejercicios`
--

INSERT INTO `t_ejercicios` (`id`, `id_parte`, `parte`, `nombre`, `descripcion`) VALUES
(1, 1, 'C', 'Core calvo', ''),
(2, 2, 'C', 'CORE', ''),
(3, 3, 'C', 'Core en barra', ''),
(4, 1, 'E', 'Dominadas', ''),
(5, 2, 'E', 'Dominadas tuck gomas', ''),
(6, 3, 'E', 'Dominadas escapulares', ''),
(7, 4, 'E', 'Remo bajo barra', ''),
(8, 5, 'E', 'Maquinaremo', ''),
(9, 6, 'E', 'Remo barra', ''),
(10, 7, 'E', 'Dom. goma', ''),
(11, 8, 'E', 'Dom piramide', ''),
(12, 9, 'E', 'Remo mancuernas', ''),
(13, 10, 'E', 'Jalones al pecho', ''),
(14, 11, 'E', 'Dominadas negativas', ''),
(15, 12, 'E', 'Dominadas negativas', ''),
(16, 13, 'E', 'Dominadas neutras', ''),
(17, 14, 'E', 'TRX', ''),
(18, 15, 'E', 'Dominadas estáticas', ''),
(19, 1, 'H', 'Frontales Hs', ''),
(20, 2, 'H', 'Pájaros', ''),
(21, 3, 'H', 'Press militar barra', ''),
(22, 4, 'H', 'Elevaciones laterales', ''),
(23, 5, 'H', 'Maquina press Hs', ''),
(24, 1, 'PT', 'Flexiones lastradas', ''),
(25, 2, 'PT', 'Paralelas', ''),
(26, 3, 'PT', 'Flexiones', ''),
(27, 4, 'PT', 'Flexiones agarres', ''),
(28, 5, 'PT', 'Flexiones escápulas', ''),
(29, 6, 'PT', 'Press mancuernas', ''),
(30, 7, 'PT', 'Press banca', ''),
(31, 8, 'PT', 'Flexiones montaña+manos abiertas', ''),
(32, 9, 'PT', 'Flexiones arquero', ''),
(33, 10, 'PT', 'Fondos con remo', ''),
(34, 11, 'PT', 'Pirámide paralelas', ''),
(35, 1, 'P', 'Búlgara', ''),
(36, 2, 'P', 'Bíceps femoral', ''),
(37, 3, 'P', 'Comba', ''),
(38, 4, 'P', 'Elevar gemelos desde escalón', ''),
(39, 5, 'P', 'Salto cajón', ''),
(40, 6, 'P', 'Adbuctores-aductores', ''),
(41, 7, 'P', 'Zancadas', ''),
(42, 8, 'P', 'Propiocepción', ''),
(43, 9, 'P', 'Máquina empuje horizontal', ''),
(44, 10, 'P', 'Hip thrust', ''),
(45, 11, 'P', 'Bajada un pie pistol', ''),
(46, 12, 'P', 'Prensa.Subo con 2 bajo con 1', ''),
(48, 14, 'P', 'Excentrico cuadriceps desde rodillas', ''),
(49, 1, 'TR', 'Remo alto', ''),
(50, 1, 'X', 'Estirar', ''),
(51, 20, 'P', 'TROTE', 'TROTE'),
(52, 20, 'P', 'ESCALERAS', 'ESCALERAS'),
(53, 30, 'CU', 'CUELLO', 'CUELLO');

-- --------------------------------------------------------

--
-- Table structure for table `t_entrenos_hechos`
--

CREATE TABLE `t_entrenos_hechos` (
  `id` int NOT NULL,
  `id_ent` int NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_entrenos_hechos`
--

INSERT INTO `t_entrenos_hechos` (`id`, `id_ent`, `fecha`) VALUES
(1, 1, '2025-03-20'),
(2, 1, '2025-03-20'),
(3, 1, '2025-03-23'),
(4, 2, '2025-03-28'),
(5, 3, '2025-03-29'),
(6, 4, '2025-04-07'),
(7, 4, '2025-04-07'),
(8, 4, '2025-04-07'),
(9, 4, '2025-04-07'),
(10, 4, '2025-04-07'),
(11, 4, '2025-04-07'),
(12, 4, '2025-04-07'),
(13, 5, '2025-04-09'),
(14, 6, '2025-04-21'),
(15, 7, '2025-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `t_entrenos_plantilla`
--

CREATE TABLE `t_entrenos_plantilla` (
  `id` int NOT NULL,
  `id_entreno` int DEFAULT NULL,
  `id_ejercicio` int NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_entrenos_plantilla`
--

INSERT INTO `t_entrenos_plantilla` (`id`, `id_entreno`, `id_ejercicio`, `fecha_creacion`) VALUES
(1, 1, 7, '2025-03-20 17:30:28'),
(2, 1, 18, '2025-03-20 17:30:28'),
(3, 1, 21, '2025-03-20 17:30:28'),
(4, 1, 30, '2025-03-20 17:30:28'),
(5, 2, 9, '2025-03-20 17:30:28'),
(6, 2, 8, '2025-03-20 17:30:28'),
(7, 2, 20, '2025-03-20 17:30:28'),
(8, 2, 31, '2025-03-20 17:30:28'),
(9, 3, 12, '2025-03-20 17:30:28'),
(10, 3, 10, '2025-03-20 17:30:28'),
(11, 3, 22, '2025-03-20 17:30:28'),
(12, 3, 25, '2025-03-20 17:30:28'),
(13, 4, 5, '2025-03-28 15:36:05'),
(14, 4, 13, '2025-03-28 15:36:05'),
(15, 4, 23, '2025-03-28 15:36:05'),
(16, 4, 30, '2025-03-28 15:36:05'),
(17, 5, 17, '2025-03-28 15:36:05'),
(18, 5, 4, '2025-03-28 15:36:05'),
(19, 5, 20, '2025-03-28 15:36:05'),
(20, 5, 25, '2025-03-28 15:36:05'),
(21, 6, 7, '2025-03-28 15:36:05'),
(22, 6, 15, '2025-03-28 15:36:05'),
(23, 6, 19, '2025-03-28 15:36:05'),
(24, 6, 31, '2025-03-28 15:36:05'),
(25, 7, 6, '2025-03-28 15:36:08'),
(26, 7, 17, '2025-03-28 15:36:08'),
(27, 7, 19, '2025-03-28 15:36:08'),
(28, 7, 27, '2025-03-28 15:36:08'),
(29, 8, 12, '2025-03-28 15:36:08'),
(30, 8, 11, '2025-03-28 15:36:08'),
(31, 8, 21, '2025-03-28 15:36:08'),
(32, 8, 28, '2025-03-28 15:36:08'),
(33, 9, 5, '2025-03-28 15:36:08'),
(34, 9, 7, '2025-03-28 15:36:08'),
(35, 9, 23, '2025-03-28 15:36:08'),
(36, 9, 26, '2025-03-28 15:36:08');

-- --------------------------------------------------------

--
-- Table structure for table `t_observaciones_ejercicios`
--

CREATE TABLE `t_observaciones_ejercicios` (
  `id` int NOT NULL,
  `id_ejercicio` int NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `observaciones` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_observaciones_ejercicios`
--

INSERT INTO `t_observaciones_ejercicios` (`id`, `id_ejercicio`, `fecha`, `observaciones`) VALUES
(1, 7, '2025-03-20 18:35:19', 'remo bajo 1'),
(2, 18, '2025-03-20 18:35:19', '3x40seg'),
(3, 21, '2025-03-20 18:35:19', '4x15x20kg'),
(4, 30, '2025-03-20 18:35:19', '3x10x20kg'),
(5, 7, '2025-03-20 19:02:41', 'remo bajo2'),
(6, 18, '2025-03-20 19:02:41', '3x40seg'),
(7, 21, '2025-03-20 19:02:41', '4x15x20kg'),
(8, 30, '2025-03-20 19:02:41', '3x10x20kg'),
(9, 7, '2025-03-23 16:46:57', '3x15x30'),
(10, 18, '2025-03-23 16:46:57', '3x20seg. Ulti regular'),
(11, 21, '2025-03-23 16:46:57', '3x10x30kg'),
(12, 30, '2025-03-23 16:46:57', '3x10x30kg'),
(13, 9, '2025-03-28 16:22:05', ''),
(14, 8, '2025-03-28 16:22:05', ''),
(15, 20, '2025-03-28 16:22:05', ''),
(16, 31, '2025-03-28 16:22:05', ''),
(17, 12, '2025-03-29 09:21:30', '2x15x10kg+2x15x14kg'),
(18, 10, '2025-03-29 09:21:30', '3x6'),
(19, 22, '2025-03-29 09:21:30', '3x15x8kg'),
(20, 25, '2025-03-29 09:21:30', '3x10'),
(21, 5, '2025-04-07 16:18:19', '4x5 sin goma'),
(22, 13, '2025-04-07 16:18:19', ''),
(23, 23, '2025-04-07 16:18:19', '4x10x23kg.Cambio agarres'),
(24, 30, '2025-04-07 16:18:19', '3x10x30kg.Regular'),
(25, 5, '2025-04-07 16:18:48', '4x5 sin goma'),
(26, 13, '2025-04-07 16:18:48', ''),
(27, 23, '2025-04-07 16:18:48', '4x10x23kg.Cambio agarres'),
(28, 30, '2025-04-07 16:18:48', '3x10x30kg.Regular.Bajar a 25kg'),
(29, 5, '2025-04-07 16:53:37', '4x5 sin goma'),
(30, 13, '2025-04-07 16:53:37', '4x10x39kg'),
(31, 23, '2025-04-07 16:53:37', '4x10x23kg.Cambio agarres'),
(32, 30, '2025-04-07 16:53:37', '3x10x30kg.Regular.Bajar a 25kg'),
(33, 0, '2025-04-07 16:53:37', 'No terminé.Sin Internet'),
(34, 5, '2025-04-07 16:56:44', '4x5 sin goma'),
(35, 13, '2025-04-07 16:56:44', '4x10x39kg'),
(36, 23, '2025-04-07 16:56:44', '4x10x23kg.Cambio agarres'),
(37, 30, '2025-04-07 16:56:44', '3x10x30kg.Regular.Bajar a 25kg'),
(38, 0, '2025-04-07 16:56:44', 'no acabè. sin internet'),
(39, 5, '2025-04-07 23:03:41', '4x5 sin goma'),
(40, 13, '2025-04-07 23:03:41', '4x10x39kg'),
(41, 23, '2025-04-07 23:03:41', '4x10x23kg.Cambio agarres'),
(42, 30, '2025-04-07 23:03:41', '3x10x30kg.Regular.Bajar a 25kg'),
(43, 1, '2025-04-07 23:03:41', 'No terminé. Me quedé sin internet'),
(44, 5, '2025-04-07 23:14:44', '4x5 sin goma'),
(45, 13, '2025-04-07 23:14:44', '4x10x39kg'),
(46, 23, '2025-04-07 23:14:44', '4x10x23kg.Cambio agarres'),
(47, 30, '2025-04-07 23:14:44', '3x10x30kg.Regular.Mejor25kg'),
(48, 5, '2025-04-07 23:16:10', '4x5 sin goma'),
(49, 13, '2025-04-07 23:16:10', '4x10x39kg'),
(50, 23, '2025-04-07 23:16:10', '4x10x23kg.Cambio agarres'),
(51, 30, '2025-04-07 23:16:10', '3x10x30kg.R.Mejor25kg'),
(52, 17, '2025-04-09 16:44:41', '4x10. Me gusta.'),
(53, 4, '2025-04-09 16:44:41', '3x4S+3x3P'),
(54, 20, '2025-04-09 16:44:41', '4x10x6kg. Puedo subir a 7'),
(55, 25, '2025-04-09 16:44:41', '3x10'),
(56, 49, '2025-04-09 16:44:41', '3x10x17.5kg'),
(57, 7, '2025-04-21 22:27:32', '3x15x30'),
(58, 15, '2025-04-21 22:27:32', '4x4x8seg'),
(59, 19, '2025-04-21 22:27:32', '4x30x8kg'),
(60, 31, '2025-04-21 22:27:32', '3x15'),
(61, 29, '2025-04-21 22:27:32', '3x10x20kg'),
(62, 6, '2025-05-01 11:20:02', '3x10'),
(63, 17, '2025-05-01 11:20:02', '4x10. Me gusta.'),
(64, 19, '2025-05-01 11:20:02', '4x30x8kg'),
(65, 27, '2025-05-01 11:20:02', '4x10'),
(66, 2, '2025-05-01 11:20:02', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_ejercicios`
--
ALTER TABLE `t_ejercicios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_entrenos_hechos`
--
ALTER TABLE `t_entrenos_hechos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_entrenos_plantilla`
--
ALTER TABLE `t_entrenos_plantilla`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_observaciones_ejercicios`
--
ALTER TABLE `t_observaciones_ejercicios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_ejercicios`
--
ALTER TABLE `t_ejercicios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `t_entrenos_hechos`
--
ALTER TABLE `t_entrenos_hechos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `t_entrenos_plantilla`
--
ALTER TABLE `t_entrenos_plantilla`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `t_observaciones_ejercicios`
--
ALTER TABLE `t_observaciones_ejercicios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
