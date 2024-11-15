<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css">
    <link rel="icon" href="../assets/icono.png">
    
    <title>Clientes</title>
    <script src="https://kit.fontawesome.com/f1a9439f03.js" crossorigin="anonymous"></script>

    <style>
        form.columna{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <?php 
        require_once("./funciones.php");
        $conexion=conectar();
        
        $usuario=comprobar_usuario();
        if($usuario==0){
            pintarHeader($usuario);
            
            //Tabla de visualización de todos los clientes(y sus datos)               
            $sql="SELECT * FROM clientes";
            $res=$conexion->query($sql);
            if($res){
                echo"<table border id='formulario'><tr><th>id</th><th>Nombre</th><th>Nick</th><th>Apellidos</th><th>Dirección</th><th>Telef1</th><th>Telef2</th><th>Contraseña</th><th></th></tr>";
                while($fila=$res->fetch_array(MYSQLI_ASSOC)){
                    echo"<tr>
                        <td>$fila[id]</td>
                        <td>$fila[nombre]</td>
                        <td>$fila[nombre_usuario]</td>
                        <td>$fila[apellidos]</td>
                        <td>$fila[direccion]</td>
                        <td>$fila[telefono1]</td>
                        <td>";
                            if($fila["telefono2"]=="" || $fila["telefono2"]==null){
                                echo"--";
                            }else{
                                echo"$fila[telefono2]";
                            }
                        echo"</td>
                        <td>$fila[pass]</td>
                        <td><a href='modificar.php?modCliId=$fila[id]'>Modificar</a></td>
                    </tr>";
                }
                echo"</table>";
            }

            //Para crear un nuevo cliente pedir info mediante formulario y el id mostrarlo readonly
            $sql="SELECT AUTO_INCREMENT 
            FROM information_schema.tables 
            WHERE table_schema='inmobiliaria' AND table_name='clientes'";
            $res=$conexion->query($sql);
            if($res){
                $fila=$res->fetch_array();
                $idCliente=$fila[0];
            }

            echo"<form action='#' method='post' class='columna' id='formulario'>
                Id:<input type='number' name='idC' value='$idCliente' readonly>
                Nombre: <input type='text' name='nombre'>
                Nick: <input type='text' name='nick'>
                Apellidos: <input type='text' name='apellido'>
                Dirección: <input type='text' name='dir'>
                Telefono: <input type='text' name='telefono1'>
                Telefono(Opcional): <input type='text' name='telefono2'>
                Contraseña:  <input type='text' name='pss'>
                <input type='submit' name='enviarCliente' value='Añadir'>
            </form>";

            if(isset($_POST["enviarCliente"])){      
                $nom=$_POST["nombre"]; 
                $nick=$_POST["nick"]; 
                $apell=$_POST["apellido"];   
                $dir=$_POST["dir"];      
                $tl=$_POST["telefono1"];       
                $tl2=$_POST["telefono2"];  
                $pss=$_POST["pss"];                
                
                //Insertar cliente
                if($nom=="" || $nick=="" || $apell=="" || $dir=="" || $tl="" || $pss==""){
                    echo"Debes completar todos los campos.";
                }else{
                    $yaExiste="SELECT count(id) cant FROM clientes WHERE nombre=? AND apellidos=?";
                    $consulta=$conexion->prepare($yaExiste);
                    $consulta->bind_param("ss", $nom,$apell);
                    $consulta->execute();
                    $consulta->bind_result($cant);
                    $consulta->fetch();
                    $consulta->close();

                    if($cant==0){
                        $sql="INSERT INTO clientes VALUES(null,?,?,?,?,?)";
                        $preparada=$conexion->prepare($sql);
                        $preparada->bind_param("sssss",$nom,$apell,$dir,$tl,$tl2);
                        $preparada->execute();
                        echo"<META HTTP-EQUIV='REFRESH'CONTENT='0;clientes.php'>";
                        $preparada->close();
                    }else{
                        echo"<h2 class='text-center text-white'>Ese cliente ya existe...</h2>";
                        header("refresh:4;url=./clientes.php");
                    }
                }
            }
        }else{            
            header("refresh:4;url=../index.php");
        }
        
        pintarFooter();
    ?>
</body>
</html>