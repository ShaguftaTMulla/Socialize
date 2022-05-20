<?php
            if(isset($_POST['submit'])){

                $name = $_POST['name'];
                $hobby = $_POST['category'];
                $insta = $_POST['insta'];
                $loc = $_POST['loc'];
                $showoff = "https://ucdsocialize.s3.us-east-2.amazonaws.com/".$name."/";
                $username=$_COOKIE["username"];
                $con = new mysqli("localhost", "root", "", "Socialize");
                $sql = "UPDATE `profile` SET `Name` = '$name', `Hobbies` = '$hobby',`location`='$loc',`InstaHand`='$insta' WHERE `username`='$username' ";
    
                $result = $con->query($sql) or die($con->error);
                setcookie("Hobby", $hobby);
                setcookie("name", $name);
            
            for ($x = 0; $x < count($_FILES['image']['name']); $x++) {               
              
                $file_name = $_FILES['image']['name'][$x];   
                $temp_file = $_FILES['image']['tmp_name'][$x]; 

                require 'vendor/autoload.php';

                $s3Client = new Aws\S3\S3Client([
                    'region'  => 'us-east-2',
                    'version' => 'latest',
                    'credentials' => [
                      'key'    => "AKIATXZLCCMDHIY4Q2KP",
                      'secret' => "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",
                    ]
              ]);		

              $result = $s3Client->putObject([
                'Bucket' => 'ucdsocialize',
                'Key'    => $name.'/'.$file_name,
                'SourceFile' => $temp_file			
              ]);
            }
            
            header("Location: home.php");
            }
            ?>
            