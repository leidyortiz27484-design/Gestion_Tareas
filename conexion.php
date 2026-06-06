<?php
// Configuración adaptada para Docker
$host = 'db'; // Nombre del servicio definido en docker-compose.yml
$db   = 'gestion_tareas';
$user = 'root';        
$pass = 'root_password'; // Contraseña definida en docker-compose.yml
$charset = 'utf8mb4';  

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
// ... (El resto del código try/catch se queda exactamente igual)


// Opciones de configuración para máxima seguridad y reporte de errores
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Muestra errores de SQL detallados
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Devuelve los datos como arreglos asociativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desactiva la emulación para evitar inyección SQL
];

try {
    // Intentar establecer la conexión
    $pdo = new PDO($dsn, $user, $pass, $options);
    // echo "¡Conexión exitosa a la base de datos!"; // Puedes desmarcar esto para probar
} catch (\PDOException $e) {
    // Si hay un error, detiene la aplicación y lo muestra
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
