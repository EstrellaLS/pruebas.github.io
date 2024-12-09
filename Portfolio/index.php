<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/styles.css">

    <link rel="icon" href="./assets/logor.png">
    <title>Inicio</title>
</head>
<body>
    <?php     
        //Estrella Lucía Sáez Ribera      
        require_once("./bd/bd.php");
        require_once("./php/funciones.php");
        require_once("./modelos/modelo_campos.php");
        require_once("./modelos/modelo_muestras.php");
        require_once("./modelos/modelo_comentarios.php");
        
        $usuario=comprobar_usuario();        
        
        pintar_menu_index($usuario);
        
        echo "<h1 class='text-center pb-5'>PORTFOLIO DE ESTRELLA</h1>";
        
        //Listar proyectos + nuevas por cada campo
        $camp=new modelo_campos();
        $listcamp=$camp->ver_campos();
        echo"<section class='container'>";
        foreach($listcamp as $campo){
            echo"<article class='row border border-success-subtle my-2'> 
                <div class='d-flex justify-content-center align-items-center'>
                    <h2 class='text-center p-4'>$campo[nombre]</h2>
                    <img src='./assets/campos/$campo[logotipo]' class='img-fluid rounded logo' alt='Portada de $campo[nombre]'>
                </div>
                <div class='row justify-content-evenly'> ";
            
            $campoV=new modelo_muestra();
            $listcampoV=$campoV->ultims_muestras($campo);
                foreach($listcampoV as $c){
                    echo"<div class='col-md-6 card mb-3 g-0' style='max-width: 540px;'>
                        <div class='row'>
                            <div class='col-md-4'>
                            <img src='./assets/proyectos/$c[foto]' class='img-fluid rounded' alt='Portada de $c[proyecto]'>
                            </div>
                            <div class='col-md-8'>
                            <div class='card-body text-center d-flex flex-column justify-content-center h-100'>
                                <h5 class='card-title'>$c[proyecto]</h5>
                                <p class='card-text'>";
                                    echo ordenarFecha($c["fecha"]);
                                    echo"</p>
                            </div>
                            </div>
                        </div>
                    </div>";
                } 
            echo"</div></article>";
        }  
        echo"</section>";
        unset($camp);
        unset($campoV);

        // //Últimos 5 comentarios        
        // $com=new modelo_comentario();
        // $datos=$com->ultims_comentarios();
        // carrousel_comentarios($datos);        
        // unset($com);
        
        pintar_footer();
    ?>