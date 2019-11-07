<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="img/favicon.ico">
		<title>Terminal Fallout 3 - Menu</title>
		<link rel="stylesheet" type="text/css" href="css/menustyle.css">
		<link rel="stylesheet" type="text/css" href="css/daltonic.css">
		<script type="text/javascript" src="js/scripts.js"></script>
	</head>
	<body>
		<?php
		
		
		if (isset($_SESSION['colors'])) {
			echo "<link rel='stylesheet' type='text/css' href='css/".$_SESSION['colors']."'>";
		}
        if(isset($_GET["stylescss"])){
           $Filecss=$_GET["stylescss"];
           echo '<script type="text/javascript">document.getElementById("colors").remove();</script>';
           echo "<link id='colors' rel='stylesheet' type='text/css' href='css/".$Filecss."'>";    
             $_SESSION['colors'] = $_GET['stylescss'];	
    }
    ?>
		<img id="audioImg" src="img/speaker.png" onclick="audioControl('menu')" class="enabled">
		<img id="daltonicImg" src="img/daltonic_false.png" onclick="daltControl('menu')" class="enabled">
		<audio autoplay loop>
			<source src="sound/bg_music.mp3"  type="audio/ogg">
		</audio>
		<audio>
			<source src="sound/sound.mp3" type="audio/mp3">
		</audio>
		<?php
			session_start();
			if ( isset($_GET['difficulty']) ) { 
				$_SESSION['difficulty'] = $_GET['difficulty'];				
				if(isset($_GET['extreme'])){
				$_SESSION['extreme']=$_GET['extreme'];				
			}
				echo '<script type="text/javascript">','window.location.href ="php/index.php";','</script>';			
			}else {
			$_SESSION['difficulty']=0;
			}
		?>
		
	<div id="menu" style="visibility: visible;">
		<div id="menuInit">
			<div class="menuclick" onclick="showHideSomething('GameMode'); playAudio()" style="border-bottom: 0;">PLAY</div>		
			<div class="menuclick" onclick="showHideSomething('Ranking'); playAudio()">RANKING</div>
		</div>
		<div id="MenuHidden">
			<div id="GameMode" style="display: none">
				<ul>
					<li>EXTREME
						<form method="POST">
						  <input type="checkbox" id="extreme" name="check" onclick="playAudio()">
						  <label for="extreme"></label>
						</form>
					</li>
	   				<li>
	   					<a href="index.php?difficulty=1" onclick="checkExtreme(this)">EASY</a>
	   				</li>
					<li>
						<a href="index.php?difficulty=2" onclick="checkExtreme(this)">NORMAL</a>
					</li>
					<li style="border-bottom: 2px solid black;">
						<a href="index.php?difficulty=3" onclick="checkExtreme(this)">HARD</a>
					</li>
				</ul>
			</div>
			<div id="Ranking" style="display: none;">
				<ul>
	   				<li>
	   					<label onclick="revealRanks('rankingEasy'); playAudio()">RANKING EASY</label>
	   				</li>
					<li>
						<label onclick="revealRanks('rankingNormal'); playAudio()">RANKING NORMAL</label>
					</li>
					<li style="border-bottom: 2px solid black;">
						<label onclick="revealRanks('rankingHard'); playAudio()">RANKING HARD</label>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- RANKING EASY -->
	<div id="rankingEasy" class="rankDiv" style="visibility: hidden;">
	<button class="myButton" onclick="hideRanks('rankingEasy'); playAudio()">GO BACK</button>
	<?php
		$file = file("txt/recordsEasy.txt");
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
	<!-- END -->
	<!-- RANKING NORMAL -->
	<div id="rankingNormal" class="rankDiv" style="visibility: hidden;">
	<?php
		$file = file("txt/recordsNormal.txt");
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
	<br>
	<button class="myButton" onclick="hideRanks('rankingNormal'); playAudio()">GO BACK</button>
	</div>
	<!-- END -->
	<!-- RANKING HARD -->
	<div id="rankingHard" class="rankDiv" style="visibility: hidden;">
	<?php
		$file = file("txt/recordsHard.txt");
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
	<br>
	<button class="myButton" onclick="hideRanks('rankingHard'); playAudio()">GO BACK</button>
	</div>
	<!-- END -->
	</body>
<script type="text/javascript">
var difficulty = "<?php echo $_SESSION['difficulty'] ?>";
var extreme= "<?php echo $_SESSION['extreme'] ?>";
document.styleSheets[1].disabled = true;
</script>
</html>
