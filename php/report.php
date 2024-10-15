<?php
session_start();
require_once "../connection/config.php";

$username = $_SESSION['user_name'];

if(!$username) 
{
 echo 'the name is not valid or set';
}




$user_id = $_SESSION['users_id'];

$sql = "SELECT * FROM users_tbl WHERE id = $user_id";

$result = $conn->query($sql);

if($result->num_rows > 0) { 
    $row = $result->fetch_assoc();

    $name = $row['name'];
    $dept = $row['dept_name'];
}






if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = htmlspecialchars($_POST['name']);
    $department = htmlspecialchars($_POST['department']);
    $report_type = htmlspecialchars($_POST['report-type']);
    $date = htmlspecialchars($_POST['date']);
    $report_body = htmlspecialchars($_POST['report-body']);

    $file = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $file_folder = '../photos/' . $file;

    if (empty($name) || empty($department) || empty($report_type) || empty($date) || empty($report_body)) {
        $_SESSION['emptyField'] = 'Empty Field Is not Allowed.';
    } else {
        if ($_FILES['file']['error'] === 0) {
            if (move_uploaded_file($file_tmp_name, $file_folder)) {
                $sql = mysqli_prepare($conn, "INSERT INTO reports_tbl (name, dept_name, date, report_type, report, file) VALUES (?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($sql, 'ssssss', $name, $department, $date, $report_type, $report_body, $file);
                if (mysqli_stmt_execute($sql)) {
                    $_SESSION['insertedMess'] = "Your Report Sent";
                } else {
                    echo mysqli_error($conn);
                }
            } else {
                echo "Error moving uploaded file.";
            }
        } else {
            echo "Error uploading file.";
        }
    }
}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css ">
    <title>Report</title>
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
    background-image: var(--bg-color);
    background-size: cover;

}

