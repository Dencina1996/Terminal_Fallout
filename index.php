<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="img/favicon.ico">
		<title>Terminal Fallout 3 - Menu</title>
		<link rel="stylesheet" type="text/css" href="css/menustyle.css">
	</head>
	<body>
	<div id="menu">
		<div id="menuInit">
				
				<div class="menuclick" onclick="showHideSomething('GameMode')">PLAY</div>		
				
				<div class="menuclick" onclick="showHideSomething('Ranking')">RANKING</div>	
		</div>
		<div id="MenuHidden">
			<div id="GameMode" class="menuH ">
				<ul>
	   				<li><a href="php\index.php">EASY</a></li>
					<li><a href="php\index.php">NORMAL</a></li>
					<li><a href="php\index.php">HARD</a></li>
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
	function showHideSomething(div) {
		
  		var x = document.getElementById(div);
  		if (x.style.display === "none") {
  			var one=document.getElementsByClassName('menuH')[0];
			one.style.display="none";
			var two=document.getElementsByClassName('menuH')[1];
			two.style.display="none";
   			x.style.display = "block";
  		} else {
    		x.style.display = "none";
  		}
	}
</script>
	</body>
</html>
