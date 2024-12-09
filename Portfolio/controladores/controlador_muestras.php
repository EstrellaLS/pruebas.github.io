<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/styles.css">

    <link rel="icon" href="../assets/logor.png">
    <title>muestras</title>
</head>
<body>
    <?php
        require_once("../bd/bd.php");  
        require_once("../php/funciones.php");
        require_once("../modelos/modelo_muestras.php");
        require_once("../modelos/modelo_campos.php");
        require_once("../modelos/modelo_proyectos.php");
        
        $usuario=comprobar_usuario();
        
        if($usuario==0){
            pintar_menu($usuario);    

            //Modificar muestra
            if(isset($_GET["modificarMp"]) && isset($_GET["modificarMc"])){   
                include "../vistas/vista_muestra.php";
                
            }
            
            if(isset($_GET["guardar"])){
                $cambio=new modelo_muestra();
                $proyectoCamb=$_POST["proyecto"];
                $campoCamb=$_POST["campo"];
                $fechaCamb=$_POST["nwFecha"];
                $cambio->modificar_muestra($proyectoCamb,$campoCamb,$fechaCamb);
                unset($cambio);
                echo $_POST["proyecto"],$_POST["campo"],$_POST["nwFecha"];
                echo"<main><div id='login'><h2 class='text-center p-3'>Cambiando fecha de muestra...</h2></div></main>"; 
                header("refresh:2;url=../controladores/controlador_muestras.php");
            
            }else{
                //Visualizar muestras            
                $campoV=new modelo_muestra();              
                $muestras=$campoV->ver_muestras();
                
                $proyecto=new modelo_proyectos();
                $listadoS=$proyecto->ver_proyectos(); 
                        
                $camp=new modelo_campos(); 
                $listadoP=$camp->ver_campos(); 

                //Insertar muestra
                if(isset($_POST["incampoV"])){
                    if(isset($_POST["proyectoIn"]) && isset($_POST["campoIn"]) && isset($_POST["fechaIn"])){
                        $muestra=new modelo_muestra();
                        $existe=$muestra->buscar_muestra($_POST["proyectoIn"],$_POST["campoIn"]);
                        if(!$existe){
                            $proyectoM=$_POST["proyectoIn"];
                            $camporM=$_POST["campoIn"];
                            $feccampoV=$_POST["fechaIn"];
                            
                            $m=new modelo_muestra();
                            $m->insertar_muestra($proyectoM,$camporM,$feccampoV);
                            echo"<main><div id='login'><h2 class='text-center p-3'>Creando muestra...</h2></div></main>";         
                            unset($m);               
                        }else{                        
                            echo"<main><div id='login'><h2 class='text-center p-3'>muestra ya existente...</h2></div></main>";
                        }
                        header("refresh:3;url=../controladores/controlador_muestras.php");
                        unset($muestra);
                    }
                }

                //Eliminar muestra
                if(isset($_GET["eliminarMp"]) && isset($_GET["eliminarMc"])){
                    $borrar=new modelo_muestra();
                    $borrar->borrar_muestra($_GET["eliminarMp"],$_GET["eliminarMc"]);
                    unset($borrar);
                    echo"<main><div id='login'><h2 class='text-center p-3'>Eliminando muestra...</h2></div></main>";  
                    header("refresh:2;url=../controladores/controlador_muestras.php");
                }
                
                include "../vistas/vista_muestras.php";
        
                unset($camp);
                unset($proyecto);  
                unset($campoV);
            }
            
            
            pintar_footer();
        }else{            
            header("refresh:0;url=../index.php");
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>