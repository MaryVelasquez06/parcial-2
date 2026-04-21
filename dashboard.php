<?php
require_once "config.php";

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

$mensaje = $_SESSION["mensaje"] ?? "";
$tipo = $_SESSION["tipo"] ?? "";
unset($_SESSION["mensaje"], $_SESSION["tipo"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel administrativo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Panel administrativo</h1>
        <p>Bienvenido, <?= htmlspecialchars($_SESSION["nombre"]) ?></p>

        <div class="acciones-superiores">
            <a href="index.php" class="btn secondary">Ver listado público</a>
            <a href="logout.php" class="btn danger">Cerrar sesión</a>
        </div>

        <?php if($mensaje): ?>
            <div class="alert <?= htmlspecialchars($tipo) ?>">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <h2>Registrar nuevo estudiante</h2>

        <form method="POST" action="guardar_estudiante.php">
            <label>Nombres</label>
            <input type="text" name="nombres" maxlength="100" required>

            <label>Apellidos</label>
            <input type="text" name="apellidos" maxlength="100" required>

            <label>Correo electrónico (opcional)</label>
            <input type="email" name="correo" maxlength="100">

            <label>Teléfono</label>
            <input type="text" name="telefono" maxlength="20" required>

            <label>Carrera</label>
            <select name="carrera" required>
                <option value="">Seleccione una carrera</option>
                <option value="Ingeniería en Sistemas">Ingeniería en Sistemas</option>
                <option value="Administración de Empresas">Administración de Empresas</option>
                <option value="Arquitectura">Arquitectura</option>
                <option value="Contaduría Pública">Contaduría Pública</option>
                <option value="Mercadeo">Mercadeo</option>
            </select>

            <label>Sexo</label>
            <div class="radio-group">
                <label><input type="radio" name="sexo" value="Masculino" required> Masculino</label>
                <label><input type="radio" name="sexo" value="Femenino" required> Femenino</label>
            </div>

            <label class="checkbox-label">
                <input type="checkbox" name="beca" value="1"> Aplica a beca
            </label>

            <button type="submit" class="btn">Guardar estudiante</button>
        </form>
    </div>
</body>
</html>