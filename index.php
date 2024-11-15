<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/styles.css">
    <link rel="icon" href="./assets/icono.png">

    <title>Inmobiliaria</title>
    <script src="https://kit.fontawesome.com/f1a9439f03.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <?php
            require_once("./php/funciones.php");
            $conexion=conectar();
            
            $usuario=comprobar_usuario();
            pintarHeader_index($usuario);

            
            
            pintarFooter();
        ?>
    </main>
</body>
</html>