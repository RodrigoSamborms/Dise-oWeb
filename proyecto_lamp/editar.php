<?php
include 'conexion.php';

// 1. Obtener los datos actuales del registro
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM personas WHERE id = $id AND activo = 1";
    $result = mysqli_query($conn, $query);
    $persona = mysqli_fetch_assoc($result);

    if (!$persona) {
        die("Registro no encontrado.");
    }
}

// 2. Procesar la actualización
if (isset($_POST['actualizar'])) {
    $id_update = $_POST['id'];
    $nuevo_nombre = mysqli_real_escape_string($conn, $_POST['nombre']);

    $sql_update = "UPDATE personas SET nombre = '$nuevo_nombre' WHERE id = $id_update";
    
    if (mysqli_query($conn, $sql_update)) {
        header("Location: index.php"); // Regresar al inicio
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
</head>
<body>
    <h2>Editar Nombre</h2>
    <form method="POST" action="editar.php">
        <input type="hidden" name="id" value="<?php echo $persona['id']; ?>">
        
        <input type="text" name="nombre" value="<?php echo $persona['nombre']; ?>" required>
        <button type="submit" name="actualizar">Guardar Cambios</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>