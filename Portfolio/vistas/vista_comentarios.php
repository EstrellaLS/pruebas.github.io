<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/styles.css">

    <link rel="icon" href="../assets/logor.png">
    <title>Comentarios</title>
</head>
<body>
    <?php        
        require_once("../bd/bd.php");
        require_once("../modelos/modelo_comentarios.php");
        require_once("../php/funciones.php");

        echo "<h1 class='text-center'>COMENTARIOS</h1>";
        echo"<section class='container extra'>"; 
            echo"<article class='row border border-success-subtle p-5 mt-5'>
                <table border='0' class='text-center'>
                    <thead>
                        <tr>
                            <th>SOCIO</th>
                            <th>PROYECTO</th>
                            <th>FECHA</th>
                            <th>COMENTARIO</th>
                            <th>ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach($datos as $dato){
                            $fecha=ordenarFecha($dato["fecha"]);
                            echo"<tr><td>$dato[socio]</td>
                            <td>$dato[proyecto]</td>
                            <td>$fecha</td>
                            <td>$dato[texto]</td>
                            <td>
                                <a href='../controladores/controlador_comentarios.php?borrarC=true&idSoc=$dato[idSoc]&idPro=$dato[idPro]&fec=$dato[fecha]'>
                                    <button type='button' class='btn btn-danger'>Borrar comentario</button>
                                </a>
                            </td></tr>";
                        } 
                    echo"</tbody>
                </table>
            </article></section>";   

    ?>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>