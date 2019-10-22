<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="img/favicon.ico">
		<title>Terminal Fallout 3</title>
		<link rel="stylesheet" type="text/css" href="../css/menustyle.css">
		
	</head>
	<body>
		<div>
		<?php

			$file = file("../txt/records.txt");
			$ArrayOfArrayRecords=[];
			for ($i=0; $i < sizeof($file) ; $i++) { 
				$SingleOne=explode(";", $file[$i]);
				$minutos=intval(intval($SingleOne[2])/60);
				$minutosSinSegundos=$minutos*60;
				$segundos=intval($SingleOne[2])-$minutosSinSegundos;
				
				$SingleOne= array('name' => $SingleOne[0],"attemps"=>$SingleOne[1], 'timeMinuts'=>$minutos,'timeSeconds'=>$segundos);
				$ArrayOfArrayRecords[]=$SingleOne;
				
			}	

			//Ordenar
			foreach ($ArrayOfArrayRecords as $clave => $fila) {
    			$attemps[$clave] = $fila['attemps'];
    			$timeMinuts[$clave] = $fila['timeMinuts'];
    			$timeSeconds[$clave] = $fila['timeSeconds'];
			}

			// Ordenar los datos con volumen descendiente, edición ascendiente
			// Agregar $datos como el último parámetro, para ordenar por la clave común
			array_multisort($attemps, SORT_ASC, $timeMinuts, SORT_ASC,$timeSeconds, SORT_ASC, $ArrayOfArrayRecords);



			//Imprimir Table
			echo "<table><tr><th>Name</th><th>Attemps</th><th>Time</th></tr>";
			foreach ($ArrayOfArrayRecords as $clave => $fila){
				echo "<tr><td>".$fila['name']."</td>";
				echo "<td>".$fila['attemps']."</td>";
				if ($fila['timeSeconds']<10){
					$nuevosSegundos="0".$fila['timeSeconds'];
				}else{
					$nuevosSegundos=$fila['timeSeconds'];
				}
				echo "<td>".$fila['timeMinuts'].":".$nuevosSegundos."</td></tr>";
			}


		?>
	</body>
</html>
