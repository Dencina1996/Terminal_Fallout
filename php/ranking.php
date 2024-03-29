<!DOCTYPE html>
<html>
<?php session_start();?>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="/img/favicon.ico">
		<title>Terminal Fallout 3 - Ranking</title>
		<link rel="stylesheet" type="text/css" href="../css/menustyle.css">
		<link rel="stylesheet" type="text/css" href="../css/daltonic.css">	
		<script type="text/javascript">
			document.styleSheets[1].disabled = true;
		</script>
		<script type="text/javascript" src="../js/scripts.js"></script>
		<style type="text/css">
			@keyframes zoominout {
			    0% {
			        transform: scale(1,1);
			    }
			    50% {
			        transform: scale(1.1,1.1);
			    }
			    100% {
			        transform: scale(1,1);
			    }
			}
			.userGame {	
				animation: zoominout 1s infinite ease-in-out;
			}
		</style>
		<?php	
		if (isset($_SESSION['colors'])) {
			echo "<link rel='stylesheet' type='text/css' href='../css/".$_SESSION['colors']."'>";
		}
    ?>
	</head>
	<body>
		<img id="audioImg" src="/img/speaker.png" onclick="audioControl('menu')" class="enabled">
		<img id="daltonicImg" src="/img/daltonic_false.png" onclick="daltControl('menu')" class="enabled">
		<audio autoplay loop>
			<source src="/sound/end.mp3"  type="audio/ogg">
		</audio>
		<audio>
			<source src="/sound/sound.mp3" type="audio/mp3">
		</audio>
		<div id="menuImage"></div>
		<div id="rankingEasy" class="rankDiv">
	<?php
		if ($_SESSION['difficulty']==1) {
		$file = file("../txt/recordsEasy.txt");
	}else if($_SESSION['difficulty']==2){
		$file = file("../txt/recordsNormal.txt");
	}else if($_SESSION['difficulty']==3){
		$file = file("../txt/recordsHard.txt");
	}
		$ArrayOfArrayRecords=[];
		for ($i=0; $i < sizeof($file) ; $i++) { 
			$SingleOne=explode(";", $file[$i]);
			$minutos=intval(intval($SingleOne[2])/60);
			$minutosSinSegundos=$minutos*60;
			$segundos=intval($SingleOne[2])-$minutosSinSegundos;
			
			$SingleOne= array('name' => $SingleOne[0],"attempts"=>$SingleOne[1], 'timeMinuts'=>$minutos,'timeSeconds'=>$segundos, "time"=>$SingleOne[2]);
			$ArrayOfArrayRecords[]=$SingleOne;				
		}	
		foreach ($ArrayOfArrayRecords as $clave => $fila) {
			$attempts[$clave] = $fila['attempts'];
			$timeMinuts[$clave] = $fila['timeMinuts'];
			$timeSeconds[$clave] = $fila['timeSeconds'];
		}
		array_multisort($attempts, SORT_ASC, $timeMinuts, SORT_ASC,$timeSeconds, SORT_ASC, $ArrayOfArrayRecords);
		echo "<table><tr><th>Top</th><th>Name</th><th>Attempts</th><th>Time</th></tr>";
		foreach ($ArrayOfArrayRecords as $clave => $fila){
			if ($_SESSION["user"]==$fila['name'] && (int)$_SESSION["attempts"]==(int)$fila['attempts'] && (int)$_SESSION["timeGame"]==(int)$fila['time']){
				echo "<tr class='userGame'>";
			}else{
				echo "<tr>";
			}
			echo "<td>".($clave+1)."</td>";
			echo "<td>".$fila['name']."</td>";
			echo "<td>".$fila['attempts']."</td>";
			if ($fila['timeSeconds']<10){
				$nuevosSegundos="0".$fila['timeSeconds'];
			}else{
				$nuevosSegundos=$fila['timeSeconds'];
			}
			echo "<td>".$fila['timeMinuts'].":".$nuevosSegundos."</td></tr>";
			if ($clave==10) {
				break;	
			}
		}
		echo "</table>";
	?>
	<table id="buttonTable">
		<tr>
			<td><button class="myButton" style="display: contents;" onclick="window.location.href = '/index.php'">GO BACK TO MENU</button></td>
			<td><button class="myButton" style="display: contents;" onclick="window.location.href = '/php/index.php'">PLAY AGAIN</button></td>
		</tr>
	</table>
	</body>
</html>
