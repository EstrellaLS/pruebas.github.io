<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/styles.css">

    <link rel="icon" href="../assets/logor.png">
    <title>Proyecto</title>
</head>
<body>
    <?php
        require_once("../bd/bd.php");  
        require_once("../php/funciones.php");
        require_once("../modelos/modelo_proyectos.php");
        require_once("../modelos/modelo_comentarios.php");
        
        $usuario=comprobar_usuario();      
        
        pintar_menu($usuario);            
    
        $proyecto=new modelo_proyectos();
        $proyectoBD=$proyecto->buscar_proyecto_id($_GET["verProyecto"]);
        
        //Mostrar comentarios de la proyecto
        if($usuario>0){
            $puede=true;
            $com=new modelo_comentario(); 
            $comentariosBD=$com->buscar_comentario_x_proyecto($_GET["verProyecto"]);
            if($comentariosBD!=null){
                foreach($comentariosBD as $coment){
                    if($coment["idSoc"]==$usuario){
                        $puede=false;
                    }
                }
            }

            if(isset($_POST["enviar"])){
                if(isset($_POST["feCom"])!="" && isset($_POST["comentao"])!=""){
                    $fecha=$_POST["feCom"];
                    $texto=$_POST["comentao"];
                    $comentario=new modelo_comentario();
                    $comentario->insertar_comentario($usuario,$_GET["verProyecto"],$fecha,$texto);
                    unset($comentario);
                    header("refresh:0;url=../controladores/controlador_proyecto_completo.php?verProyecto=$_GET[verProyecto]");
                }else{
                    echo"Deben estar todos los campos rellenos";
                }
            }
        }

        include("../vistas/mostrar_un_proyecto.php");
        
        unset($com);
        unset($proyecto);
        pintar_footer();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>