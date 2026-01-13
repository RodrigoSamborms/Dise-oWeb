<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Implementamos el Borrado Lógico: cambiamos activo de 1 a 0
    $sql_borrar = "UPDATE personas SET activo = 0 WHERE id = $id";

    if (mysqli_query($conn, $sql_borrar)) {
        // Redirigir al index para ver los cambios
        header("Location: index.php");
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conn);
    }
} else {
    // Si alguien intenta entrar a borrar.php sin un ID, lo regresamos al inicio
    header("Location: index.php");
}
?>