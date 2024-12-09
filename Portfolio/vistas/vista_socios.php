<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/styles.css">

    <link rel="icon" href="../assets/logor.png">
    <title>Socios</title>
</head>
<body>
    <?php        
        require_once("../bd/bd.php");
        require_once("../php/funciones.php");
        require_once("../modelos/modelo_socios.php");

        echo "<h1 class='text-center'>SOCIOS</h1>";

        echo"<section class='container p-5'>
            <article class='row border border-success-subtle p-5'>
                <form action='../controladores/controlador_socios.php' method='post' class='row p-5'>
                    <h2 class='text-center'>Buscar socio</h2>
                    <div class='d-flex flex-nowrap justify-content-evenly p-3'>
                        <div class='col-md-7'>
                            <div class='input-group mb-3'>
                                <span class='input-group-text' id='basic-addon1'>Búsqueda</span>
                                <input type='text' name='busq' class='form-control' placeholder='Nombre, letra o fragmento del título' aria-describedby='basic-addon1'>
                            </div> 
                        </div>                   
                                    
                        <div>
                            <button type='submit' name='buscar' class='btn'>Buscar</button>
                        </div>  
                    </div>
                </form>";

        if($buscado){
            echo"<table border='0' class='text-center w-75 m-auto'>
                <thead class='pb-3'>
                    <tr>
                        <th>NOMBRE</th>
                        <th>NICK</th>
                        <th>CONTRASEÑA</th>
                    </tr>
                </thead>
                <tbody>";
                foreach($encontrados as $b){
                    echo"<tr>
                        <td class='fs-4'>$b[nom]</td>
                        <td class='w-50'>$b[nick]</td>                     
                        <td>$b[pass]</td>
                    </tr>";
                } 
            echo"</tbody>
            </table>";
        }
                  
        echo"</article>
            </section><section class='container p-5' border='0'>
        <article class='row text-center border border-success-subtle px-4'>";
        for($cont=0; $cont<=1; $cont++){
            echo"<h2  class='py-5'>Socios ".$socios[2][$cont]."</h2>
            <table border=0>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>NICK</th>
                        <th>CONTRASEÑA</th>
                    </tr>
                </thead>
                <tbody>";
                    foreach($socios[$cont] as $dato){
                        echo"<tr>
                            <td>$dato[id]</td>
                            <td>$dato[nombre]</td>
                            <td>$dato[nick]</td>
                            <td>$dato[pass]</td>
                            <td class='d-flex justify-content-evenly'>";
                                if($cont==0 && $dato["id"]!=0){//Evitar desactivar al administrador
                                    echo"<a href='../controladores/controlador_socios.php?verSoc=$dato[id]'>
                                        <button type='button' class='btn btn-warning'>Modificar socio</button>
                                    </a>
                                    <a href='../controladores/controlador_socios.php?borrarSoc=$dato[id]'>
                                        <button type='button' class='btn btn-danger'>Desactivar socio</button>
                                    </a>";
                                }                                
                            echo"</td>
                        </tr>";
                    } 
            echo"</tbody></table>";
        }
        echo"</article></section>
        <section class='container p-5'>
            <form action='../controladores/controlador_socios.php' method='post' class='row border border-success-subtle pt-5' enctype='multipart/form-data'>
                <h2 class='text-center'>Insertar socio nuevo</h2>
                <div class='row justify-content-center p-3'>
                    <div class='col-md-5'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text' id='basic-addon1'>Nombre</span>
                            <input type='text' class='form-control' name='nomIn' aria-describedby='basic-addon1'>
                        </div> 
                    </div>     

                    <div class='col-md-5'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text' id='basic-addon1'>Nick</span>
                            <input type='text' class='form-control' aria-describedby='basic-addon1' name='nickIn'>
                        </div> 
                    </div> 

                    <div class='col-md-5'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text' id='basic-addon1'>Contraseña</span>
                            <input type='text' class='form-control' aria-describedby='basic-addon1' name='psswrd'>
                        </div> 
                    </div> 

                    <div class='col-md-5'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text' id='basic-addon1'>Repetir contraseña</span>
                            <input type='text' class='form-control' aria-describedby='basic-addon1' name='psswrd2'>
                        </div> 
                    </div> 
                </div>             
                                
                <div class='d-flex justify-content-center p-3'>
                    <button type='submit' class='btn' name='inSoc'>Insertar socio</button>
                </div>   
            </form>
        </section>";

    ?>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>