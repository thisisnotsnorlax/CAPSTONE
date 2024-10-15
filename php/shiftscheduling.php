<?php
session_start();
require_once "../connection/config.php";

$adminname = $_SESSION['admin_name'];

if (!isset($adminname)) {
    echo 'not set';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = htmlspecialchars($_POST['name']);
    $days = isset($_POST['day']) ? $_POST['day'] : array();
    $timefrom = htmlspecialchars($_POST['timefrom']);
    $dept = htmlspecialchars($_POST['department']);
    $timeuntil = htmlspecialchars($_POST['timeuntil']);
    $shiftname = htmlspecialchars($_POST['shiftname']);
    $date = htmlspecialchars($_POST['date']);
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../photos/' . $image;


    if (!isset($name, $days, $timefrom, $timeuntil, $date, $dept, $image, $shiftname)) {
        exit(mysqli_error($conn));
    }

    // Check if any required field is empty
    if (empty($name) || empty($days) || empty($timefrom) || empty($dept) || empty($timeuntil) || empty($date) || empty($image) || empty($dept) || empty($shiftname)) {
        $_SESSION['errorMessage'] = 'Fill out all the blank fields';
        header("Location: shiftscheduling.php");
        exit(); // Stop execution after redirect
    } 
    else
    {
        // Check if ang name is nag  e-exists in the users table
        $check_query = mysqli_query($conn, "SELECT * FROM `users_tbl` WHERE name = '$name' AND dept_name = '$dept' ");
        if (mysqli_num_rows($check_query) > 0) {
            // Name&department exists in users_tbl, proceed with insertion into shift_tbl
            // Convert the selected days array into a string
            $selectedDays = implode(", ", $days);

            // Insert the user's info into the database
            $insert_query = mysqli_prepare($conn, "INSERT INTO `shift_tbl` (name, day, timefrom, timeuntil, date, image, dept_name, shiftname) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($insert_query, 'ssssssss', $name, $selectedDays, $timefrom, $timeuntil, $date, $image, $dept, $shiftname);

            if (mysqli_stmt_execute($insert_query)) {
                move_uploaded_file($image_tmp_name, $image_folder);
                $_SESSION['successMessage'] = "Shift Added.";
                header("Location: shiftscheduling.php");
                exit(); // Stop execution after redirect
            } else {
                $_SESSION['errorMessage2'] = 'Cannot Add Shift.';
                header("Location: shiftscheduling.php");
                exit(); // Stop execution after redirect
            }
        } else {
            // Name does not exist in users_tbl, display an error message
            $_SESSION['namenotExist'] = 'This employee is not in the employee list';
            header("Location: shiftscheduling.php");
            exit(); // Stop execution after redirect
        }
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css ">
    <title>Shift Management</title>
</head>
<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');



*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

/* width */
::-webkit-scrollbar {
  width: 1px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #333; 
  box-shadow: inset 0 0 5px grey; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: var(--7-color); 
  border-radius: 20px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #789461;
; 
}

body{
    background-image: var(--bg-color);
    background-size: cover;
    background-attachment: fixed;
}

h1{
    font-size: 3em;
    font-weight: bold;
    margin-bottom: 0.5em;
    text-align: center;
    color: var(--font-color);
  
}
h2{
    font-size: 1.4rem;
    color: #fff;
    margin-bottom: 0.1em;
    margin-right: 60vh;
    text-align: center;
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




.btn {
    display: inline-block;
    padding: 5px 30px;
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
    background: var(--sidenav-color) ; 
    color: #fff;
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

/*
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
    background-color: var(--card-color);
    overflow: hidden;
    box-shadow: 3px 3px 6px var(--outline-color) ;
    border-radius: 10px;
    transition: background-color 0.3s ease;
}
.container .content .cards  .icon-case {
    background-color: var(--secondary-color);
    color: #fff;
    text-align: center;
    width: 100%;
    padding: 8em;
    border-radius: 0 0 5px 5px;
    transition: background-color 0.3s ease;
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

.profile-img {
  border-radius: 100%;
   height: 50px;
   width: 50px;
   border: 3px solid var(--span-color);
   margin-left: 11px;
}

/* FORM */

.row {
  display: flex;
  flex-wrap: wrap;
}

.container1 {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
  width: 80%;
  height: 560px;
  margin: 7rem auto;

}

.form-row {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

label {
  margin-right: 10px;
}

.txtb[type=text], .input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin: 0px 5px;
  
}



.city { 
  width:100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin-right: 80px;
  
}

.photo { 
  margin-left: 5px;
}

.deprt {
  width: 35%;
  margin-left: 65%;
  padding: 12px;
  margin-bottom: 20px;
  position: relative;
  bottom: 45px;
  right: 2rem;
}

.deptlbl { 
  margin-left: 40px;
}

.col-50 { 
  margin: 0 0px;
  
}

.textbox  {
  width: 150%;
  margin: 22px 45%;

}

.col-50 .passwordlabel {
  color:  wheat;
}


.radio-container { 
  display: flex;
  justify-content: center;
  padding: 10px;
  background-color: #ffffff;
  margin-top: 18px;
  margin-left: 5px;
}

.time-container { 
  display: flex;
  background-color: #ffffff;
  justify-content: center;  
 
}

.time-container input { 
  margin-right: 40px;
}

.time-container label { 
  margin-right: 80px;
}

#password {
  padding: 10px;
  
  width: 35%;
  margin-top: 20px;
}

#eye {
  position: relative;
  right: 4%;
  top: 2.1rem;
}

#file { 
  border: 1px solid #ccc;
  padding: 10px 5px;
  
  margin-top: 20px;
  width: 300px;
  background-color: #fff;
  margin-right: 2%;
}


#btnsub { 
  
  background-color: var(--2-color);
  color: #fff;
  border: none;
  margin-left: 300px;
  padding: 0 110px;
  margin-top: -40px;
  margin-bottom: 20px;
}

.small-textbox { 
  margin: 10px 0px;

}

.notify { 
  background-color: red;
  padding: 2px 8px;
  border-radius: 100%;
  height: 30px;
  width: 30px;
  margin-left: 4px;
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
  --font-color: #4F6F52;
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
        <h4>ADMIN <span> <?php echo $adminname ?></span></h4>

        </div>
        <hr>
        <ul>
        <li><a href="dashboard.php"><i class="fa-solid fa-chart-line"></i>Dashboard</a></li>
            <li><a href="dept_list.php"><i class="fa-solid fa-building-user"></i>Department</a></li>
            <li><a href="staffs.php"><i class="fa-solid fa-clipboard-user"></i>Staff</a></li>
            <li><a href="adminreport.php"><i class="fa-regular fa-pen-to-square"></i>Report</a></li>
            <li><a href="shift_list.php"><i class="fa-solid fa-calendar-days"></i>Shift</a></li>
            <li><a href="adminleave.php"><i class="fa-solid fa-message">          
  	         
           </i>Leave  Request
           <?php
              
              $sql = "SELECT * FROM leave_tbl WHERE status = 'pending' ";
              $result = $conn->query($sql);         
              echo '<span class="notify">'.$result->num_rows.'</span>';

              ?>	</a></li>
            <li><a href="login.php "><i class="fa-solid fa-right-from-bracket"></i>Log out</a></li>        
        

       
        </ul>
    </div>

    <div class="container">
        <div class="header">
            <div class="nav">
            
                <div class="search">

                <h2>Ritetrack Enviro Services, Inc. EMS</h2>
                </div>
           
              

                <div class="user">
                    <a href="shift_list.php" class="btn">Shift List</a>
                 
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
                       <a href="profileadmin.php"> <img src="../photos/<?php echo $row['image']; ?>" height="70"; width="70"; class="profile-img"></a>
                       <?php
                            }
                        }
                        ?>
                    </div>
                    <i class="fa-solid fa-circle-half-stroke" id="icon"></i>
                </div>
            </div>
        </div>

    
  <div class="row">
  <div class="container1">
    <form action="shiftscheduling.php" method="post" enctype="multipart/form-data">
      <div class="col-50">
        <h3>Manage Shift</h3>

    
    <?php
    if(isset($_SESSION['errorMessage'])) {

      echo '<span class="message">' . $_SESSION['errorMessage'] .'</span>';
      unset($_SESSION["errorMessage"]);
       
    }
    elseif(isset($_SESSION['errorMessage1'])) {
      echo '<span class="message">' . $_SESSION['errorMessage1'] .'</span>';
      unset($_SESSION["errorMessage1"]);
       
    }
    elseif(isset($_SESSION['successMessage'])) {
      echo '<span class="message">' . $_SESSION['successMessage'] .'</span>';
      unset($_SESSION["successMessage"]);
      
    }elseif(isset($_SESSION['namenotExist'])) {
      echo '<span class="message">' . $_SESSION['namenotExist'] .'</span>';
      unset($_SESSION["namenotExist"]);

    }
  
    ?>
    <hr>
        <label for="fname"><i class="fa fa-user"></i>Employee Name</label>
        
        <input type="text" id="fname" name="name" placeholder="Juan, Dela Cruz" class="txtb">
        
        <div class="radio-container">
            <input type="checkbox" id="monday" name="day[]" value="Monday">
            <label for="monday">Monday</label>
            
            <input type="checkbox" id="tuesday" name="day[]" value="Tuesday">
            <label for="tuesday">Tuesday</label>
            
            <input type="checkbox" id="wednesday" name="day[]" value="Wednesday">
            <label for="wednesday">Wednesday</label>
            
            <input type="checkbox" id="thursday" name="day[]" value="Thursday">
            <label for="thursday">Thursday</label>
            
            <input type="checkbox" id="friday" name="day[]" value="Friday">
            <label for="friday">Friday</label>
            
            <input type="checkbox" id="saturday" name="day[]" value="Saturday">
            <label for="saturday">Saturday</label> 
        </div><br>

      <div class="time-container">
        <label for="time"><i class="fa-solid fa-clock"></i>From:</label> <br>
        <label for="time"><i class="fa-solid fa-clock"></i></i>Until:</label><br>
      </div>

      <div class="time-container">
        <input type="time" id="time" name="timefrom"   class="txtb"><br>
        <input type="time" id="time" name="timeuntil" class="txtb"> 
      </div>
        
      <div class="small-textbox">

        <div class="row">
          <div class="col-50">
            <label for="date"><i class="fa-solid fa-calendar"></i></i>Starting Date of shift until changed:</label>
            <input type="date" id="date" name="date"  class="city">
            <label for="date"><i class="fa-solid fa-calendar"></i></i>Shift Name:</label>
            <input type="text" id="shiftname" name="shiftname"  class="city">
          
        
            <label for="department"  class="photo"><i class="fa fa-user"></i>Image:</label>
            <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" id="file"  class="photo">  
    


            <label for="department" class="deptlbl"><i class="fa-solid fa-building"></i>Department:</label>
            <select name="department" class="deprt" >
            <?php

              $sql = "SELECT * FROM department_tbl";
              $result1 = mysqli_query($conn,$sql);
       
              while($row1 = mysqli_fetch_assoc($result1))
              {
              ?>
             <option value="<?php echo $row1['dept_name'];?>"><?php echo $row1['dept_name'];?></option> 
              
            <?php
              }
            ?>
            </select>
          </div>
          <br>
          <input type="submit" name="sub" value="submit" id="btnsub">
                        

      </div>
      </div>  
    </form>
  </div>
</div>

<script src="../js/script.js"></script>

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


function loadDoc() {

setInterval(function() {

      var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      document.getElementById("notif").innerHTML = this.responseText;
      }
    };
  //  xhttp.open("GET", "adminleave.php", true);
  //  xhttp.send();

},1000);


}
loadDoc();



</script>


</script>
</body>
</html>