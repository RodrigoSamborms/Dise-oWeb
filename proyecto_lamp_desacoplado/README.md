http://localhost/proyecto_lamp_desacoplado/src/faseA/web/

proyecto_lamp_desacoplado
├ src
| ├ faseA
| | ├ api
| | | ├ conexion.php
| | | └ personas.php
| | └ web
| | ├borrar.php
| | ├editar.php
| | └index.php
| ├ faseB

proyecto_lamp_desacoplado/src/faseB/
├── docker-compose.yml
├── nginx-web.conf        <-- Configuración para el Frontend
├── nginx-api.conf        <-- Configuración para la API
├── db-init/
│   └── init.sql          <-- Tu archivo SQL de inicialización
├── api/
│   ├── conexion.php
│   └── personas.php
└── web/
    ├── index.php
    ├── editar.php
    └── borrar.php