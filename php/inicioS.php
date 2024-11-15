<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css">
    <link rel="icon" href="../assets/icono.png">
    <title>Inicio de sesión</title>
    <script src="https://kit.fontawesome.com/f1a9439f03.js" crossorigin="anonymous"></script>
</head>
<body>
    <main id="login">
        <?php
            require_once("./funciones.php");
            $conexion=conectar();

            echo"<form action='#' method='post'>
                <div>
                    <label for='nick' class='form-label'>Nick:</label>
                    <input type='text' id='nick' name='nick' placeholder='Nombre usuario...' required>
                </div>
                <div>
                    <label for='pss' class='form-label'>Contraseña</label>
                    <input type='password' id='pss' name='pss' required>
                </div>
                <div class='form-check'>
                    <input type='checkbox' class='form-check-input' id='mantenerSess' name='mantS'>
                    <label class='form-check-label' for='mantenerSess'>Mantener sesión iniciada</label>
                </div>
                <div>
                    <div>
                        <button type='submit' name='enviar'>Acceder</button>
                    </div>
                    <div>
                        <a href='../index.php'>
                            <button type='button' class='btn px-5'>No estoy registrado</button>
                        </a>
                    </div>
                </div>
            </form>";

            if(isset($_POST["enviar"])){
                if($_POST["nick"]!="" && $_POST["pss"]!=""){
                    $nick=$_POST["nick"];
                    $pass=$_POST["pss"];
                    
                    
                    $passCod=encriptar($pass);
                    $consulta="SELECT id FROM clientes WHERE nombre_usuario=? AND pass=?";
                    $sentencia=$conexion->prepare($consulta);
                    $sentencia->bind_param("ss",$nick,$passCod);
                    $sentencia->bind_result($idRec);
                    $sentencia->execute();
                    $sentencia->store_result();
                    
                    if($sentencia->num_rows==1){
                        while($filas=$sentencia->fetch()){
                            $id=$idRec;
                        }
                        $login=$id;
                    }else{
                        $login=(-1);
                    }
                    $sentencia->close();

                    if($login==(-1)){
                        echo"<h2 class='text-center text-white'>Nick o contraseña no válidos.</h2>";
                        header("refresh:4;url=./inicioS.php");
                    }else{
                        session_start();
                        $_SESSION["sesiUser"]=$login;
                        if($_POST["mantS"]){
                            echo"Sesión mantener";
                            $info=session_encode();
                            setcookie("cookiUser",$info,time()+3600,"/");
                        }
                        header("location:../index.php");
                    }
                }else{        
                    echo"<h2 class='text-center text-white'>Debes rellenar todos los campos...</h2>";
                    header("refresh:4;url=../index.php");
                }
            }
        ?>
    </main>
</body>
</html>