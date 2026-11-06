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
