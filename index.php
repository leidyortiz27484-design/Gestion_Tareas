<?php
// 1. Incluir la conexión a la base de datos
require_once 'conexion.php';

// ==========================================================================
// NUEVA LÓGICA EN EL BACKEND: PROCESAR ACCIONES (ELIMINAR Y COMPLETAR)
// ==========================================================================
if (isset($_GET['accion']) && isset($_GET['id'])) {
    $accion = $_GET['accion'];
    $id_tarea = intval($_GET['id']); // Validamos que sea un número entero seguro

    try {
        if ($accion === 'completar') {
            // Actualizar el estado de la tarea a completada
            $sql = "UPDATE tareas SET estado = 'completada' WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_tarea]);
        } elseif ($accion === 'eliminar') {
            // Eliminar físicamente la tarea de la base de datos
            $sql = "DELETE FROM tareas WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_tarea]);
        }
        
        // Redireccionar para limpiar los parámetros de la URL
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        $error = "Error al procesar la acción: " . $e->getMessage();
    }
}

// 2. Procesar el formulario cuando se agrega una nueva tarea (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $fecha_limite = !empty($_POST['fecha_limite']) ? $_POST['fecha_limite'] : null;
    $usuario_id = 1; 

    if (!empty($titulo)) {
        try {
            $sql = "INSERT INTO tareas (usuario_id, titulo, descripcion, fecha_limite) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$usuario_id, $titulo, $descripcion, $fecha_limite]);
            
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
        <div class="tarjeta">
            <h2>Mis Tareas Pendientes</h2>
            <?php if (empty($tareas)): ?>
                <p>No tienes tareas registradas todavía. ¡Empieza creando una!</p>
            <?php else: ?>
                <div class="lista">
                    <?php foreach ($tareas as $tarea): ?>
                        <!-- Agregamos una clase especial si la tarea ya está completada -->
                        <div class="tarea-item <?php echo $tarea['estado'] === 'completada' ? 'completada' : ''; ?>">
                            <h3><?php echo htmlspecialchars($tarea['titulo']); ?></h3>
                            <p><?php echo htmlspecialchars($tarea['descripcion']); ?></p>
                            
                            <div class="meta">
                                <span>Estado: <strong class="badge-<?php echo $tarea['estado']; ?>"><?php echo $tarea['estado']; ?></strong></span>
                                <?php if ($tarea['fecha_limite']): ?>
                                    <span>⏱ Vence: <?php echo $tarea['fecha_limite']; ?></span>
                                <?php endif; ?>
                            </div>

                            <!-- ACCIONES DE CADA TAREA -->
                            <div class="acciones">
                                <?php if ($tarea['estado'] !== 'completada'): ?>
                                    <a href="index.php?accion=completar&id=<?php echo $tarea['id']; ?>" class="btn-accion btn-completar">✔ Completar</a>
                                <?php endif; ?>
                                <a href="index.php?accion=eliminar&id=<?php echo $tarea['id']; ?>" class="btn-accion btn-eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta tarea?');">❌ Eliminar</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
