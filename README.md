# 📝 Sistema de Gestión de Tareas (PHP & MySQL)

Una aplicación web interactiva y responsiva desarrollada desde cero para gestionar tareas pendientes de forma eficiente. Este proyecto sirve como demostración de habilidades esenciales en el desarrollo backend, manipulación de bases de datos relacionales y diseño web adaptativo.

---

## 🚀 Características principales
* **Operaciones CRUD completas**: Creación, lectura, actualización y eliminación de tareas (en desarrollo continuo).
* **Base de Datos Relacional**: Arquitectura robusta que conecta usuarios, categorías y tareas mediante claves foráneas.
* **Seguridad Avanzada**: Uso estricto de **PDO** y sentencias preparadas para mitigar ataques de inyección SQL.
* **Interfaz Moderna**: Diseño limpio, responsivo y estilizado exclusivamente con CSS nativo (sin frameworks).

---

## 🛠️ Tecnologías utilizadas
* **Backend:** PHP 8.x
* **Base de Datos:** MySQL
* **Frontend:** HTML5 y CSS3 nativo
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
1. Abre tu gestor de base de datos (como MySQL Workbench o phpMyAdmin).
2. Crea una base de datos llamada `gestion_tareas`.
3. Ejecuta el archivo de la estructura de tablas para crear `usuarios`, `categorias` y `tareas`.
4. **Importante:** Inserta al menos un usuario de prueba para la integridad referencial:
   ```sql
   INSERT INTO usuarios (id, nombre, email, password) VALUES (1, 'Usuario Prueba', 'prueba@correo.com', '123456');
   ```

### 3. Ejecutar el Servidor
1. Inicia los módulos de **Apache** y **MySQL** en el panel de XAMPP.
2. Abre tu navegador e ingresa a: `http://localhost/gestion_tareas/index.php`

---

## 📸 Demostración del Proyecto
*(Tip profesional: Puedes tomar una captura de pantalla a tu navegador, guardarla como `captura.png` en tu proyecto y se verá aquí reflejada)*

![Vista Principal de la Aplicación](captura.png)

---

## ⚖️ Licencia
Este proyecto es de código abierto y está disponible bajo los términos de la [Licencia MIT](LICENSE). Puedes usarlo y modificarlo libremente para tu aprendizaje o portafolio.
