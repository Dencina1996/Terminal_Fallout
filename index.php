<!DOCTYPE html>
<?php include 'codeWare.php';?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="favicon.ico">
		<title>Terminal Fallout 3</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<script type="text/javascript" src="scripts.js"></script>
		<script type="text/javascript">
			setTimeout(function(){ 
				document.getElementsByTagName('html')[0].style.background = "url('staticPage.jpg') no-repeat center center fixed";
				document.getElementsByTagName('html')[0].style.backgroundSize = "cover";
				document.getElementsByTagName('html')[0].style.backgroundColor = "black";
				document.getElementsByTagName('body')[0].style.visibility = "visible";
				 }, 1200);
		</script>
	</head>
	<body>
		<div id="attemptCounter">
			<span>4</span> INTENTO(S) RESTANTES:
				<div class="attemptDiv"></div>
				<div class="attemptDiv"></div>
				<div class="attemptDiv"></div>
				<div class="attemptDiv"></div>
		</div>
		<div id="contentDiv">
			<br>
			<div id="leftHexCol">
				<?php
					$hex = array("0xF91C","0xF928","0xF934","0xF940","0xF94C","0xF958","0xF964","0xF970","0xF97C","0xF988","0xF994","0xF9A0","0xF9AC","0xF9B8","0xF9C4","0xF9D0","0xF9DC","0xF9E8","0xF9F4","0xFA00","0xFA0C","0xFA18","0xFA24","0xFA30","0xFA3C","0xFA48","0xFA54","0xFA60","0xFA6C","0xFA78","0xFA84","0xFA90","0xFA9C","0xFAA8");
					for ($i = 0; $i < 17; $i++) { 
						echo $hex[$i].'<br>';
					}
				?>
			</div>
			<div id="leftSymCol">
				<?php
					$symbols = "!\"#$%&'()*+,-./:;?=>@[\]^_`{|}~";
					$index = 0;
					for ($i = 0; $i < 17; $i++) { 
						for ($x = 0; $x < 12; $x++) { 
							echo $col1[$index];
							$index++;
							//echo '<span class="symbol">'.$symbols[rand(0,30)].'</span>';	
						}
						echo '<br>';
					}
				?>
			</div>
			<div id="rightHexCol">
				<?php
					$hex = array("0xF91C","0xF928","0xF934","0xF940","0xF94C","0xF958","0xF964","0xF970","0xF97C","0xF988","0xF994","0xF9A0","0xF9AC","0xF9B8","0xF9C4","0xF9D0","0xF9DC","0xF9E8","0xF9F4","0xFA00","0xFA0C","0xFA18","0xFA24","0xFA30","0xFA3C","0xFA48","0xFA54","0xFA60","0xFA6C","0xFA78","0xFA84","0xFA90","0xFA9C","0xFAA8");
					for ($i = 17; $i < 34; $i++) { 
						echo $hex[$i].'<br>';
					}
				?>
			</div>
			<div id="rightSymCol">
				<?php
					$symbols = "!\"#$%&'()*+,-./:;?=>@[\]^_`{|}~";
					$index = 0;
					for ($i = 0; $i < 17; $i++) { 
						for ($x = 0; $x < 12; $x++) { 
							echo $col2[$index];
							$index++;
							//echo '<span class="symbol">'.$symbols[rand(0,30)].'</span>';	
						}
						echo '<br>';
					}
				?>
			</div>
		</div>
	</body>
</html>