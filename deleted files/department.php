<?php
session_start();
require_once "../connection/config.php";


if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $dept = htmlspecialchars($_POST['dept']);
  
  // check if set
  if(!isset($dept)){
    echo 'error';
    exit();
  }

  // check if the text box is empty
  if(empty($dept)) {
    $_SESSION['emptyMessage'] = 'Empty Field Is not Allowed.';
    
  }
  else 
  {
    // check kung existing yung department
    $check_query = mysqli_prepare($conn, "SELECT COUNT(*) FROM `department_tbl` WHERE dept_name = ?");
    mysqli_stmt_bind_param($check_query, 's', $dept);
    mysqli_stmt_execute($check_query);
    mysqli_stmt_bind_result($check_query, $count);
    mysqli_stmt_fetch($check_query);
    mysqli_stmt_close($check_query);

    if($count > 0){
        $_SESSION['errorMessage2'] = 'This Email Already Exists.';
         }
    else { 
           $insert_dept = mysqli_prepare($conn, "INSERT INTO `department_tbl`(dept_name) VALUES (?)");
           mysqli_stmt_bind_param($insert_dept, 's', $dept );
    
        if(mysqli_stmt_execute($insert_dept)){
          
              $_SESSION['insertedMess'] = "Department Added Successfully";
              
            }
        else{
              echo 'error';
            }
     }
  }

  }
  




?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css ">
    <title>Dashboard</title>
</head>
<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');



*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body{
    background: #9EC8B9 ;
    min-height: 100vh;

}

h1{
    font-size: 3em;
    font-weight: bold;
    margin-bottom: 0.5em;
    text-align: center;
  
}
h2{
    font-size: 1.4rem;
    color: #ccc3c3;
    margin-bottom: 0.5em;
    margin-right: 60vh;
    text-align: center;
}
h3{
    font-size: 1rem;
    color: #092635;
    margin-bottom: 0.5em;
    text-align: center;
}

h4{
  font-size: 1.5rem;
  color: #fff;
  font-weight: bold;
  margin-bottom: 0.5em;
  text-align: center;
}



.btn {
    display: inline-block;
    padding: 10px 40px;
    border-radius: 5px;
    background-color: #4CAF50;
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #3e8e41;
}

