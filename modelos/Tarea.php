<?php
// modelos/Tarea.php

class Tarea {
    private $pdo;

    public function __construct($conexionDb) {
        $this->pdo = $conexionDb;
    }

    // NUEVA FUNCIÓN: Obtener todas las categorías para el formulario
    public function obtenerCategorias() {
        $stmt = $this->pdo->query("SELECT * FROM categorias ORDER BY nombre ASC");
        return $stmt->fetchAll();
    }

    public function obtenerTodas() {
        // MODIFICADO: Agregamos un LEFT JOIN para traer también el nombre de la categoría en el listado
        $sql = "SELECT t.*, c.nombre AS categoria_nombre 
                FROM tareas t 
                LEFT JOIN categorias c ON t.categoria_id = c.id 
                ORDER BY t.creado_en DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // MODIFICADO: Ahora recibe y procesa el $categoria_id
    public function crear($usuario_id, $categoria_id, $titulo, $descripcion, $fecha_limite) {
        $sql = "INSERT INTO tareas (usuario_id, categoria_id, titulo, descripcion, fecha_limite) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$usuario_id, $categoria_id, $titulo, $descripcion, $fecha_limite]);
    }

    public function actualizarEstado($id, $nuevoEstado) {
        $sql = "UPDATE tareas SET estado = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nuevoEstado, $id]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM tareas WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
