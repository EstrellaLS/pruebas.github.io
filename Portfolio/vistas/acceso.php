<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/styles.css">

    <link rel="icon" href="../assets/logor.png">
    <title>Acceso</title>
    
    <style>  
        body{
            background-image: url(../assets/login.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
    <main>
        <section id='login' class="container p-5">
            <h1 class='text-white text-center'>Iniciar sesión</h1>
            <?php
                //Formulario de acceso
                echo"<form action='../controladores/controlador_acceso.php' class='text-white' method='post'>
                    <div class='mb-3'>
                        <label for='nick' class='form-label'>Nombre:</label>
                        <input type='text' class='form-control' id='nick' name='nick' placeholder='Nick...' required>
                    </div>
                    <div class='mb-3'>
                      <label for='pss' class='form-label'>Contraseña</label>
                      <input type='password' class='form-control' id='pss' name='pss' required>
                    </div>
                    <div class='mb-3 form-check'>
                      <input type='checkbox' class='form-check-input' id='mantenerSess' name='mantS'>
                      <label class='form-check-label' for='mantenerSess'>Mantener sesión iniciada</label>
                    </div>
                    <div class='row justify-content-center'>
                        <div class='col-md-5 p-3 d-flex justify-content-center'>
                            <button type='submit' class='btn px-5' name='enviar'>Acceder</button>
                        </div>
                        <div class='col-md-5 p-3 d-flex justify-content-center'>
                            <a class='text-decoration-none' href='../index.php'>
                                <button type='button' class='btn px-5'>No estoy registrado</button>
                            </a>
                        </div>
                    </div>
                </form>";
            ?>
        </section>
    </main>
</body>
</html>