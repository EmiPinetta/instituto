<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("conexion.php"); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <!-- Agrega la referencia al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Agrega tu archivo CSS personalizado aquí -->
    <link rel="stylesheet" href="stylesAdmin.css">
    <link rel="stylesheet" href="stylesFooter.css">
</head>
<body>

<script>
        function cerrarsesion() {
        //if (confirm("¿Estás seguro de cerrar sesion?")) {
            window.location.href = 'login.php';
            unset($_SESSION['id']);
        //}
    }
</script>

<?php 
        if(isset($_POST['boton1'])){
            unset($_SESSION['id']);
            ?>
            <script >	
                location.href ='login.php';
            </script>	
            <?php
        }
        
        $id = $_SESSION['id'];
        $sql = "SELECT id, nombre, email, contrasena, personas.nombres, personas.apellidos FROM `usuarios` INNER JOIN personas ON usuarios.id_persona = personas.id_personas WHERE id ='$id'";
        $resul = mysqli_query($conexion, $sql);
        $cant = mysqli_num_rows($resul);
        if($cant > 0){
            $row = mysqli_fetch_row($resul);
            $id_us = $row[0];
            $usuario = $row[1];
            $email = $row[2];
            $contrasena = $row[3];
            $nombre = $row[4];
            $apellido = $row[5];
    ?>		

    <div class= "container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="container mt-5">
            <h1 class="display-4 text-dark font-weight-bold" >BIENVENIDO <br> <?php echo "- ", $nombre, " ", $apellido, " -" ?></h1>
            <!--<form method="post" class="for">
                <input type="submit" value="Cerrar sesión" name="boton1" class="btn btn-danger mt-3">
            </form>-->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropcs">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                    </svg> 
                    Cerrar sesion
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdropcs" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelcs" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabelcs">Cerrar sesion</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿estas seguro de cerrar sesion?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" onclick="cerrarsesion()">Aceptar</button>
                        </div>
                        </div>
                    </div>
                    </div>
            <br><br>

            <div class="card">
                <div class="card-body">
                    <h2 class="card-title" >DATOS</h2>
                    <div class="card-text">
                    <h5 class="card-subtitle mb-2 p-3 mb-2 bg-secondary text-white">NOMBRE: <?php echo $nombre ?></h5>
                    <h5 class="card-subtitle mb-2 p-3 mb-2 bg-secondary-subtle text-emphasis-secondary">APELLIDO: <?php echo $apellido ?></h5>
                    <h5 class="card-subtitle mb-2 p-3 mb-2 bg-secondary text-white">USUARIO: <?php echo $usuario ?></h5>
                    <h5 class="card-subtitle mb-2 p-3 mb-2 bg-secondary-subtle text-emphasis-secondary">EMAIL: <?php echo $email ?></h5>
                    <h5 class="card-subtitle mb-2 p-3 mb-2 bg-secondary text-white">ESTADO: Administrador</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <?php		
        } else {
            ?>
            <script>	
                alert('No existe el usuario enviado');
                location.href ='login.php';
            </script>	
            <?php
        }
    ?>
<footer class="foo">
            <div class="contenedor-footer">
                <div class="content-foo">
                <h4>Telefono</h4>
                <p>+5493834775872</p>
                </div>
                <div class="content-foo">
                <h4>Email</h4>
                <p>lucasjs@gmail.com</p>
                </div>
                <div class="content-foo">
                <h4>Ubicación</h4>
                <p>San Fernando del valle de Catamarca </p>
                </div>    
            </div>
        <h2 class="titulo-final">&copy; GUC-Gestion de usuarios Catamarca Corp. | Lucas José Santillán | Roberto Rodrigo Ibañez | Emiliano Luna Pinetta </h2>
        </footer>
    <!-- Agrega las referencias a los archivos JS de Bootstrap -->
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
</body>
</html>