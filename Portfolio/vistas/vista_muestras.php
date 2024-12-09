<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/styles.css">

    <link rel="icon" href="../assets/logor.png">
    <title>Muestras</title>
</head>
<body>
    <?php        
        require_once("../bd/bd.php");
        require_once("../php/funciones.php");

        echo "<h1 class='text-center'>MUESTRAS</h1>
        <section class='container extra'>
        <article class='row border border-success-subtle p-5 mt-5'>
            <table border='0' class='text-center'>
                <thead class='text-center'>
                    <tr>
                        <th>PROYECTO</th>
                        <th>CAMPO</th>
                        <th>FECHA</th>
                    </tr>
                </thead>
                <tbody>";
                foreach($muestras as $datoM){
                    $fecha=ordenarFecha($datoM["fecha"]);
                    echo"<tr><td>$datoM[proyecto]</td>
                    <td>$datoM[campo]</td>   
                    <td>$fecha</td>   
                    <td>
                        <a href='../controladores/controlador_muestras.php?modificarMp=$datoM[proyecto]&modificarMc=$datoM[campo]'>
                            <button type='button' class='btn btn-warning'>Modificar muestra</button>
                        </a>
                    </td>
                    <td>
                        <a href='../controladores/controlador_muestras.php?eliminarMp=$datoM[proyecto]&eliminarMc=$datoM[campo]'>
                            <button type='button' class='btn btn-danger'>Borrar muestra</button>
                        </a>
                    </td></tr>";
                } 
            echo"</tbody>
            </table>
        </section>";     
     
        echo"<section class='container extra'>
                <form method='post' action='../controladores/controlador_muestras.php' class='row border border-success-subtle justify-content-center p-5'>
                    <h2 class='text-center pb-3'>Insertar muestra</h2>
                    <div class='col-md-5'>
                        <div class='input-group mb-3'>
                        <label class='input-group-text' for='proyecto'>proyecto</label>
                        <select class='form-select' name='proyectoIn' id='proyecto' required>
                            <option selected disabled>Seleccionar una opción...</option>";
                                for($cont=0; $cont<=sizeof($listadoP); $cont++){
                                    $valor=$listadoP[$cont]["nombre"];
                                    $id=$cont+1;
                                    echo"<option value='$id'>$valor</option>";
                                }
                            echo"</select>
                        </div>
                    </div>                    
                    <div class='col-md-5'>
                        <div class='input-group mb-3 col-md-5'>
                        <label class='input-group-text' for='campo'>campo</label>
                        <select class='form-select' name='campoIn' id='campo' required>
                            <option selected disabled>Seleccionar una opción...</option>";
                            for($cont=0; $cont<=sizeof($listadoC); $cont++){
                                $valor=$listadoC[$cont]["nombre"];
                                $id=$cont+1;
                                echo"<option value='$id'>$valor</option>";
                            }
                        echo"</select>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class='input-group mb-3'>
                            <input type='date' class='form-control' aria-describedby='basic-addon1' name='fechaIn' required>
                        </div> 
                    </div>
                    <div class='col-md-12'>
                        <div class='input-group mb-3'>                    
                            <span class='m-auto text-secondary text-center'>Los muestras deben ser únicos.</span> 
                        </div> 
                    </div> 
                    <div class='col-md-12 d-flex justify-content-center'>
                        <button type='submit' class='btn' name='incampoV'>Insertar</button>
                    </div>
                </form>
            </section>";
    ?>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>