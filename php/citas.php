<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css">
    <link rel="icon" href="../assets/icono.png">
    
    <title>Citas</title>
    <script src="https://kit.fontawesome.com/f1a9439f03.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
		<?php
			require_once("./funciones.php");
			$conexion=conectar();
			
			$usuario=comprobar_usuario();
			pintarHeader($usuario);

			if($usuario==0){			
				echo"<h1>CITAS</h1><br>
				<h2>Insertar cita</h2>";
				$consulta="SELECT id,nombre FROM clientes WHERE id!=0";        
				$sentencia=$conexion->query($consulta);

				echo"<form action='#' method='POST' id='formulario'>
				Fecha: <input type='date' name='fecha'>
				Hora: <input type='time' name='hora'>
				Motivo: <input type='text' name='motivo' placeholder='motivo'>
				Lugar: <input type='text' name='lugar' placeholder='lugar'>
					<select><option value=0> Elige un comprador...</option>";
					while($fila = $sentencia->fetch_array())
					{
						echo "<option value='$fila[id]'>$fila[nombre]</option>";
					}
					echo "</select>";
				echo "<input type='submit' name='enviarVenta'>";
				echo "</form>";
				}

				/* //Calendario:
				$dia=date("d");
				$mes=date("m");
				$anio=date("Y");
	
				setlocale(LC_ALL,"es-ES.UTF-8");
				$fecha=mktime(0,0,0,$mes,$dia,$anio);
				$Nmes=ucfirst(strftime("%B",$fecha));
				
				$diasS=['Lunes','Martes','Miercoles','Jueves','Viernes','Sábado','Domingo'];
				$meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
				$diasM=[31,28,31,30,31,30,31,31,30,31,30,31];
	
				if(checkdate($mes,$dia,$anio)){
					$celda=1;					
	
					echo"<table border><tr><th colspan='7'>$Nmes</th></tr><tr>";
					foreach($diasS as $valor){
						echo"<th class='sinFondo'>$valor</th>";
					}
					echo"</tr><tr>";
					for($i=1; $i<$celda; $i++){
						echo"<td>holaaaa</td>";
					}
					echo"</tr></table>";
				}else{
					echo"Datos mal introducidos.-->$dia,$mes,$anio";
				}

				$celda=1;
				$calend=0;				
				
				echo"<table border><tr><td>";
				echo"<table border>";
				echo"<tr><th colspan='7'>$meses[$mes]</th></tr>";
				echo"<tr><th class='sinFondo'>Lunes</th><th class='sinFondo'>Martes</th><th class='sinFondo'>Miercoles</th><th class='sinFondo'>Jueves</th><th class='sinFondo'>Viernes</th><th class='sinFondo'>Sábaho</th><th class='sinFondo'>homingo</th></tr>";
				for($i=1; $i<$celda; $i++){
					echo"<td>ho</td>";
				}
				for($dia=1; $dia<=$diasM[$mes]; $dia++){
					echo"<td>$dia</td>";
					$celda++;
					if($celda==8){
						echo"</tr><tr>";
						$celda=1;
					}
				}
				echo"</tr></table>";
				$calend++;
				if($calend%4==0 && $calend!=12){
					echo"</td><td>";
				}
				if($calend==12){
					echo"</td>";
				}
				echo"</td></tr></table>"; */
			pintarFooter();        
		?>
	</main>
</body>
</html>