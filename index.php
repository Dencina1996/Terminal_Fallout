<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Terminal Fallout 3</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		<div>
			<div id="col1">
				Bringing unlocked me an striking ye perceive. Mr by wound hours oh happy. Me in resolution pianoforte continuing we. Most my no spot felt by no. He he in forfeited furniture sweetness he arranging. Me tedious so to behaved written account ferrars moments. Too objection for elsewhere her preferred allowance her. Marianne shutters mr steepest to me. Up mr ignorant produced distance although is sociable blessing. Ham whom call all lain like.

				Oh he decisively impression attachment friendship so if everything. Whose her enjoy chief new young. Felicity if ye required likewise so doubtful. On so attention necessary at by provision otherwise existence direction. Unpleasing up announcing unpleasant themselves oh do on. Way advantage age led listening belonging supposing.
			</div>
			<div id="col2">
				Bringing unlocked me an striking ye perceive. Mr by wound hours oh happy. Me in resolution pianoforte continuing we. Most my no spot felt by no. He he in forfeited furniture sweetness he arranging. Me tedious so to behaved written account ferrars moments. Too objection for elsewhere her preferred allowance her. Marianne shutters mr steepest to me. Up mr ignorant produced distance although is sociable blessing. Ham whom call all lain like.

				Oh he decisively impression attachment friendship so if everything. Whose her enjoy chief new young. Felicity if ye required likewise so doubtful. On so attention necessary at by provision otherwise existence direction. Unpleasing up announcing unpleasant themselves oh do on. Way advantage age led listening belonging supposing.
			</div>
		</div>
		<script type="text/javascript" src="scripts.js"></script>
		<?php
				$symbols = "!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
				$file = file("palabrasTerminal.txt");
				$words = explode(";", strtoupper($file[0]));
				while (sizeof($words) > 6) {
					$index = rand(0, sizeof($words)-1);
					unset($words[$index]);
					$words = array_values($words);
				}

				$memory_dump = array();
				$numbers = array();
				for ($i=0; $i < 384; $i++) {
					$rand = rand(0, strlen($symbols)-1);
					// htmlspecialchars() con el párametro ENT_QUOTES, convierte todos los caracteres especiales (además de las comillas dobles y las simples)
					$char = htmlspecialchars($symbols[$rand], ENT_QUOTES);
					if ($i > 0) {
						if (($char == "!") && ($memory_dump[$i-1] == "<")) {
							$rand = rand(1, strlen($symbols)-1);
							$char = htmlspecialchars($symbols[$rand], ENT_QUOTES);
						}
					}

					array_push($memory_dump, $char);
					if ($i < 379) {
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
							if (($num+$i) == $copy) {
								$span = html_entity_decode("<span onclick='checkWord(\"".$word."\")' class='terminalWords'>").$word[$num_letter];
								$memory_dump[$num+$i] = $span;
							} elseif ($num_letter == ($length_word - 1)) {
								$memory_dump[$num+$i] = $word[$num_letter].html_entity_decode("</span>");
							} else {
								$memory_dump[$num+$i] = $word[$num_letter];
							}
							$num_letter += 1;
						}
					}
					$num_word += 1;
				}
				// Mostramos el resultado en un párrafo (Para hacer pruebas!)
				$result = implode($memory_dump);
				echo "<p style='color:white'>".$result."</p>";
				// Guardamos la contraseña en un párrafo oculto (eligimos una de las 6 palabras aleatoriamente)
				echo "<p hidden id='password'>".$words[rand(0, sizeof($words)-1)]."</p>";
		?>
	</body>
</html>
