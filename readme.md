# 🧉 Salta de Mates — Sitio Web y Módulo CRUD (Hito 2)

**Autor:** Enriquez Tiago  
**Curso:** 4° 3° Turno Mañana — Computación / Programación Web  
**Entorno local:** XAMPP (Apache + MySQL / MariaDB)

---

## 📌 1. Descripción del Proyecto
**Salta de Mates** es una plataforma turística y cultural dedicada a difundir los mejores rincones y costumbres para disfrutar de un buen mate en la provincia de Salta, Argentina.

En esta etapa correspondiente al **Hito 2 (Clase 7)**, se implementó la capa de persistencia conectando PHP con MySQL a través de **PDO (PHP Data Objects)** y desarrollando un módulo de administración **CRUD completo (Create, Read, Update, Delete)** para la entidad principal definida en el TP6: **`lugares` (spots y rincones materos)**.

---

## 🛠️ 2. Arquitectura y Estructura del Proyecto

```plaintext
salta-de-mates/
│
├── config/
│   └── conexion.php            # Conexión PDO robusta con try-catch y opciones de seguridad
│
├── database/
│   ├── salta_de_mates.sql      # Script DDL/DML con creación de BD, tabla e inserción inicial
│   └── importar_bd.bat         # Script para importar la base de datos en 1 clic
│
├── includes/
│   ├── header.php              # Cabecera global modular con enlace al CRUD
│   └── footer.php              # Pie de página global modular
│
├── admin/                      # Módulo de Administración CRUD
│   ├── header.php              # Header específico del panel admin (Bootstrap 5 + paleta temática)
│   ├── footer.php              # Footer del panel admin
│   ├── index.php               # READ: Listado de registros, búsqueda y acciones
│   ├── crear.php               # CREATE: Formulario de alta + inserción con Prepared Statements
│   ├── editar.php              # UPDATE: Formulario de edición + actualización con Prepared Statements
│   └── eliminar.php            # DELETE: Lógica de baja física segura por ID
│
├── img/                        # Fotografías de los spots salteños
├── index.php                   # Página principal pública (sincronizada en vivo con la BD)
├── blog.php                    # Sección de blog
├── curso.php                   # Sección de curso online
├── contacto.php                # Formulario de contacto
├── style.css                   # Hoja de estilos original del sitio
└── readme.md                   # Documentación técnica del proyecto
```

---

## 🔒 3. Seguridad y Buenas Prácticas Implementadas

### A. Conexión Segura con PDO (`config/conexion.php`)
- Instancia de PDO encapsulada en bloque `try-catch (\PDOException $e)` para evitar fugas de credenciales en pantalla.
- Juego de caracteres configurado a `utf8mb4` para soporte total de caracteres en español y emojis.
- Configuración estricta de atributos:
  - `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION`: Disparo de excepciones en fallos de consulta.
  - `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC`: Retorno directo de arrays asociativos limpios.
  - `PDO::ATTR_EMULATE_PREPARES => false`: Desactiva la emulación de preparadas para delegar la preparación real al motor MySQL.

### B. Consultas Preparadas (Anti SQL Injection)
Todas las operaciones contra la base de datos utilizan **Prepared Statements** con marcadores de parámetros obligatorios:
- **CREATE (`crear.php`):**
  ```php
  $sql = "INSERT INTO lugares (nombre, ubicacion, descripcion, historia, imagen) 
          VALUES (:nombre, :ubicacion, :descripcion, :historia, :imagen)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([...]);
  ```
- **READ (`index.php` / `admin/index.php`):**
  ```php
  $stmt = $pdo->prepare("SELECT * FROM lugares WHERE nombre LIKE :q OR ubicacion LIKE :q ORDER BY id DESC");
  $stmt->execute([':q' => "%$busqueda%"]);
  ```
- **UPDATE (`editar.php`):**
  ```php
  $sql = "UPDATE lugares SET nombre = :nombre, ubicacion = :ubicacion, descripcion = :descripcion, historia = :historia, imagen = :imagen WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([...]);
  ```
