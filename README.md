# 📝 Sistema de Gestión de Tareas (PHP, MySQL & MVC)

Una aplicación web interactiva desarrollada desde cero para gestionar tareas pendientes de forma eficiente. Este proyecto ha sido reestructurado bajo un patrón arquitectónico **MVC (Modelo-Vista-Controlador)** simplificado, demostrando habilidades avanzadas en organización de código, separación de responsabilidades y desarrollo backend robusto.

---

## 🚀 Características principales
* **Arquitectura MVC Profesional**: Separación total entre la lógica del negocio, el control de flujos y la interfaz de usuario.
* **Ciclo de Vida de Estados**: Control fluido de tareas mediante transiciones dinámicas entre los estados `Pendiente`, `En Progreso` y `Completada`.
* **Operaciones CRUD completas**: Creación, lectura, actualización y eliminación de registros en tiempo real.
* **Seguridad Implementada**: Uso estricto de **PDO** (PHP Data Objects) con sentencias preparadas para la prevención de ataques por Inyección SQL.
* **Interfaz Responsiva**: Diseño moderno, limpio y adaptable a cualquier dispositivo móvil o de escritorio mediante CSS nativo.

---

## 📐 Arquitectura del Proyecto (Patrón MVC)

El proyecto implementa una separación clara de responsabilidades para garantizar la escalabilidad y facilidad de mantenimiento del código:

*   **`index.php` (Controlador Principal):** Actúa como el núcleo de la aplicación. Captura todas las peticiones del usuario (`GET` y `POST`), interactúa con el Modelo para procesar o alterar datos y finalmente despacha la Vista correspondiente.
*   **`modelos/Tarea.php` (Modelo):** Clase encargada exclusivamente del acceso a datos. Contiene los métodos SQL (`SELECT`, `INSERT`, `UPDATE`, `DELETE`) y encapsula la comunicación con la base de datos MySQL a través de PDO.
*   **`vistas/lista_tareas.php` (Vista):** Contiene la estructura puramente visual (HTML5/CSS3). No realiza consultas a la base de datos; solo recibe las variables preparadas por el controlador y las renderiza utilizando desinfectado de datos básico con `htmlspecialchars()`.
*   **`conexion.php` (Configuración):** Centraliza la configuración del entorno (Host, BD, credenciales) y provee la instancia única de conexión PDO configurada en modo seguro de excepciones.

### 📁 Estructura de Archivos
```text
gestion_tareas/
│
├── modelos/
│   └── Tarea.php           # Capa de Datos (Lógica y Consultas SQL)
│
├── vistas/
│   └── lista_tareas.php    # Capa de Presentación (Interfaz de Usuario HTML)
│
├── conexion.php            # Conexión Segura PDO a MySQL
├── database.sql            # Script de inicialización de la Base de Datos
├── estilos.css             # Estilos globales y diseño responsivo
├── index.php               # Controlador Principal (Enrutador de peticiones)
└── README.md               # Documentación Técnica del Proyecto
```

---

## 🛠️ Tecnologías utilizadas
* **Backend:** PHP 8.x (Programación Orientada a Objetos)
* **Base de Datos:** MySQL (Motor InnoDB con integridad referencial)
* **Frontend:** HTML5 y CSS3 nativo (CSS Grid y Flexbox)
* **Entorno Local:** XAMPP / Apache / MySQL Workbench
* **Control de Versiones:** Git & GitHub

---

## 📋 Requisitos e Instalación

Para replicar este proyecto en tu entorno local, asegúrate de cumplir con los siguientes pasos:

Gracias a la contenedorización, no necesitas instalar XAMPP ni configurar bases de datos manualmente en tu máquina local. Solo requieres tener instalado [Docker Desktop](https://docker.com).

### 1. Clonar el repositorio
Abre tu terminal en cualquier carpeta de tu computadora y ejecuta:
```bash
git clone https://github.com
cd gestion_tareas_php
```

### 2. Desplegar con Docker Compose
Asegúrate de tener Docker Desktop abierto. Luego, en la terminal de la raíz del proyecto, ejecuta el siguiente comando mágico:
```bash
docker compose up -d --build
```
*Este comando descargará las imágenes oficiales de PHP y MySQL, compilará tu entorno aislado, creará la base de datos e importará automáticamente la estructura y los datos de prueba desde el archivo `database.sql`.*

### 3. Acceder a la Aplicación
Abre tu navegador web favorito e ingresa a la siguiente dirección:
* **Aplicación Web:** `http://localhost:8080/index.php`

---

### 🔍 Gestión Local de la Base de Datos (Opcional)
Si deseas conectar un gestor visual como **MySQL Workbench** a la base de datos que corre dentro del contenedor, utiliza los siguientes datos de conexión:
* **Host:** `127.0.0.1` (o `localhost`)
* **Puerto:** `3307` *(mapeado externamente para evitar conflictos con instalaciones locales)*
* **Usuario:** `root`
* **Contraseña:** `root_password`

## ⚖️ Licencia
Este proyecto es de código abierto y está disponible bajo los términos de la [Licencia MIT](LICENSE). Puedes usarlo y modificarlo libremente para tu aprendizaje o portafolio.
