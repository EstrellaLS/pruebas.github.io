<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/styles.css">

    <link rel="icon" href="../assets/logor.png">
    <title>socios</title>
</head>
<body>
    <?php
        require_once("../bd/bd.php");  
        require_once("../php/funciones.php");
        require_once("../modelos/modelo_socios.php");
        
        $usuario=comprobar_usuario();
        
        
        if($usuario==0){
            pintar_menu($usuario);    
        
            $buscado=false;       
            
            //Visualizar un socio
            if(isset($_GET["verSoc"])){
                $infoSoc=new modelo_socios();
                $socioBD=$infoSoc->ver_socio($_GET["verSoc"]);   
                
                include "../vistas/vista_socio.php";
    
                unset($infoSoc);
                
            }else{          
                //Visualizar todos
                $socioTodo=new modelo_socios();            
                $socios=$socioTodo->ver_socios();
    
                //Buscar socio
                if(isset($_POST["buscar"])){
                    $buscar=new modelo_socios();    
                    $encontrados=$buscar->buscar_socio_nom($_POST["busq"]);
                    $buscado=true;
                    unset($buscar); 
                }
    
                //Insertar socio
                if(isset($_POST["inSoc"])){
                    if(isset($_POST["nomIn"]) && isset($_POST["nickIn"]) && isset($_POST["psswrd"]) && isset($_POST["psswrd2"])){                    
                        if($_POST["psswrd"] == $_POST["psswrd2"]){
                            $nomSocNew=$_POST["nomIn"];
                            $nickSocNw=$_POST["nickIn"];
                            $socioParaIn=new modelo_socios();
                            $socioParaIn->insertar_socios($nomSocNew,$nickSocNw,$_POST["psswrd"]);
                            unset($socioParaIn);
                            header("refresh:0;url=../controladores/controlador_socios.php");//Para evitar duplicados
                        }else{                    
                            echo"Ambas contraseñas deben ser idénticas.";
                        }
                    }else{
                        echo"Deben estar todos los campos rellenos";
                    }
                }
                
                //Modificar socio
                if(isset($_POST["modificarSoc"])){
                    $socio=new modelo_socios();  
                    $socio->modificar_socio($_GET["idSocM"],$_POST["nomIn"],$_POST["nickIn"],$_POST["pssIn"],$_POST["pssIn2"]);
                    echo"<main><div id='login'><h2 class='text-center p-3'>Modificando socio...</h2></div></main>";
                    header("refresh:0;url=../controladores/controlador_socios.php");
                        
                    unset($socio);
                }
    
    
                //Desactivar socio
                if(isset($_GET["borrarSoc"])){
                    $socio=new modelo_socios();  
                    $socio->desactivar_socio($_GET["borrarSoc"]);
                    echo"<main><div id='login'><h2 class='text-center p-3'>Desactivando socio...</h2></div></main>";
                    unset($socio);
                    header("refresh:1;url=../controladores/controlador_socios.php");
                }
                
                include "../vistas/vista_socios.php";
                unset($socioTodo);
            }
            
            pintar_footer();
        }else{            
            header("refresh:0;url=../index.php");
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>