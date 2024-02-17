<?php
include("conexion.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
<link rel="stylesheet" href="stylesModificarRol.css">
<link rel="stylesheet" href="cssUsuario.css">
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Modificación de usuario
    $sql = "SELECT id, nombre, email, contrasena, id_rol, id_persona,habilitado FROM usuarios WHERE id = $id";
    $resulUsu = mysqli_query($conexion, $sql);
    $reg = mysqli_fetch_row($resulUsu);

    if ($reg) {
        $sql2 = "SELECT id, nombre, habilitado FROM roles";
        $resulRol = mysqli_query($conexion, $sql2);
        $sql3 = "SELECT id_personas, nombres, apellidos FROM personas";
        $resulPer = mysqli_query($conexion, $sql3);
        $sqlPERSONAS = "SELECT id_personas, nombres, apellidos FROM personas WHERE id_personas NOT IN (SELECT id_persona FROM usuarios)";
        $resultPERSONA = mysqli_query($conexion, $sqlPERSONAS);

        $cantPERSONAS = mysqli_num_rows($resulRol);

        $id = $reg[0];
        $usuario = $reg[1];
        $email = $reg[2];
        $contrasena = $reg[3];
        $id_rol = $reg[4];
        $id_rol_persona = $reg[5];

        // Procesar el formulario de modificación

        // Mostrar el formulario de modificación
        ?>

<div class="container overflow-hidden">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">MODIFICAR USUARIO</h1>
            
            <form action="modificarAccionUs.php?id=<?php echo $id; ?>" method="post">
                <input type="hidden" name="idmodificar" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <input type="text" name="nombre" id="usuario" value="<?php echo $reg[1] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" name="email" id="email" value="<?php echo $reg[2] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="contrasena" class="form-label">Contraseña:</label>
                    <input type="text" name="contrasena" id="contraseña" value="<?php echo $reg[3] ?>" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="rol" class="form-label">Rol:</label>
                    <select name="rol" id="rol" class="form-select">
                <?php
                $cant2 = mysqli_num_rows($resulRol);

                while ($reg2 = mysqli_fetch_row($resulRol)) {
                    if ($reg2[2] == 1) {
                        ?>
                        <option value="<?php echo $reg2[0]; ?>" <?php if ($reg2[0] == $id_rol) { echo "selected"; } ?>>
                            <?php echo $reg2[1]; ?>
                        </option>
                        <?php
                    }
                }
                    ?>
                    </select>
                </div>


                <div class="form-group">
                    <label for="persona" class="form-label">Persona:</label>
                    <select name="persona" id="persona" class="form-select">
                    <?php
                        $cant3 = mysqli_num_rows($resultPERSONA);

                        $sqlPersona = "SELECT id_personas, nombres, apellidos FROM personas WHERE id_personas = $id_rol_persona";
                        $resultPersona = mysqli_query($conexion, $sqlPersona);
                        $regPersona = mysqli_fetch_row($resultPersona);

                        // Opción por defecto: la persona asociada al usuario
                        if ($regPersona) {
                            ?>
                            <option value="<?php echo $regPersona[0]; ?>" selected>
                                <?php echo $regPersona[1], " ", $regPersona[2]; ?>
                            </option>
                            <?php
                        }

                        // Opciones de personas libres
                        while ($reg3 = mysqli_fetch_row($resultPERSONA)) {
                            ?>
                            <option value="<?php echo $reg3[0]; ?>">
                                <?php echo $reg3[1], " ", $reg3[2]; ?>
                            </option>
                            <?php
                        }
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="habilitado" class="form-label">Habilitado:</label>
                    <select name="habilitado" id="habilitado" class="form-select">
                        <option value="1" <?php if ($reg[2] == 1) { echo "selected"; } ?>>Habilitado</option>
                        <option value="0" <?php if ($reg[2] == 0) { echo "selected"; } ?>>Deshabilitado</option>
                    </select>
                </div>

                <input type="submit" value="Modificar" name="modificar" id="modificar" class="btn btn-primary">
            </form>

            <a href="perfilAdmin.php">Volver</a>
        </div>
    </div>
</div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
        <?php
    } else {
        echo "El usuario no existe.";
    }
} else {
    echo "No se proporcionó un ID de usuario válido.";
}

mysqli_close($conexion);
?>
