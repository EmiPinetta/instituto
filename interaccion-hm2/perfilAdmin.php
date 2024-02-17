<!DOCTYPE html>
<html lang="en">
<head>
<style>
        /* Estilos para el popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }

        .popup h2 {
            margin-top: 0;
        }

        .popup-buttons {
            text-align: right;
        }
    </style>
<?php include("conexion.php"); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Agrega la referencia al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Agrega tu archivo CSS personalizado aquí -->
    <link rel="stylesheet" href="stylesAdmin.css">
    <link rel="stylesheet" href="stylesFooter.css">
    <title>perfilAdmin</title>
    
    <script>
        function verArchivos(id) {
        
            window.location.href = "archivos.php?id=" + id;
        
    }
    </script>
    <script>
        function Domicilio(id) {
        
            window.location.href = "mapa.php?id=" + id;
        
    }
    </script>
    <script>
        function cerrarsesion() {
        //if (confirm("¿Estás seguro de cerrar sesion?")) {
            window.location.href = 'login.php';
            unset($_SESSION['id']);
        //}
    }
    </script>
    <script>
        function eliminarRegistroRol(id) {
        //if (confirm("¿Estás seguro de eliminar este registro de rol?")) {
            window.location.href = "eliminarRol.php?id=" + id;
        //}
    }
    </script>
    <script>
        function eliminarRegistroUs(id) {
        //if (confirm("¿Estás seguro de eliminar este registro de usuario?")) {
            window.location.href = "eliminarUs.php?id=" + id;
        //}
    }
    </script>
    <script>
        function modificarRegistroRol(id) {
        //if (confirm("¿Estás seguro de modificar este registro de rol?")) {
            window.location.href = "modificarRol.php?id=" + id;
        //}
    }
    </script>
    <script>
        function modificarRegistroUs(id) {
        //if (confirm("¿Estás seguro de modificar este registro de usuario?")) {
            window.location.href = "modificarUs.php?id=" + id;
        //}
    }
    </script>
    

</head>
<body>


<?php
 
        if(isset($_POST['boton1'])){
            unset($_SESSION['id']);
            ?>
			<script >	
				location.href ='login.php';
			</script>	
			<?php
        }
    
		
		$id=$_SESSION['id'];
		$sql="SELECT id, nombre, email, contrasena, personas.nombres, personas.apellidos FROM `usuarios` INNER JOIN personas ON usuarios.id_persona = personas.id_personas WHERE id ='$id'";
		$resul=mysqli_query($conexion,$sql);
		$cant=mysqli_num_rows($resul);

        $sqlrol = "SELECT id, nombre FROM roles";
        $resrol = mysqli_query($conexion,$sqlrol);

		if($cant>0){
			$row=mysqli_fetch_row($resul);
			$id_us=$row[0];
			$usuario=$row[1];
			$email=$row[2];
			$contrasena=$row[3];
            $nombre = $row[4];
            $apellido = $row[5];
	?>
    <!--<div id="confirmationPopup" class="popup">
        <h2>Confirmación</h2>
        <p>¿Está seguro de cerrar sesión?</p>
        <div class="popup-buttons">
            <button onclick="cancelAction()">Cancelar</button>
            <button onclick="confirmAction()">Aceptar</button>
        </div>
    </div>-->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Mi Sitio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i> Opciones
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="datos.php">Ver perfil</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="mapatotal.php">Ver mapa</a>
          <div class="dropdown-divider"></div>
          <button type="button" class="dropdown-item btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropcs">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
            </svg>
            Cerrar sesión
          </button>
        </div>
      </li>
    </ul>
  </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="staticBackdropcs" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelcs" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabelcs">Cerrar sesión</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de cerrar sesión?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="cerrarsesion()">Aceptar</button>
      </div>
    </div>
  </div>
</div>


    <div class= "container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="container mt-5">
            <h1 class="display-4 text-dark font-weight-bold" >BIENVENIDO <br> <?php echo "- ", $nombre, " ", $apellido, " -" ?></h1>
            <!--<form method="post" class="for">
                <input type="submit" value="Cerrar sesión" name="boton1" class="btn btn-danger mt-3">
            </form>-->
            <!-- Button trigger modal -->
                    
                        <!--<button id="logoutButton" onclick="showPopup()">Cerrar sesión</button> -->
            
            
        </div>
    </div>
	<?php		
		}else{
			?>
			<script >	
				alert('No existe el usuario enviado');
				location.href ='login.php';
	   		</script>	
			<?php
			
		}

	?>

<div class="card1">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          GESTIÓN DE USUARIOS
        </button>
      </h2>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
    <div id="accordion">

  <!-- Tabla de Usuarios -->
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          USUARIOS
        </button>
      </h2>
    </div>

    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
      <?php
	    $sqlusuarios="SELECT id, nombre, email, contrasena, id_rol, id_persona, habilitado, fecha_creacion, id_usuario_creacion, eliminado, fecha_eliminacion, id_usuario_eliminacion FROM usuarios";
		$resul1=mysqli_query($conexion,$sqlusuarios);
		?>
        <div class="table-responsive">
        <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">USUARIOS</th>
            </tr>
            <tr>
                <th scope="col">NOMBRE</th>
                <th scope="col">EMAIL</th>
                <th scope="col">ROL</th>
                <th scope="col">PERSONA</th>
                <th scope="col">HABILITADO</th>
                <th scope="col">FECHA CREACION</th>
                <th scope="col">ID USUARIO CREACION</th>
                <th scope="col">ELIMINADO</th>
                <th scope="col">FECHA ELIMINACION</th>
                <th scope="col">ID USUARIO ELIMINACION</th>
                <th scope="col">ARCHIVOS</th>
                <th scope="col">MODIFICAR</th>
                <th scope="col">ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cant1 = mysqli_num_rows($resul1);

            $can = 0;
            for ($i = 0; $i < $cant1; $i++) {

                $can++;
                $reg1 = mysqli_fetch_row($resul1);
            ?>
                <tr>
                    <td><?php echo $reg1[1]; ?></td>
                    <td><?php echo $reg1[2]; ?></td>
                    <td>
                        <?php

                        $squr = "SELECT id, nombre FROM roles WHERE id = $reg1[4]";
                        $reur = mysqli_query($conexion,$squr);
                        $regur = mysqli_fetch_row($reur);
                        echo $regur[1]; 
                        ?>
                    </td>
                    <td>
                        <?php

                        $squp = "SELECT id_personas, nombres, apellidos  FROM personas WHERE id_personas = $reg1[5]";
                        $reup = mysqli_query($conexion,$squp);
                        $regup = mysqli_fetch_row($reup);
                        echo $regup[1]," ", $regup[2]; 
                        ?>
                    </td>
                    <td>
                        <?php 
                        if($reg1[6] == 1){
                            echo "Habilitado";
                        }else{
                            echo "Deshabilitado";
                        }
                        ?>
                    </td>
                    <td><?php echo date('d/m/Y H:i:s', strtotime($reg1[7])); ?></td>
                    <td>
                        <?php
                        if($reg1[8] == NULL){
                            echo "";
                        }else{
                            $squh = "SELECT id, nombre FROM usuarios WHERE id = $reg1[8]";
                            $reuh = mysqli_query($conexion,$squh);
                            $reguh = mysqli_fetch_row($reuh);
                            echo $reguh[1];
                        }
                         
                        ?>
                    </td>
                    <td>
                        <?php 
                        if($reg1[9] == 1){
                            echo "Eliminado";
                        }else{
                            echo "";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($reg1[10] == NULL){
                            echo "";
                        }else{
                            echo date('d/m/Y H:i:s', strtotime($reg1[10]));
                        }
                         
                        ?>
                    </td>
                    <td>
                        <?php
                        if($reg1[11] == NULL){
                            echo "";
                        }else{
                            $squh = "SELECT id, nombre FROM usuarios WHERE id = $reg1[11]";
                            $reuh = mysqli_query($conexion,$squh);
                            $reguh = mysqli_fetch_row($reuh);
                            echo $reguh[1];
                        }
                         
                        ?>
                    </td>
                    <td><button type="button" class="btn btn-outline-primary" onclick="verArchivos(<?php echo $reg1[0]; ?>)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                    <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                    </svg>
                    Archivos
                    </button>
                    </td>
                    <td><!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                    </svg>
                    modificar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modificar usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿estas seguro en modificar este usuario?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" onclick="modificarRegistroUs(<?php echo $reg1[0]; ?>)">Aceptar</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    </td>
                    <td><!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                    </svg>
                    eliminar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel1">Eliminar usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿estas seguro de eliminar este usuario?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            

                            <button type="button" class="btn btn-danger" onclick="eliminarRegistroUs(<?php echo $reg1[0]; ?>)">Aceptar</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
        </div>
		

    <div class="gestion">
        <div class="fs-2 mb-3">
            <a href="agregarUs.php" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>  Agregar usuario</a>
        </div>
    </div>
      </div>
    </div>
  </div>

  <!-- Tabla de Roles -->
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          ROLES
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
      <?php
    $sqlrol="SELECT id, nombre, habilitado, fecha_creacion, id_usuario_creacion, eliminado, fecha_eliminacion, id_usuario_eliminacion FROM roles";
    $resul2=mysqli_query($conexion,$sqlrol);
    ?>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ROLES</th>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">HABILITADO</th>
                <th scope="col">FECHA CREACION</th>
                <th scope="col">ID USUARIO CREACION</th>
                <th scope="col">ELIMINADO</th>
                <th scope="col">FECHA ELIMINACION</th>
                <th scope="col">ID USUARIO ELIMINACION</th>
                <th scope="col">MODIFICAR</th>
                <th scope="col">ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cant2=mysqli_num_rows($resul2);
            $can = 0;
             for($i=0; $i<$cant2;$i++){
                $can++;
                $reg2=mysqli_fetch_row($resul2);
            ?>
                <tr>
                <td><?php echo $can;?></td>
                    <td><?php echo $reg2[1];?></td>
                    <td>
                        <?php 
                        if($reg2[2] == 1){
                            echo "Habilitado";
                        }else{
                            echo "Deshabilitado";
                        }
                        ?>
                    </td>
                    <td><?php echo date('d/m/Y H:i:s', strtotime($reg2[3])); ?></td>
                    <td>
                        <?php
                        if($reg2[4] == null){
                            echo "";
                        }else{
                            $sqrh = "SELECT id, nombre FROM usuarios WHERE id = $reg2[4]";
                            $rerh = mysqli_query($conexion,$sqrh);
                            $regrh = mysqli_fetch_row($rerh);
                            echo $regrh[1];
                        }
                         
                        ?>
                    </td>
                    <td>
                        <?php 
                        if($reg2[5] == 1){
                            echo "Eliminado";
                        }else{
                            echo "";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($reg2[6] == null){
                            echo "";
                        }else{
                            echo date('d/m/Y H:i:s', strtotime($reg2[6]));
                        }
                         
                        ?>
                    </td>
                    <td>
                        <?php
                        if($reg2[7] == null){
                            echo "";
                        }else{
                            $sqrh = "SELECT id, nombre FROM usuarios WHERE id = $reg2[7]";
                            $rerh = mysqli_query($conexion,$sqrh);
                            $regrh = mysqli_fetch_row($rerh);
                            echo $regrh[1];
                        }
                         
                        ?>
                    </td>
                    <td><!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                    </svg>
                    modificar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel2">Modificar rol</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿estas seguro en modificar este rol?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" onclick="modificarRegistroRol(<?php echo $reg2[0]; ?>)">Aceptar</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    </td>
                    <td><!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                    </svg>
                    eliminar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel3" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel3">Eliminar rol</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿estas seguro de eliminar este rol?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" onclick="eliminarRegistroRol(<?php echo $reg2[0]; ?>)">Aceptar</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>




    <div class="gestion">
        <a href="agregarRol.php" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-rolodex" viewBox="0 0 16 16">
    <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
    <path d="M1 1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h.5a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h.5a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H6.707L6 1.293A1 1 0 0 0 5.293 1H1Zm0 1h4.293L6 2.707A1 1 0 0 0 6.707 3H15v10h-.085a1.5 1.5 0 0 0-2.4-.63C11.885 11.223 10.554 10 8 10c-2.555 0-3.886 1.224-4.514 2.37a1.5 1.5 0 0 0-2.4.63H1V2Z"/>
    </svg>  Agregar rol</a>
    </div>

      </div>
    </div>
  </div>

  <!-- Tabla de Personas -->
  <div class="card">
  <div class="card-header" id="headingFour">
    <h2 class="mb-0">
      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        PERSONAS
      </button>
    </h2>
  </div>
  <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
    <div class="card-body">
      <?php
      $sqlper = "SELECT id_personas, nombres, apellidos FROM personas";
      $resul3 = mysqli_query($conexion, $sqlper);
      $cant3 = mysqli_num_rows($resul3);
      $registros_por_pagina = 5;
      $paginas = ceil($cant3 / $registros_por_pagina);

      if (!isset($_GET['pagina'])) {
        $pagina = 1;
      } else {
        $pagina = $_GET['pagina'];
      }

      $inicio = ($pagina - 1) * $registros_por_pagina;
      $sqlper_paginado = "SELECT id_personas, nombres, apellidos FROM personas LIMIT $inicio, $registros_por_pagina";
      $resul3_paginado = mysqli_query($conexion, $sqlper_paginado);
      ?>
      <br>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">PERSONAS</th>
          </tr>
          <tr>
            <th scope="col">#</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">APELLIDO</th>
            <th scope="col">DOMICILIO</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $can = $inicio;
          while ($reg3 = mysqli_fetch_row($resul3_paginado)) {
            $can++;
          ?>
            <tr>
              <td><?php echo $can; ?></td>
              <td><?php echo $reg3[1]; ?></td>
              <td><?php echo $reg3[2]; ?></td>
              <td>
                <button type="button" class="btn btn-outline-primary" onclick="Domicilio(<?php echo $reg3[0]; ?>)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                    <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                  </svg>
                  Domicilio
                </button>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <?php
          if ($pagina > 1) {
          ?>
            <li class="page-item">
              <a class="page-link" href="?pagina=<?php echo ($pagina - 1); ?>">Anterior</a>
            </li>
          <?php
          }

          for ($i = 1; $i <= $paginas; $i++) {
            if ($i == $pagina) {
          ?>
              <li class="page-item active">
                <span class="page-link"><?php echo $i; ?></span>
              </li>
            <?php
            } else {
            ?>
              <li class="page-item">
                <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
              </li>
          <?php
            }
          }

          if ($pagina < $paginas) {
          ?>
            <li class="page-item">
              <a class="page-link" href="?pagina=<?php echo ($pagina + 1); ?>">Siguiente</a>
            </li>
          <?php
          }
          ?>
        </ul>
      </nav>
      
    </div>
    <div class="gestion">
      <div class="fs-2 mb-3">
        <a href="agregarPER.php" class="btn btn-success">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
          </svg>
          Agregar persona
        </a>
      </div>

</div>
<footer>
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
<!--<script>
        // Función para mostrar el popup
        function showPopup() {
            var popup = document.getElementById("confirmationPopup");
            popup.style.display = "block";
        }

        // Función para cancelar la acción
        function cancelAction() {
            var popup = document.getElementById("confirmationPopup");
            popup.style.display = "none";
        }

        // Función para confirmar la acción
        function confirmAction() {
            // Aquí puedes realizar las acciones necesarias antes de cerrar sesión
            // Redirigir al usuario al inicio de sesión
            unset($_SESSION['id']);
            window.location.href = "login.php";
        }
    </script>
!-->
    <br><br>
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