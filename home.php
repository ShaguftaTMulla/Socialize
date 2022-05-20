<html>
<head>
<title>Socialize</title>
<link rel="stylesheet" href="style.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
  <header>
    <div class="logo">
        <img class="img" src="media/logo.png" alt="">
    </div>
  </header>
    <main>
        <form action="Signin.html">
            <input class="navigate" type="submit" value="Log Out"></input>
        </form>
        <div class="message-container">
            <form method="post" class="popup">
                <input class="navigate1" type="submit" name="mymessage" value="Messages"></input>
            </form>
        </div>
        <div class="container-fluid main-container">
        <div class="row box-holder">
           
        <?php

use Aws\Crypto\Polyfill\Key;

require 'vendor/autoload.php';

        
        $con = new mysqli("localhost", "root", "", "Socialize");
       
        if ($con->connect_error) {
            echo "connection Failed: " . $con->connect_error;
        } else {
            $myhobby=$_COOKIE["Hobby"];
            $username=$_COOKIE["username"];
            
            $region = 'us-east-2';
            $bucket = 'ucdsocialize';
            $key = 'AKIATXZLCCMDHIY4Q2KP';
            $secret = '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';
            
            $s3 = new Aws\S3\S3Client([
                'version' => 'latest',
                'region' => $region,
                'credentials' => [
                    'key' => $key,
                    'secret' => $secret,
                ],
            ]);
            
            $sql = "SELECT * FROM `profile` WHERE `Hobbies` = '$myhobby' AND `username`!= '$username' ";

            $result = $con->query($sql) or die($con->error);
            while ($row = $result->fetch_assoc()) {
                $prefix=$row['Name']."/";
                $reciever = $row['Name'];
                $objects = $s3->getIterator('ListObjects', [
                    'Bucket' => $bucket,
                    'Prefix' => $prefix
                  ]);
                  $media=[];
                  foreach ($objects as $object) {
                      
                      array_push($media, $object['Key']);
                      
                  };
                  $media=array_splice($media,1);
                $carousel= '<div class="col-lg-3 view-container">
                            <div id="carouselIndicators'.$row['Name'].'" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">';
                    for ($j=0;$j<count($media) ; $j++) {
                        $active1 = $j==0?"active":"";
                        $carousel.='<li data-target="#carouselIndicators" data-slide-to="'.$j.'" class="'.$active1.'"></li> ';
                    }
                    $carousel.= '</ol><div class="carousel-inner">';
                    for ($i=0;$i<count($media) ; $i++) {
                        $active = $i==0?"active":"";
                        $carousel.= '<div class="carousel-item '.$active.'">
                                        <img class="d-block" src="https://ucdsocialize.s3.us-east-2.amazonaws.com/'.$media[$i].'" alt="First slide">
                                    </div>';
                    }
                    $carousel.='</div>
                      <a class="carousel-control-prev" href="#carouselIndicators'.$row['Name'].'" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselIndicators'.$row['Name'].'" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a></div>';

                    $carousel.='<div class="attr-container">
                           <div class="profile-label"> Name:  </div>
                           <div class= "profile-value">'
                           .$row['Name'].
                           '</div>
                        </div>
                        <div class="attr-container">
                        <div class="profile-label"> Hobby:  </div>
                        <div class=" profile-value">'
                            .$row['Hobbies'].
                            '</div> 
                        </div>
                        <div class="attr-container">
                        <div class="profile-label"> Location:  </div>
                        <div class=" profile-value">'
                            .$row['Location'].
                            ' </div>
                        </div>  
                        <div class="attr-container">
                        <div class="profile-label"> Instagram:  </div>
                        <div class=" profile-value">'
                            .$row['InstaHand'].
                            '  </div>
                        </div>
                        <input type="submit" name="message" class="button btn-success message-button" value="Message" onclick="openForm()"/>
                    </div>';
                    echo $carousel;
            } 
        }
        if(isset($_POST['sendmessage'])) {
            $message = $_POST['message'];
            $sender = $_POST['sender'];
            $reciever = $_POST['reciever'];
            
            $value1= "SELECT LoginId FROM `Login` WHERE `Username`='$sender'";
            $value2 = "SELECT ProfileId FROM `profile` WHERE `Name`='$reciever'";
            $result1 = $con->query($value1);
            $result2 = $con->query($value2);
            if($row = $result1->fetch_assoc()) {
                $sendervar = $row['LoginId'];
                
            }
            if($row1 = $result2->fetch_assoc()) {
                $recvar = (int)$row1['ProfileId'];
            }
            $sql = "INSERT INTO `Message`(`SenderId`,`RecieverId`,`Message`) VALUES('$sendervar','$recvar','$message') ";

            $result = $con->query($sql) or die($con->error);
        }
         if(isset($_POST['mymessage'])) {
            $msg=" <div class='message-box' id='myForm'>
            <button type='button' class='close close-msg' aria-label='Close' onclick='closeMessages()'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <h3 class='d-flex justify-content-center'>My Messages</h3>";
            $myid= $_COOKIE["myId"];
            $sql1= "SELECT * FROM `Message`, `profile`
                    WHERE `Message`.`SenderId` = `profile`.`ProfileId`
                    AND `Message`.`RecieverId` ='$myid'";
            // echo $myid;
            $result = $con->query($sql1) or die($con->error);
            while($row = $result->fetch_assoc()) {
                $msg.= '<div class="my-messages d-flex justify-content-center">
                        <div class="Sendername">From: '.$row['Name'].'</div>
                        <div class="message">Message: '.$row['Message'].'</div>
                    </div>';
            }
            $msg.="</div>";
             echo $msg;
        }
    ?>
    
    <script>
        var mysql = require('mysql');
        function openForm() {
            $(".message-block").removeClass("hidden");
            $(".main-container").addClass("openform");
        }
        function closeForm() {
            $(".message-block").addClass("hidden");
            $(".main-container").removeClass("openform");
        }
        function openMessages(){
            $(".message-box").removeClass("hidden");
            $(".close-msg").removeClass("hidden");
        }
        function closeMessages(){
            $(".message-box").addClass("hidden");
            $(".close-msg").addClass("hidden");
        }

        </script>
        </div>
        </div>
        <div class="message-block hidden" id="myForm">
            <button type="button" class="close" aria-label="Close" onclick="closeForm()">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="center">Send a message</h3>

            <form method="POST" class="form-popup">
                <textarea id="message" name="message" rows="4" cols="50"></textarea>
                <input type="submit" name="sendmessage" class="button btn-success" value="Send Message" />
                <input type="hidden" name="reciever" value="<?php echo $reciever; ?>">
                <input type="hidden" name="sender" value="<?php echo $username; ?>">
            </form>
        </div>

       
        
    </main>

  <footer>
    <p>Copyright @ UCD Information Systems</p>
  </footer>
</body>

</div>
</html>
