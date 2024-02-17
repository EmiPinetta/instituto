<?php
include("conexion.php");
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE usuarios SET habilitado = 0, eliminado = 1, fecha_eliminacion = now(), id_usuario_eliminacion = {$_SESSION['id']} where id = '$id'";
    $resul=mysqli_query($conexion,$sql);
    // Redirigir a la página de perfilAdmin.php después de la modificación
    header("Location: perfilAdmin.php");
    exit();
} else {
    echo "Error al modificar el registro. Faltan parámetros.";
}
?>
