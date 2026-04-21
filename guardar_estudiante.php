<?php
require_once "config.php";

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: dashboard.php");
    exit;
}

$nombres = trim($_POST["nombres"] ?? "");
$apellidos = trim($_POST["apellidos"] ?? "");
$correo = trim($_POST["correo"] ?? "");
$telefono = trim($_POST["telefono"] ?? "");
$carrera = trim($_POST["carrera"] ?? "");
$sexo = trim($_POST["sexo"] ?? "");
$beca = isset($_POST["beca"]) ? 1 : 0;

if (
    empty($nombres) ||
    empty($apellidos) ||
    empty($telefono) ||
    empty($carrera) ||
    empty($sexo)
) {
    $_SESSION["mensaje"] = "Todos los campos obligatorios deben completarse.";
    $_SESSION["tipo"] = "error";
    header("Location: dashboard.php");
    exit;
}

if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/u", $nombres)) {
    $_SESSION["mensaje"] = "El campo nombres solo debe contener letras.";
    $_SESSION["tipo"] = "error";
    header("Location: dashboard.php");
    exit;
}

if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/u", $apellidos)) {
    $_SESSION["mensaje"] = "El campo apellidos solo debe contener letras.";
    $_SESSION["tipo"] = "error";
    header("Location: dashboard.php");
    exit;
}

if (!preg_match("/^[0-9-]+$/", $telefono)) {
    $_SESSION["mensaje"] = "El teléfono solo debe contener números y guion.";
    $_SESSION["tipo"] = "error";
    header("Location: dashboard.php");
    exit;
}

if (!empty($correo) && !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["mensaje"] = "El correo no tiene un formato válido.";
    $_SESSION["tipo"] = "error";
    header("Location: dashboard.php");
    exit;
}

$carreras_validas = [
    "Ingeniería en Sistemas",
    "Administración de Empresas",
    "Arquitectura",
    "Contaduría Pública",
    "Mercadeo"
];

if (!in_array($carrera, $carreras_validas)) {
    $_SESSION["mensaje"] = "La carrera seleccionada no es válida.";
    $_SESSION["tipo"] = "error";
    header("Location: dashboard.php");
    exit;
}

if ($sexo !== "Masculino" && $sexo !== "Femenino") {
    $_SESSION["mensaje"] = "Debe seleccionar un sexo válido.";
    $_SESSION["tipo"] = "error";
    header("Location: dashboard.php");
    exit;
}

try {
    $sql = "INSERT INTO estudiantes (nombres, apellidos, correo, telefono, carrera, sexo, beca)
            VALUES (:nombres, :apellidos, :correo, :telefono, :carrera, :sexo, :beca)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":nombres", $nombres);
    $stmt->bindParam(":apellidos", $apellidos);

    if ($correo === "") {
        $correo = null;
    }

    $stmt->bindParam(":correo", $correo);
    $stmt->bindParam(":telefono", $telefono);
    $stmt->bindParam(":carrera", $carrera);
    $stmt->bindParam(":sexo", $sexo);
    $stmt->bindParam(":beca", $beca, PDO::PARAM_INT);
    $stmt->execute();

    $_SESSION["mensaje"] = "Estudiante guardado correctamente.";
    $_SESSION["tipo"] = "success";
} catch (PDOException $e) {
    $_SESSION["mensaje"] = "Error al guardar: " . $e->getMessage();
    $_SESSION["tipo"] = "error";
}

header("Location: dashboard.php");
exit;