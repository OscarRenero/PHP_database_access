Proyecto Foro Web – PHP y MySQL

Consiste en una aplicación web tipo **foro**, con sistema de usuarios, publicaciones y comentarios, desarrollada con **PHP**, **MySQL**, **HTML** y **CSS**.

## Tecnologías utilizadas
* **Lenguaje servidor:** PHP
* **Base de datos:** MySQL
* **Frontend:** HTML5 y CSS3
* **Control de versiones:** Git y GitHub
## Funcionalidades

### Usuarios
* Registro de usuarios con almacenamiento en base de datos
* Inicio y cierre de sesión mediante sesiones PHP
* Perfil de usuario con visualización de datos
* Posibilidad de modificar la contraseña

### Publicaciones (Posts)
* Creación de publicaciones por usuarios autenticados
* Visualización de un feed con todas las publicaciones
* Vista resumida de cada post en el feed
* Acceso al contenido completo de cada publicación en una página independiente

### Comentarios (Threads)
* Sistema de comentarios asociado a cada publicación
* Relación de cada comentario con el usuario que lo crea
* Visualización de los hilos de comentarios en cada post

## Base de datos
La base de datos está compuesta por **tres tablas principales**, relacionadas entre sí:

* **users**: almacena la información de registro de los usuarios
* **posts**: almacena las publicaciones y las relaciona con su creador
* **comments**: almacena los comentarios y los relaciona con el usuario y la publicación

El script de creación se encuentra en:

```
sql/database.sql
```
## Estructura del proyecto

```
foro-php/
│── config/
│   └── db.php  
│
│── sql/
│   └── database.sql
│
│── public/
│   ├── index.php         # Página principal
│   ├── login.php         # Inicio de sesión
│   ├── register.php      # Registro de usuarios
│   ├── logout.php        # Cierre de sesión
│   ├── profile.php       # Perfil de usuario
│   ├── feed.php          # Feed de publicaciones
│   ├── post.php          # Post completo con comentarios
│   └── create_post.php   # Creación de publicaciones
│
│── includes/
│   ├── header.php        # Cabecera común
│   ├── footer.php        # Pie de página
│   └── auth.php          # Protección de rutas
│
│── assets/
│   └── style.css         # Estilos CSS
```
## Instalación y ejecución

1. Clonar el repositorio:

2. Copiar el proyecto en el directorio del servidor web (XAMPP, WAMP o similar).

3. Crear la base de datos ejecutando el script `database.sql` en phpMyAdmin o MySQL.

4. Configurar la conexión a la base de datos en:

   ```
   config/db.php
   ```

5. Acceder a la aplicación desde el navegador:

   ```
   http://localhost/foro-php/public
   ```

## Organización del trabajo

El desarrollo del proyecto se ha gestionado mediante:

* **GitHub** para el control de versiones, manteniendo un historial claro de commits.
* **Tablero Kanban** para la organización de tareas y reparto del trabajo entre los miembros del equipo.

## Notas finales

Este proyecto tiene fines **educativos** y está orientado a demostrar el uso de PHP y MySQL para el acceso y gestión de bases de datos desde el servidor, aplicando buenas prácticas básicas de organización y documentación del código.
