# Proyecto LAMP Contenerizado

Este proyecto es una aplicación web CRUD (Crear, Leer, Actualizar, Eliminar) desarrollada con PHP y MariaDB, desplegada mediante contenedores Docker usando **Nginx** como servidor web en lugar de Apache.

## 🏗️ Arquitectura

La aplicación está compuesta por tres contenedores Docker que trabajan en conjunto:

- **web** (Nginx): Servidor web que escucha en el puerto 8080 y redirige las peticiones PHP al contenedor `php`
- **php** (PHP-FPM 8.2): Procesador PHP que ejecuta el código de la aplicación
- **db** (MariaDB): Base de datos que almacena la información de la tabla `personas`

## 📁 Estructura del Proyecto

```
proyecto_lamp_contenerizado/
├── docker-compose.yml       # Orquestación de los contenedores
├── nginx.conf              # Configuración del servidor Nginx
├── db-init/
│   └── init.sql           # Script de inicialización de la base de datos
└── src/
    ├── index.php          # Página principal con listado y formulario
    ├── conexion.php       # Conexión a la base de datos
    ├── editar.php         # Edición de registros
    └── borrar.php         # Eliminación lógica de registros
```

## 🗄️ Base de Datos

La base de datos `proyecto_lamp` contiene una tabla `personas` con la siguiente estructura:

- `id`: INT (AUTO_INCREMENT, PRIMARY KEY)
- `nombre`: VARCHAR(100)
- `activo`: TINYINT(1) - Para borrado lógico

## 🚀 Instrucciones de Uso

### Requisitos Previos

- Docker instalado
- Docker Compose instalado

### Levantar la Aplicación

1. Desde el directorio del proyecto, ejecuta:

```bash
docker-compose up -d
```

Este comando:
- Descarga las imágenes necesarias (Nginx, PHP-FPM, MariaDB)
- Crea los tres contenedores
- Inicializa la base de datos con el script `init.sql`
- Levanta todos los servicios en segundo plano

2. Accede a la aplicación en tu navegador:

```
http://localhost:8080
```

### Detener la Aplicación

Para detener los contenedores:

```bash
docker-compose down
```

Para detener y eliminar también los volúmenes (base de datos):

```bash
docker-compose down -v
```

### Ver los Logs

Para ver los logs de todos los servicios:

```bash
docker-compose logs -f
```

Para ver los logs de un servicio específico:

```bash
docker-compose logs -f web
docker-compose logs -f php
docker-compose logs -f db
```

### Reiniciar los Servicios

```bash
docker-compose restart
```

## 🔧 Configuración

### Credenciales de la Base de Datos

Las credenciales están definidas en el archivo `docker-compose.yml`:

- **Host**: `db` (nombre del servicio)
- **Base de datos**: `proyecto_lamp`
- **Usuario**: `admin`
- **Contraseña**: `1234`
- **Root Password**: `Megamanzero`

### Puerto de Acceso

La aplicación está configurada para escuchar en el puerto **8080** del host, que mapea al puerto 80 del contenedor Nginx.

## 🔄 Flujo de Funcionamiento

1. El navegador hace una petición HTTP al puerto 8080
2. **Nginx** (contenedor `web`) recibe la petición
3. Si es un archivo PHP, Nginx redirige la petición al contenedor `php` mediante FastCGI en el puerto 9000
4. **PHP-FPM** (contenedor `php`) procesa el código PHP
5. Si es necesario, PHP se conecta al contenedor `db` para consultar o modificar datos en **MariaDB**
6. La respuesta se envía de vuelta al navegador a través de Nginx

## 📝 Funcionalidades de la Aplicación

- **Listar personas**: Muestra todos los registros activos de la tabla `personas`
- **Agregar persona**: Formulario para insertar nuevos registros
- **Editar persona**: Modificar el nombre de una persona existente
- **Eliminar persona**: Borrado lógico (marca el registro como inactivo)

## 🛠️ Comandos Útiles

### Acceder al contenedor PHP para debugging

```bash
docker-compose exec php sh
```

### Acceder a MariaDB

```bash
docker-compose exec db mysql -u admin -p proyecto_lamp
```

Contraseña: `1234`

### Reconstruir los contenedores

Si modificas el `docker-compose.yml` o quieres forzar la reconstrucción:

```bash
docker-compose up -d --build
```

## 📌 Notas

- Los archivos PHP están montados como volumen, por lo que cualquier cambio en `src/` se refleja inmediatamente sin necesidad de reiniciar los contenedores
- La base de datos persiste en un volumen Docker llamado `db_data`
- El script `init.sql` solo se ejecuta la primera vez que se crea el contenedor de base de datos
- La extensión `mysqli` se instala automáticamente en el contenedor PHP al iniciar

## 🔄 Diferencias con el Proyecto LAMP Original

- **Servidor Web**: Nginx en lugar de Apache
- **Despliegue**: Docker Compose en lugar de instalación local
- **Aislamiento**: Cada componente corre en su propio contenedor
- **Portabilidad**: El proyecto puede ejecutarse en cualquier sistema con Docker instalado
