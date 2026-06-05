<?php
// modelos/Tarea.php

class Tarea {
    private $pdo;

    // Recibe la conexión PDO al instanciar el modelo
    public function __construct($conexionDb) {
        $this->pdo = $conexionDb;
    }

    // Obtener todas las tareas de la base de datos
    public function obtenerTodas() {
        $stmt = $this->pdo->query("SELECT * FROM tareas ORDER BY creado_en DESC");
        return $stmt->fetchAll();
    }

    // Crear una nueva tarea
    public function crear($usuario_id, $titulo, $descripcion, $fecha_limite) {
        $sql = "INSERT INTO tareas (usuario_id, titulo, descripcion, fecha_limite) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$usuario_id, $titulo, $descripcion, $fecha_limite]);
    }

    // Actualizar el estado de una tarea
    public function actualizarEstado($id, $nuevoEstado) {
        $sql = "UPDATE tareas SET estado = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nuevoEstado, $id]);
    }

    // Eliminar una tarea
    public function eliminar($id) {
        $sql = "DELETE FROM tareas WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
