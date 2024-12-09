<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/styles.css">

    <link rel="icon" href="../assets/logor.png">
    <title>Acceso</title>
    
    <style>  
        body{
            background-image: url(../assets/login.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>    
    <main>
        <section class='d-flex flex-column justify-content-center' style='height:100vh'>
            <?php   
                require_once("../bd/bd.php");
                require_once("../php/funciones.php");    
                require_once("../modelos/modelo_socios.php");      

                if(isset($_POST["enviar"]) && $_POST["nick"]!="" && $_POST["pss"]!=""){
                    $nick=$_POST["nick"];
                    $pass=$_POST["pss"];
                    $socio=new modelo_socios();
                    $login=$socio->login_socio($nick,$pass);
                    if($login==(-1)){
                        echo"<h2 class='text-center text-white'>Nick o contraseña no válidos.</h2>";
                        header("refresh:4;url=../index.php");
                    }else{
                        session_start();
                        $_SESSION["sesiUser"]=$login;
                        if($_POST["mantS"]){
                            $info=session_encode();
                            setcookie("cookiUser",$info,time()+3600,"/");
                        }
                        header("location:../index.php");
                    }
                }else{        
                    echo"<h2 class='text-center text-white'>Debes rellenar todos los campos...</h2>";
                    header("refresh:4;url=../index.php");
                }
            ?>
        </section>
    </main>
</body>
</html>