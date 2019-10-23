<?php
  receiveAndWrite();
  function receiveAndWrite() {
		if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["username"]) and $_POST["username"]!="") {
      $file = "../txt/records.txt";
      $result = file_put_contents($file, $_POST["username"].";".$_POST["attemptsUsr"].";".$_POST["time"]."\n", FILE_APPEND | LOCK_EX);
      if ($result !== false) {
        echo "<script>alert('Record saved  successfully!');</script>";
        echo "<script>location.href = '../index.html';</script>";
      }
		}else{
      echo "<script>alert('Goodbye!');</script>";
      echo "<script>location.href = '../index.html';</script>";
    }

	}
?>