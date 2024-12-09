<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/styles.css">

    <link rel="icon" href="../assets/logor.png">
    <title>Socio</title>
</head>
<body>
    <?php 
        foreach($socioBD as $dato){
            echo"<section class='container p-5'>
                <form action='../controladores/controlador_socios.php?idSocM=$_GET[verSoc]' method='post' class='row border border-success-subtle p-5' enctype='multipart/form-data'>
                    <h2 class='text-center'>Modificar socio</h2>
                    <div class='row justify-content-center p-3'>
                        <div class='col-md-4'>
                            <div class='input-group mb-3'>
                                <span class='input-group-text' id='basic-addon1'>Nombre</span>
                                <input type='text' class='form-control' name='nomIn' placeholder='Nombre del socio' aria-describedby='basic-addon1' value='$dato[nom]' required>
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <div class='input-group mb-3'>
                                <span class='input-group-text' id='basic-addon1'>Nick</span>
                                <input type='text' class='form-control' name='nickIn' placeholder='Nick del socio' aria-describedby='basic-addon1' value='$dato[nick]' required>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='input-group mb-3'>
                                <span class='input-group-text' id='basic-addon1'>Contraseña</span>
                                <input type='text' class='form-control' name='pssIn' placeholder='Contraseña del socio' aria-describedby='basic-addon1'>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='input-group mb-3'>                    
                                <span class='input-group-text' id='basic-addon1'>Repetir contraseña</span>  
                                <input type='text' class='form-control' name='pssIn2' placeholder='Contraseña del socio' aria-describedby='basic-addon1'>
                            </div> 
                        </div>    
                        <div class='col-md-12'>
                            <div class='input-group mb-3'>                    
                                <span class='m-auto text-secondary'>Si existe algún error al introducir los datos nuevos, no se modificarán. Se mantendrán los anteriores.</span> 
                            </div> 
                        </div>       
                    </div>               
                                    
                    <div class='d-flex justify-content-center p-3'>
                        <button type='submit' class='btn w-50' name='modificarSoc'>Modificar</button>
                    </div>   
                </form>
            </section>";
        }

    ?>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>