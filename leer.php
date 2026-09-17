
<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

require_once "conexion.php";

$sql = "SELECT id, placa, conductor, telefono, estado, ubicacion FROM gruas";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Grúas</title>
</head>
<body>

<h2>Listado de Grúas</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Placa</th>
        <th>Conductor</th>
        <th>Teléfono</th>
        <th>Estado</th>
        <th>Ubicación</th>
    </tr>

    <?php
    while ($fila = $resultado->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo $fila["id"]; ?></td>
            <td><?php echo $fila["placa"]; ?></td>
            <td><?php echo $fila["conductor"]; ?></td>
            <td><?php echo $fila["telefono"]; ?></td>
            <td><?php echo $fila["estado"]; ?></td>
            <td><?php echo $fila["ubicacion"]; ?></td>
        </tr>
    <?php
    }
    ?>

</table>

</body>
</html>