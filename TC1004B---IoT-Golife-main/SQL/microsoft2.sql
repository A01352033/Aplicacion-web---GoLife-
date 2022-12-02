CREATE DATABASE microsoft2;
USE microsoft2;

CREATE TABLE `medidas` (
  `Conteo` int(15) NOT NULL,
  `Dia` date NOT NULL,
  `Hora` time NOT NULL,
  `Temp_actual` float NOT NULL,
  `Humed_actual` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `medidas` (`Conteo`, `Dia`, `Hora`, `Temp_actual`, `Humed_actual`) VALUES
(1, '2022-12-01', '10:22:13', 24.4, 44),
(2, '2022-12-01', '10:22:48', 21.8, 44),
(3, '2022-12-01', '10:23:24', 21.8, 44),
(4, '2022-12-01', '10:24:00', 21.8, 44),
(5, '2022-12-01', '10:24:36', 21.8, 44),
(6, '2022-12-01', '10:25:11', 21.8, 43),
(7, '2022-12-01', '10:25:48', 21.8, 43),
(8, '2022-12-01', '10:26:23', 21.8, 43),
(9, '2022-12-01', '10:26:59', 21.8, 43),
(10, '2022-12-01', '10:27:35', 21.8, 43),
(11, '2022-12-01', '10:28:11', 21.8, 43),
(12, '2022-12-01', '10:28:46', 21.8, 43),
(13, '2022-12-01', '10:29:24', 21.8, 43),
(14, '2022-12-01', '10:30:00', 21.8, 43),
(15, '2022-12-01', '10:30:35', 21.8, 43),
(16, '2022-12-01', '10:31:11', 21.8, 43),
(17, '2022-12-01', '10:31:47', 21.8, 43),
(18, '2022-12-01', '10:32:23', 21.8, 43),
(19, '2022-12-01', '10:32:58', 21.8, 43),
(20, '2022-12-01', '10:33:34', 21.8, 43),
(21, '2022-12-01', '10:34:10', 21.8, 43),
(22, '2022-12-01', '10:34:46', 22.2, 43),
(23, '2022-12-01', '10:35:21', 22.2, 43),
(24, '2022-12-01', '10:35:57', 22.2, 43),
(25, '2022-12-01', '10:36:33', 22.2, 43);


CREATE TABLE `planta` (
  `id` int(5) NOT NULL,
  `Día` date NOT NULL DEFAULT current_timestamp(),
  `Nombre` varchar(15) NOT NULL,
  `Temperatura` float NOT NULL,
  `Humedad` float NOT NULL,
  `Ubicacion` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `medidas`
  ADD PRIMARY KEY (`Conteo`);

ALTER TABLE `planta`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `medidas`
  MODIFY `Conteo` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;