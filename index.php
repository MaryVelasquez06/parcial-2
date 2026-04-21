<?php
require_once "config.php";

$sql = "SELECT * FROM estudiantes ORDER BY apellidos ASC, nombres ASC";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inscripciones UGB</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Sistema web de inscripción de nuevos estudiantes</h1>
        <p class="subtitulo">Universidad Gerardo Barrios</p>

        <div class="acciones-superiores">
            <?php if(isset($_SESSION['usuario'])): ?>
                <a href="dashboard.php" class="btn">Ir al panel</a>
                <a href="logout.php" class="btn danger">Cerrar sesión</a>
            <?php else: ?>
                <a href="login.php" class="btn">Iniciar sesión</a>
            <?php endif; ?>
        </div>

        <h2>Listado público de estudiantes inscritos</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Carrera</th>
                    <th>Sexo</th>
                    <th>Beca</th>
                    <th>Fecha registro</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($estudiantes) > 0): ?>
                    <?php foreach($estudiantes as $fila): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['id']) ?></td>
                            <td><?= htmlspecialchars($fila['nombres']) ?></td>
                            <td><?= htmlspecialchars($fila['apellidos']) ?></td>
                            <td><?= htmlspecialchars($fila['correo'] ?? 'No registrado') ?></td>
                            <td><?= htmlspecialchars($fila['telefono']) ?></td>
                            <td><?= htmlspecialchars($fila['carrera']) ?></td>
                            <td><?= htmlspecialchars($fila['sexo']) ?></td>
                            <td><?= $fila['beca'] ? 'Sí' : 'No' ?></td>
                            <td><?= htmlspecialchars($fila['fecha_registro']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No hay estudiantes registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>