<?php  
  session_start();
  receiveAndWrite();
  function receiveAndWrite() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["username"]) and $_POST["username"]!="") {
    $_SESSION['session_username'] = $_POST["username"];
    if ($_SESSION['difficulty']==1) {
        $file = "../txt/recordsEasy.txt";        
    }else if ($_SESSION['difficulty']==2) {
        $file = "../txt/recordsNormal.txt";       
    }else if ($_SESSION['difficulty']==3) {
        $file = "../txt/recordsHard.txt";     
    }
    $content=$_POST["username"].";".$_POST["attemptsUsr"].";".$_POST["time"]."\n";
    $_SESSION['user']=$_POST["username"];
    $_SESSION['attempts']=$_POST["attemptsUsr"];
    $_SESSION['timeGame']=$_POST["time"];
    $result = file_put_contents($file ,$content , FILE_APPEND | LOCK_EX);
      if ($result !== false) {
        echo "<script>alert('Record saved successfully!');</script>";
        echo "<script>location.href = 'ranking.php';</script>";
      }
    }else{
      echo "<script>alert('Goodbye!');</script>";
      echo "<script>location.href = '../index.php';</script>";
    }
  }
?>