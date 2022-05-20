<?php
    if (isset($_POST['submit'])) {
      $username = $_POST['user'];
      $password = $_POST['pass'];
      
      $con = new mysqli("localhost", "root", "", "Socialize");
      if ($con->connect_error) {
          echo "connection Failed: " . $con->connect_error;
      } else {
        $sql = "INSERT INTO `Login`(`Username`, `Password`) VALUES ('$user','$pass')";
        
        $result = $con->query($sql) or die($con->error);
        if($row = $result->fetch_assoc()) {
            header("Location: myProfile.php");
        } else {
            header("Location: Signin.html");
        }
      }
  }
?>