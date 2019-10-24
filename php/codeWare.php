<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
<?php
	$symbols = "!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
	$file = file("../txt/terminalWords.txt");
	$words = explode(";", strtoupper($file[0]));

	while (sizeof($words) > 6) {
		$index = rand(0, sizeof($words)-1);
		unset($words[$index]);
		$words = array_values($words);
	}

	$memory_dump = array();
	$numbers = array();
	$rows = 17;
	$characters = 12;
	$column_length = $rows * $characters;
	$length_word = strlen($words[0]);
	$symbols2 = "!\"#$%&'(*+,-./:;<=?@[\^_`{|~";
	$lineHasLessThan = false;
	$lineHasOpenKey = false;
	$lineHasOpenSqrBracket = false;
	$lineHasOpenParenthesis = false;
	for ($i=0; $i < $column_length * 2; $i++) {
		$rand = rand(0, strlen($symbols)-1);
		$char = htmlspecialchars($symbols[$rand], ENT_QUOTES);
		if ($char == htmlspecialchars("<") && !$lineHasLessThan) {
			$lineHasLessThan = true;
		} elseif ($char == htmlspecialchars(">") && $lineHasLessThan) {
			$rand = rand(0, strlen($symbols2)-1);
			$char = htmlspecialchars($symbols2[$rand], ENT_QUOTES);
		}

		if ($char == htmlspecialchars("{") && !$lineHasOpenKey) {
			$lineHasOpenKey = true;
		} elseif ($char == htmlspecialchars("}") && $lineHasOpenKey) {
			$rand = rand(0, strlen($symbols2)-1);
			$char = htmlspecialchars($symbols2[$rand], ENT_QUOTES);
		}

		if ($char == htmlspecialchars("[") && !$lineHasOpenSqrBracket) {
			$lineHasOpenSqrBracket = true;
		} elseif ($char == htmlspecialchars("]") && $lineHasOpenSqrBracket) {
			$rand = rand(0, strlen($symbols2)-1);
			$char = htmlspecialchars($symbols2[$rand], ENT_QUOTES);
		}

		if ($char == htmlspecialchars("(") && !$lineHasOpenParenthesis) {
			$lineHasOpenParenthesis = true;
		} elseif ($char == htmlspecialchars(")") && $lineHasOpenParenthesis) {
			$rand = rand(0, strlen($symbols2)-1);
			$char = htmlspecialchars($symbols2[$rand], ENT_QUOTES);
		}

		if ($i == ($characters - 1)) {
			$lineHasLessThan = false;
			$lineHasOpenKey = false;
			$lineHasOpenSqrBracket = false;
			$lineHasOpenParenthesis = false;
		}
		array_push($memory_dump, $char);
		if ($i < ($column_length * 2) - $length_word) {
			if ($i >= $column_length || $i <= ($column_length - $length_word)) {
				array_push($numbers, $i);
			}
		}
	}
	$pos_helps = array();
	$string = array_slice($memory_dump, 0, $column_length * 2);
	$length = sizeof($memory_dump);
	$helps = rand(3, 5);
	$arr_lines = array();
	$num_lines = $rows * 2;
	for ($i=0; $i < $num_lines; $i++) {
		array_push($arr_lines, $i);
	}
	$open = "<{[(";
	$close = ">}])";
	for ($i=0; $i < $helps; $i++) {
		$index = rand(0, sizeof($arr_lines)-1);
		$num_line = $arr_lines[$index];
		$start = rand(0, $characters - 2);
		$end = rand($start+1, $characters - 1);
		$help_length = ($end - $start) + 1;
		if ($start == ($characters - 2)) {
			$end = $characters - 1;
			$help_length = ($end - $start) + 1;
		}
		$pos = 0;
		$start_del = 0;
		$rand_symbol = $open[rand(0, strlen($open)-1)];
		$symbols2 = getSymbols($rand_symbol);
		for ($j = $characters * $num_line; $j < ($characters * $num_line) + $characters; $j++) {
			if ($pos == $start) {
				$span = "";
				$click_option = rand(0, 1);
				if ($click_option == 0) {
					$span = "<span onclick='deleteTrash(this)' class='helps'>";
				} else {
					$span = "<span onclick='resetAttempts(this)' class='helps'>";
				}
				$memory_dump[$j] = html_entity_decode($span).htmlspecialchars($rand_symbol);
				$start_del = $j - $length_word - 1;
			} elseif ($pos == $end) {
				$memory_dump[$j] = htmlspecialchars($close[strpos($open, $rand_symbol)]).html_entity_decode("</span>");
			} else {
				$memory_dump[$j] = htmlspecialchars($symbols2[rand(0, strlen($symbols2) - 1)], ENT_QUOTES);
			}
			$pos += 1;
		}
		for ($j=$start_del; $j < $start_del + 1 + $length_word + $help_length + 2; $j++) {
			array_splice($numbers, array_search($j, $numbers), 1);
		}
		array_splice($arr_lines, array_search($num_line, $arr_lines), 1);
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

		for ($i = 0; $i < $del_positions; $i++) {
			array_splice($numbers, array_search($num+$i, $numbers), 1);
			if (($num+$i) >= $copy && $num_letter < $length_word) {
				if (($num+$i) == $copy) {
					$span = html_entity_decode("<span onclick='checkWord(this)' onmouseover='sendCheck(this)' onmouseleave='cleanCheck()' class='terminalWords'>").$word[$num_letter];
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
	$col1 = array_slice($memory_dump, 0, $column_length);
	$col2 = array_slice($memory_dump, $column_length, $column_length);
	echo "<p hidden id='password'>".$words[rand(0, sizeof($words)-1)]."</p>";

	function getSymbols($symbol) {
		$symb = "!\"#$%&'(*+,-./:;<=?@[\^_`{|~";
	    switch ($symbol) {
	    	case "<":
	    		$symb = "!\"#$%&'(*+,-./:;=?@[\^_`{|~";
	    		break;
				case "{":
		    	$symb = "!\"#$%&'(*+,-./:;<=?@[\^_`|~";
		    	break;
				case "[":
					$symb = "!\"#$%&'(*+,-./:;<=?@\^_`{|~";
					break;
				case "(":
					$symb = "!\"#$%&'*+,-./:;<=?@[\^_`{|~";
					break;
	    }
			return $symb;
	}
?>