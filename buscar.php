<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

require_once "conexion.php";
$grua = null;
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]) && $_GET["id"] !== "") {

    // Recibir y validar el ID enviado por GET
    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

    if ($id === false || $id === null) {
        $mensaje = "El ID debe ser un número válido.";
    } else {

        // Consulta preparada para mayor seguridad
        $sql = "SELECT id, placa, conductor, telefono, estado, ubicacion
                FROM gruas
                WHERE id = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $grua = $resultado->fetch_assoc();
        } else {
            $mensaje = "No se encontró ninguna grúa con ese ID.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Grúa</title>
</head>

<body>

<h1>Buscar Grúa - Método GET</h1>

<form method="GET" action="">
    <label>ID de la grúa:</label><br>
    <input type="number" name="id" required>
    <br><br>

    <button type="submit">Buscar Grúa</button>
</form>

<?php if ($mensaje != ""): ?>

    <p><?php echo htmlspecialchars($mensaje); ?></p>

<?php endif; ?>

<?php if ($grua): ?>

    <h2>Resultado de la búsqueda</h2>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Placa</th>
            <th>Conductor</th>
            <th>Teléfono</th>
            <th>Estado</th>
            <th>Ubicación</th>
        </tr>

        <tr>
            <td><?php echo htmlspecialchars($grua["id"]); ?></td>
            <td><?php echo htmlspecialchars($grua["placa"]); ?></td>
            <td><?php echo htmlspecialchars($grua["conductor"]); ?></td>
            <td><?php echo htmlspecialchars($grua["telefono"]); ?></td>
            <td><?php echo htmlspecialchars($grua["estado"]); ?></td>
            <td><?php echo htmlspecialchars($grua["ubicacion"]); ?></td>
        </tr>
    </table>

<?php endif; ?>

<br>

<a href="panel.php">Volver al panel</a>

</body>
</html>