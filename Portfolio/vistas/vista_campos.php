
<?php    
    echo "<h1 class='text-center'>CAMPOS</h1>
    <section class='container p-5'>
        <form  action='../controladores/controlador_campos.php' method='post' class='row border border-success-subtle p-5'>
            <h2 class='text-center'>Buscar campo</h2>
            <div class='d-flex flex-nowrap justify-content-evenly p-3'>
                <div class='col-md-7'>
                    <div class='input-group mb-3'>
                        <span class='input-group-text' id='basic-addon1'>Nombre</span>
                        <input type='text' name='busq' class='form-control' placeholder='Nombre, letra o fragmento' aria-describedby='basic-addon1'>
                    </div> 
                </div>                   
                            
                <div>
                    <button type='submit' class='btn' name='buscar'>Buscar</button>
                </div>  
            </div>
            <div class='d-flex justify-content-center'>
                <ul>";                
                    if($buscado){
                            foreach($encontrados as $b){
                                echo"<li class='text-center fs-4' style='list-style:none'>$b[nom]</li>";
                            } 
                    }
                echo"</ul>
            </div>
        </form>";
    echo"</section>
    <section class='container p-5'>
    <article class='row p-5 justify-content-center border border-success-subtle'>
    <h2 class='text-center pb-5'>Todos ls campos</h2>";       
    foreach($listadoCamp as $dato){
        echo"<div class='col-md-4 p-3'>                    
            <a href='../controladores/controlador_campos.php?vercamp=$dato[id]&nomCamp=$dato[nombre]&logC=$dato[logotipo]' class='text-decoration-none text-reset d-flex flex-column align-items-center'>
                <img src='../assets/campos/$dato[logotipo]' class='col-md-4 img-fluid rounded maxim' alt='Logo de la campo'>
                <p>$dato[nombre]</p>
            </a>
        </div>";
        }  
    echo"</article></section>";

    if($usuario==0){
        echo "<section class='container p-5'>
            <form action='../controladores/controlador_campos.php' method='post' class='row border border-success-subtle p-5'  enctype='multipart/form-data'>
                <h2 class='text-center'>Insertar campo nuevo</h2>
                <div class='row justify-content-center p-3'>
                    <div class='col-md-5'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text' id='basic-addon1'>Nombre</span>
                            <input type='text' class='form-control' name='nomIn' placeholder='Nombre del campo' aria-describedby='basic-addon1' required>
                        </div> 
                    </div>       
                    
                    <div class='col-md-5'>
                        <div class='input-group'>
                            <input type='file' class='form-control' id='inArchivs' name='inFls' aria-describedby='inFls' aria-label='Upload'>
                        </div>
                    </div>    
                </div>              
                                
                <div class='d-flex justify-content-center p-3'>
                    <button type='submit' class='btn' name='incamp'>Insertar campo</button>
                </div>   
            </form>
        </section>";    
    }
?>    