<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css">
    <link rel="icon" href="../assets/icono.png">
    
    <title>Contacta</title>
    <script src="https://kit.fontawesome.com/f1a9439f03.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        require_once("./funciones.php");
        $conexion=conectar();
        
        $usuario=comprobar_usuario();
        pintarHeader($usuario);
        
        echo"<main>
            <div id='subir'>		
                <a href='#cabecera'><i class='fa-solid fa-caret-up'></i></a>	
            </div>
            <div id='formulario'>
                <h2 class='texto'>Contacta y comparte!</h2>
                <form action=''>
                <label class='texto' for='nameUsuario'>Indica tu nombre:</label>
                <input class='b' id='nameUsuario' name='nameUsuario'  type='text' pattern='[A-Z][A-Z|a-zñ]+' minlength='3' maxlength='20' placeholder='Mi Nombre' required> 
                <br>
                <label class='texto' for='fecha'>Fecha de nacimiento:</label>
                <input id='fecha' type='date' min='1900-01-01' max='2003-01-01' name='fecha' required>
                </label>
                <br>
                <label class='texto' for='archivo'>Subir archivo:</label>
                <input id='archivo' name='archivo' type='file'>
                <br>
                <label class='texto' for='correoUsuario'>E-mail:</label>
                <input class='b' id='correoUsuario' name='correoUsuario'  type='correo' placeholder='Escriba aquí su email' pattern='[A-Z|a-z]+@+.' required> 
                <br>
                <label class='texto' name='tlf' for='tlf'>Teléfono:</label>
                <input class='b' type='text' name='tlf' placeholder='Escriba aquí su telefono' id='tlf' minlength='9' maxlength='9' pattern='[6|7][0-9]{0,9}'>
                <br>
                <fieldset>
                    <legend class='texto'>¿Cuál es tu sección favorita?:</legend>
                    <input type='radio' name='r' id='principal' checked>
                    <label for='principal'>Principal</label>
                    <input type='radio' name='r' id='Noticias'>
                    <label for='Noticias'>Noticias</label>
                    <input type='radio' name='r' id='Inmuebles'>
                    <label for='Inmuebles'>Inmuebles</label>
                </fieldset>
                <br>
                <label class='texto' name='satisfaccion' for='satisfaccion'>Puntúanos (0-10):</label>
                <br>
                <input name='satisfaccion' id='satisfaccion' type='range' min='0' max='10'>
                <br>
                <label class='texto' for='cuentanos'>Cuéntanos algo sobre tu o tus preferencias:</label>
                <br>
                <textarea name='cuentanos' id='cuentanos' cols='20' rows='10'></textarea>
                <br>
                <button class='texto' type='submit'>Enviar</button>
                <br>
                <input name='condiciones' type='checkbox' required> Acepto los terminos y condiciones de uso.
            </div>
        </main>";
        
        pintarFooter();
    ?>
</body>
</html>