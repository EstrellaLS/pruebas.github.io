
    <?php       
        echo"<section class='container extra'>
        <article class='row p-5' style='border:none'>";
            foreach($proyectoBD as $dato){
                echo "<h1 class='text-center'>$dato[nom]</h1>
                <div class='d-flex'>
                    <img src='../assets/proyectos/$dato[img]' class='col-md-4 img-fluid rounded maxim'>       
                    <div class='col-md-10 px-5 d-flex flex-column align-items-center justify-content-center'>
                        <p>$dato[desc]</p>";

                        //Comentar proyecto
                        if($usuario>0){                          
                            echo"<form action='../controladores/controlador_proyecto_completo.php?verProyecto=$_GET[verProyecto]' method='post' class='row row-cols-lg-auto g-3 pt-3 align-items-center formComent'>             
                                <div class='col-12'>
                                    <div class='input-group'>
                                        <input type='date' class='form-control' id='fecha' name='feCom' required>
                                    </div>
                                </div>  
            
                                <div class='col-12'>
                                    <div class='form-floating'>
                                        <textarea class='form-control' id='comentario' name='comentao' placeholder='Hacer el comentario...' required></textarea>
                                    </div>
                                </div>
                                
                                <div class='col-12'>";
                                    if(!$puede){
                                        echo"<button type='submit' class='btn' name='enviar' disabled>Realizar comentario</button>";
                                    }else{
                                        echo"<button type='submit' class='btn' name='enviar'>Realizar comentario</button>";
                                    }
                                    
                                echo"</div>   
                                
                                <input type='text' hidden name='puede' value='$puede'>                 
                            </form>";
                        }
                    echo "</div>
                </div>";
            } 
        echo"</article></section>";
        
        //Modificar proyecto o mostrar comentarios
        if($usuario==0){
            foreach($proyectoBD as $dato){
                echo"<section class='container p-5'>
                    <form action='../controladores/controlador_proyectos.php' method='post' class='row border border-success-subtle p-5' enctype='multipart/form-data'>
                        <h2 class='text-center'>Modificar proyecto</h2>
                        <div class='row justify-content-center p-3'>
                            <div class='col-md-5'>
                                <div class='input-group mb-3'>
                                    <span class='input-group-text' id='basic-addon1'>Nombre</span>
                                    <input type='text' class='form-control' name='nomIn' placeholder='Nombre de la proyecto' aria-describedby='basic-addon1' value='$dato[nom]' required>
                                </div> 
                            </div>       
                            
                            <div class='col-md-5'>
                                <div class='input-group'>
                                    <input type='file' class='form-control' id='inArchivs' name='inFls' aria-describedby='inFls' aria-label='Upload'>
                                </div>
                            </div>
                        </div>
                        
                        <div class='row justify-content-center'>
                            <div class='col-md-11 form-floating'>
                                <textarea class='form-control' id='comentario' name='descIn' value='$dato[desc]' required>$dato[desc]</textarea>
                            </div>
                        </div>                
                                        
                        <div class='d-flex justify-content-center p-3'>
                            <button type='submit' class='btn' name='modificarPry'>Modificar</button>
                        </div>   
                        <input type='text' hidden name='img' value='$dato[img]'>
                        <input type='text' hidden name='id' value='$_GET[verProyecto]'>
                    </form>
                </section>";
            }
        }elseif($usuario>0){
            if($comentariosBD!=null){
                echo"<section class='container extra'>
                <article class='row border border-success-subtle p-5 mt-5'>
                    <table border='0' class='text-center'>
                        <thead>
                            <tr>
                                <th>SOCIO</th>
                                <th>FECHA</th>
                                <th>COMENTARIO</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody>";                            
                            foreach($comentariosBD as $dato){
                                $fecha=ordenarFecha($dato["fecha"]);
                                echo"<tr><td>$dato[socio]</td>
                                <td>$fecha</td>
                                <td>$dato[texto]</td>
                                <td>
                                    <a href='../controladores/controlador_comentarios.php?borrarC=true&idSoc=$usuario&idPro=$_GET[verProyecto]&fec=$dato[fecha]'>";
                                        if($dato["idSoc"]==$usuario){
                                            echo"<button type='button' class='btn btn-danger'>Borrar comentario</button>";
                                        }
                                    echo"</a>
                                </td></tr>";
                                } 
                        echo"</tbody>
                    </table>
                </article>"; 
            }else{
                echo "<p class='py-4 text-center'>No hay comentarios de esta proyecto.</p>";
            }
        } 
    ?> 