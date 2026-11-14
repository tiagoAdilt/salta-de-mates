-- ============================================================
-- Base de Datos para el proyecto: Salta de Mates
-- Entidades:
--   1. usuarios (Administradores y estudiantes registrados)
--   2. lugares (Spots para tomar mate en Salta con FK a usuarios)
--   3. respuestas_quiz (Calificaciones del Curso online con FK a usuarios)
-- ============================================================

CREATE DATABASE IF NOT EXISTS `salta_de_mates` 
  DEFAULT CHARACTER SET utf8mb4 
  COLLATE utf8mb4_unicode_ci;

USE `salta_de_mates`;

-- 1. Estructura de la tabla `usuarios`
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL,
  `usuario` VARCHAR(50) NOT NULL UNIQUE,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `rol` VARCHAR(20) DEFAULT 'estudiante',
  `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Usuarios de prueba predeterminados (Clave por defecto de ejemplo: admin123)
INSERT INTO `usuarios` (`nombre`, `usuario`, `email`, `password`, `rol`) VALUES
('Enriquez Tiago', 'tiago', 'tiago@saltademates.com', '$2y$10$H5SQ1qNNvNjXM1UWC8IVFu2T0OwgtjdeZbqWOldV8n4r8vbUqwCFq', 'admin'),
('Administrador', 'admin', 'admin@saltademates.com', '$2y$10$H5SQ1qNNvNjXM1UWC8IVFu2T0OwgtjdeZbqWOldV8n4r8vbUqwCFq', 'admin')
ON DUPLICATE KEY UPDATE `nombre` = VALUES(`nombre`);

-- 2. Estructura de la tabla `lugares`
CREATE TABLE IF NOT EXISTS `lugares` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `usuario_id` INT NULL,
  `nombre` VARCHAR(150) NOT NULL,
  `ubicacion` VARCHAR(200) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `historia` TEXT NULL,
  `imagen` VARCHAR(255) DEFAULT 'cerro.jpg',
  `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_lugares_usuarios` 
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) 
    ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcado de datos de prueba / iniciales de Salta de Mates
INSERT INTO `lugares` (`usuario_id`, `nombre`, `ubicacion`, `descripcion`, `historia`, `imagen`) VALUES
(1, 'Cerro San Bernardo', 'Salta Capital', 'Vista panorámica de toda la ciudad desde la cima. Ideal para ir al atardecer y matear con vista a los cerros.', 'El cerro tutelar de la ciudad, con su viacrucis y vegetación autóctona.', 'cerro.jpg'),
(1, 'Plaza 9 de Julio', 'Centro Histórico, Salta Capital', 'Rodeada de recovas coloniales, la Catedral y el Cabildo. Corazón de la ciudad y punto de encuentro obligado.', 'Fundada en 1582, testigo de los principales hechos históricos de la provincia.', 'plaza9dejulio.jpg'),
(1, 'Parque Bicentenario', 'Zona Norte, Salta Capital', 'Gran espacio verde con laguna artificial, caminerías y amplias zonas de césped para reposeras.', 'Inaugurado en 2015 como el pulmón verde más grande de la zona norte.', 'parquesur.jpg'),
(1, 'Quebrada de San Lorenzo', 'San Lorenzo (a 12 km de Capital)', 'Reserva natural con arroyo de montaña, helechos gigantes y vegetación de yunga salteña.', 'Tradicional villa veraniega salteña con microclima fresco todo el año.', 'sanlorenzo.jpg'),
(1, 'Plaza Güemes', 'Salta Capital', 'Ubicada frente a la Legislatura, arbolada con jacarandás y rodeada de ferias artesanales los fines de semana.', 'Homenaje al héroe nacional General Martín Miguel de Güemes.', 'guemes.jpg'),
(1, 'Paseo de los Poetas', 'Salta Capital', 'Canal con puente peatonal, murales y esculturas dedicadas a poetas salteños.', 'Espacio bohemio recuperado en honor al folclore y la poesía local.', 'legislatura.jpg'),
(1, 'Centro Cultural Palacio Zorrilla', 'Salta Capital', 'Patio interior colonial con vegetación y sombra permanente en pleno casco histórico.', 'Antigua casona del siglo XIX sede de actividades culturales de la UNSa.', 'paludica.png'),
(1, 'Mirador del Portezuelo', 'Acceso Este, Salta Capital', 'Punto de bienvenida a la ciudad con vista panorámica a los valles y cerros salteños.', 'Histórico acceso vial por la ruta nacional 9.', 'portezuelo.jpg'),
(1, 'Plaza Alvarado', 'Barrio Macrocentro, Salta Capital', 'Plaza barrial muy concurrida por vecinos, con arboleda frondosa y puestos de churros y bizcochitos.', 'Corazón del tradicional barrio Alvarado.', 'plaza.jpg'),
(1, 'Parque Sur', 'Zona Sur, Salta Capital', 'Nuevo parque urbano con anfiteatro, pistas de salud y amplios sectores de pasto para el mate familiar.', 'Construido sobre los predios del ex aeropuerto para beneficio del sector sur.', 'bicentenario.jpg');

-- 3. Estructura de la tabla `respuestas_quiz` (Evaluación del Curso online)
CREATE TABLE IF NOT EXISTS `respuestas_quiz` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `usuario_id` INT NOT NULL,
  `puntaje` INT NOT NULL,
  `nota_sobre_10` INT NOT NULL,
  `estado` VARCHAR(20) NOT NULL,
  `fecha` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_quiz_usuarios` 
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) 
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
