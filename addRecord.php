<?php
  receiveAndWrite();

  function receiveAndWrite() {
		if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["username"])) {
      $file = "records.txt";
      $result = file_put_contents($file, $_POST["username"].";".$_POST["attemptsUsr"].";".$_POST["time"]."\n", FILE_APPEND | LOCK_EX);
      if ($result !== false) {
        echo "<script>alert('Récord guardado correctamente!');</script>";
      }
		}
	}
?>
