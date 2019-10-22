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
				$SingleOne=$file[$i];
				$SingleOne=explode(";", $SingleOne);
				$ArrayOfArrayRecords[$i]=$SingleOne;
				
			}	

			//Ordenar




			//Imprimir Table
			echo "<table><tr><th>Name</th><th>Attemps</th><th>Time</th></tr>";
			for ($k=0; $k <sizeof($ArrayOfArrayRecords) ; $k++) { 

				echo "<tr>";
				for ($p=0; $p <sizeof($ArrayOfArrayRecords[$k]) ; $p++) { 
					echo "<td>".$ArrayOfArrayRecords[$k][$p]."</td>";
				}
				echo "</tr>";
			}
			


		?>
	</body>
</html>