h1{
    font-size: 3em;
    font-weight: bold;
    margin-bottom: 0.5em;
    text-align: center;
    color: var(--font-color);
  
}
h2{
    margin-right: 45%;
    font-size: 1.4rem;
    color: #fff;
    margin-bottom: 0.1rem;
    align-items: center;
}
h3{
     font-size: 1rem;
    color: var(--font-color);
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

h4 span { 
  color:   var(--span-color);
}




.side-menu{
    position: fixed;
    background: var(--secondary-color) ;
    width: 20vw;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    box-shadow: 3px 3px 6px var(--outline-color);
   transition: background-color 0.3s ease;
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

.side-menu li:last-child {
    border-bottom: none;
} 

.side-menu li:hover{
    background: var(--sidenav-color) ; ;
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
 background: var(--secondary-color);
 display: flex;
 align-items: center;
 justify-content: center;
 box-shadow: 3px 3px 6px var(--outline-color);
 transition: background-color 0.3s ease;
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

.btn {
    margin-right: 2%;
    display: inline-block;
    padding: 5px 50px;
    border-radius: 5px;
    background-color:   var(--add-color);
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    transition: background-color 0.3s ease;
}
  
.btn:hover {
    background-color: var(--addhover-color);
}



/*report form*/
form {
  width: 700px;
  height: 550px;
  margin-top: 8rem;
  margin-left: 15rem;
  padding: 20px;
  border: 1px solid #ccc;
  box-shadow: 3px 3px 6px var(--nav-color),
  2px 2px 4px  var(--nav-color)inset;
  transition: background-color 0.3s ease;
  background-color: #f2f2f2;

}

form label {
  font-weight: bold;
}

form input[type="text"], form input[type="date"] {
  width: 100%;
  height: 40px;
  padding: 10px;
  font-size: 16px;
  border-radius: 5px;
}

form select {
  width: 100%;
  height: 40px;
  padding: 10px;
  font-size: 16px;
  border-radius: 5px;
}

form textarea {
  width: 100%;
  height: 100px;
  padding: 10px;
  font-size: 16px;
  border-radius: 5px;
}

form button[type="submit"] {
  background-color: var(--add-color);
  color: #fff;
  padding: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

form button[type="submit"]:hover {
  background-color:  var(--addhover-color);
}


.profile-img{
  border-radius: 100%;
  height: 50px;
  width: 50px;
  border: 3px solid var(--span-color)
  
} 

/*message */

.message{
  border-radius: 5px;
  display: block;
  background-color: #102C57;
  padding: 2px 3px;
  font-size: 1rem;
  color:#fff;
  font-weight: 300;
}


/*Dark Mode*/
#icon{
  width: 35px;
  cursor:pointer;
  float: right;
  margin-right: 2%;
  margin-top: 1.3%;
  font-size: 2rem;
  color: var(--add-color);
  transition: background-color 0.3s ease;
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
    <div class="side-menu">
        <div class="brand-name">
            <h4>USER <span><?php echo $username ?></span></h4>

        </div>
        <hr>
        <ul>
        <li><a href="userdashboard.php"><i class="fa-solid fa-chart-line"></i>Dashboard</a></li>
        <!--<li><a href="department.php"><i class="fa-solid fa-building-user"></i>Department</a></li>
            <li><a href="staffs.php"><i class="fa-solid fa-clipboard-user"></i>Staff</a></li> -->
            <li><a href="report.php"><i class="fa-regular fa-pen-to-square"></i>Report</a></li>
            <li><a href="usershiftlist.php"><i class="fa-solid fa-calendar-days"></i>Shift</a></li>
            <li><a href="leave.php"><i class="fa-solid fa-message"></i>Leave  Request</a></li>
            <li><a href="login.php "><i class="fa-solid fa-right-from-bracket"></i>Log out</a></li>
     
        
       
        </ul>
    </div>

    <div class="container">
        <div class="header">
            <div class="nav">
            
                <div class="search">

                <h2>Ritetrack Enviro Services, Inc. EMS</h2>
                
                </div>

                <a href="#" class="btn">+ Add New</a>
                <?php
                       $loggedInUserId = $_SESSION['users_id'];

                        $query = "SELECT * FROM users_tbl";
                        $result = $conn->query($query);
                        if(!$result) {
                          die($conn->error);
                        }
                        while ($row = $result->fetch_assoc()) {
                            // Assuming you have a variable $loggedInUserId that stores the ID of the currently logged-in user
                            if ($row['id'] == $loggedInUserId) {
                                ?>
                            <a href="prof.php"> <img src="../photos/<?php echo $row['image']; ?>" height="70"; width="70"; class="profile-img"></a>

                                <?php
                            }
                          }
                                ?>
                    <i class="fa-solid fa-circle-half-stroke" id="icon"></i>
            </div>
        </div>

        
  <form action="report.php" method="POST" enctype="multipart/form-data">
  <?php

    if(isset( $_SESSION['emptyField']))
    { 
      echo '<div class="message">'.$_SESSION['emptyField'].'</div>' ;
      unset($_SESSION['emptyField']);
    }
    elseif(isset($_SESSION['insertedMess']))
    {
      echo '<div class="message">'.$_SESSION['insertedMess'].'</div>' ;
      unset($_SESSION['insertedMess']);

    }

    ?> <br>
    <hr>
    <input type="hidden" id="name" name="name" value="<?php echo $name ?>" ><br>

    <input type="hidden" name="department"  value="<?php echo $dept ?>">
  
    <label for="report-type">Report Type:</label>
    <select id="report-type" name="report-type">
      <option value="Weekly">Weekly</option>
      <option value="Bi-Weekly">Bi-Weekly</option>
      <option value="Monthly">Monthly</option>
      <option value="Quarterly">Quarterly</option>
    </select><br> <br>

    <label for="date">Report Date:</label>
    <input type="date" id="date" name="date"><br><br>

    <label for="file">Insert a file:</label><br>
    <input type="file" name="file" accept="image/png, image/jpg, image/jpeg, application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" id="file"> <br>

    <label for="report-body">Report Body:</label>
    <textarea id="report-body" name="report-body"></textarea><br><br>

    <button type="submit" name="submit">Submit Report</button>
  </form>
         
        

<script type="text/javascript">
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