- **DELETE (`eliminar.php`):**
  ```php
  $stmt = $pdo->prepare("DELETE FROM lugares WHERE id = :id");
  $stmt->execute([':id' => $id]);
  ```

### C. Prevención de Cross-Site Scripting (XSS)
Toda salida de datos proveniente de la base de datos o de peticiones de usuario se sanitiza antes de renderizarse en HTML:
```php
htmlspecialchars($variable, ENT_QUOTES, 'UTF-8');
```

---

## 🚀 4. Guía de Puesta en Marcha Local (Demo en Vivo)

1. **Iniciar el servidor local (XAMPP):**
   - Abrir el **XAMPP Control Panel**.
   - Presionar **Start** en los módulos **Apache** y **MySQL** (ambos deben figurar en verde).

2. **Crear / Importar la Base de Datos:**
   - **Opción A (Rápida):** Hacer doble clic en el archivo `database/importar_bd.bat`.
   - **Opción B (phpMyAdmin):**
     1. Ingresar en el navegador a `http://localhost/phpmyadmin`.
     2. Hacer clic en la pestaña **Importar**.
     3. Seleccionar el archivo `C:\xampp\htdocs\salta-de-mates\database\salta_de_mates.sql`.
     4. Presionar el botón **Continuar**.

3. **Acceder a las interfaces del sistema:**
   - **Sitio Público:** `http://localhost/salta-de-mates/index.php`
   - **Panel CRUD Admin:** `http://localhost/salta-de-mates/admin/index.php`
   - **Crear Nuevo Lugar:** `http://localhost/salta-de-mates/admin/crear.php`

---

## 🧪 5. Verificación del Flujo Completo (Criterios de Evaluación)

| Operación | Ruta | Descripción de la prueba |
| :--- | :--- | :--- |
| **CREATE (Alta)** | `admin/crear.php` | Completar el formulario con un nuevo spot, elegir foto y guardar. Verifica que redirige con alerta verde y persiste en MySQL. |
| **READ (Lectura)** | `admin/index.php` | Listado general ordenado por ID descendente con barra de búsqueda rápida por GET. |
| **UPDATE (Modificación)** | `admin/editar.php?id=X` | Carga previa segura de datos mediante consulta preparada. Permite editar y guardar cambios al instante. |
| **DELETE (Baja)** | `admin/eliminar.php?id=X` | Modal/confirmación en JavaScript antes de procesar el borrado seguro con Prepared Statement. |
| **REFLEJO EN VIVO** | `index.php` | El catálogo público de la página inicial consume la tabla `lugares` de MySQL en tiempo real. |


__________________________________________________________________________________________________

PRACTICO  CSS
<img width="700" height="347" alt="image" src="https://github.com/user-attachments/assets/12b6154f-b1d9-48e2-b282-26637e2b5666" />

<img width="702" height="346" alt="image" src="https://github.com/user-attachments/assets/e689ad81-8894-4faa-8d09-02e7585f96e6" />

________________________________________________________________________________________________

JAVA SCRIPT

PUNTO 1 — Mensajes y alertas
Se agregó un saludo con alert() que se ejecuta al cargar la página usando
window.onload. El mensaje varía según la hora del día:
 De 6:00 a 12:00 muestra: &quot;Buenos días! Bienvenido a Salta de Mates.&quot;
 De 12:00 a 19:00 muestra: &quot;Buenas tardes! Bienvenido a Salta de
Mates.&quot;
 De 19:00 en adelante: &quot;Buenas noches! Bienvenido a Salta de Mates.&quot;

ESCUELA DE EDUCACIÓN TÉCNICA N.º 3139
“GRAL. MARTIN M. DE GÜEMES”
Dirección: CASEROS N° 1615 – Telf.: (0387) 4320294 SALTA – CAPITAL

