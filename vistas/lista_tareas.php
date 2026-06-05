<!-- vistas/lista_tareas.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas</title>
    <!--<link rel="stylesheet" href="estilos.css">-->
    <link rel="stylesheet" href="estilos.css?v=1.1">

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
                    <input type="text" id="titulo" name="titulo" required placeholder="Ej: Estudiar patrones de diseño">
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
                        <div class="tarea-item <?php echo $tarea['estado'] === 'completada' ? 'completada' : ''; ?>">
                            <h3><?php echo htmlspecialchars($tarea['titulo']); ?></h3>
                            <p><?php echo htmlspecialchars($tarea['descripcion']); ?></p>
                            
                            <div class="meta">
                                <span>Estado: <strong class="badge-<?php echo $tarea['estado']; ?>"><?php echo $tarea['estado']; ?></strong></span>
                                <?php if ($tarea['fecha_limite']): ?>
                                    <span>⏱ Vence: <?php echo $tarea['fecha_limite']; ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="acciones">
                                <?php if ($tarea['estado'] === 'pendiente'): ?>
                                    <a href="index.php?accion=progresar&id=<?php echo $tarea['id']; ?>" class="btn-accion btn-progreso">⏳ Iniciar</a>
                                    <a href="index.php?accion=completar&id=<?php echo $tarea['id']; ?>" class="btn-accion btn-completar">✔ Completar</a>
                                <?php endif; ?>

                                <?php if ($tarea['estado'] === 'en_progreso'): ?>
                                    <a href="index.php?accion=completar&id=<?php echo $tarea['id']; ?>" class="btn-accion btn-completar">✔ Completar</a>
                                    <a href="index.php?accion=reabrir&id=<?php echo $tarea['id']; ?>" class="btn-accion btn-reabrir">↩ Detener</a>
                                <?php endif; ?>

                                <?php if ($tarea['estado'] === 'completada'): ?>
                                    <a href="index.php?accion=reabrir&id=<?php echo $tarea['id']; ?>" class="btn-accion btn-reabrir">↩ Reabrir</a>
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
