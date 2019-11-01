<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="img/favicon.ico">
		<title>Terminal Fallout 3 - Menu</title>
		<link rel="stylesheet" type="text/css" href="css/menustyle.css">
		<link rel="stylesheet" type="text/css" href="css/min.css">
		<script type="text/javascript" src="js/scripts.js"></script>
	</head>
	<body>
		<img id="audioImg" src="img/speaker.png" onclick="audioControl()" class="enabled">
		<audio autoplay loop>
			<source src="bg_music.mp3"  type="audio/ogg">
		</audio>
		<audio>
			<source src="sound.mp3" type="audio/mp3">
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
		
	<div id="menu">
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
	   				<li><a href="php\rankingEasy.php">RANKING EASY</a></li>
					<li><a href="php\rankingNormal.php">RANKING NORMAL</a></li>
					<li style="border-bottom: 2px solid black;"><a href="php\rankingHard.php">RANKING HARD</a></li>
				</ul>
			</div>
		</div>
	</div>
	</body>
<script type="text/javascript">
var difficulty = "<?php echo $_SESSION['difficulty'] ?>";
var extreme= "<?php echo $_SESSION['extreme'] ?>";
</script>
</html>