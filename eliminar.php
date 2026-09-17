
<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

require_once "conexion.php";
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];

    // Consulta preparada para evitar inyección SQL
    $stmt = $conexion->prepare("DELETE FROM gruas WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        if ($stmt->affected_rows > 0) {
            $mensaje = "Grúa eliminada correctamente.";
        } else {
            $mensaje = "No existe una grúa con ese ID.";
        }

    } else {
        $mensaje = "Error al eliminar la grúa.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Grúa</title>
</head>

<body>

<h2>Eliminar Grúa</h2>

<?php
if ($mensaje != "") {
    echo "<p>$mensaje</p>";
}
?>

<form method="POST" action="">

    <label>ID de la grúa:</label><br>
    <input type="number" name="id" required>
    <br><br>

    <button type="submit">Eliminar Grúa</button>

</form>

</body>
</html>