javascript
window.onload = function() {
var hora = new Date().getHours();
var saludo;
if (hora &gt;= 6 &amp;&amp; hora &lt; 12) saludo = &#39;Buenos dias&#39;;
else if (hora &gt;= 12 &amp;&amp; hora &lt; 19) saludo = &#39;Buenas tardes&#39;;
else saludo = &#39;Buenas noches&#39;;
alert(saludo + &#39;! Bienvenido a Salta de Mates.&#39;);
};

PUNTO 2 — Validación de formularios
En contacto.html se implementó validación completa con JavaScript:
 Campo vacío: si el nombre tiene menos de 3 caracteres aparece el
mensaje &quot;El nombre es obligatorio (mínimo 3 caracteres)&quot;
 Formato de email: se valida con expresión regular
/^[^\s@]+@[^\s@]+\.[^\s@]+$/
 Mensajes de error personalizados: aparecen en rojo debajo de cada
campo con borde rojo en el input
javascript
function validarEmail(email) {
return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

PUNTO 3 — Fecha y hora en tiempo real
Se agregó una barra verde en la parte superior de las páginas que muestra la
fecha y hora actual actualizándose cada segundo usando setInterval y Date().
javascript
function actualizarReloj() {

ESCUELA DE EDUCACIÓN TÉCNICA N.º 3139
“GRAL. MARTIN M. DE GÜEMES”
Dirección: CASEROS N° 1615 – Telf.: (0387) 4320294 SALTA – CAPITAL

var ahora = new Date();
var fecha = ahora.toLocaleDateString(&#39;es-AR&#39;, { weekday:&#39;long&#39;, year:&#39;numeric&#39;,
month:&#39;long&#39;, day:&#39;numeric&#39; });
var hora = ahora.toLocaleTimeString(&#39;es-AR&#39;);
document.getElementById(&#39;reloj-bar&#39;).textContent = &#39;Fecha: &#39; + fecha + &#39; | Hora:
&#39; + hora;
}
actualizarReloj();
setInterval(actualizarReloj, 1000);

PUNTO 4 — Menú interactivo (Acordeón)
En faq.html se implementó un acordeón donde cada pregunta se expande o
colapsa al hacer clic. Solo una pregunta puede estar abierta a la vez.
javascript
function toggleAcordeon(btn) {
var contenido = btn.nextElementSibling;
var estaAbierto = contenido.classList.contains(&#39;abierto&#39;);
document.querySelectorAll(&#39;.acordeon-contenido&#39;).forEach(function(c) {
c.classList.remove(&#39;abierto&#39;); });
document.querySelectorAll(&#39;.acordeon-btn&#39;).forEach(function(b) {
b.classList.remove(&#39;abierto&#39;); });
if (!estaAbierto) {
contenido.classList.add(&#39;abierto&#39;);
btn.classList.add(&#39;abierto&#39;);
}
}

PUNTO 5 — Galería de imágenes

ESCUELA DE EDUCACIÓN TÉCNICA N.º 3139
“GRAL. MARTIN M. DE GÜEMES”
Dirección: CASEROS N° 1615 – Telf.: (0387) 4320294 SALTA – CAPITAL

En index.html se agregó una galería con botones Anterior y Siguiente que
recorre las 10 fotos de los lugares. Muestra el nombre del lugar y un contador
(ej: 3 / 10).
javascript
function galeriaSiguiente() {
var total = document.querySelectorAll(&#39;.galeria-img&#39;).length;
galeriaIndex = (galeriaIndex + 1) % total;
actualizarGaleria();
}

function galeriaAnterior() {
var total = document.querySelectorAll(&#39;.galeria-img&#39;).length;
galeriaIndex = (galeriaIndex - 1 + total) % total;
actualizarGaleria();
}

PUNTO 6 — Modo oscuro
Se agregó un botón flotante en la esquina inferior derecha que alterna entre
modo claro y modo oscuro usando classList.toggle(). Cambia el fondo, las
tarjetas, el header y el footer.
javascript
function toggleDarkMode() {
var body = document.getElementById(&#39;body-root&#39;);
var btn = document.getElementById(&#39;dark-toggle&#39;);
body.classList.toggle(&#39;dark-mode&#39;);
if (body.classList.contains(&#39;dark-mode&#39;)) {
btn.textContent = &#39;Modo Claro&#39;;
} else {

ESCUELA DE EDUCACIÓN TÉCNICA N.º 3139
“GRAL. MARTIN M. DE GÜEMES”
Dirección: CASEROS N° 1615 – Telf.: (0387) 4320294 SALTA – CAPITAL

btn.textContent = &#39;Modo Oscuro&#39;;
}
PUNTO 7 — Formulario con resumen
En contacto.html, al hacer clic en Ver resumen, el formulario se oculta y
aparece un cuadro con todos los datos ingresados para que el usuario los
revise antes de confirmar el envío. Tiene dos botones: Confirmar y enviar y
Editar para volver al formulario.
javascript
document.getElementById(&#39;form-contacto&#39;).addEventListener(&#39;submit&#39;,
function(e) {
e.preventDefault();
if (!validarForm()) return;
document.getElementById(&#39;res-nombre&#39;).textContent =
document.getElementById(&#39;nombre&#39;).value;
document.getElementById(&#39;res-email&#39;).textContent =
document.getElementById(&#39;email&#39;).value;
// ... resto de campos
document.getElementById(&#39;form-contacto&#39;).style.display = &#39;none&#39;;
document.getElementById(&#39;resumen-box&#39;).style.display = &#39;block&#39;;
});
-----------------------------------------------------------------------------------------------

Servidores-Web-SSR-y-Maquetacion-Modular-con-PHP

Estructura del proyecto en Visual Studio Code. Se observa la carpeta includes/
que contiene los componentes modulares header.php y footer.php,

<img width="310" height="715" alt="image" src="https://github.com/user-attachments/assets/8bfc197b-c60d-4656-a8a0-702ce0dc8eea" />

Estado del repositorio local y sincronización con GitHub.
Se verifica mediante el comando git status el estado del proyecto tras realizar la
migración modular a PHP. La consola confirma la rama principal activa
(master), la sincronización con el servidor remoto (origin/master) y el estado
limpio del área de trabajo (working tree clean), garantizando un control de
versiones correcto y sin cambios pendientes.

<img width="570" height="502" alt="image" src="https://github.com/user-attachments/assets/b9f40b08-1570-4b81-9e9c-79233c49f385" />

Integración de arquitectura modular en el archivo fuente (index.php).
Se visualiza la estructura inicial adoptada tras la refactorización, donde se
asigna de forma dinámica el título de la pestaña mediante la variable
$titulo_pagina, se inyectan estilos personalizados con $extra_styles y se invoca
el encabezado reutilizable a través de la directiva require_once, centralizando
el código HTML repetitivo del sitio.

<img width="572" height="457" alt="image" src="https://github.com/user-attachments/assets/77c6c371-86b9-4e01-a490-624b8902a72e" />

Diseño y estructura del componente modular de cabecera (header.php).
Se visualiza el código fuente del archivo parcial encargado de renderizar la
estructura común del sitio web (etiquetas &lt;head&gt;, metadatos globales,
vinculación de hojas de estilo y la barra de navegación &lt;nav&gt;), permitiendo su
inclusión dinámica en todas las páginas y evitando la duplicación de código.

<img width="562" height="285" alt="image" src="https://github.com/user-attachments/assets/5c918f91-e757-4b56-b936-ed15bcb5af6e" />
Visualización del sitio web en el entorno de desarrollo local.

Se comprueba el correcto funcionamiento de la arquitectura modular y la carga
de estilos mediante el servidor local Apache (XAMPP). La interfaz renderiza de
forma integrada la cabecera, la barra de navegación y el contenido dinámico de
la página principal (index.php).

<img width="572" height="425" alt="image" src="https://github.com/user-attachments/assets/0cf5f10b-f195-4d9b-b6a6-ba2343dec03b" />

Visualización del sitio web en el entorno de desarrollo local.

Se comprueba el correcto funcionamiento de la arquitectura modular y la carga
de estilos mediante el servidor local Apache (XAMPP). La interfaz renderiza de
forma integrada la cabecera, la barra de navegación y el contenido dinámico de
la página principal (index.php).
________________________________________________________________________________________________

seguridad web 
<img width="568" height="270" alt="image" src="https://github.com/user-attachments/assets/618c471a-cfa5-4d50-9f53-ca85777bccc9" />
Formulario de alta/contacto procesado mediante el método POST. Se evidencia
la validación de campos obligatorios en el servidor, la persistencia de datos y el
mensaje de retroalimentación para el usuario.
<img width="568" height="217" alt="image" src="https://github.com/user-attachments/assets/23416d52-cbdc-4b76-9423-e0c8fcf480e0" />
Módulo de consulta rápida implementado mediante el método GET. Se
visualiza la captura del parámetro de búsqueda en la URL
falta integración con la base de datos, pero en el navegador se muestra lo
que pide en el tp
<img width="452" height="573" alt="image" src="https://github.com/user-attachments/assets/c621776e-e152-41bd-b3d7-d4d6a5af2d2a" />
Repositorio oficial en GitHub mostrando la estructura modular y la carpeta
clase5/ sincronizada en la rama principal.

--------------------------------------------------------------------------------------------------------------
TP Diseño y Creación del Esquema Relacional en MySQL


<img width="525" height="302" alt="image" src="https://github.com/user-attachments/assets/ad287a87-72c1-4047-8047-01280657b5a0" />


<img width="605" height="216" alt="image" src="https://github.com/user-attachments/assets/271d919a-04fe-4426-9bab-1f2aec8d232b" />

-- ============================================================
-- Base de Datos para el proyecto: Salta de Mates
-- Entidades:
--   1. usuarios (Administradores y estudiantes registrados)
--   2. lugares (Spots para tomar mate en Salta con FK a usuarios)
--   3. respuestas_quiz (Calificaciones del Curso online con FK a usuarios)
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
  `rol` VARCHAR(20) DEFAULT &#39;estudiante&#39;,
  `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- Usuarios de prueba predeterminados (Clave por defecto de ejemplo: admin123)
INSERT INTO `usuarios` (`nombre`, `usuario`, `email`, `password`, `rol`) VALUES
(&#39;Enriquez Tiago&#39;, &#39;tiago&#39;, &#39;tiago@saltademates.com&#39;,
&#39;$2y$10$H5SQ1qNNvNjXM1UWC8IVFu2T0OwgtjdeZbqWOldV8n4r8vbUqwCFq&#39;, &#39;admin&#39;),
(&#39;Administrador&#39;, &#39;admin&#39;, &#39;admin@saltademates.com&#39;,
&#39;$2y$10$H5SQ1qNNvNjXM1UWC8IVFu2T0OwgtjdeZbqWOldV8n4r8vbUqwCFq&#39;, &#39;admin&#39;)
ON DUPLICATE KEY UPDATE `nombre` = VALUES(`nombre`);
-- 2. Estructura de la tabla `lugares`
CREATE TABLE IF NOT EXISTS `lugares` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `usuario_id` INT NULL,
  `nombre` VARCHAR(150) NOT NULL,
  `ubicacion` VARCHAR(200) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `historia` TEXT NULL,
  `imagen` VARCHAR(255) DEFAULT &#39;cerro.jpg&#39;,
  `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_lugares_usuarios`
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- Volcado de datos de prueba / iniciales de Salta de Mates
INSERT INTO `lugares` (`usuario_id`, `nombre`, `ubicacion`, `descripcion`, `historia`,
`imagen`) VALUES
(1, &#39;Cerro San Bernardo&#39;, &#39;Salta Capital&#39;, &#39;Vista panorámica de toda la ciudad desde la cima.
Ideal para ir al atardecer y matear con vista a los cerros.&#39;, &#39;El cerro tutelar de la ciudad, con
su viacrucis y vegetación autóctona.&#39;, &#39;cerro.jpg&#39;),

(1, &#39;Plaza 9 de Julio&#39;, &#39;Centro Histórico, Salta Capital&#39;, &#39;Rodeada de recovas coloniales, la
Catedral y el Cabildo. Corazón de la ciudad y punto de encuentro obligado.&#39;, &#39;Fundada en
1582, testigo de los principales hechos históricos de la provincia.&#39;, &#39;plaza9dejulio.jpg&#39;),
(1, &#39;Parque Bicentenario&#39;, &#39;Zona Norte, Salta Capital&#39;, &#39;Gran espacio verde con laguna
artificial, caminerías y amplias zonas de césped para reposeras.&#39;, &#39;Inaugurado en 2015
como el pulmón verde más grande de la zona norte.&#39;, &#39;parquesur.jpg&#39;),
(1, &#39;Quebrada de San Lorenzo&#39;, &#39;San Lorenzo (a 12 km de Capital)&#39;, &#39;Reserva natural con
arroyo de montaña, helechos gigantes y vegetación de yunga salteña.&#39;, &#39;Tradicional villa
veraniega salteña con microclima fresco todo el año.&#39;, &#39;sanlorenzo.jpg&#39;),
(1, &#39;Plaza Güemes&#39;, &#39;Salta Capital&#39;, &#39;Ubicada frente a la Legislatura, arbolada con jacarandás
y rodeada de ferias artesanales los fines de semana.&#39;, &#39;Homenaje al héroe nacional General
Martín Miguel de Güemes.&#39;, &#39;guemes.jpg&#39;),
(1, &#39;Paseo de los Poetas&#39;, &#39;Salta Capital&#39;, &#39;Canal con puente peatonal, murales y esculturas
dedicadas a poetas salteños.&#39;, &#39;Espacio bohemio recuperado en honor al folclore y la poesía
local.&#39;, &#39;legislatura.jpg&#39;),
(1, &#39;Centro Cultural Palacio Zorrilla&#39;, &#39;Salta Capital&#39;, &#39;Patio interior colonial con vegetación y
sombra permanente en pleno casco histórico.&#39;, &#39;Antigua casona del siglo XIX sede de
actividades culturales de la UNSa.&#39;, &#39;paludica.png&#39;),
(1, &#39;Mirador del Portezuelo&#39;, &#39;Acceso Este, Salta Capital&#39;, &#39;Punto de bienvenida a la ciudad
con vista panorámica a los valles y cerros salteños.&#39;, &#39;Histórico acceso vial por la ruta
nacional 9.&#39;, &#39;portezuelo.jpg&#39;),
(1, &#39;Plaza Alvarado&#39;, &#39;Barrio Macrocentro, Salta Capital&#39;, &#39;Plaza barrial muy concurrida por
vecinos, con arboleda frondosa y puestos de churros y bizcochitos.&#39;, &#39;Corazón del tradicional
barrio Alvarado.&#39;, &#39;plaza.jpg&#39;),
(1, &#39;Parque Sur&#39;, &#39;Zona Sur, Salta Capital&#39;, &#39;Nuevo parque urbano con anfiteatro, pistas de
salud y amplios sectores de pasto para el mate familiar.&#39;, &#39;Construido sobre los predios del
ex aeropuerto para beneficio del sector sur.&#39;, &#39;bicentenario.jpg&#39;);
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

<img width="621" height="373" alt="image" src="https://github.com/user-attachments/assets/2e448701-f222-4b04-844c-3921336a7248" />
consultas en sql
<img width="402" height="392" alt="image" src="https://github.com/user-attachments/assets/bad45537-d098-4946-b0d5-56b1296c63a8" />
inicio de sesion 
<img width="403" height="748" alt="image" src="https://github.com/user-attachments/assets/b26483d3-95e2-4c95-b0c1-26ea8db18e64" />
inicio de sesion como admi exitoso
<img width="400" height="331" alt="image" src="https://github.com/user-attachments/assets/2b6332c8-05ea-413c-9518-42897cf81ecb" />
oton para cerrar sesion 
<img width="401" height="615" alt="image" src="https://github.com/user-attachments/assets/e4b357a9-3586-47ea-a2dc-a4dc35d277d2" />
8. Resultado de UPDATE (cambio de categoría)

-----------------------------------------------------------------------------------------------------------------------

Sesiones, Login y Control de Acceso por Roles

<img width="566" height="268" alt="image" src="https://github.com/user-att3. Sesion y cookies seguras (config/session.php)

Se centraliza el inicio de sesion en un unico archivo. Se activan
use_strict_mode (rechaza IDs de sesion inventados), use_only_cookies (el ID
nunca va en la URL), cookie HttpOnly (JavaScript no puede leerla) y

SameSite=Lax (mitiga CSRF). El flag Secure se activa automaticamente
cuando el sitio se sirve por HTTPS.
&lt;?php
// Sesión segura (TP8): cookies HttpOnly + SameSite + modo estricto.
// Se inicia solo si no hay una sesión activa.
if (session_status() === PHP_SESSION_NONE) {
$https = (!empty($_SERVER[&#39;HTTPS&#39;]) &amp;&amp; $_SERVER[&#39;HTTPS&#39;] !== &#39;off&#39;);

ini_set(&#39;session.use_strict_mode&#39;, &#39;1&#39;); // rechaza IDs de sesión no generados
por el servidor
ini_set(&#39;session.use_only_cookies&#39;, &#39;1&#39;); // el ID nunca viaja por URL
ini_set(&#39;session.cookie_httponly&#39;, &#39;1&#39;); // JS no puede leer la cookie (mitiga
XSS)

session_set_cookie_params([
&#39;lifetime&#39; =&gt; 0, // expira al cerrar el navegador
&#39;path&#39; =&gt; &#39;/&#39;,
&#39;secure&#39; =&gt; $https, // solo HTTPS cuando esté disponible
&#39;httponly&#39; =&gt; true,
&#39;samesite&#39; =&gt; &#39;Lax&#39;, // mitiga CSRF
]);

session_start();


<img width="568" height="506" alt="image" src="https://github.com/user-attachments/assets/2bb2e072-8dc4-43d7-b4e7-86f35a16f130" />


Entradas saneadas con trim() y filter_var(FILTER_VALIDATE_EMAIL); toda
salida HTML pasa por htmlspecialchars() (prevencion de XSS). Se verifica con
consulta preparada que usuario/email no existan, y la contrasena se encripta
con password_hash($password, PASSWORD_BCRYPT) antes del INSERT
preparado.
// 2. Verificar que el usuario o email no existan previamente
if (empty($errores)) {
$stmt = $pdo-&gt;prepare(&quot;SELECT id FROM usuarios WHERE usuario = :u OR email =
:e LIMIT 1&quot;);
$stmt-&gt;execute([&#39;:u&#39; =&gt; $usuario, &#39;:e&#39; =&gt; $email]);
if ($stmt-&gt;fetch()) {
$errores[] = &quot;El nombre de usuario o correo electrónico ya está
registrado.&quot;;
}
}

// 3. Crear el nuevo usuario con contraseña encriptada (Bcrypt)
if (empty($errores)) {
try {
$password_hash = password_hash($password, PASSWORD_BCRYPT);
$rol = &#39;estudiante&#39;; // Rol por defecto

$sql = &quot;INSERT INTO usuarios (nombre, usuario, email, password, rol)
VALUES (:nombre, :usuario, :email, :password, :rol)&quot;;
$stmt = $pdo-&gt;prepare($sql);
$stmt-&gt;execute([
&#39;:nombre&#39; =&gt; $nombre,
&#39;:usuario&#39; =&gt; $usuario,
&#39;:email&#39; =&gt; $email,
&#39;:password&#39; =&gt; $password_hash,
&#39;:rol&#39; =&gt; $rol
]);
<img width="470" height="510" alt="image" src="https://github.com/user-attachments/assets/b05c45ae-91dd-47f4-bb1d-3115761dfb21" />

6. Guardian de rutas (auth_guard.php)
Script reutilizable: si no existe $_SESSION[&#39;usuario_id&#39;] redirige a
login.php?error=acceso_denegado. Si la pagina define $requiredRole = &#39;admin&#39;
y el rol de la sesion no coincide, redirige a login.php?error=rol_insuficiente.
Resuelve la ruta de login segun la carpeta del script (raiz o admin/).
// Ruta a login.php según la carpeta del script que incluye el guard.
// Se usa dirname(realpath()) para que funcione igual con &quot;/&quot; o &quot;\&quot; (Windows/XAMPP).
$__scriptDir = basename(dirname(realpath($_SERVER[&#39;SCRIPT_FILENAME&#39;])));
$__loginUrl = ($__scriptDir === &#39;admin&#39;) ? &#39;../login.php&#39; : &#39;login.php&#39;;

// 1. Verificar que la sesión esté iniciada y el usuario autenticado
if (!isset($_SESSION[&#39;usuario_id&#39;])) {

header(&#39;Location: &#39; . $__loginUrl . &#39;?error=acceso_denegado&#39;);
exit;
}

// 2. Verificar rol si se definió $requiredRole antes de incluir este archivo
if (isset($requiredRole) &amp;&amp; ($_SESSION[&#39;rol&#39;] ?? $_SESSION[&#39;usuario_rol&#39;] ?? &#39;&#39;) !==
$requiredRole) {
header(&#39;Location: &#39; . $__loginUrl . &#39;?error=rol_insuficiente&#39;);
exit;
}
Paginas protegidas: admin/index.php, admin/crear.php, admin/editar.php (via
admin/header.php) y admin/eliminar.php. Todas exigen rol admin.
&lt;?php
require_once __DIR__.&#39;/../config/session.php&#39;;
// Control de acceso (TP8): guardián reutilizable, solo rol &#39;admin&#39;
$requiredRole = &#39;admin&#39;;
require_once __DIR__.&#39;/../auth_guard.php&#39;;

if (!isset($titulo_admin)) {
$titulo_admin = &quot;Panel de Administración - Salta de Mates&quot;;

<img width="581" height="625" alt="image" src="https://github.com/user-attachments/assets/3d9dec08-6947-4edc-84e1-3e44ab4f85f5" />

7. Cierre de sesion (logout.php)
Vacia $_SESSION, elimina la cookie de sesion del navegador con setcookie()
(expiracion en el pasado), ejecuta session_unset() y session_destroy(), y
redirige a login.php.
&lt;?php
require_once &#39;config/session.php&#39;;
// Unset all session variables
$_SESSION = [];
// Delete session cookie
if (ini_get(&#39;session.use_cookies&#39;)) {
$params = session_get_cookie_params();

setcookie(session_name(), &#39;&#39;, time() - 42000,
$params[&#39;path&#39;], $params[&#39;domain&#39;],
$params[&#39;secure&#39;], $params[&#39;httponly&#39;]
);
}
session_unset();
session_destroy();
header(&#39;Location: login.php&#39;);
exit;
<img width="573" height="280" alt="image" src="https://github.com/user-attachments/assets/9341c5cb-cb75-405a-abb5-ea0814970ca3" />

Pruebas ejecutadas contra el servidor local (XAMPP):
- Sin sesion: admin/index.php, crear.php, editar.php y eliminar.php responden
302 a ../login.php?error=acceso_denegado.
- Login admin: 302 a admin/index.php y luego 200 en el panel.
- Logout: la cookie se invalida (Max-Age=0) y admin/index.php vuelve a redirigir
al login.
- La cookie PHPSESSID se emite con HttpOnly y SameSite=Lax.
- Registro: un usuario nuevo se crea y queda logueado (302 a index.php); en la
base el campo password guarda un hash bcrypt (prefijo $2y$10$, 60
caracteres), nunca la clave en texto plano.
- Registro duplicado: usar un usuario o email ya existente es rechazado con el
mensaje de que ya esta registrado.
- Login con clave incorrecta: muestra Usuario o contrasena incorrectos y no
crea sesion.

- Control por roles: un usuario sin rol admin que entra a admin/index.php es
redirigido a login.php?error=rol_insuficiente.
- En cada login se emiten dos cookies PHPSESSID: la primera al iniciar la
sesion y la segunda tras session_regenerate_id(true), que es el
comportamiento esperado contra Session Fixation.
Nota: el rol por defecto de los usuarios nuevos en este proyecto es estudiante
(el enunciado ejemplifica usuario) y la fecha de alta se guarda en la columna
creado_en (equivalente a created_at). El control de acceso distingue admin del
resto de los roles.
