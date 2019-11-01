<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="/img/favicon.ico">
		<title>Terminal Fallout 3 - Ranking</title>
		<link rel="stylesheet" type="text/css" href="../css/menustyle.css">	
	</head>
	<body>
		<div id="rankingEasy">
		<?php
			$file = file("../txt/recordsEasy.txt");
			$ArrayOfArrayRecords=[];
			for ($i=0; $i < sizeof($file) ; $i++) { 
				$SingleOne=explode(";", $file[$i]);
				$minutos=intval(intval($SingleOne[2])/60);
				$minutosSinSegundos=$minutos*60;
				$segundos=intval($SingleOne[2])-$minutosSinSegundos;
				
				$SingleOne= array('name' => $SingleOne[0],"attempts"=>$SingleOne[1], 'timeMinuts'=>$minutos,'timeSeconds'=>$segundos);
				$ArrayOfArrayRecords[]=$SingleOne;				
			}	
			foreach ($ArrayOfArrayRecords as $clave => $fila) {
    			$attempts[$clave] = $fila['attempts'];
    			$timeMinuts[$clave] = $fila['timeMinuts'];
    			$timeSeconds[$clave] = $fila['timeSeconds'];
			}
			array_multisort($attempts, SORT_ASC, $timeMinuts, SORT_ASC,$timeSeconds, SORT_ASC, $ArrayOfArrayRecords);
			echo "<table><tr><th>Name</th><th>Attempts</th><th>Time</th></tr>";
			foreach ($ArrayOfArrayRecords as $clave => $fila){
				echo "<tr><td>".$fila['name']."</td>";
				echo "<td>".$fila['attempts']."</td>";
				if ($fila['timeSeconds']<10){
					$nuevosSegundos="0".$fila['timeSeconds'];
				}else{
					$nuevosSegundos=$fila['timeSeconds'];
				}
				echo "<td>".$fila['timeMinuts'].":".$nuevosSegundos."</td></tr>";
			}
		?>
		</div>
	</body>
</html>
