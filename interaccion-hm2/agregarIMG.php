<?php
include("conexion.php");

if (isset($_POST['agregar'])) {
    $id = $_GET['id'];
    $nombre=($_POST['nombre']);

    if (isset($_FILES["imgFile"]) && $_FILES["imgFile"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "img/"; //directorio donde se guardara la img
        $targetFile = $targetDir . basename($_FILES["imgFile"]["name"]);

        //verificar tipo de archivo
        $allowedTypes = array('image/png', 'image/jpeg');
        if (in_array($_FILES["imgFile"]["type"], $allowedTypes)) {
            //mover el archivo al directorio
            if (move_uploaded_file($_FILES["imgFile"]["tmp_name"], $targetFile)) {
                
              
              // Guardar la información en la base de datos
                
                $ruta_imagen = $targetFile;

                //consulta sql
                $sql = "INSERT INTO imagenes (nombre, ruta, id_usuario) VALUES ('$nombre', '$ruta_imagen', '$id')";
                $resultado = mysqli_query($conexion, $sql);

                if ($resultado) {
                    echo "Imagen agregada correctamente";
                    header("Location: archivos.php?id=$id");
                    exit();
                } else {
                    echo "Error al agregar la imagen: " . mysqli_error($conexion);
                    ?>
                    <script>
                        location.href ='archivos.php?id=' + id;
                    </script>
                    <?php
                }

                //Cerrar la conexion
                $conexion->close();
            } else {
                echo "Ocurrió un error al subir la imagen.";
            }
        } else {
            echo "Por favor, selecciona una imagen en formato PNG o JPG.";
        }
    } else {
        echo "Por favor, selecciona una imagen.";
    }
} else {
    echo "1";
}
?>
