<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css">
    <link rel="icon" href="../assets/icono.png">
    
    <title>Inmuebles</title>
    <script src="https://kit.fontawesome.com/f1a9439f03.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        require_once("./funciones.php");
        $conexion=conectar();
        
        $usuario=comprobar_usuario();
        pintarHeader($usuario);

        if($usuario==0){
            //Insertar inmueble
            echo"<h2>Insertar inmueble</h2>   
			<form action='#' method='POST' enctype='multipart/form-data' id='formulario'>
				Dirección: <input type='text' name='dir' required>
				Descripción: <input type='text' name='desc' required>
				Precio: <input type='number' name='prec' required>
				Fotografía: <input type='file' name='inFile' id='inFile' class='form-control' required>
                <input type='submit' name='nwInmb'>
            </form>";

            if(isset($_POST["nwInmb"])){
            
                $consulta="SELECT AUTO_INCREMENT 
                            FROM information_schema.tables 
                            WHERE table_schema='inmobiliaria' AND table_name='inmuebles'";
                $sentencia=$conexion->query($consulta);
                while($filas=$sentencia->fetch_assoc()){
                    $id[]=$filas;
                }
                $sigId=$id[0]["AUTO_INCREMENT"];
                $sentencia->close(); 

                if($dir!="" || $desc!="" || $prec!=""){
                    if(isset($_FILES["inFile"])){                        
                        $yaExiste="SELECT count(id) cant FROM inmuebles WHERE direccion=?";
                        $consulta=$conexion->prepare($yaExiste);
                        $consulta->bind_param("s", $dir);
                        $consulta->execute();
                        $consulta->bind_result($cant);
                        $consulta->fetch();
                        $consulta->close();

                        if($cant==0){
                            $temporal=$_FILES["inFile"]["tmp_name"];
                            switch($_FILES["inFile"]["type"]){
                                case 'image/jpeg':
                                    $ext='.jpeg';
                                    break;
                                case 'image/jpg':
                                    $ext='.jpg';
                                    break;
                                case 'image/png':
                                    $ext='.png';
                                    break;
                            }
                            $nombre_final="$sigId"."$ext";
                            $ruta="../assets/inmuebles/$nombre_final";
                            move_uploaded_file($temporal, "$ruta");

                            $dir=$_POST['dir'];
                            $desc=$_POST['desc'];
                            $prec=$_POST['prec'];
                            
                            $consulta="INSERT INTO inmuebles values(null,?,?,?,?,null)";
                            $sentencia=$conexion->prepare($consulta);
                            $sentencia->bind_param("ssss",$dir,$desc,$prec,$nombre_final);
                            $sentencia->execute();
                            $sentencia->close();
                            
                        echo"<h2 class='text-center text-white'>Inmueble insertado</h2>";
                        header("refresh:4;url=./inmuebles.php");
                        }
                    }

                }else{
                    echo"Todos los campos deben estar rellenos";
                }
            }

            //Buscar inmueble
            echo"<h2>Buscar y eliminar</h2>
			<form action='#' method='POST' id='formulario''>
				<input type='text' name='busq' placeholder='buscar por precio o dirección'>
				<input type='submit' name='buscar' value='Buscar'>
			</form>";

            if(isset($_POST["Buscar"])){
                $busqueda=$_POST["busq"];
                $busq="%$busqueda%";
                $consulta="SELECT * FROM inmuebles WHERE direccion LIKE ? OR precio LIKE ?";
                $sentencia=$conexion->prepare($consulta);
                $sentencia->bind_param("s",$busq);
                $sentencia->bind_result($dir,$desc,$prec,$img,$id_cli);
                $sentencia->execute();
                $sentencia->store_result();

                $i=0;
                while($fila=$sentencia->fetch()){
                    $datos[$i]["dir"]=$dir;
                    $datos[$i]["desc"]=$desc;
                    $datos[$i]["prec"]=$prec;
                    $datos[$i]["img"]=$img;
                    $datos[$i]["id_cli"]=$id_cli;
                    $i++;
                }
                $sentencia->close(); 
            }
        }
        
        pintarFooter();
    ?>
</body>
</html>