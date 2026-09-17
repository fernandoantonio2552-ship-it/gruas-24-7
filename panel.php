<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel - Grúas 24/7</title>
</head>
<body>

<h2>Panel de Grúas 24/7</h2>

<p>
Bienvenido,
<?php echo htmlspecialchars($_SESSION["nombre"]); ?>
</p>

<p>Sesión iniciada correctamente.</p>

<a href="crear.php">Crear Grúa</a>
<br><br>

<a href="leer.php">Ver Grúas</a>
<br><br>

<a href="actualizar.php">Actualizar Grúa</a>
<br><br>

<a href="eliminar.php">Eliminar Grúa</a>
<br><br>

<a href="logout.php">Cerrar Sesión</a>

</body>