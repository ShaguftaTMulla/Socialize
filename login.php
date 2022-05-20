<?php
    if (isset($_POST['submit'])) {
      $username = $_POST['user'];
      $password = $_POST['pass'];
      $con = new mysqli("localhost", "root", "", "Socialize");
      if ($con->connect_error) {
          echo "connection Failed: " . $con->connect_error;
      } else {
        $sql = "SELECT * FROM `Login` WHERE `Username` LIKE '%$username%' AND `Password` LIKE '%$password%'";
        setcookie("username", $username);

        $result = $con->query($sql) or die($con->error);
        if($row = $result->fetch_assoc()) {
            setcookie("myId", $row['LoginId']);

            header("Location: Home.php");
        } else {
            header("Location: Signin.html");
        }
        $sql1 = "SELECT * FROM `profile` WHERE `Username`='$username'";
        $result = $con->query($sql1) or die($con->error);
        if($row = $result->fetch_assoc()) {
                setcookie("Hobby", $row["Hobbies"]);
                setcookie("name", $row["Name"]);
        }
      }
  }
?>

