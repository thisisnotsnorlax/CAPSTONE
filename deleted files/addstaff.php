<?php
include "../connection/config.php";
include "nav.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="../css/style.css">

  <title>Add New Staff</title>
</head>
<body>
  
    <div class="container">



   <?php
    if(isset($_SESSION['errorMessage'])) {

      echo '<span class="message">' . $_SESSION['errorMessage'] .'</span>';
      unset($_SESSION["errorMessage"]);
       
    }
    else if(isset($_SESSION['errorMessage1'])) {
      echo '<span class="message">' . $_SESSION['errorMessage1'] .'</span>';
      unset($_SESSION["errorMessage1"]);
       
    }
    else if(isset($_SESSION['successMessage'])) {
      echo '<span class="message">' . $_SESSION['successMessage'] .'</span>';
      unset($_SESSION["successMessage"]);
      
    }
    


?>
      <h2>Add new staff</h2>

      <div class="form">
      <form action="../connection/adddata.php" method="POST" enctype="multipart/form-data">
      <label for="name">Name:</label>
        <input type="text" name="name" class="form-add-staff" id="name" ><i class="fa-solid fa-user"></i> <br>

        <label for="email">Email:</label>
        <input type="email" name="email" class="form-add-staff" id="email" ><i class="fa-solid fa-envelope"></i><br>

        <label for="mobile">Mobile:</label>
        <input type="text" name="mobile" class="form-add-staff" id="mobile" ><i class="fa-solid fa-phone"></i><br>

        <label for="user_type">User type:</label>
        <select name="user_type" class="form-add-staff"> <br>
          <option disabled selected hidden>choose a user type:</option>
          <option value="user">user</option>
          <option value="admin">admin</option>
        </select> <br>

        <label for="password">Password:</label>
       
        <input type="password" name="password" class="form-add-staff" id="password"> <i class="fa-solid fa-eye-slash" id="eye" onclick="toggle()"></i><br>


        <label for="address">Address:</label>
        <input type="address" name="address" class="form-add-staff" id="address"><i class="fa-solid fa-location-dot"></i><br>


        <label for="file">Photo:</label>
        <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" class="form-add-staff" > <br> 

        <div class="buttons">
          <input type="submit" class="btn-sub-cancel sub">
          <a href="staffs.php" class="btn-sub-cancel cancel">Cancel</a>
        </div>
       
        
      </form>
      </div>
     
    </div>

    <script src="../js/script.js"></script>

</body>
</html>