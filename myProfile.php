<html>
<head>
<title>Socialize</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
  <header>
    <div class="logo">
        <img class="img" src="media/logo.png" alt="">
    </div>
  </header>
    <main>
        <div class="profile-container">
            <h3>My Profile</h3>
            <form method="POST" action="uploadFile.php" enctype="multipart/form-data">

            <div class="profile-box">
                <label>Name</label>
                <input name="name" type="text" required="required">
            </div>

            <div class="profile-box">
              <label for="category">Hobby Category:</label>
              <select name="category" id="category">
                <option value="singing">Singing</option>
                <option value="dancing">Dancing</option>
                <option value="painting">Painting</option>
                <option value="photgraphy">Photography</option>
                <option value="cooking">Cooking</option>
                <option value="reading">Reading</option>
              </select>
            </div>
            <div class="profile-boxs image">
                <label for="file_name">Filename:</label>
                <input type="file" name="image[]" id="upload_image" multiple />
                <div class="note"><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</div>
            </div>
            <div class="profile-box">
              <label for="location">Location:</label>
              <script type="text/javascript">
                $(document).ready(function(){
                  fetch('http://api.ipstack.com/2a02:8084:d001:ef80:80bc:1d8:3400:1db3?access_key=488d7efac441205df3725c9b580314d0').then(function (response) {
                    return response.json();
                  }).then(function (location) {
                var location=location.city;
                $("#location").val(location);
                })
                })
                  </script>
              <input name="loc" id="location" readonly></input>
              
            </div>
            <div class="profile-box">
                <label>Instagram Handle</label>
                <input name="insta" type="text">
            </div>
            <a class="submit" href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            <input class="form-submit" value="Save" type="submit" name="submit"></input>
            </form>
            
        </div>
    </main>

  <footer>
    <p>Copyright @ UCD Information Systems</p>
  </footer>
</body>
</html>
