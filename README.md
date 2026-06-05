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

### 1. Clonar el repositorio
Abre tu terminal en la carpeta `htdocs` de XAMPP y ejecuta:
```bash
git clone https://github.com
```

### 2. Configurar la Base de Datos
1. Abre tu gestor de base de datos (como MySQL Workbench).
2. Abre e importa el archivo `database.sql` ubicado en la raíz del proyecto para generar automáticamente el esquema `gestion_tareas`, las tablas y el usuario de pruebas.

### 3. Ejecutar el Servidor
1. Inicia los módulos de **Apache** y **MySQL** en tu panel de XAMPP.
2. Abre tu navegador e ingresa a: `http://localhost/gestion_tareas/index.php`

---

## 📸 Demostración del Proyecto
![Vista Principal de la Aplicación](captura.png)

---

## ⚖️ Licencia
Este proyecto es de código abierto y está disponible bajo los términos de la [Licencia MIT](LICENSE). Puedes usarlo y modificarlo libremente para tu aprendizaje o portafolio.
