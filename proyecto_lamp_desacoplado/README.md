# Proyecto LAMP Desacoplado

Este proyecto implementa una arquitectura de aplicación LAMP desacoplada en dos fases: **faseA** con una estructura tradicional y **faseB** con microservicios containerizados.

---

## 📋 Descripción de Fases

### **Fase A - Transición hacia Microservicios**

**Propósito:** Fase A representa el primer paso en la migración del proyecto monolítico original ([`proyecto_lamp`](../proyecto_lamp) en la raíz) hacia una arquitectura de microservicios desacoplada.

**Cambio clave:** En esta fase se **desacopla el acceso a la base de datos** creando una API separada. Aunque el API y el frontend aún residen en la misma carpeta, la separación conceptual permite que:
- El frontend acceda a los datos **a través de la API**, no directamente desde la BD
- Los cambios en la lógica de datos o en la BD **no afecten al frontend**, siempre que la API mantenga su contrato
- El código del frontend permanece **independiente y desacoplado**

Esta arquitectura prepara el camino para Fase B, donde backend y frontend se separan completamente en contenedores Docker.

**Ubicación:** `src/faseA/`

**Base para Containerización:** Fase A sirve como base para la containerización en Fase B. En Fase B se realiza la siguiente mejora:
- Se **reemplaza Apache por Nginx**, que es más eficiente y se adapta mejor a arquitecturas de contenedores
- Nginx consume menos recursos y es ideal para microservicios en Docker
- Esta migración permite un mejor rendimiento y escalabilidad horizontal

**Componentes:**
- `api/` - Contiene la lógica de datos y consultas
  - `conexion.php` - Configuración de conexión a la base de datos
  - `personas.php` - Endpoint de API para gestionar personas
- `web/` - Contiene la interfaz de usuario
  - `index.php` - Página principal
  - `editar.php` - Página para editar registros
  - `borrar.php` - Página para eliminar registros

**URL de acceso:**
```
http://localhost/proyecto_lamp_desacoplado/src/faseA/web/
```

---

### **Fase B - Arquitectura Desacoplada con Docker**
Implementación con microservicios containerizados, separando completamente la API (backend) del frontend, cada uno con su propio contenedor de PHP y Nginx.

**Ubicación:** `src/faseB/`

**Componentes:**
- `docker-compose.yml` - Orquestación de contenedores
- `nginx-api.conf` - Configuración de Nginx para la API
- `nginx-web.conf` - Configuración de Nginx para el frontend
- `db-init/` - Inicialización de la base de datos
  - `init.sql` - Script SQL para crear tablas e insertar datos
- `api/` - Microservicio de API (Backend)
  - `conexion.php` - Configuración de conexión
  - `personas.php` - Endpoints REST para la API
- `web/` - Microservicio Web (Frontend)
  - `index.php` - Página principal
  - `editar.php` - Página para editar registros
  - `borrar.php` - Página para eliminar registros

**Direcciones de Acceso:**
```
Frontend:  http://localhost:8080
API:       http://localhost:8081/personas.php
```

---

## 📁 Estructura de Directorios Completa

```
proyecto_lamp_desacoplado/
├── README.md (este archivo)
└── src/
    ├── faseA/
    │   ├── api/
    │   │   ├── conexion.php
    │   │   └── personas.php
    │   └── web/
    │       ├── borrar.php
    │       ├── editar.php
    │       └── index.php
    │
    └── faseB/
        ├── docker-compose.yml
        ├── nginx-api.conf
        ├── nginx-web.conf
        ├── README.md
        ├── db-init/
        │   └── init.sql
        ├── api/
        │   ├── conexion.php
        │   └── personas.php
        └── web/
            ├── borrar.php
            ├── editar.php
            └── index.php
```

---

## 🐳 Guía de Uso - Fase B

### Requisitos
- Docker y Docker Compose instalados

### Iniciar los contenedores
```bash
cd src/faseB
docker-compose up -d
```

### Detener los contenedores
```bash
docker-compose down
```

### Limpiar volúmenes y reiniciar (útil para reinicializar la BD)
```bash
docker-compose down -v
docker-compose up -d
```

### Acceder a los servicios
- **Frontend:** Abre tu navegador en `http://localhost:8080`
- **API:** Consulta `http://localhost:8081/personas.php`

---

## 🗄️ Base de Datos

La base de datos se inicializa automáticamente al crear los contenedores usando el archivo `src/faseB/db-init/init.sql`.

**Tabla: personas**
| Campo  | Tipo        | Descripción           |
|--------|-------------|----------------------|
| id     | INT         | ID único (autoincrement) |
| nombre | VARCHAR(100)| Nombre de la persona  |
| activo | TINYINT(1)  | Estado (1=activo, 0=inactivo) |

**Datos iniciales:**
- Usuario Inicial
- Prueba Docker

---

## 📝 Notas

- **Fase A** es ideal para desarrollo local rápido sin containerización
- **Fase B** es una arquitectura más escalable y profesional, separando completamente backend y frontend
- Los contenedores de Fase B incluyen MySQL/MariaDB, PHP-FPM y Nginx
- La API en Fase B usa variables de entorno para configurar credenciales de base de datos
