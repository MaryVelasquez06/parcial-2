<?php
require_once "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = trim($_POST["usuario"] ?? "");
    $clave = trim($_POST["clave"] ?? "");

    if (empty($usuario) || empty($clave)) {

        $error = "Todos los campos son obligatorios.";

    } else {

        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1";

        $stmt = $conexion->prepare($sql);

        $stmt->bindParam(":usuario", $usuario);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        /* CAMBIO IMPORTANTE:
           ya NO usamos password_verify()
        */

        if ($user && $clave == $user["clave"]) {

            $_SESSION["usuario"] = $user["usuario"];
            $_SESSION["nombre"] = $user["nombre"];
            $_SESSION["rol"] = $user["rol"];

            header("Location: dashboard.php");
            exit;

        } else {

            $error = "Usuario o contraseña incorrectos.";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login - Inscripciones UGB</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container small">

<h1>Iniciar sesión</h1>

<?php if($error): ?>
<div class="alert error">
<?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<form method="POST" action="">

<label>Usuario</label>
<input type="text" name="usuario" required>

<label>Contraseña</label>
<input type="password" name="clave" required>

<button type="submit" class="btn">
Ingresar
</button>

<a href="index.php" class="btn secondary">
Volver
</a>

</form>

</div>

</body>
</html>