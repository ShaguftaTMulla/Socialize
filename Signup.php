<html>
<head>
<title>Socialize</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <header>
    <div class="logo">
        <img class="img" src="media/logo.png" alt="">
    </div>
  </header>
    <main>
        <div class="login-container">
            <h3>Get Ready to Soci@lize</h3>
            <form method="post">
            <div class="user-box">
                <input name="user" type="text" required="required">
                <label>Username</label>
            </div>
            <?php
              if (isset($_POST['submit'])) {
                $username = $_POST['user'];
                $password = $_POST['pass'];
                $con = new mysqli("localhost", "root", "", "Socialize");
                if ($con->connect_error) {
                    echo "connection Failed: " . $con->connect_error;
                } else {
                  $sql = "SELECT * FROM `Login` WHERE `Username` LIKE '%$username%'";

                  $result = $con->query($sql) or die($con->error);
                  if($row = $result->fetch_assoc()) {
                      echo "<div class='error1' style='color:#f00; margin-bottom:12px; display:block;'> Username Exists</div>";
                  } else {
                    
                  $sql1 = "INSERT INTO `Login`(`Username`, `Password`) VALUES ('$username','$password')";
                  setcookie("username", $username);
                  $success = $con->query($sql1) or die($con->error);
                    
                  // $sql2 = "INSERT INTO `profile`(`username`) SELECT `Username` FROM `Login`";
                  $sql2 = "INSERT INTO `profile`(`username`) VALUES ('$username')";
                  $addtable = $con->query($sql2) or die($con->error);

                  $cookiedata = "SELECT * FROM `Login`";
                  setcookie("username", $username);

                  $result5 = $con->query($cookiedata) or die($con->error);
                  if($row = $result5->fetch_assoc()) {
                      setcookie("myId", $row['LoginId']);
                      header("Location: myProfile.php");
                  }
                  }
                }
              }
            ?>
            <div class="user-box">
                <input name="pass" type="password" required="required">
                <label>Password</label>
            </div>
            <div class="user-box">
                <input name="cpass" type="password" required="required">
                <label>Confirm Password</label>
            </div>
            <div class="error"></div>
            <a class="submit" href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <input class="form-submit" value="Sign Up" type="submit" name="submit"></input>
                <a href="signin.html">Already a member? Sign In</a>
            </form>

        </div>
        <script type="text/javascript">
          $(document).ready(function () {
            $('[name="user"]').keyup(function() {
                $(".error1").css("display","none")
              });
            $("[name='pass'], [name='cpass']").keyup(checkPasswordMatch);
          });
          function checkPasswordMatch() {
          
              var pw1 = $('[name="pass"]').val();
              var pw2 = $('[name="cpass"]').val();
              if(pw2 != pw1) {
                  $(".error").html('Passwords do not match');
                  $(".error").css("color","red");
              
              }
              else{
                  $(".error").html("Passwords Match");
                  $(".error").css("color","green");
              }
             
          }
        </script>
    </main>

  <footer>
    <p>Copyright @ UCD Information Systems</p>
  </footer>
</body>
</html>
