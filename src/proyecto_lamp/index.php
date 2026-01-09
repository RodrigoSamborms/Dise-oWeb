<?php
// Incluimos la conexión que ya probamos
include 'conexion.php';

// Lógica para Insertar (esto se ejecuta cuando presionas el botón)
if (isset($_POST['agregar'])) {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    if (!empty($nombre)) {
        $sql_insert = "INSERT INTO personas (nombre, activo) VALUES ('$nombre', 1)";
        mysqli_query($conn, $sql_insert);
        // Recargar la página para limpiar el formulario y ver el nuevo nombre
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Personas - LAMP Monolítico</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 300px; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .formulario { margin-bottom: 20px; }
    </style>
</head>
<body>

    <h2>Agregar Nuevo Nombre</h2>
    
    <div class="formulario">
        <form method="POST" action="index.php">
            <input type="text" name="nombre" placeholder="Escribe un nombre..." required>
            <button type="submit" name="agregar">Agregar a la lista</button>
        </form>
    </div>

    <hr>

    <h2>Nombres Registrados</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Solo seleccionamos los registros que NO tengan borrado lógico
            $query = "SELECT id, nombre FROM personas WHERE activo = 1";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>