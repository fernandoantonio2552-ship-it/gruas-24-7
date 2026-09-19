<?php
session_start();

require_once "conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $sql = "SELECT id, nombre, correo, contraseña, rol
            FROM usuarios
            WHERE correo = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {

        $usuario = $resultado->fetch_assoc();

        if (password_verify($password, $usuario["password"])) {

            session_regenerate_id(true);

            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["rol"] = $usuario["rol"];

            header("Location: panel.php");
            exit;

        } else {
            $mensaje = "Contraseña incorrecta.";
        }

    } else {
        $mensaje = "Usuario no encontrado.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Grúas 24/7</title>
</head>
<body>

<h2>Iniciar Sesión</h2>

<?php
if ($mensaje != "") {
    echo "<p>$mensaje</p>";
}
?>

<form method="POST">

    <label>Correo:</label><br>
    <input type="email" name="correo" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Iniciar Sesión</button>

</form>

</body>
</html>
