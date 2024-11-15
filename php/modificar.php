<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css">
    <link rel="icon" href="../assets/icono.png">
    
    <title>Modificar datos</title>
    <script src="https://kit.fontawesome.com/f1a9439f03.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        require_once("./funciones.php");
        $conexion=conectar();
        
        $usuario=comprobar_usuario();
        pintarHeader($usuario);

        //Modificar Cliente
        if(isset($_GET["modCliId"])){
            $id=$_GET["modCliId"];

            $consulta="SELECT * FROM clientes WHERE id=$id";        
            $sentencia=$conexion->query($consulta);
            $fila=$sentencia->fetch_array();

            echo"<h1>Modificar $fila[nombre]</h1>
            <form action='#' method='post' id='formulario'>
                Id:<input type='number' name='idC' value='$fila[id]' readonly>
                Nombre: <input type='text' name='nombre' value='$fila[nombre]'>
                Nick: <input type='text' name='nick' value='$fila[nick]'>
                Apellidos: <input type='text' name='apellido' value='$fila[apellidos]'>
                Dirección: <input type='text' name='dir' value='$fila[direccion]'>
                Telefono: <input type='text' name='telefono1' value='$fila[telefono1]'>
                Telefono(Opcional): <input type='text' name='telefono2' value='$fila[telefono2]'>
                Contraseña: <input type='text' name='pss' value='$fila[pass]'>
                <input type='submit' name='enviarCliente' value='Guardar'>
            </form>";
            $consulta->close();

            if(isset($_POST["enviarCliente"])){  
                $id=$_POST["id"];    
                $nom=$_POST["nombre"]; 
                $nick=$_POST["nick"]; 
                $apell=$_POST["apellido"];   
                $dir=$_POST["dir"];      
                $tl=$_POST["telefono1"];       
                $tl2=$_POST["telefono2"];  
                $pss=$_POST["pss"];

                //Comprobar si se ha modificado la contraseña
                $consulta="SELECT pass FROM clientes WHERE id=$id";
                $sentencia=$conexion->query($consulta);
                $pssBD=$sentencia->fetch_array();
                if($pssBD==$pss){
                    $pssRegistrar=$pssBD;
                }else{
                    $pssRegistrar=encriptar($pss);
                }   
                $consulta->close();             
                
                if($nom=="" || $nick=="" || $apell=="" || $dir=="" || $tl="" || $pss==""){
                    echo"Debes completar todos los campos.";
                }else{
                    $sql="UPDATE clientes SET nombre=?, nombre_usuario=?, apellidos=?, direccion=?, telefono1=?, telefono2=?, pass=? WHERE id=$id";
                    $preparada=$conexion->prepare($sql);
                    $preparada->bind_param("sssssss",$nom,$nick,$apell,$dir,$tl,$tl2,$pssRegistrar);
                    $preparada->execute();
                    echo"<h2 class='text-center text-white'>Modificando datos</h2>";
                    header("refresh:4;url=../index.php");
                    $preparada->close();
                }
            }

        }elseif($usuario==0){
            //Modificar cita
            if(isset($_GET["modCitId"])){
                $id = $_GET['modCitId'];
                $consulta = "SELECT * FROM clientes, citas WHERE citas.id_cliente=clientes.id and citas.id=$id";        
                $sentencia = $conexion->query($consulta);

                echo "<form action='#' method='post' id='formulario'>";
                $fila = $sentencia->fetch_array();

                echo "Id: <input name='id' value='$id' readonly>
                    Fecha: <input type='date' name='fecha' value='$fila[fecha]'>
                    Hora: <input type='time' name='hora' value='$fila[hora]'>
                    Motivo: <input type='text' name='motivo' value='$fila[motivo]'>
                    Lugar: <input type='text' name='lugar' value='$fila[lugar]'>
                    Id del cliente: <input type='number' name='cliente' value='$fila[id_cliente]'>
                    Telefono: <input type='text' name='telefono1' value='$fila[telefono1]'>
                    Telefono 2: <input type='text' name='telefono2' value='";
                        if($fila["telefono2"]=="" || $fila["telefono2"]==null){
                            echo"--";
                        }else{
                            echo"$fila[telefono2]";
                        }
                    echo"'>
                    <input type='submit' name='enviarCita'>
                </form>";
                $consulta->close();

                if (isset($_POST["enviarCita"])) {
                    $id=$_POST["id"];
                    $fecha=$_POST["fecha"];
                    $hora=$_POST["hora"];
                    $motivo=$_POST["motivo"];
                    $lugar=$_POST["lugar"];
                    $cliente=$_POST["cliente"];
                    $telefono1=$_POST["telefono1"];
                    $telefono2=$_POST["telefono2"];
            
                    $consulta="UPDATE citas, clientes set fecha=?, hora=?, motivo=?, lugar=?, id_cliente=?, telefono1=?, telefono2=? WHERE citas.id_cliente=clientes.id and citas.id=?";
                    $consulta_editada = $conexion->prepare($consulta);
                    $consulta_editada->bind_param("ssssissi", $fecha, $hora, $motivo, $lugar, $cliente, $telefono1, $telefono2, $id);
                    $consulta_editada->execute();
            
                    echo"<h2 class='text-center text-white'>Guardando cita</h2>";
                    header("refresh:4;url=../index.php");
                }
            }

            //Modificar inmueble(vender):
            if(isset($_GET["venderInmb"])){   
                $id=$_GET["venderInmb"];            
                $consulta="SELECT id,nombre FROM clientes WHERE id!=0";        
                $sentencia=$conexion->query($consulta);
                $fila=$sentencia->fetch_array();

                echo "<form action='#' method='POST' id='formulario'>
                    Id inmueble: <input name='id' value='$id' readonly>
                    <select name='clientes'>
                    <option value=0> Elige un comprador...</option>";
                    while($fila = $datos->fetch_array())
                    {
                        echo "<option value='$fila[id]'>$fila[nombre]</option>";
                    }
                    echo "</select>";
                    echo "<input type='submit' name='enviarVenta'>";
                echo "</form>";
            }

            if(isset($_POST["enviarVenta"])){
                $id_cliente=$_POST['clientes'];
                $id_inmueble=$_POST['id'];
    
                $consulta="UPDATE inmuebles set id_cliente=$id_cliente WHERE id=$id_inmueble";
                $sentencia=$conexion->query($consulta);
                $consulta->close();

                echo"<h2 class='text-center text-white'>Inmueble modificado</h2>";
                header("refresh:4;url=./inmuebles.php");
            }
            
        }else{            
            header("refresh:4;url=../index.php");
        }
        
        pintarFooter();
    ?>
</body>
</html>