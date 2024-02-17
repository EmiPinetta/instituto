<?php
include("conexion.php");

if (isset($_POST['agregar'])) {
    $id = $_GET['id'];
    $nombre=($_POST['nombre']);
  // Verificar si se seleccionó un archivo
  if (isset($_FILES["pdfFile"]) && $_FILES["pdfFile"]["error"] == UPLOAD_ERR_OK) {
    $targetDir = "pdf/"; // Directorio de destino donde se guardarán los archivos
    $targetFile = $targetDir . basename($_FILES["pdfFile"]["name"]);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar si el archivo es un PDF
    if ($fileType == "pdf") {
      // Mover el archivo al directorio de destino
      if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)) {

        // Guardar la información en la base de datos
        $ruta_archivo = $targetFile;
        // Preparar la consulta SQL
        $sql = "INSERT INTO archivos (nombre, ruta, id_usuario) VALUES ('$nombre', '$ruta_archivo', '$id')";
        $resultado = mysqli_query($conexion, $sql);

                                if ($resultado) {
                                  echo "PDF agregado correctamente";
                                  header("Location: archivos.php?id=$id");
                                  exit();
                                } else {
                                    echo "Error al agregar el PDF: " . mysqli_error($conexion);
                                    ?>
                                <script>	
                                    location.href ='archivos.php?id=' + id;
                                </script>	
                                <?php
                                }
                                ?>
                                <script>	
                                    location.href ='archivos.php?id=' + id;
                                </script>	
                                <?php

        // Cerrar la conexión
        $conexion->close();
      } else {
        echo "Ocurrió un error al subir el archivo.";
      }
    } else {
      echo "Por favor, selecciona un archivo PDF válido.";
    }
  } else {
    echo "Por favor, selecciona un archivo PDF.";
  }
}
else{
    echo "1";
}
?>
