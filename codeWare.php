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
				$columns = 17;
				$characters = 12;
				$column_length = $columns * $characters;
				$sizeof_words = sizeof($words);

				for ($i=0; $i < $column_length * 2; $i++) {
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
					if ($i < ($column_length * 2) - $sizeof_words) {
						array_push($numbers, $i);
					}
				}

				$num_word = 0;
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
				$col1 = array_slice($memory_dump, 0, $column_length);
				$col2 = array_slice($memory_dump, $column_length, $column_length);

				//$result = implode($memory_dump);
				//echo "<p style='color:white'>".$result."</p>";
				// Guardamos la contraseña en un párrafo oculto (eligimos una de las 6 palabras aleatoriamente)
				echo "<p hidden id='password'>".$words[rand(0, sizeof($words)-1)]."</p>";
?>
