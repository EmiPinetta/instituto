<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("conexion.php"); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Agrega la referencia al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Agrega tu archivo CSS personalizado aquí -->
    <link rel="stylesheet" href="stylesLOGIN.css">
    <link rel="stylesheet" href="stylesFooter.css">
</head>
<body>
    <?php
    $c = 0;
    if(isset($_POST['enviar'])) {
        $nombre = $_POST['nombre'];
        $contrasena = $_POST['contrasena'];
        $sql = "SELECT id, nombre, contrasena, id_rol FROM usuarios WHERE nombre='$nombre' AND contrasena='$contrasena'";
        $result = mysqli_query($conexion, $sql);
        if(mysqli_num_rows($result) > 0) {
            $reg = mysqli_fetch_row($result);
            $_SESSION['id'] = $reg[0];
            $_SESSION['name'] = $reg[1];

            $idrol = $reg[3];
            ?>
            <script>
                <?php 
                if($idrol == 1) {
                    ?>
                    location.href = 'perfilAdmin.php';
                    <?php
                } else {
                    ?>
                    location.href = 'perfil.php';
                    <?php
                };
                ?>
            </script>	
            <?php	
        } else {
            ?>
            <script>alert('El usuario <?php echo $nombre; ?> no existe');</script>
            <?php
            $c = 1;
        }
    }
    if(!isset($_POST['enviar']) or $c != 0) {
        ?>
        <form id="form1" name="form1" method="post" class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Inicio de sesión</h4>
                            <h6>Gestion de usuarios</h6>
                            <div class="form-group">
                                <label for="nombre">Usuario</label>
                                <input name="nombre" type="text" id="nombre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="contrasena">Contraseña</label>
                                <input type="password" name="contrasena" id="contrasena" class="form-control">
                            </div>
                            <div class="text-center">
                                <input type="submit" name="enviar" id="enviar" value="Enviar" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
    ?>
    <footer>
        <br><b><br><b><br><b><br><b><br><b><br><b><br><b><br><b><br><b><br><b><br><b>
        <h2 class="titulo-final">&copy; GUC-Gestion de usuarios Catamarca Corp. | Lucas José Santillán | Roberto Rodrigo Ibañez | Emiliano Luna Pinetta </h2>
        </footer>
    <!-- Agrega las referencias a los archivos JS de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>