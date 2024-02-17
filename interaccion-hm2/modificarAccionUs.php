<?php
include("conexion.php");
if (isset($_POST['modificar'])) {
    $id = $_GET['id'];
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];
            $rol = $_POST['rol'];
            $persona = $_POST['persona'];
            $habilitado = $_POST['habilitado'];


            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                if(strlen($contrasena) >= 8){
    
                    if(preg_match('/[A-Z]/',$contrasena)){
            
                        if (preg_match('/\d/', $contrasena)) {
        
                            if (preg_match('/^[a-zA-Z0-9]+$/', $contrasena)) {
                                     
                                $sqlFinal = "UPDATE usuarios SET nombre = '$nombre', email = '$email', contrasena = '$contrasena', id_rol = '$rol', id_persona = '$persona', habilitado = '$habilitado' WHERE id = '$id'";
                                $resultado = mysqli_query($conexion, $sqlFinal);

                                if ($resultado) {
                                    echo "El usuario se ha modificado correctamente.";
                                } else {
                                    echo "Error al modificar el usuario: " . mysqli_error($conexion);
                                }
                                ?>
                                <script>	
                                    location.href ='perfilAdmin.php';
                                </script>	
                                <?php
        
                            }else{
        
                                ?>
                                <script>
                                    alert ("no debe tener caracteres especiales");
                                    window.location.href = "modificarUs.php?id=<?php echo $id; ?>";
                                </script>
                
                                <?php
        
                            }
        
                        }else{
        
                            ?>
                            <script>
                                alert ("minimo un numero");
                                window.location.href = "modificarUs.php?id=<?php echo $id; ?>";
                            </script>
            
                            <?php
                        }
        
            
                    }else{
        
                        ?>
            
                        <script>
                            alert ("minimo una mayuscula");
                            window.location.href = "modificarUs.php?id=<?php echo $id; ?>";
                            </script>
            
                        <?php
        
                    }
        
                }else{
        
        
                    ?>
                    <script>
                        alert ("minimo 8 caracteres");
                        window.location.href = "modificarUs.php?id=<?php echo $id; ?>";
                    </script>
        
                    <?php
        
                }
    
            }else{
                    ?>
                    <script>
                        alert('Ingrese correo valido');
                        window.location.href = "modificarUs.php?id=<?php echo $id; ?>";
                    </script>
                    <?php
            }

        }
        ?>