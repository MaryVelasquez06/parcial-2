<?php
session_start();

$host = "127.0.0.1";
$dbname = "inscripciones_ugb";
$user = "root";
$pass = "";
$port = "3307";

try {
    $conexion = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>