<?php
// index.php (Controlador Principal)

// 1. Cargar dependencias esenciales
require_once 'conexion.php';
require_once 'modelos/Tarea.php';

// 2. Instanciar el modelo pasando la conexión PDO
$modeloTarea = new Tarea($pdo);
$error = null;

// 3. CAPA CONTROLADORA: Procesar acciones del usuario (GET)
if (isset($_GET['accion']) && isset($_GET['id'])) {
    $accion = $_GET['accion'];
    $id_tarea = intval($_GET['id']);

    try {
        if ($accion === 'completar') {
            $modeloTarea->actualizarEstado($id_tarea, 'completada');
        } elseif ($accion === 'progresar') {
            $modeloTarea->actualizarEstado($id_tarea, 'en_progreso');
        } elseif ($accion === 'reabrir') {
            $modeloTarea->actualizarEstado($id_tarea, 'pendiente');
        } elseif ($accion === 'eliminar') {
            $modeloTarea->eliminar($id_tarea);
        }
        
        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        $error = "Error al procesar la acción: " . $e->getMessage();
    }
}

// 4. CAPA CONTROLADORA: Procesar envío de formulario (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $fecha_limite = !empty($_POST['fecha_limite']) ? $_POST['fecha_limite'] : null;
    $usuario_id = 1; 

    if (!empty($titulo)) {
        try {
            $modeloTarea->crear($usuario_id, $titulo, $descripcion, $fecha_limite);
            header("Location: index.php");
            exit;
        } catch (Exception $e) {
            $error = "Error al guardar la tarea: " . $e->getMessage();
        }
    } else {
        $error = "El título de la tarea es obligatorio.";
    }
}

// 5. Cargar los datos necesarios para la pantalla
$tareas = $modeloTarea->obtenerTodas();

// 6. Cargar la vista correspondiente
require_once 'vistas/lista_tareas.php';
