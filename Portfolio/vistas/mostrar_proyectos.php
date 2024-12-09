<?php
    echo "<h1 class='text-center'>PROYECTOS</h1>";
    echo"<section class='container p-5 border border-success-subtle'>
        <form action='../controladores/controlador_proyectos.php' method='post' class='row p-5'>
            <h2 class='text-center'>Buscar proyecto</h2>
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
        echo"<table border='0'>
            <thead class='text-center pb-3'>
                <tr>
                    <th>NOMBRE</th>
                    <th>DESCRIPCIÓN</th>
                    <th>FOTO</th>
                </tr>
            </thead>
            <tbody>";
            foreach($encontrados as $b){
                echo"<tr><td class='text-center fs-4'>$b[nom]</td>
                <td class='w-50'>$b[desc]</td>                     
                <td class='text-center'>
                    <img src='../assets/proyectos/$b[img]' class='col-md-4 img-fluid rounded' alt='Portada del proyecto'>       
                </td></tr>";
            } 
        echo"</tbody>
        </table>";
    }
    echo"</section>";        

    if($usuario==0){
        echo"<section class='container extra'>
        <article class='row border border-success-subtle p-5 mt-5'>
        <h2 class='text-center pb-5'>Todos los proyectos</h2>
            <table border='0'>
                <thead class='text-center pb-3'>
                    <tr>
                        <th>NOMBRE</th>
                        <th>DESCRIPCIÓN</th>
                        <th>FOTO</th>
                    </tr>
                </thead>
                <tbody>";
                foreach($proyectos as $p){
                    if($p["activo"]=='1'){
                        echo"<tr><td class='text-center fs-4'>$p[nombre]</td>
                        <td class='w-50'>$p[descripcion]</td>                     
                        <td class='text-center'>
                            <img src='../assets/proyectos/$p[foto]' class='col-md-4 img-fluid rounded' alt='Imagen del proyecto'>       
                        </td>
                        <td>
                            <a href='../controladores/controlador_proyecto_completo.php?verProyecto=$p[id]'>
                                <button type='button' class='btn btn-warning'>Modificar proyecto</button>
                            </a>
                        </td>
                        <td>
                            <a href='../controladores/controlador_proyectos.php?borrarPry=$p[id]'>
                                <button type='button' class='btn btn-danger'>Desactivar proyecto</button>
                            </a>
                        </td>";
                    }else{  
                        echo"<tr><td class='text-center fs-4 text-secondary'>$p[nombre]</td>
                        <td class='w-50 text-secondary'>$p[descripcion]</td>                     
                        <td class='text-center'>
                            <img src='../assets/proyectos/$p[foto]' class='col-md-4 img-fluid rounded' alt='Imagen del proyecto'>       
                        </td>
                        <td>
                            <button type='button' class='btn btn-warning' disabled>Modificar proyecto</button>
                        </td>
                        <td>
                            <button type='button' class='py-3 btn btn-danger' disabled>Desactivado</button>
                        </td>";
                    }
                    echo"</tr>";
                } 
            echo"</tbody>
            </table>
        </section>
        
        <section class='container p-5 mb-5 border border-success-subtle'>
            <form action='../controladores/controlador_proyectos.php' method='post' class='row' enctype='multipart/form-data'>
                <h2 class='text-center'>Insertar proyecto nueva</h2>
                <div class='row justify-content-center p-3'>
                    <div class='col-md-5'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text' id='basic-addon1'>Nombre</span>
                            <input type='text' class='form-control' name='nomIn' placeholder='Nombre de la proyecto' aria-describedby='basic-addon1' required>
                        </div> 
                    </div>       
                    
                    <div class='col-md-5'>
                        <div class='input-group'>
                            <input type='file' class='form-control' id='inArchivs' name='inFls' aria-describedby='inFls' aria-label='Upload' required>
                        </div>
                    </div>
                </div>
                
                <div class='row justify-content-center'>
                    <div class='col-md-11 form-floating'>
                        <textarea class='form-control' id='comentario' name='descIn' required></textarea>
                        <label for='comentario'>Descripción del proyecto...</label>
                    </div>
                </div>                
                                
                <div class='d-flex justify-content-center p-3'>
                    <button type='submit' class='btn' name='inPry'>Insertar proyecto</button>
                </div>   
            </form>
        </section>";

    }else{
        echo"<section class='container'>";
        foreach($listcamp as $campo){
            echo"<article class='row border border-success-subtle my-2'> 
                <div class='d-flex justify-content-center align-items-center'>
                    <h2 class='text-center p-4'>$campo[nombre]</h2>
                    <img src='../assets/campos/$campo[logotipo]' class='img-fluid rounded logo' alt='Portada de $campo[nombre]'>
                </div>
                <div class='row justify-content-evenly'>";

                if(isset($muestras[$campo["id"]])){
                    for($i=0; $i<sizeof($muestras[$campo["id"]]); $i++){                
                        echo"<div class='col-md-6 card mb-3 g-0' style='max-width: 540px;'>
                            <div class='row'>
                                <div class='col-md-4'>
                                <img src='../assets/proyectos/".$muestras[$campo["id"]][$i]["foto"]."' class='img-fluid rounded' alt='Portada de ".$muestras[$campo["id"]][$i]["proyecto"]."'>
                                </div>
                                <div class='col-md-8'>
                                <div class='card-body text-center d-flex flex-column justify-content-around h-100'>
                                    <div>
                                        <h5 class='card-title'>".$muestras[$campo["id"]][$i]["proyecto"]."</h5>
                                        <p class='card-text'>";
                                            echo ordenarFecha($muestras[$campo["id"]][$i]["fecha"]);
                                            echo"</p>
                                    </div>
                                    <div>
                                        <a href='../controladores/controlador_proyecto_completo.php?verProyecto=".$muestras[$campo["id"]][$i]["idproyecto"]."'>
                                            <button class='btn'>Ver más</button>
                                        </a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>";
                    } 
                }else{
                    echo "<p class='py-4 text-center'>No hay muestras en esta campo.</p>";
                }            
            echo"</div></article>";
        }  
        echo"</section>";
    }
?>