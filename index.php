<?php
// 1. Incluir la conexión a la base de datos
require_once 'conexion.php';

// 2. Procesar el formulario cuando el usuario hace clic en "Guardar Tarea"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $fecha_limite = !empty($_POST['fecha_limite']) ? $_POST['fecha_limite'] : null;
    $usuario_id = 1; // ID de prueba temporal hasta tener un sistema de login

    if (!empty($titulo)) {
        try {
            // Consulta SQL usando marcadores para evitar Inyección SQL
            $sql = "INSERT INTO tareas (usuario_id, titulo, descripcion, fecha_limite) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$usuario_id, $titulo, $descripcion, $fecha_limite]);
            
            // Redireccionar para limpiar el formulario y evitar envíos duplicados al recargar
            header("Location: index.php");
            exit;
        } catch (PDOException $e) {
            $error = "Error al guardar la tarea: " . $e->getMessage();
        }
    } else {
        $error = "El título de la tarea es obligatorio.";
    }
}

// 3. Consultar las tareas existentes para mostrarlas abajo
try {
    $stmt = $pdo->query("SELECT * FROM tareas ORDER BY creado_en DESC");
    $tareas = $stmt->fetchAll();
} catch (PDOException $e) {
    $tareas = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <div class="contenedor">
        <h1>📝 Mi Gestor de Tareas</h1>

        <!-- Mostrar mensajes de error si existen -->
        <?php if (isset($error)): ?>
            <div class="alerta error"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- FORMULARIO PARA AGREGAR TAREA -->
        <div class="tarjeta">
            <h2>Nueva Tarea</h2>
            <form action="index.php" method="POST">
                <div class="grupo-control">
                    <label for="titulo">Título de la tarea:</label>
                    <input type="text" id="titulo" name="titulo" required placeholder="Ej: Estudiar para el examen de PHP">
                </div>

                <div class="grupo-control">
                    <label for="descripcion">Descripción (Opcional):</label>
                    <textarea id="descripcion" name="descripcion" rows="3" placeholder="Añade detalles sobre la tarea..."></textarea>
                </div>

                <div class="grupo-control">
                    <label for="fecha_limite">Fecha Límite:</label>
                    <input type="date" id="fecha_limite" name="fecha_limite">
                </div>

                <button type="submit" class="btn-guardar">💾 Guardar Tarea</button>
            </form>
        </div>

        <!-- LISTADO DE TAREAS -->
        <div class="tarjeta grid-tareas">
            <h2>Mis Tareas Pendientes</h2>
            <?php if (empty($tareas)): ?>
                <p>No tienes tareas registradas todavía. ¡Empieza creando una!</p>
            <?php else: ?>
                <div class="lista">
                    <?php foreach ($tareas as $tarea): ?>
                        <div class="tarea-item">
                            <h3><?php echo htmlspecialchars($tarea['titulo']); ?></h3>
                            <p><?php echo htmlspecialchars($tarea['descripcion']); ?></p>
                            <div class="meta">
                                <span>Estado: <strong><?php echo $tarea['estado']; ?></strong></span>
                                <?php if ($tarea['fecha_limite']): ?>
                                    <span>⏱ Vence el: <?php echo $tarea['fecha_limite']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
