<!DOCTYPE html>
<html lang="en">
<head>
<?php include("conexion.php"); ?>

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
	$c=0;
	if(isset($_POST['agregar'])){
		$nombre=($_POST['nombre']);
		$apellido=($_POST['apellido']);
                                 
      
        
	}else if(isset($_POST['domi'])){

        $pais = ($_POST['pais']);
        $provincia = ($_POST['provincia']);
        $departamento = ($_POST['departamento']);
        $localidad = ($_POST['localidad']);
        $barrio = ($_POST['barrio']);
        $latitud = ($_POST['latitud']);
        $longitud = ($_POST['longitud']);

        $nombre = ($_POST['nombre']);
        $apellido = ($_POST['apellido']);

        /*echo $pais;
        echo $provincia;
        echo $departamento;
        echo $localidad;
        echo $barrio;
        echo $latitud;
        echo $longitud;*/

        $sqlINS1="INSERT INTO personas (nombres,apellidos) VALUES ('$nombre','$apellido')";
		$resultFinal1=mysqli_query($conexion,$sqlINS1);


			if (mysqli_errno($conexion)==0){
                $idpersona = mysqli_insert_id($conexion);
                $sqlINS2="INSERT INTO domicilio (pais, provincia, departamento, localidad, barrio, latitud, longitud, id_persona) VALUES ('$pais', '$provincia','$departamento','$localidad','$barrio',$latitud,$longitud,$idpersona)";
                $resultFinal2 = mysqli_query($conexion,$sqlINS2);
                if (mysqli_errno($conexion)==0){
                    ?>
                    
                    <?php
                }else{
                    ?>
                    <script>
                        alert('No se cargo correctamente el domicilio ');
                    </script>
                    <?php
                }
                
                
                ?>
				<?php
			}else{
                ?>
                <script>
                       alert('No se cargo correctamente la persona ');
                </script>
                <?php
			}
			
			
			?>
			<script >	
				location.href ='perfilAdmin.php';
			</script>	
			<?php
        

      }else{
        echo 2;
      }

    ?>



<div id="map" style="height: 600px;"></div>

<form id="" method="POST" action="agregarDOM.php">
    <input type="hidden" id="latitud" name="latitud">
    <input type="hidden" id="longitud" name="longitud">
    <input type="hidden" id="pais_h" name="pais">
    <input type="hidden" id="provincia_h" name="provincia">
    <input type="hidden" id="departamento_h" name="departamento">
    <input type="hidden" id="localidad_h" name="localidad">
    <input type="hidden" id="barrio_h" name="barrio">
    <input type="hidden" id="nombre_h" name="nombre">
    <input type="hidden" id="apellido_h" name="apellido">
    
    <label for="pais">País:</label>
    <span id="pais"></span>
    <br>
    <label for="provincia">Provincia:</label>
    <span id="provincia"></span>
    <br>
    <label for="departamento">Departamento:</label>
    <span id="departamento"></span>
    <br>
    <label for="localidad">Localidad:</label>
    <span id="localidad"></span>
    <br>
    <label for="barrio">Barrio:</label>
    <span id="barrio"></span>
    <br>
    <button type="submit" name="domi" id="domi" onclick="submitForm()">Guardar Domicilio</button>
</form>

<a href="perfilAdmin.php">volver</a>

<script>
    var map = L.map('map').setView([-28.46897424139158, -65.77929854393007], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18,
    }).addTo(map);

    var marker;

    map.on('click', function(e) {
        var latitude = e.latlng.lat;
        var longitude = e.latlng.lng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([latitude, longitude]).addTo(map);

        var geocodingUrl = 'https://nominatim.openstreetmap.org/reverse?format=json&lat=' + latitude + '&lon=' + longitude;

        fetch(geocodingUrl)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                var address = data.address;
                
                var country = address.country;
                var province = address.state;
                var department = address.state_district;
                var locality = address.city || address.town;
                var neighborhood = address.neighbourhood || address.suburb;

                document.getElementById('pais').textContent = country;
                document.getElementById('provincia').textContent = province;
                document.getElementById('departamento').textContent = department;
                document.getElementById('localidad').textContent = locality;
                document.getElementById('barrio').textContent = neighborhood;


                document.getElementById('pais_h').value = country;
                document.getElementById('provincia_h').value = province;
                document.getElementById('departamento_h').value = department;
                document.getElementById('localidad_h').value = locality;
                document.getElementById('barrio_h').value = neighborhood;
                document.getElementById('latitud').value = latitude;
                document.getElementById('longitud').value = longitude;
            });
    });

    function submitForm() {
        var nombre = "<?php echo $nombre; ?>";
        var apellido = "<?php echo $apellido; ?>";

        document.getElementById('nombre_h').value = nombre;
        document.getElementById('apellido_h').value = apellido;

        document.getElementById('agregarDOM.php').submit();
    }
</script>

</body>
</html>
