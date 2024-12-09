<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/styles.css">

    <link rel="icon" href="../assets/logor.png">
    <title>campos</title>
</head>
<body>
    <?php
        require_once("../bd/bd.php");  
        require_once("../php/funciones.php");
        require_once("../modelos/modelo_campos.php");
        require_once("../modelos/modelo_muestras.php");
        
        $usuario=comprobar_usuario();      
        
        pintar_menu($usuario);       
        $buscado=false; 

        //Buscar campo
        if(isset($_POST["buscar"])){
            $buscar=new modelo_campos();    
            $encontrados=$buscar->buscar_campo($_POST["busq"]);
            $buscado=true;
            unset($buscar); 
        }
        
        //Mostrar una o todas las campos
        if(isset($_GET["vercamp"])){
            $campoV=new modelo_muestra();  
            $datos=$campoV->buscar_muestra_x_camp($_GET["vercamp"]);
            include "../vistas/ver_campo.php";
            unset($campoV);   
        }else{
            $camp=new modelo_campos();        
            $listadoPl=$camp->ver_campos();
            include "../vistas/vista_campos.php";
            unset($camp);
        }

        //Insertar campo
        if($usuario==0){
            if(isset($_POST["incamp"])){
                if(isset($_FILES["inFls"]) && isset($_POST["nomIn"])){   
                    $proxId=new modelo_campos();  
                    $autInc=$proxId->sacar_id();
                    unset($proxId);
                    $sigId=$autInc [0]["AUTO_INCREMENT"];

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
                    $ruta="../assets/campos/$nombre_final";
                    move_uploaded_file($temporal,"$ruta");

                    $nomcampNew=$_POST["nomIn"];
                    $campParaIn=new modelo_campos();
                    $campParaIn->insertar_campos($nomcampNew,'1',$nombre_final);
                    unset($campParaIn);                   
                    //Para evitar duplicados
                    ?>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=../controladores/controlador_campos.php">
                    <?php
                }else{ 
                    echo"Deben estar todos los campos rellenos";
                }
            }
        }

        //Modificar campo
        if(isset($_POST["modificarCamp"])){            
            if(!isset($_FILES["inFls"])){                    
                $proxId=new modelo_campos();  
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
            $ruta="../assets/campos/$nombre_final";
            move_uploaded_file($temporal,"$ruta");

            $nomCamp=$_POST["nomIn"];
            $campoParaIn=new modelo_campos();
            $id=$_POST["id"];
            $nombre=$_POST["nomIn"];

            $campo=new modelo_campos();  
            $campo->modificar_campo($id,$nombre,'1',$nombre_final);
            unset($campo);
            unset($campoParaIn);

            echo"<main><div id='login'><h2 class='text-center p-3'>Actualizando campo...</h2></div></main>";                 
            //Para evitar duplicados
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="1;URL=../controladores/controlador_campos.php?ver_campo=$id">
            <?php
        }

        pintar_footer();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>