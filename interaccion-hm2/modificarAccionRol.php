<?php
include("conexion.php");
if (isset($_POST['modificar'])) {
    $id = $_GET['id'];
            $nombre = $_POST['nombre'];
            $habilitado = $_POST['habilitado'];

                if(strlen($nombre) > 0){
    
                    if(preg_match('/[a-zA-Z]/',$nombre)){
        
                            if (preg_match('/^[a-zA-Z0-9]+$/', $nombre)) {
                                     
                                $sqlFinal = "UPDATE roles  SET nombre = '$nombre', habilitado = '$habilitado' WHERE id = '$id'";
                                $resultado = mysqli_query($conexion, $sqlFinal);

                                if ($resultado) {
                                    echo "El rol se ha modificado correctamente.";
                                } else {
                                    echo "Error al modificar el rol: " . mysqli_error($conexion);
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
                                    window.location.href = "modificarRol.php?id=<?php echo $id; ?>";
                                </script>
                
                                <?php
        
                            }
        
            
                    }else{
        
                        ?>
            
                        <script>
                            alert ("si o si caracteres");
                            window.location.href = "modificarRol.php?id=<?php echo $id; ?>";
                            </script>
            
                        <?php
        
                    }
        
                }else{
        
        
                    ?>
                    <script>
                        alert ("minimo 1 caracter");
                        window.location.href = "modificarRol.php?id=<?php echo $id; ?>";
                    </script>
        
                    <?php
        
                }
    
            

        }
        ?>