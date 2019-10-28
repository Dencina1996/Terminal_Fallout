<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="img/favicon.ico">
		<title>Terminal Fallout 3 - Menu</title>
		<link rel="stylesheet" type="text/css" href="css/menustyle.css">
		<script type="text/javascript" src="js/scripts.js"></script>
	</head>
	<body>

		<?php
			session_start();
			if ( isset($_GET['difficulty']) ) { 
				$_SESSION['difficulty'] = $_GET['difficulty'];
				echo '<script type="text/javascript">','window.location.href ="php/index.php";','</script>';			
			}else {
			$_SESSION['difficulty']=0;
			}
?>
	<div id="menu">
		<div id="menuInit">
				
				<div class="menuclick" onclick="showHideSomething('GameMode')">PLAY</div>		
				
				<div class="menuclick" onclick="showHideSomething('Ranking')">RANKING</div>	
		</div>
		<div id="MenuHidden">
			<div id="GameMode" class="menuH ">
				<ul>
	   				<li><a href="index.php?difficulty=1" onclick="changeTab('php/index.php')">EASY</a></li>
					<li><a href="index.php?difficulty=2" onclick="changeTab('php/index.php')">NORMAL</a></li>
					<li><a href="index.php?difficulty=3" onclick="changeTab('php/index.php')">HARD</a></li>
				</ul>
			</div>

			<div id="Ranking" class="menuH" >
				<ul>
	   				<li><a href="php\rankingEasy.php">RANKING EASY</a></li>
					<li><a href="php\rankingNormal.php">RANKING NORMAL</a></li>
					<li><a href="php\rankingHard.php">RANKING HARD</a></li>
				</ul>
			</div>
		</div>

	</div>


		<script>
	


    $(document).ready(function(){
var difficulty = "<?php echo $_SESSION['difficulty']; ?>";

alert (player);
    });
</script>
</script>
	</body>
</html>
