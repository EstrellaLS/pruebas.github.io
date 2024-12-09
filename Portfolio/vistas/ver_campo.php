<?php     
    echo"<h1 class='text-center'>$_GET[nomCamp]</h1>";       
    if($usuario!=0){           
        echo"<section class='container extra'>
            <article class='row border border-success-subtle p-5 mt-5'>";
        if($datos!=null){                 
                echo"<table border='0' class='text-center'>
                        <thead>
                            <tr>
                                <th>PROYECTO</th>
                                <th>FECHA</th>
                                <th>FOTO</th>
                            </tr>
                        </thead>
                        <tbody>";
                    foreach($datos as $dato){
                        $fecha=ordenarFecha($dato["fecha"]);
                        echo"<tr><td class='fs-4'>$dato[proyecto]</td>
                        <td>$fecha</td>
                        <td>
                            <img src='../assets/proyectos/$dato[foto]' class='col-md-4 img-fluid rounded maxim' alt='Imagen del proyecto'>       
                        </td></tr>";
                    } 
                    echo"</tbody>
                </table>";
        }else{
            echo"<p class='text-center m-auto'>$_GET[nomCamp] no dispone de proyectos</p>
            </article></section>";
        }
    }else{
        echo"<section class='container extra'>
        <article class='row border border-success-subtle p-5 mt-5'>";
        if($datos!=null){
            echo"<table border='0' class='text-center'>
                    <thead>
                        <tr>
                            <th>PROYECTO</th>
                            <th>FECHA</th>
                            <th>FOTO</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach($datos as $dato){
                            $fecha=ordenarFecha($dato["fecha"]);
                            echo"<tr><td class='fs-4'>$dato[proyecto]</td>
                            <td>$fecha</td>
                            <td>
                                <img src='../assets/proyectos/$dato[foto]' class='col-md-4 img-fluid rounded maxim' alt='Imagen del proyecto'>       
                            </td>
                            </tr>";
                        } 
                    echo"</tbody>
                </table>";
        }else{
            echo"<p class='text-center m-auto'>$_GET[nomCamp] no dispone de proyectos</p>";
        }
                  
        echo"</article></section>";
        echo"<section class='container p-5'>
            <form action='../controladores/controlador_campos.php' method='post' class='row border border-success-subtle p-5' enctype='multipart/form-data'>
                <h2 class='text-center'>Modificar campo</h2>
                <div class='row justify-content-center p-3'>
                    <div class='col-md-5'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text' id='basic-addon1'>Nombre</span>
                            <input type='text' class='form-control' name='nomIn' placeholder='Nombre del campo' aria-describedby='basic-addon1' value='$_GET[nomCamp]' required>
                        </div> 
                    </div>       
                    
                    <div class='col-md-5'>
                        <div class='input-group'>
                            <input type='file' class='form-control' id='inArchivs' name='inFls' aria-describedby='inFls' aria-label='Upload'>
                        </div>
                    </div>
                </div>             
                                
                <div class='d-flex justify-content-center p-3'>
                    <button type='submit' class='btn' name='modificarCamp'>Modificar</button>
                </div>   
                <input type='text' hidden name='img' value='$_GET[logC]'>
                <input type='text' hidden name='id' value='$_GET[vercamp]'>
            </form>
        </section>";
    }
