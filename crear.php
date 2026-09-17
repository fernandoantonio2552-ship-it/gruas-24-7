<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

require_once "conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $placa = trim($_POST["placa"] ?? "");
    $conductor = trim($_POST["conductor"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");
    $estado = trim($_POST["estado"] ?? "");
    $ubicacion = trim($_POST["ubicacion"] ?? "");

    if (
        $placa === "" ||
        $conductor === "" ||
        $telefono === "" ||
        $estado === "" ||
        $ubicacion === ""
    ) {
        $mensaje = "Todos los campos son obligatorios.";
    } else {

        $sql = "INSERT INTO gruas
                (placa, conductor, telefono, estado, ubicacion)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);

        $stmt->bind_param(
            "sssss",
            $placa,
            $conductor,
            $telefono,
            $estado,
            $ubicacion
        );

        try {
            if ($stmt->execute()) {
                $mensaje = "Grúa registrada correctamente.";
            } else {
                $mensaje = "Error al registrar la grúa.";
            }
        } catch (mysqli_sql_exception $e) {
            $mensaje = "No se pudo registrar la grúa. Verifique que la placa no esté repetida.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar Grúa</title>
</head>

<body>

    <h2>Registrar Grúa</h2>

    <?php
    if ($mensaje !== "") {
        echo "<p>$mensaje</p>";
    }
    ?>

    <form method="POST" action="">

        <label>Placa:</label><br>
        <input type="text" name="placa" required>
        <br><br>

        <label>Conductor:</label><br>
        <input type="text" name="conductor" required>
        <br><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono" required>
        <br><br>

        <label>Estado:</label><br>
        <input type="text" name="estado" required>
        <br><br>

        <label>Ubicación:</label><br>
        <input type="text" name="ubicacion" required>
        <br><br>

        <button type="submit">Registrar Grúa</button>

    </form>

    <br>

    <a href="index.php">Volver al panel</a>

</body>
</html>