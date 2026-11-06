-- ============================================================
-- Base de Datos para el proyecto: Salta de Mates
-- Entidad Principal: lugares (Spots para tomar mate en Salta)
-- ============================================================

CREATE DATABASE IF NOT EXISTS `salta_de_mates` 
  DEFAULT CHARACTER SET utf8mb4 
  COLLATE utf8mb4_unicode_ci;

USE `salta_de_mates`;

-- Estructura de la tabla `lugares`
CREATE TABLE IF NOT EXISTS `lugares` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(150) NOT NULL,
  `ubicacion` VARCHAR(200) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `historia` TEXT NULL,
  `imagen` VARCHAR(255) DEFAULT 'cerro.jpg',
  `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcado de datos de prueba / iniciales de Salta de Mates
INSERT INTO `lugares` (`nombre`, `ubicacion`, `descripcion`, `historia`, `imagen`) VALUES
('Cerro San Bernardo', 'Salta Capital', 'Vista panorámica de toda la ciudad desde la cima. Ideal para ir al atardecer y matear con vista a los cerros.', 'El cerro tutelar de la ciudad, con su viacrucis y vegetación autóctona.', 'cerro.jpg'),
('Plaza 9 de Julio', 'Centro Histórico, Salta Capital', 'Rodeada de recovas coloniales, la Catedral y el Cabildo. Corazón de la ciudad y punto de encuentro obligado.', 'Fundada en 1582, testigo de los principales hechos históricos de la provincia.', 'plaza9dejulio.jpg'),
('Parque Bicentenario', 'Zona Norte, Salta Capital', 'Gran espacio verde con laguna artificial, caminerías y amplias zonas de césped para reposeras.', 'Inaugurado en 2015 como el pulmón verde más grande de la zona norte.', 'parquesur.jpg'),
('Quebrada de San Lorenzo', 'San Lorenzo (a 12 km de Capital)', 'Reserva natural con arroyo de montaña, helechos gigantes y vegetación de yunga salteña.', 'Tradicional villa veraniega salteña con microclima fresco todo el año.', 'sanlorenzo.jpg'),
('Plaza Güemes', 'Salta Capital', 'Ubicada frente a la Legislatura, arbolada con jacarandás y rodeada de ferias artesanales los fines de semana.', 'Homenaje al héroe nacional General Martín Miguel de Güemes.', 'guemes.jpg'),
('Paseo de los Poetas', 'Salta Capital', 'Canal con puente peatonal, murales y esculturas dedicadas a poetas salteños.', 'Espacio bohemio recuperado en honor al folclore y la poesía local.', 'legislatura.jpg'),
('Centro Cultural Palacio Zorrilla', 'Salta Capital', 'Patio interior colonial con vegetación y sombra permanente en pleno casco histórico.', 'Antigua casona del siglo XIX sede de actividades culturales de la UNSa.', 'paludica.png'),
('Mirador del Portezuelo', 'Acceso Este, Salta Capital', 'Punto de bienvenida a la ciudad con vista panorámica a los valles y cerros salteños.', 'Histórico acceso vial por la ruta nacional 9.', 'portezuelo.jpg'),
('Plaza Alvarado', 'Barrio Macrocentro, Salta Capital', 'Plaza barrial muy concurrida por vecinos, con arboleda frondosa y puestos de churros y bizcochitos.', 'Corazón del tradicional barrio Alvarado.', 'plaza.jpg'),
('Parque Sur', 'Zona Sur, Salta Capital', 'Nuevo parque urbano con anfiteatro, pistas de salud y amplios sectores de pasto para el mate familiar.', 'Construido sobre los predios del ex aeropuerto para beneficio del sector sur.', 'bicentenario.jpg');
