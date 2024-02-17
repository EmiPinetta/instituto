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

<?php

$sql = "SELECT p.nombres, p.apellidos, d.latitud, d.longitud, d.provincia, d.departamento, d.localidad, d.barrio FROM personas p INNER JOIN domicilio d ON p.id_personas = d.id_persona";
$resultado = mysqli_query($conexion, $sql);

$ubicaciones = array(); // Array para almacenar las ubicaciones de los usuarios

while ($row = mysqli_fetch_assoc($resultado)) {
    $ubicacion = array(
        'latitud' => floatval($row['latitud']),
        'longitud' => floatval($row['longitud']),
        'nombres' => $row['nombres'],
        'apellidos' => $row['apellidos'],
        'barrio' => $row['barrio']
    );

    $ubicaciones[] = $ubicacion;

}

$ubicaciones_json = json_encode($ubicaciones); // Codificar las ubicaciones como JSON

$sqlProv = "SELECT DISTINCT barrio FROM domicilio";
$resprov = mysqli_query($conexion,$sqlProv);
//$rowprov = mysqli_fetch_row($resprov);
?>

<div id="map" style="height: 600px;"></div>

<form id="filtro-form">
  <label for="barrio-select">Filtrar por barrio:</label>
  <select name="barrio-select" id="barrio-select">
  <option value="">Todos los barrios</option>
                        <?php echo $cant = mysqli_num_rows($resprov);

                        for ($i = 0; $i < $cant; $i++) {
                            $regprov = mysqli_fetch_row($resprov);

                            
                                ?>
                                <option value="<?php echo $regprov[0]; ?>">
                                    <?php echo $regprov[0]; ?>
                                </option>
                            <?php
                            }
                        ?>
    </select>
  <button type="submit">Filtrar</button>
</form>

<script>
var map = L.map('map').setView([-28.46897424139158, -65.77929854393007], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    maxZoom: 18,
}).addTo(map);

var ubicaciones = <?php echo $ubicaciones_json; ?>; // Obtener las ubicaciones como objeto JavaScript

// Función para agregar marcadores según el barrio seleccionado
function agregarMarcadores(barrioSeleccionado) {
    // Eliminar los marcadores actuales del mapa
    map.eachLayer(function(layer) {
        if (layer instanceof L.Marker) {
            map.removeLayer(layer);
        }
    });

    // Agregar los marcadores filtrados al mapa
    ubicaciones.forEach(function(ubicacion) {
        var latitud = ubicacion.latitud;
        var longitud = ubicacion.longitud;
        var nombres = ubicacion.nombres;
        var apellidos = ubicacion.apellidos;
        var barrio = ubicacion.barrio;

        // Filtrar marcadores según el barrio seleccionado
        if (barrioSeleccionado === "" || barrio === barrioSeleccionado) {
            L.marker([latitud, longitud])
                .bindPopup('Nombre: ' + nombres + ' ' + apellidos + '<br><br> Latitud: ' + latitud + '<br> Longitud: ' + longitud)
                .addTo(map);
        }
    });
}

document.getElementById('filtro-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que se recargue la página al enviar el formulario

    var selectedBarrio = document.getElementById('barrio-select').value;

    agregarMarcadores(selectedBarrio); // Llamar a la función para agregar los marcadores filtrados
});

// Agregar todos los marcadores al cargar la página
agregarMarcadores("");

</script>

<a href="perfilAdmin.php">volver</a>
</body>
</html>
