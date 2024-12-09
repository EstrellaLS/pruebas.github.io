<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/styles.css">

    <link rel="icon" href="../assets/logor.png">
    <title>Comentarios</title>
</head>
<body>
    <?php
        require_once("../bd/bd.php");  
        require_once("../php/funciones.php");
        include "../modelos/modelo_comentarios.php";
        
        $usuario=comprobar_usuario();
        
        if($usuario>=0){
            pintar_menu($usuario);    

            //Eliminar comentario
            if(isset($_GET["borrarC"])){
                $idSocio=$_GET["idSoc"];
                $idproyecto=$_GET["idPro"];
                $fechaCom=$_GET["fec"];
                $com=new modelo_comentario();
                $com->borrar_comentario($idSocio,$idproyecto,$fechaCom);
                echo"<main><div id='login'><h2 class='text-center p-3'>Borrando comentario...</h2></div></main>";
                unset($com);
                header("refresh:1;url=../controladores/controlador_comentarios.php");
            }

            if($usuario==0){                                  
                $com=new modelo_comentario(); 
                $datos=$com->ver_comentarios();
                
                include("../vistas/vista_comentarios.php");
                
                unset($com);   
            }else{
                header("refresh:0;url=../index.php");
            }


            pintar_footer();
        }else{
            header("refresh:0;url=../index.php");
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>