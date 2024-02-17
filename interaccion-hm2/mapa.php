<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("conexion.php");?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mapa.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <title>Document</title>
</head>
<body>

<?php if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "SELECT pais, provincia, departamento, localidad, barrio, latitud, longitud, id_persona FROM domicilio WHERE id_persona = $id";
    $resultado = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_row($resultado);

    $sql2 = "SELECT id_personas, nombres, apellidos FROM personas WHERE id_personas = $id";
    $res = mysqli_query($conexion, $sql2);
    $row2 = mysqli_fetch_array($res);

    $latitud = $row[5];
    $longitud = $row[6];

    ?><div id="map" style="height: 600px;"></div>
    
    <div>
        <label for="">Nombre: <?php echo $row2[1];?></label>
        <br>
        <label for="">Apellido: <?php echo $row2[2];?></label>
        <br>
        <label for="">Pais: <?php echo $row[0];?></label>
        <br>
        <label for="">Provincia: <?php echo $row[1];?></label>
        <br>
        <label for="">Departamento: <?php echo $row[2];?></label>
        <br>
        <label for="">Localidad: <?php echo $row[3];?></label>
        <br>
        <label for="">Barrio: <?php echo $row[4];?></label>
        <br>
        <label for="">Latitud: <?php echo $latitud?></label>
        <br>
        <label for="">Longitud: <?php echo $longitud?></label>
        <br>
    </div>
    
    
    
    
    <?php

    ?>
    <script>
        var map = L.map('map').setView([<?php echo $latitud; ?>, <?php echo $longitud; ?>], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        var marker = L.marker([<?php echo $latitud; ?>, <?php echo $longitud; ?>]).addTo(map);
    </script>
    <?php

    }
?>

    <a href="perfilAdmin.php">volver</a>
</body>
</html>