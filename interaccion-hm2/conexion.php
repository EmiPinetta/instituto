<?php
session_name();
session_start();
$dbhost="localhost";
$dbusuario="root";
$dbpassword="";
$db="gestion";
$conexion = mysqli_connect($dbhost,$dbusuario,$dbpassword,$db);	
	
if(!$conexion){
			?>
			<script >	
				//alert('no se pudo conectar al sistema');
				location.href ='login.php';
	   		</script>
	   		<?php
}else{
			?>
			<script >	
				//alert('Se conecto correctamente al sistema');
	   		</script>
	   		<?php
}
?>