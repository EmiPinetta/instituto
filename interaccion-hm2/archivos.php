<?php
include("conexion.php");
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
<link rel="stylesheet" href="stylesArchivos.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="archivos.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
        .table-img {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }
        .table-img td {
            width: 25%;
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
            position: relative;
        }
        .table-img img {
            width: 100%;
            height: auto;
        }
        .table-img p {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 5px;
        margin: 0;
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        font-size: 14px;
    }
    </style>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Modificación de usuario
    $sql = "SELECT id, nombre FROM usuarios WHERE id = $id";
    $resul = mysqli_query($conexion, $sql);
    $reg = mysqli_fetch_row($resul);

    $sqlarc = "SELECT id, nombre, ruta, id_usuario FROM archivos WHERE id_usuario = $id";
    $res = mysqli_query($conexion, $sqlarc);
    
    //$regarc = mysqli_fetch_row($res);
    $sqlfot = "SELECT id, nombre, ruta, id_usuario FROM imagenes WHERE id_usuario = $id";
    $resfot = mysqli_query($conexion, $sqlfot);
    
    if ($reg) {
        $nombre = $reg[1];
?>
        <!--<div class="container">
            <div class="card">
                <div class="card-body">-->
                    <br>
                    <h1 class="card-title">GESTION DE ARCHIVOS DEL USUARIO: <?php echo $nombre ?></h1>
                    <Br></Br>


                    <h1 class="card-title">GALERÍA DE FOTOS DEL USUARIO: <?php echo $nombre ?></h1>
                <br>
                <table class="table-img">
                    <tbody>
                        <?php
                        $counter = 0;
                        while ($regfot = mysqli_fetch_row($resfot)) {
                            if ($counter % 4 === 0) {
                                echo "<tr>";
                            }
                        ?>
                            <td>
                                <img src="<?php echo $regfot[2]; ?>" alt="foto" class="img-fluid">
                                <p><?php echo $regfot[1]; ?></p>
                            </td>
                            
                        <?php
                            if ($counter % 4 === 3) {
                                echo "</tr>";
                            }
                            $counter++;
                        }
                        ?> <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadIMGModal">
                                    Subir imagen
                                </button>
                            </td>
                            <div class="modal fade" id="uploadIMGModal" tabindex="-1" aria-labelledby="uploadIMGModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadIMGModalLabel">Subir IMG</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="agregarIMG.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre de la IMG:</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                                            </div>
                                            <div class="mb-3">
                                                <label for="imgFile" class="form-label">Seleccionar IMG:</label>
                                                <input type="file" class="form-control" id="imgFile" name="imgFile">
                                            </div>
                                            <button type="submit" name="agregar" class="btn btn-primary">Subir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <?php
                        // Completar la última fila si no hay un número exacto de imágenes
                        if ($counter % 4 !== 0) {
                            echo "</tr>";
                        }
                        
                        ?>
                        
                    </tbody>
                </table>
                <br>


                            
                    </div>
                    <h3>Galería de PDF:</h3>
<br>

<div class="container">
  <div class="row row-cols-2">
    <?php while ($regarc = mysqli_fetch_row($res)) { ?>
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?php echo $regarc[1]; ?></h5>
            <p class="card-text">Para leer el PDF, presiona el botón debajo.</p>
            <a href="<?php echo $regarc[2]; ?>" target="_blank" class="btn btn-primary">Abrir PDF</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<div class="container">
  <div class="aco">
    <ul class="list-group">
      <?php while ($regarc = mysqli_fetch_row($res)) { ?>
        <li class="list-group-item">
          <h5 class="mb-1"><?php echo $regarc[1]; ?></h5>
          <a href="<?php echo $regarc[2]; ?>" target="_blank" class="btn btn-primary">Abrir PDF</a>
        </li>
      <?php } ?>
      <li class="list-group-item">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadPdfModal">
          Subir PDF
        </button>
      </li>
    </ul>
  </div>
</div>

                <div class="modal fade" id="uploadPdfModal" tabindex="-1" aria-labelledby="uploadPdfModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadPdfModalLabel">Subir PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="agregarPDF.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del PDF:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                        </div>
                        <div class="mb-3">
                            <label for="pdfFile" class="form-label">Seleccionar PDF:</label>
                            <input type="file" class="form-control" id="pdfFile" name="pdfFile">
                        </div>
                        <button type="submit" name="agregar" class="btn btn-primary">Subir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
                                             


                        <div class="form-group">
                            <label for="nombre" class="form-label">Subir:</label>
                            <div class="card-body">
                                <div>
                                    <video id="video" width="640" height="480" autoplay></video>
                                    <form id="capture-form" action="agregarIMG.php?id=<?php echo $id; ?>" method="POST">
                                        <canvas id="canvas" style="display: none;"></canvas>
                                        <input type="submit" value="Capturar imagen">
                                    </form>
                                </div>

                                <script>
                                    // Acceder a la cámara y capturar imagen
                                    navigator.mediaDevices.getUserMedia({ video: true })
                                        .then(function(stream) {
                                            var video = document.getElementById('video');
                                            video.srcObject = stream;
                                            video.play();
                                        })
                                        .catch(function(error) {
                                            console.log('Error al acceder a la cámara:', error);
                                        });

                                    // Capturar imagen al enviar el formulario
                                    document.getElementById('capture-form').addEventListener('submit', function(event) {
                                        event.preventDefault(); // Evitar que se envíe el formulario de manera tradicional
                                        
                                        var video = document.getElementById('video');
                                        var canvas = document.getElementById('canvas');
                                        var context = canvas.getContext('2d');
                                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                                        // Convertir imagen a formato base64
                                        var imageData = canvas.toDataURL('image/jpeg');

                                        // Agregar la imagen al formulario como un campo oculto
                                        var imageInput = document.createElement('input');
                                        imageInput.setAttribute('type', 'hidden');
                                        imageInput.setAttribute('name', 'image');
                                        imageInput.setAttribute('value', imageData);
                                        document.getElementById('capture-form').appendChild(imageInput);

                                        // Enviar el formulario utilizando AJAX
                                        $.ajax({
                                            type: 'POST',
                                            url: 'agregarIMG.php?id=<?php echo $id; ?>',
                                            data: $('#capture-form').serialize(), // Serializar el formulario para enviar todos los campos
                                            success: function(response) {
                                                console.log('Imagen enviada exitosamente.');
                                            },
                                            error: function(error) {
                                                console.log('Error al enviar la imagen:', error);
                                            }
                                        });
                                    });
                                </script>

                            </div>
                        </div>
                    
                        

                    <a href="perfilAdmin.php">Volver</a>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Agrega las referencias a los archivos JS de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
<?php
    } else {
        echo "El rol no existe.";
    }
} else {
    echo "No se proporcionó un ID de rol válido.";
}

mysqli_close($conexion);
?>