.side-menu{
    position: fixed;
    background: #092635;
    width: 20vw;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
.side-menu .brand-name{
    height: 10vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
    flex: 0.2;
    padding: 0;
    margin: 0;
}

.side-menu li{
    font-size: 1.2rem;
    color: #fff;
    font-weight: 400;
    flex: 0.2;
    padding: 10px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #ffffff;
}

.side-menu li:last-child
 {
    border-bottom: none;
 } 
.side-menu li:hover{
    background: #9EC8B9 ;
    color: #000;
    cursor: pointer;
}
.side-menu  li a {
    color: #fff;
    text-decoration: none;
    display: flex;
    margin-left: 20px;
    align-items: center;
  }
  
  .side-menu  li i {
    font-size: 20px;
    margin-right: 10px;
  }

.container{
    position: absolute;
    right: 0;
    width: 80vw;
    height: 100vh;

}

.container .header{
 position: fixed;
 top: 0;
 right: 0;
 width: 80vw;
 height: 8vh;
 background: #1B4242;
 display: flex;
 align-items: center;
 justify-content: center;
 box-shadow: rgb(0, 0, 0);

}


.container .header .nav{
    width: 90%;
    display: flex;
    align-items: center;
}
.container .header .nav  .search{
    flex: 3;
    display: flex;
    justify-content: center;
  
}

.container .header .nav  .search button{
    width: 40px;
    height: 40px;
    border: none;
}



.container .header .nav .search input[type="text"]{
    border: none; 
    padding: 10px;
    width: 50%;
    text-align: center;
}


.container .header .nav .user{
    justify-content: space-between;
    display: flex;
    align-items: center;
    flex: 1;
}

.container .header .nav .user img{
    width: 40px;
    height: 40px;
}
.container .header .nav .user .image-case{
    position: relative;
    width: 50px;
    height: 50px;
}

.container .header .nav .user .image-case img{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}


.container .content{
    position: relative;
    margin-top: 10vh;
    min-height: 90vh;
}

.container .content .cards{
    padding: 25px 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
.container .content .cards .card{
    flex: 0 1 calc(30% - 1em);
    width: 250px;
    height: 180px;
    margin: 1em;
    background-color: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}
.container .content .cards  .icon-case {
    background-color: #5C8374;
    color: #fff;
    text-align: center;
    width: 100%;
    padding: 8em;
    border-radius: 0 0 5px 5px;
  }
  
  /* dept */

  .row {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
}


.col-50 {
  -ms-flex: 50%;
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%;
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container1 {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
  height: 400px;
  width: 90%;
  margin: 10rem auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.container1 .dept { 
  font-size: 2rem;
  text-align: left;
  color: #322C2B;
  padding: 40px 30px;
}

input[type="text"] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}


.btn1 {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  margin-left: 78%;
  border: none;
  width: 20%;
  border-radius: 5px;
  cursor: pointer;
  font-size: 17px;
}

.btn1:hover {
  background-color: #45a049;
}

.message{
  border-radius: 5px;
  display: block;
  background-color: #102C57;
  padding: 2px 3px;
  font-size: 1rem;
  color:#fff;
  font-weight: 300;
}

.profile-img {
  border-radius: 100%;
}


/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}


</style>
<body>
    <div class="side-menu">
        <div class="brand-name">
            <h4>EMS DASHBOARD</h4>

        </div>
        <hr>
        <ul>
            <li><a href="dashboard.php"><i class="fa-solid fa-chart-line"></i></a>Dashboard</li>
            <li><a href="department.php"><i class="fa-solid fa-building-user"></i></a>Department</li>
            <li><a href="staffs.php"><i class="fa-solid fa-clipboard-user"></i></a>Staff</li>
            <li><a href="report.php"><i class="fa-regular fa-pen-to-square"></i></a>report</li>
            <li><a href="#"><i class="fa-solid fa-calendar-days"></i></a>Events</li>
            <li><a href="#"><i class="fa-solid fa-message"></i></i></a>Leave  Request</li>
            <li><a href="login.php "><i class="fa-solid fa-right-from-bracket"></i></a>Log out</li>
     
        
       
        </ul>
    </div>

    <div class="container">
        <div class="header">
            <div class="nav">
            
                <div class="search">

                <h2>Ritetrack Enviro Services, Inc. EMS</h2>
                </div>
           
              

                <div class="user">
                    <a href="dept_list.php" class="btn">List</a>
                 
                    <div class="image-case">

                        <?php
                       $loggedInUserId= $_SESSION['admin_id'];

                        $query = "SELECT * FROM users_tbl";
                        $result = $conn->query($query);
                        if(!$result) {
                          die($conn->error);
                        }
                        while ($row = $result->fetch_assoc()) {
                            // Assuming you have a variable $loggedInUserId that stores the ID of the currently logged-in user
                            if ($row['id'] == $loggedInUserId) {
                                ?>
                       <a href="#"> <img src="../photos/<?php echo $row['image']; ?>" height="70"; width="70"; class="profile-img"></a>
                       <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    
        <!-- dept -->
        <div class="row">
  <div class="col-75">
  
    <div class="container1">
    <h1 class="dept">Departments</h1>

       <?php 
        if(isset($_SESSION['insertedMess'])){
            echo '<div class="message">'.$_SESSION['insertedMess'] .'</div>';
            unset($_SESSION['insertedMess']);
        }

        if(isset($_SESSION['errorMessage2'])){
          echo '<div class="message">'.$_SESSION['errorMessage2'] .'</div>';
          unset($_SESSION['errorMessage2']);
        }
        
        if(isset($_SESSION['emptyMessage'])){
          echo '<div class="message">'.$_SESSION['emptyMessage'] .'</div>';
          unset($_SESSION['emptyMessage']);
        }

       ?>
                       
      <form action="" method="post">

        <div class="row">
          <div class="col-50">
            <h3>Add Department</h3>
            <label for="dept"><i class="fa-solid fa-building"></i> New Department</label>
            <input type="text" id="dept" name="dept" placeholder="ex. Backend developer">
        </div>
        <input type="submit" name="submit" value="Submit" class="btn1">
      </form>
    </div>
  </div>





</body>
</html>