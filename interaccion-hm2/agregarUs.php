<!DOCTYPE html>
<html lang="en">
<head>
<?php include("conexion.php"); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylesModificarRol.css">
    <link rel="stylesheet" href="cssUsuario.css">
    <title>Agregar</title>
</head>
<body>


    <?php 
    $sql = "SELECT nombre, email, contrasena FROM usuarios";
    $resulUsu=mysqli_query($conexion,$sql); 
    $sql2 = "SELECT id, nombre, habilitado FROM roles";
    $resulRol=mysqli_query($conexion,$sql2);
    $sql3 = "SELECT id_personas, nombres, apellidos FROM personas";
    $resulPer=mysqli_query($conexion,$sql3);
    $sqlPERSONAS = "SELECT id_personas, nombres, apellidos FROM personas WHERE id_personas NOT IN (SELECT id_persona FROM usuarios)";
    $resultPERSONA = mysqli_query($conexion, $sqlPERSONAS);

    ?>


<?php
	
	$c=0;
	if(isset($_POST['agregar'])){
		$usuario=($_POST['usuario']);
		$email=($_POST['email']);
		$contraseña=$_POST['contrasena'];
		$rol=$_POST['rol'];
		$persona=$_POST['persona'];
		$habilitado=$_POST['habilitado'];



        //$contraseña = $_POST['contraseña'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            if(strlen($contraseña) >= 8){

                if(preg_match('/[A-Z]/',$contraseña)){
        
                    if (preg_match('/\d/', $contraseña)) {
    
                        if (preg_match('/^[a-zA-Z0-9]+$/', $contraseña)) {
                                 
                            $sqlINS="INSERT INTO usuarios (nombre, email,contrasena, id_rol, id_persona, habilitado, fecha_creacion, id_usuario_creacion, eliminado) VALUES ('$usuario','$email','$contraseña','$rol','$persona','$habilitado', now(), {$_SESSION['id']}, 0)";
                            $resultFinal=mysqli_query($conexion,$sqlINS);
                                if (mysqli_errno($conexion)==0){
                                    ?>
                                    
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
    
                        }else{
    
                            ?>
                            <script>
                                alert ("no debe tener caracteres especiales");
                            </script>
            
                            <?php
    
                        }
    
                    }else{
    
                        ?>
                        <script>
                            alert ("minimo un numero");
                        </script>
        
                        <?php
                    }
    
        
                }else{
    
                    ?>
        
                    <script>
                        alert ("minimo una mayuscula");
                        </script>
        
                    <?php
    
                }
    
            }else{
    
    
                ?>
                <script>
                    alert ("minimo 8 caracteres");
                </script>
    
                <?php
    
            }

        }else{
                ?>
                <script>
                    alert('Ingrese correo valido');
                </script>
                <?php
        }

        
	}

    ?>

<div class="container overflow-hidden">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">AGREGAR USUARIO</h1>
            
            <form class="row g-3 needs-validation" action="agregarUs.php" method="post" onsubmit="return validarFormulario();" novalidate>
                <input type="hidden" name="idmodificar" value="<?php echo $id; ?>">
                <div class="col-md-6">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" placeholder="usuario" class="form-control" required>
                    <div class="invalid-feedback">
                        Por favor ingresa un usuario.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" name="email" id="email" placeholder="email" class="form-control" required>
                    <div class="invalid-feedback">
                        Por favor ingresa un email válido.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="contrasena" class="form-label">Contraseña:</label>
                    <input type="text" name="contrasena" id="contraseña" placeholder="contraseña" class="form-control" required>
                    <div class="invalid-feedback">
                        Por favor ingresa una contraseña válida.
                    </div>
                </div>
                
                <div class="col-md-6">
                    <label for="rol" class="form-label">Rol:</label>
                    <select name="rol" id="rol" class="form-select" required>
                        <?php echo $cant2 = mysqli_num_rows($resulRol);

                        for ($i = 0; $i < $cant2; $i++) {
                            $reg2 = mysqli_fetch_row($resulRol);

                            if ($reg2[2] == 1) {
                                ?>
                                <option value="<?php echo $reg2[0]; ?>">
                                    <?php echo $reg2[1]; ?>
                                </option>
                            <?php
                            };
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        Por favor selecciona un rol.
                    </div>
                </div>


                <div class="col-md-6">
                    <label for="persona" class="form-label">Persona:</label>
                    <select name="persona" id="persona" class="form-select" required>
                        <?php
                        $cant3 = mysqli_num_rows($resultPERSONA);

                        while ($reg3 = mysqli_fetch_row($resultPERSONA)) {
                            ?>
                            <option value="<?php echo $reg3[0]; ?>">
                                <?php echo $reg3[1], " ", $reg3[2]; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        Por favor selecciona una persona.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="habilitado" class="form-label">Habilitado:</label>
                    <select name="habilitado" id="habilitado" class="form-select" required>
                        <option value="1" selected>Habilitado</option>
                        <option value="0">Deshabilitado</option>
                    </select> 
                    <div class="invalid-feedback">
                        Por favor selecciona un estado de habilitación.
                    </div>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit" name="agregar" id="agregar">Agregar</button>
                </div>
            </form>

            <a href="perfilAdmin.php">Volver</a>
        </div>
    </div>
</div>

<script>
    // Función para validar el formulario
    function validarFormulario() {
        var usuario = document.getElementById("usuario").value;
        var email = document.getElementById("email").value;
        var contrasena = document.getElementById("contraseña").value;
        var formularioValido = true; // Variable para almacenar si el formulario es válido o no

        // Validar campo de usuario
        if (!usuario) {
            mostrarError("usuario", "Por favor ingresa un usuario.");
            formularioValido = false;
        } else {
            ocultarError("usuario");
        }

        // Validar campo de email
        if (!email || !validateEmail(email)) {
            mostrarError("email", "Por favor ingresa un email válido.");
            formularioValido = false;
        } else {
            ocultarError("email");
        }

        // Validar campo de contraseña
        if (!contrasena || contrasena.length < 8) {
            mostrarError("contraseña", "La contraseña debe tener al menos 8 caracteres.");
            formularioValido = false;
        } else if (!/[A-Z]/.test(contrasena)) {
            mostrarError("contraseña", "La contraseña debe contener al menos una letra mayúscula.");
            formularioValido = false;
        } else if (!/\d/.test(contrasena)) {
            mostrarError("contraseña", "La contraseña debe contener al menos un número.");
            formularioValido = false;
        } else if (!/^[a-zA-Z0-9]+$/.test(contrasena)) {
            mostrarError("contraseña", "La contraseña no debe contener caracteres especiales.");
            formularioValido = false;
        } else {
            ocultarError("contraseña");
        }

        return formularioValido;
    }

    // Función para validar el formato del email
    function validateEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Función para mostrar el mensaje de error
    function mostrarError(campo, mensaje) {
        var campoElemento = document.getElementById(campo);
        var errorElemento = campoElemento.nextElementSibling;
        errorElemento.innerText = mensaje;
        campoElemento.classList.add("is-invalid");
    }

    // Función para ocultar el mensaje de error
    function ocultarError(campo) {
        var campoElemento = document.getElementById(campo);
        var errorElemento = campoElemento.nextElementSibling;
        errorElemento.innerText = "";
        campoElemento.classList.remove("is-invalid");
    }
</script>

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

</body>
</html>