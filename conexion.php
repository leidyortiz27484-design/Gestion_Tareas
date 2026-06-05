<?php
// Datos de configuración del servidor local de XAMPP
$host = 'localhost';
$db   = 'gestion_tareas';
$user = 'root';        // Usuario por defecto en XAMPP
$pass = '';            // Contraseña por defecto en XAMPP (vacía)
$charset = 'utf8mb4';  // Soporte para caracteres especiales y emojis

// Cadena de conexión (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

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
