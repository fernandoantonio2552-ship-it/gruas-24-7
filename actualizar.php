
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
    $placa = $_POST["placa"];
    $conductor = $_POST["conductor"];
    $telefono = $_POST["telefono"];
    $estado = $_POST["estado"];
    $ubicacion = $_POST["ubicacion"];

    $sql = "UPDATE gruas
            SET placa = ?, conductor = ?, telefono = ?, estado = ?, ubicacion = ?
            WHERE id = ?";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param(
        "sssssi",
        $placa,
        $conductor,
        $telefono,
        $estado,
        $ubicacion,
        $id
    );

    if ($stmt->execute()) {
        $mensaje = "Grúa actualizada correctamente.";
    } else {
        $mensaje = "Error al actualizar la grúa.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Grúa</title>
</head>
<body>

<h2>Actualizar Grúa</h2>

<?php
if ($mensaje != "") {
    echo "<p>$mensaje</p>";
}
?>

<form method="POST" action="">

    <label>ID de la grúa:</label><br>
    <input type="number" name="id" required><br><br>

    <label>Placa:</label><br>
    <input type="text" name="placa" required><br><br>

    <label>Conductor:</label><br>
    <input type="text" name="conductor" required><br><br>

    <label>Teléfono:</label><br>
    <input type="text" name="telefono" required><br><br>

    <label>Estado:</label><br>
    <input type="text" name="estado" required><br><br>

    <label>Ubicación:</label><br>
    <input type="text" name="ubicacion" required><br><br>

    <button type="submit">Actualizar Grúa</button>

</form>

</body>
</html>