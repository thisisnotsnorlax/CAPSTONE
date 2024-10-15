<?php
@require_once "../connection/config.php";





  // STAFF INFO UPDATE/EDIT 
    
    if(isset($_POST['submit-btn'])){
      $id = htmlspecialchars($_POST['id']);
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $mobile = htmlspecialchars($_POST['mobile']);
      $usertype = htmlspecialchars($_POST['user_type']);
      $password = htmlspecialchars($_POST['password']);
      $loc = htmlspecialchars($_POST['address']);

      $image = $_FILES['file']['name'];
      $update_image_tmp_name = $_FILES['file']['tmp_name'];
      $update_image_folder = '../photos/'.$image;
   
   
      $update_query = mysqli_query($conn, "UPDATE `users_tbl` SET name = '$name', email = '$email', mobile = '$mobile', user_type = '$usertype', pw = '$password', loc = '$loc', image = '$image' WHERE id = '$id'");
   
      if($update_query){
         move_uploaded_file($update_image_tmp_name, $update_image_folder);
         echo '<script>alert("Data Updated.");
                   window.location.href = "view.php";
                  </script>';
      }else{
         exit(mysqli_error($conn));
      }
   
   }
   

?>

<?php 
  include "nav.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Add New Staff</title>
</head>
<body>
  
    <div class="container">
      <h2>Edit staff</h2>

      <div class="form">

    <?php 

       if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $query = mysqli_query($conn, "SELECT * FROM `users_tbl` WHERE id = $id");
        if(mysqli_num_rows($query) > 0){
           while($row = mysqli_fetch_assoc($query)){
           
    ?>     
      <form action="edit.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $row['id'] ?>" >
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-add-staff" id="name"  value="<?php echo $row['name']?>"><i class="fa-solid fa-user"></i> <br>

        <label for="email">Email:</label>
        <input type="email" name="email" class="form-add-staff" id="email" value="<?php echo $row['email']?>"><i class="fa-solid fa-envelope"></i><br>

        <label for="mobile">Mobile:</label>
        <input type="text" name="mobile" class="form-add-staff" id="mobile" value="<?php echo $row['mobile']?>"><i class="fa-solid fa-phone"></i><br>

        <label for="user_type">User type:</label>
        <select name="user_type" class="form-add-staff" value = "<?php echo $row['user_type']?>"> <br>
          <option disable selected hidden>Choose a user type:</option>
          <option value="user">user</option>
          <option value="admin">admin</option>
        </select> <br>

        <label for="password">Password:</label>
       
        <input type="password" name="password" class="form-add-staff" id="password" value="<?php echo $row['pw']?>"> <i class="fa-solid fa-eye-slash" id="eye" onclick="toggle()"></i><br>


        <label for="address">Address:</label>
        <input type="address" name="address" class="form-add-staff" id="address" value="<?php echo $row['loc'] ?>"><i class="fa-solid fa-location-dot"></i><br>


       <label for="file">Photo:</label>
        <input type="file" name="file" accept="image/png, image/jpg, image/jpeg" class="form-add-staff" > <br> 

        <div class="buttons">
          <input type="submit" class="btn-sub-cancel sub" name="submit-btn" value="EDIT">
          <a href="staffs.php" class="btn-sub-cancel cancel">Cancel</a>
        </div>
      </form>

    <?php
           }
          }
        }
    ?>  
      </div>
    </div>



    <script src="../js/script.js"></script>
</body>
</html>