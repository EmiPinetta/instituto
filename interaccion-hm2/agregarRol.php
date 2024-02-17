<!DOCTYPE html>
<html lang="en">
<head>
<?php include("conexion.php"); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylesModificarRol.css">
    <link rel="stylesheet" href="stylesModificarRol.css">
    <title>Agregar</title>
</head>
<body>


    <?php 
    $sql = "SELECT id FROM usuarios";
    $resulUsu=mysqli_query($conexion,$sql); 
    $sql2 = "SELECT id, nombre FROM roles";
    $resulRol=mysqli_query($conexion,$sql2);

    ?>

<script>
    sweetalert
</script>

<?php
	
	$c=0;
	if(isset($_POST['agregar'])){
		
        $nombre=($_POST['nombre']);
		$habilitado=$_POST['habilitado'];
        
			$sqlINS="INSERT INTO roles (nombre,habilitado, fecha_creacion, id_usuario_creacion, eliminado, fecha_eliminacion, id_usuario_eliminacion) VALUES ('$nombre','$habilitado', now(), {$_SESSION['id']}, 0, NULL, NULL)";
			$resultFinal=mysqli_query($conexion,$sqlINS);
			if (mysqli_errno($conexion)==0){
       			?>
       	     	<script>
                       alert('Se cargo correctamente los datos ');
                </script>
				<?php
			}else{
                ?>
                <script>
                       alert('No se cargo correctamente los datos ');
                </script>
                <?php
			}
			
			
			?>
			<script >	
				location.href ='perfilAdmin.php';
			</script>	
			<?php
		
	}
    ?>
    <div class="container">
  <div class="card">
    <div class="card-body">
      <h1 class="card-title">AGREGAR ROL</h1>
      <form class="row g-3 needs-validation" action="agregarRol.php" method="post" novalidate>
        <input type="hidden" name="idmodificar" value="<?php echo $id; ?>">
        <div class="col-md-6">
          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text" name="nombre" id="nombre" placeholder="nombre" class="form-control" required>
          <div class="invalid-feedback">
            Por favor ingresa un nombre válido.
          </div>
        </div>
        <div class="col-md-6">
          <label for="habilitado" class="form-label">Habilitado:</label>
          <select name="habilitado" id="habilitado" class="form-select" required>
            <option value="" selected disabled>Elige...</option>
            <option value="1">Habilitado</option>
            <option value="0">Deshabilitado</option>
          </select>
          <div class="invalid-feedback">
            Por favor selecciona una opción válida.
          </div>
        </div>
        <div class="col-12">
          <input type="submit" value="Agregar" name="agregar" id="agregar" class="btn btn-primary">
        </div>
      </form>
      <a href="perfilAdmin.php">Volver</a>
    </div>
  </div>
</div>
<script>
    // Habilitar las validaciones de formularios de Bootstrap
    (function () {
        'use strict';

        // Obtener todos los formularios a validar
        var forms = document.querySelectorAll('.needs-validation');

        // Recorrer cada formulario y aplicar las validaciones
        Array.from(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>