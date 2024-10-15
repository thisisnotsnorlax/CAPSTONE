<?php
session_start();
require_once("../connection/config.php");

$loggedInadminId = $_SESSION['admin_id'];

if (!isset($loggedInadminId)) {
    echo "admin id  is not set";
}



if (isset($_POST['submit'])) {
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $loc = htmlspecialchars($_POST['loc']);
    $utype = htmlspecialchars($_POST['utype']);
    $dept = htmlspecialchars($_POST['dept']);
    $city = htmlspecialchars($_POST['city']);
    $image = $_FILES['image']['name'];
    $update_image_tmp_name = $_FILES['image']['tmp_name'];
    $update_image_folder = '../photos/' . $image;

    $_SESSION['admin_name'] = $name;


    if (empty($name) || empty($email) || empty($mobile) || empty($loc) || empty($image) || empty($utype) || empty($dept) || empty($city))
    {
        $_SESSION['emptyMessage1'] = "Empty fields are not allowed";
    } 
    else
    {

        // Update the users info into the database
        $update_query = mysqli_query($conn, "UPDATE `users_tbl` SET name = '$name', email = '$email', mobile = '$mobile',  loc = '$loc', image = '$image', city = '$city', 
        dept_name = '$dept', user_type = '$utype' WHERE id = '$id'");

        if ($update_query) {
            move_uploaded_file($update_image_tmp_name, $update_image_folder);

            echo '<script>alert("Data Updated."); 
            window.location.href = "profileadmin.php";</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
body { 
    background-image: var(--bg-color);
    background-size: cover;
    background-attachment: fixed;
    height: 90vh;
}

.profile-image { 
    border-radius: 100%;
    border: 2px solid black;
}

.custom-bg-color { 
    background-color: #F6F5F2;
}

.custom-card-height {
  height: 750px;
}

.custom-edit-profile {
 
  color: #c2c2c2;
}

.list-group-item-action { 
    background-color: #FBF9F1;
}

.active { 
    background-color: #FBF9F1;
}

.custom-accounts-info {
  color: #c2c2c2;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  text-align: center;
}
th {
  background-color: #1B4242;
  color: #fff;
  padding: 50px 50px;
}
td, th {
  text-align: left;
  padding: 8px;
  text-align: center;
}

th { 

  text-align: center;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

.message{
  border-radius: 5px;
  display: block;
  background-color: #102C57;
  padding: 2px 3px;
  font-size: 1rem;
  color:#fff;
  font-weight: 100;
}




:root{
  --bg-color:  linear-gradient(rgba(50,50,50,0.75),rgba(40,40,40,0.75)), url(../photos/plant2.jpg);
  --secondary-color: #172621;
  --1-color:#5C8374;
  --2-color:#1B4242;
  --mode-color:#fff;
  --nav-color:  #74512D;
  --sidenav-color:#3B593F;
  --add-color:#3B593F;
  --addhover-color:#1A4D2E;
  --container-color:#172621;
  --card-color:#3B593F;
  --outline-color:  #4F6F52;
  --font-color: #F5EFE6;
  --bgside-color:#fff;
  --span-color:#4F6F52;

}
.white-theme{
  --bg-color: url(../photos/plant2.jpg);
  --secondary-color: #4F6F52;
  --1-color:#AFC8AD;
  --2-color:#4F6F52;
  --mode-color:#000;
  --nav-color: #1A4D2E;
  --sidenav-color:#B5C18E;
  --add-color:#7ABA78;
  --addhover-color: #0A6847;
  --container-color:#4F6F52;
  --card-color: #EADBC8;
  --outline-color:  #F1F1F1;
  --font-color: #4F6F52;
  --bgside-color:#000;
  --span-color:#7ABA78;

}

</style>

<body>
    <div class="container light-style flex-grow-1 container-p-y ">
        <h4 class="font-weight-bold py-3 mb-4">
            Admin's Account settings
        </h4>
        <div class="card overflow-hidden custom-bg-color custom-card-height">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action custom-edit-profile active" data-toggle="tab" href="#account-general">Edit Profile</a>
                        <a class="list-group-item list-group-item-action custom-accounts-info" data-toggle="tab" href="#account-info">Accounts Info</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <!-- FORM-->
                            <form action="profileadmin.php" enctype="multipart/form-data" method="post">
                                <?php
                                if (isset($_SESSION['emptyMessage1'])) {
                                    echo '<div class="message">'.$_SESSION['emptyMessage1'].'</div>';
                                    unset($_SESSION['emptyMessage1']);
                                }
                                $query = mysqli_query($conn, "SELECT * FROM `users_tbl` WHERE id = $loggedInadminId");
                                if (mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <div class="card-body media align-items-center">
                                    <img src="../photos/<?php echo $row['image'] ?>" alt class="profile-image" width="250px">
                                    <div class="media-body ml-4">
                                        <label class="btn btn-outline-secondary">
                                            New photo
                                            <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" id="file">
                                        </label> &nbsp;
                                        
                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" value="<?php echo $row['id'] ?>" name="id">

                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" value="<?php echo $row['name'] ?>" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" value="<?php echo $row['email'] ?>" name="email">
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="dept" value="<?php echo $row['dept_name']; ?>">

                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="mobile" value="<?php echo $row['mobile']?>">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="loc" value="<?php echo $row['loc']?>">
                                        <input type="hidden" class="form-control" name="utype" value="<?php echo $row['user_type']?>">

                                        <input type="hidden" class="form-control" name="city" value="<?php echo $row['city']?>">

                                    </div>
                                    
                                    </div>
                                </div>
                                     
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <input type="submit" id="saveButton" name="submit" class="btn btn-primary" value="Save">
                            <a href="dashboard.php" class="btn btn-default" id="cancelButton" >Cancel</a>
                        </div>
                        <!-- FORM-->
                    </form>

                        <!-- INFO PAGE -->
    
                        <div class="tab-pane fade" id="account-info">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                <table>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Department</th>
                                    <th>Mobile</th>
                                    <th>User Type</th>
                                    <th>Address</th>
                                    <!--<th>City</th>-->
                                </tr>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><img src="../photos/<?php echo $row['image']; ?>" alt="image" width="100px"></td>
                                    <td><?php echo $row['dept_name']; ?></td>
                                    <td><?php echo $row['mobile']; ?></td>
                                    <td><?php echo $row['user_type']; ?></td>
                                    <td><?php echo $row['loc']; ?></td>
                                   <!-- <td><?php # echo $row['city']; ?></td>-->
                                </tr>
                                </table>
                            </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                       
                     
                </div>
            </div>
        </div>
    </div>

  <!--  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script> -->

    
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.account-settings-links a').click(function(e) {
                e.preventDefault();
                var target = $(this).attr('href');
                $('.tab-pane').removeClass('active show');
                $(target).addClass('active show');
                $('.account-settings-links a').removeClass('active');
                $(this).addClass('active');

                    // Show/hide buttons based on the active tab
                if (target === '#account-info') {
                        $('#saveButton, #cancelButton').hide();
                    } else {
                        $('#saveButton, #cancelButton').show();
                    }
            
                });
        });
            


        var icon = document.getElementById("icon");

if (localStorage.getItem("theme") === "dark") {
  document.body.classList.add("dark-theme");
  icon.src = "fa-regular fa-lightbulb"; 
} else {
  document.body.classList.add("white-theme");
  icon.src = "fa-solid fa-lightbulb";
}

icon.onclick = function() {
  if (document.body.classList.contains("white-theme")) {
    document.body.classList.remove("white-theme");
    document.body.classList.add("dark-theme");
    icon.src = "fa-regular fa-lightbulb";
    localStorage.setItem("theme", "dark");
  } else {
    document.body.classList.remove("dark-theme");
    document.body.classList.add("white-theme");
    icon.src = "ffa-solid fa-lightbulb";
    localStorage.setItem("theme", "light");
  }
};
    </script>
</body>
</html>
