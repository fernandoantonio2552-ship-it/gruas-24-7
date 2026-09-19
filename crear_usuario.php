<?php
require_once "conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $rol = "usuario";

    $sql = "INSERT INTO usuarios (nombre, correo, contraseña, rol)
            VALUES (?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $correo, $password, $rol);

    if ($stmt->execute()) {
        $mensaje = "Usuario creado correctamente.";
    } else {
        $mensaje = "No se pudo crear el usuario.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
</head>
<body>

<h2>Crear Usuario</h2>

<?php
if ($mensaje != "") {
    echo "<p>$mensaje</p>";
}
?>

<form method="POST">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Correo:</label><br>
    <input type="email" name="correo" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Crear Usuario</button>

</form>

</body>
</html>
