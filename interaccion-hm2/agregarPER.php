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
    
<div class="container overflow-hidden">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">AGREGAR PERSONA</h1>
            
            <form class="row g-3 needs-validation" action="agregarDOM.php" method="post" onsubmit="return validarFormulario();" novalidate>
                <input type="hidden" name="idmodificar" value="<?php echo $id; ?>">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="nombre" class="form-control" required>
                    <div class="invalid-feedback">
                        Por favor ingresa un nombre.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="apellido" class="form-label">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" placeholder="apellido" class="form-control" required>
                    <div class="invalid-feedback">
                        Por favor ingresa un apellido.
                    </div>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit" name="agregar" id="agregar">Agregar domicilio</button>
                </div>
            </form>

            <a href="perfilAdmin.php">Volver</a>
        </div>
    </div>
</div>

<script>
    // Función para validar el formulario
    function validarFormulario() {
        var nombre = document.getElementById("nombre").value;
        var apellido = document.getElementById("apellido").value;
        var formularioValido = true; // Variable para almacenar si el formulario es válido o no

        // Validar campo de nombre
        if (!nombre) {
            mostrarError("nombre", "Por favor ingresa un nombre.");
            formularioValido = false;
        } else {
            ocultarError("nombre");
        }

        // Validar campo de email
        if (!apellido) {
            mostrarError("apellido", "Por favor ingresa un apellido.");
            formularioValido = false;
        } else {
            ocultarError("apellido");
        }

        return formularioValido;
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