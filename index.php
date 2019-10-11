<!DOCTYPE html>
<html>
<head>
	<title>Terminal Fallout 3</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div class="BackgroundImage" alt=""></div>
		
	<div class="BodyReal">dfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdsdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswwdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdsdswdfdswdfdswswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfddfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfdswdfds
	</div>
		<?php
				$symbols = "!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
				$file = file("palabrasTerminal.txt");
				$words = explode(";", $file[0]);
				while (sizeof($words) > 6) {
					$index = rand(0, sizeof($words)-1);
					unset($words[$index]);
					$words = array_values($words);
				}
				
				$memory = array();
				$numbers = array();
				for ($i=0; $i < 162; $i++) {
					$rand = rand(0, strlen($symbols)-1);
					$char = $symbols[$rand];
					array_push($memory, $char);
					if ($i < 157) {
						array_push($numbers, $i);
					}
				}
					
				$num_word = 0;
				$sizeof_words = sizeof($words);
				while ($num_word < $sizeof_words) {
					$word = $words[$num_word];
					$length_word = strlen($word);
					$index = rand(0, sizeof($numbers)-1);
					$del_positions = strlen($words[0])+$length_word;
					$num = $numbers[$index];
					$copy = $num;
					if ($num > 4) {
						$del_positions += $length_word + 2;
						$num = ($num - $length_word) - 1;
					} else {
						$del_positions += $num + 1;
						$num = 0;
					}
					
					$num_letter = 0;
					for ($i=0; $i < $del_positions; $i++) {
						array_splice($numbers, array_search($num+$i, $numbers), 1);
						if (($num+$i) >= $copy && $num_letter < $length_word) {
							$memory[$num+$i] = $word[$num_letter];
							$num_letter += 1;
						}
					}
					$num_word += 1;
				}
				// Mostramos el resultado en un párrafo (Para hacer pruebas!)
				// htmlspecialchars() con el párametro ENT_QUOTES, convierte las comillas dobles y las simples
				$result = htmlspecialchars(implode($memory), ENT_QUOTES);
				//echo "<p style='color:white'>".$result."</p>";
		?>
	</body>
</html>
