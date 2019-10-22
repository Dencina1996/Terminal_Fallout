<!DOCTYPE html>
<?php include 'codeWare.php';?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../img/favicon.ico">
		<title>Terminal Fallout 3</title>
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
		<link rel="stylesheet" type="text/css" href="../css/linesBackground.css">
		<script type="text/javascript" src="../js/scripts.js"></script>
		<script type="text/javascript">
			setTimeout(function(){
				document.getElementsByTagName('html')[0].style.background = "url('')";
				document.getElementsByTagName('html')[0].style.backgroundSize = "";
				document.getElementsByTagName('html')[0].style.backgroundColor = "";
				document.getElementsByTagName('body')[0].style.visibility = "visible";
				startTimer();
				 }, 1200);


		</script>
	</head>
	<body>
		<div id="gameTimer">
			<label id="minLabel"></label>:<label id="secLabel"></label>
		</div>
		<div id="TerminalImage"></div>

      	<div id="screen">
        	<div id="layer"></div>
        	<div id="overlay"></div>
      	</div>

		<div id="generalContainer" class="crt">
			<div id="attemptCounter">
				<p>ROBCO INDUSTRIES (TM) TERMLINK PROTOCOL</p>
				<span id="attempts">4</span> ATTEMPT(S) LEFT:
					<div class="attemptDiv"></div>
					<div class="attemptDiv"></div>
					<div class="attemptDiv"></div>
					<div class="attemptDiv"></div>
		</div>
		<div id="contentDiv">
			<br>
			<div id="leftHexCol" class="thinColumn">
				<?php
					$hex = array("0xF91C","0xF928","0xF934","0xF940","0xF94C","0xF958","0xF964","0xF970","0xF97C","0xF988","0xF994","0xF9A0","0xF9AC","0xF9B8","0xF9C4","0xF9D0","0xF9DC","0xF9E8","0xF9F4","0xFA00","0xFA0C","0xFA18","0xFA24","0xFA30","0xFA3C","0xFA48","0xFA54","0xFA60","0xFA6C","0xFA78","0xFA84","0xFA90","0xFA9C","0xFAA8");
					for ($i = 0; $i < 17; $i++) {
						echo $hex[$i].'<br>';
					}
				?>
			</div>
			<div id="leftSymCol" class="thickColumn">
				<?php
					$symbols = "!\"#$%&'()*+,-./:;?=>@[\]^_`{|}~";
					$index = 0;
					for ($i = 0; $i < 17; $i++) {
						for ($x = 0; $x < 12; $x++) {
							echo $col1[$index];
							$index++;
						}
						echo '<br>';
					}
				?>
			</div>
			<div id="rightHexCol" class="thinColumn">
				<?php
					$hex = array("0xF91C","0xF928","0xF934","0xF940","0xF94C","0xF958","0xF964","0xF970","0xF97C","0xF988","0xF994","0xF9A0","0xF9AC","0xF9B8","0xF9C4","0xF9D0","0xF9DC","0xF9E8","0xF9F4","0xFA00","0xFA0C","0xFA18","0xFA24","0xFA30","0xFA3C","0xFA48","0xFA54","0xFA60","0xFA6C","0xFA78","0xFA84","0xFA90","0xFA9C","0xFAA8");
					for ($i = 17; $i < 34; $i++) {
						echo $hex[$i].'<br>';
					}
				?>
			</div>
			<div id="rightSymCol" class="thickColumn">
				<?php
					$symbols = "!\"#$%&'()*+,-./:;?=>@[\]^_`{|}~";
					$index = 0;
					for ($i = 0; $i < 17; $i++) {
						for ($x = 0; $x < 12; $x++) {
							echo $col2[$index];
							$index++;
						}
						echo '<br>';
					}
				?>
			</div>
			<div id="rightCheckCol">
				<div id="rightCheckColScrollUp">
					<div id="rightCheckColText"></div>
					<div id="promptWrite">
						<span id="check"></span>
					</div>
				</div>
			</div>

		</div>
		</div>
		<form hidden method="post" id="form" action="addRecord.php">
	    <input type="text" id="username" name="username"/>
			<input type="text" id="attemptsUsr" name="attemptsUsr"/>
			<input type="text" id="time" name="time">
	    <input type="submit" id="save" name="save" value="send"/>
		</form>
	</body>
</html>
