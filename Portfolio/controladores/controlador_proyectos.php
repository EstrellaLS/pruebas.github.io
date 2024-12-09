<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/styles.css">

    <link rel="icon" href="../assets/logor.png">
    <title>Proyectos</title>
</head>
<body>
    <?php
        require_once("../bd/bd.php");  
        require_once("../php/funciones.php");
        require_once("../modelos/modelo_proyectos.php");
        require_once("../modelos/modelo_campos.php");
        require_once("../modelos/modelo_muestras.php");
        
        $usuario=comprobar_usuario();       
        
        pintar_menu($usuario);  
        $buscado=false; 

        //Buscar proyecto
        if(isset($_POST["buscar"])){
            $buscar=new modelo_proyectos();    
            $encontrados=$buscar->buscar_proyecto_nom($_POST["busq"]);
            $buscado=true;
            unset($buscar); 
        }
        
        //Visualizar proyectos según tipo de usuario
        if($usuario==0){
            $proyectoTodo=new modelo_proyectos();            
            $proyectos=$proyectoTodo->ver_proyectos_admin();

            //Insertar proyecto
            if(isset($_POST["inPry"])){
                if(isset($_FILES["inFls"]) && isset($_POST["nomIn"]) && isset($_POST["descIn"])){                    
                    $proxId=new modelo_proyectos();  
                    $autInc=$proxId->sacar_id();
                    unset($proxId);
                    $sigId=$autInc[0]["AUTO_INCREMENT"];

                    $temporal=$_FILES["inFls"]["tmp_name"];
                    switch($_FILES["inFls"]["type"]){
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
                    $ruta="../assets/proyectos/$nombre_final";
                    move_uploaded_file($temporal,"$ruta");

                    $nomPryNew=$_POST["nomIn"];
                    $descPryNw=$_POST["descIn"];
                    $proyectoParaIn=new modelo_proyectos();
                    $proyectoParaIn->insertar_proyectos($nomPryNew,$descPryNw,$nombre_final,'1');
                    unset($proyectoParaIn);
                    header("refresh:0;url=../controladores/controlador_proyectos.php");//Para evitar duplicados
                }else{
                    echo"Deben estar todos los campos rellenos";
                }
            }

            //Modificar proyecto
            if(isset($_POST["modificarPry"])){            
                if(!isset($_FILES["inFls"])){                    
                    $proxId=new modelo_proyectos();  
                    $autInc=$proxId->sacar_id();
                    unset($proxId);
                    $sigId=$autInc[0]["AUTO_INCREMENT"];

                    $temporal=$_FILES["inFls"]["tmp_name"];
                    switch($_FILES["inFls"]["type"]){
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
                }else{
                    $temporal="temporal";
                    $nombre_final=$_POST["img"];
                }
                $ruta="../assets/proyectos/$nombre_final";
                move_uploaded_file($temporal,"$ruta");

                $nomPryNew=$_POST["nomIn"];
                $descPryNw=$_POST["descIn"];
                $proyectoParaIn=new modelo_proyectos();
                $id=$_POST["id"];
                // $nombre=$_POST["nomIn"];
                // $descrip=$_POST["descIn"];

                $proyectoMod=new modelo_proyectos();  
                $proyectoMod->modificar_proyecto($id,$nomPryNew,$descPryNw,$nombre_final);
                unset($proyectoMod);
                unset($proyectoParaIn);

                echo"<main><div id='login'><h2 class='text-center p-3'>Actualizando proyecto...</h2></div></main>";
                header("refresh:0;url=../controladores/controlador_proyecto_completo.php?verProyecto=$id");
            }
            
            //Desactivar proyecto
            if(isset($_GET["borrarPry"])){
                $proyecto=new modelo_proyectos();  
                $proyecto->desactivar_proyecto($_GET["borrarPry"]);
                echo"<main><div id='login'><h2 class='text-center p-3'>Desactivando proyecto...</h2></div></main>";
                unset($proyecto);
                header("refresh:0;url=../controladores/controlador_proyectos.php");
            }

        }else{            
            $camp=new modelo_campos();
            $listcamp=$camp->ver_campos();

            foreach ($listcamp as $c) {
                $campoV=new modelo_muestra();            
                $listcampoV=$campoV->ver_proyectos_x_camp($c["id"]);   
                if(!empty($listcampoV)){
                    foreach ($listcampoV as $muestra) {
                        $muestras[$c["id"]][]=$muestra;  
                    }
                }
                unset($campoV);
            }
            unset($camp);
        }        
        
        include "../vistas/mostrar_proyectos.php";
        unset($proyectoTodo); 

        pintar_footer();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>