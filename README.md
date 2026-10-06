

### Descripción general

Este es un **Sistema de Gestión Escolar** desarrollado en PHP con MySQL. Permite administrar usuarios, roles, personal administrativo, docentes, estudiantes, niveles, grados, materias, calificaciones, pagos, inscripciones y configuración institucional.

El sistema utiliza el template **AdminLTE** para la interfaz de administración, **SweetAlert2** para alertas y **TCPDF** para generación de PDFs.

Nombre de la aplicación: **SISTEMA DE GESTIÓN ESCOLAR**  
Base de datos: `sisgestionescolar`  
Zona horaria: `America/Bogota`

---

### Tecnologías utilizadas

| Tecnología       | Uso                          |
|------------------|------------------------------|
| PHP              | Backend                      |
| MySQL + PDO      | Base de datos                |
| AdminLTE         | Panel de administración      |
| Bootstrap 4      | Estilos y componentes        |
| Font Awesome / Bootstrap Icons | Iconos               |
| SweetAlert2      | Notificaciones               |
| TCPDF            | Generación de PDFs           |
| jQuery           | Interactividad               |

---

### Estructura del proyecto

```
Project/
├── admin/                  # Panel de administración
│   ├── administrativos/
│   ├── calificaciones/
│   ├── configuraciones/
│   ├── docentes/
│   ├── estudiantes/
│   ├── grados/
│   ├── inscripciones/
│   ├── layout/
│   ├── materias/
│   ├── niveles/
│   ├── pagos/
│   ├── roles/
│   ├── usuarios/
│   └── index.php           # Dashboard principal
├── app/
│   ├── config.php          # Configuración de BD y constantes
│   └── controllers/        # Controladores por módulo
├── database/
│   └── db.sql              # Script de creación de tablas e inserts iniciales
├── layout/                 # Layouts compartidos (mensajes, partes)
├── login/
│   ├── controller_login.php
│   ├── index.php
│   └── logout.php
├── public/
│   ├── dist/               # AdminLTE
│   ├── plugins/            # Plugins (jQuery, Bootstrap, FontAwesome, etc.)
│   ├── images/
│   └── TCPDF-main/         # Librería TCPDF
└── index.php               # (actualmente vacío)
```

---

### Requisitos

- PHP 7.4 o superior (recomendado 8.x)
- MySQL / MariaDB
- Servidor web (Apache recomendado – XAMPP, Laragon, WAMP, etc.)
- Extensiones PHP: `pdo_mysql`, `mbstring`, `gd` (para TCPDF)

---

### Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/JhonAlexanderGarces/Project.git
   ```

2. **Mover a la carpeta del servidor web**
   - Ejemplo con XAMPP: `C:\xampp\htdocs\sisgestionescolar`
   - O renombrar la carpeta a `sisgestionescolar`

3. **Crear la base de datos**
   - Abre phpMyAdmin o tu cliente MySQL.
   - Crea una base de datos llamada `sisgestionescolar`.
   - Importa el archivo: `database/db.sql`

4. **Configurar la conexión**
   Edita el archivo `app/config.php`:

   ```php
   define('SERVIDOR','localhost');
   define('USUARIO','root');
   define('PASSWORD','');               // Cambia si tienes contraseña
   define('BD','sisgestionescolar');

   define('APP_NAME','SISTEMA DE GESTIÓN ESCOLAR');
   define('APP_URL','http://localhost/sisgestionescolar');  // Ajusta según tu ruta
   ```

5. **Acceder al sistema**
   - URL de login: `http://localhost/sisgestionescolar/login`
   - Credenciales por defecto:
     - **Email:** `admin@admin.com`
     - **Contraseña:** (la que esté hasheada en la base de datos – normalmente `123456` o la que se usó al crear el hash)

---

### Módulos principales

| Módulo              | Descripción                                      |
|---------------------|--------------------------------------------------|
| **Roles**           | Administración de roles (Admin, Director, Docente, etc.) |
| **Usuarios**        | Gestión de cuentas de usuario                    |
| **Administrativos** | Personal administrativo                          |
| **Docentes**        | Gestión de profesores y especialidades           |
| **Estudiantes**     | Registro de alumnos + datos de padres (PPFF)     |
| **Niveles**         | Niveles educativos (Inicial, Primaria, etc.)     |
| **Grados**          | Cursos y paralelos                               |
| **Materias**        | Asignaturas                                      |
| **Calificaciones**  | Registro de notas (nota1 a nota4)                |
| **Pagos**           | Control de pagos mensuales de estudiantes        |
| **Inscripciones**   | Gestión de inscripciones                         |
| **Configuraciones** | Datos de la institución (nombre, logo, contacto) |

---

### Base de datos – Tablas principales

- `roles`
- `usuarios`
- `personas`
- `administrativos`
- `docentes`
- `estudiantes`
- `ppffs` (padres/tutores)
- `configuracion_instituciones`
- `gestiones` (años lectivos)
- `niveles`
- `grados`
- `materias`
- `pagos`
- `asignaciones`
- `calificaciones`

---

### Características técnicas

- Autenticación con `password_verify()` (contraseñas hasheadas con `password_hash`)
- Uso de PDO con prepared statements
- Soft delete mediante campo `estado` (`1` = activo)
- Campos de auditoría: `fyh_creacion` y `fyh_actualizacion`
- Dashboard con contadores de registros por módulo
- Interfaz responsive con AdminLTE

---

### Recomendaciones de mejora

1. Completar el archivo `index.php` de la raíz (redirección al login).
2. Proteger mejor las rutas del panel admin (verificar sesión en todos los archivos).
3. Implementar control de acceso por roles.
4. Usar variables de entorno o un archivo de configuración fuera del webroot.
5. Agregar validaciones más robustas y protección CSRF.
6. Completar los módulos que aún no tienen toda la lógica implementada.

---

### Autor

**Jhon Alexander Garces**  
Repositorio: [https://github.com/JhonAlexanderGarces/Project](https://github.com/JhonAlexanderGarces/Project)

---

¿Quieres que te genere también un archivo `README.md` listo para subir al repositorio, o necesitas documentación más detallada de algún módulo específico (por ejemplo, calificaciones, pagos o la estructura de controladores)?
