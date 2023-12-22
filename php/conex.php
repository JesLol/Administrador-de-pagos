<?php
try {
    // Configuración de la conexión a la base de datos
    $dsn = "mysql:host=localhost;dbname=pagos-sp;charset=utf8";
    $usuario = "root";
    $contrasena = "";
    $opciones = array(
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );
    $pdo = new PDO($dsn, $usuario, $contrasena, $opciones);
    $pdo->exec("SET NAMES utf8");
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
