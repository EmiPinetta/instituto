<?php
include("conexion.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
<link rel="stylesheet" href="stylesModificarRol.css">
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Modificación de usuario
    $sql = "SELECT id, nombre, habilitado FROM roles WHERE id = $id";
    $resulRol = mysqli_query($conexion, $sql);
    $reg = mysqli_fetch_row($resulRol);

    if ($reg) {
        
        $nombre = $reg[1];
        $habilitado = $reg[2];

        ?>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">MODIFICAR ROL</h1>
            
            <form action="modificarAccionRol.php?id=<?php echo $id; ?>" method="post">
                <input type="hidden" name="idmodificar" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $reg[1] ?>" class="form-control">
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
        echo "El rol no existe.";
    }
} else {
    echo "No se proporcionó un ID de rol válido.";
}

mysqli_close($conexion);
?>
