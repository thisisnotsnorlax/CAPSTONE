<?php 
session_start();
@include("../connection/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = htmlspecialchars($_POST['email']);
  $pwd = htmlspecialchars($_POST['password']);
  $type = htmlspecialchars($_POST['usertype']);

  

if(empty($pwd) && (empty($email)))
{
  echo'  <script>
              alert("Insert EMAIL/PASSWORD");
              window.location.href = "../php/login.php";
          </script> ';
}
elseif(empty($_POST['password']))
{
  echo'  <script>
              alert("Insert PASSWORD");
              window.location.href = "../php/login.php";
          </script> ';
}
elseif(empty($email))
{
  echo'  <script>
              alert("Insert EMAIL");
              window.location.href = "../php/login.php";
         </script> ';
}



$select_users = mysqli_query($conn, "SELECT * FROM `users_tbl` WHERE email = '$email' AND pw = '$pwd' AND user_type = '$type'") or die(mysqli_error($conn));
if(mysqli_num_rows($select_users) > 0){
   
   $row = mysqli_fetch_assoc($select_users);

   if($row['user_type'] == 'admin'){

      $_SESSION['admin_name'] = $row['name'];
      $_SESSION['admin_email'] = $row['email'];
      $_SESSION['admin_id'] = $row['id'];
      $_SESSION['admin_profile'] = $row['image'];
      echo'  <script>
                    alert("you are signing in as ' . $email . '");
                    window.location.href = "../php/dashboard.php";
             </script> ';
   }elseif($row['user_type'] == 'user'){

      $_SESSION['user_name'] = $row['name'];
      $_SESSION['user_email'] = $row['email'];
      $_SESSION['users_id'] = $row['id'];
      $_SESSION['user_profile'] = $row['image'];

      echo'  <script>
                    alert("you are signing in as ' . $email . '");
                    window.location.href = "../php/userdashboard.php";
            </script> ';

   }else{
    echo'  <script>
            alert("No USER Found" );
            window.location.href = "../php/login.php";
          </script> ';
   }

}else{
    echo'  <script>
                alert("Incorrect Email/Password or User Type" );
                window.location.href = "../php/login.php";
            </script> ';
}

 


}



