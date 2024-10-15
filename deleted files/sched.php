<?php
session_start();
require_once "../connection/config.php";

$adminname = $_SESSION['admin_name'];

if(!isset($adminname)) { 
    echo 'not set';
}



$employee_id = $_POST['id'];

$sql = "SELECT name, email FROM users_tbl WHERE id = '$employee_id'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result && $result->num_rows > 0) {
    // Fetch the employee information
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
    $dept = $row['department'];

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
    background: var(--bg-color);
    min-height: 100vh;
    transition: background-color 0.3s ease;

}

h1{
    font-size: 3em;
    font-weight: bold;
    margin-bottom: 0.5em;
    text-align: center;
  
}
h2{
    font-size: 1.4rem;
    color: #fff;
    margin-right: 40vh;
    text-align: center;
    margin-top: 5px;
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

h4 span { 
  color:   var(--add-color);
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

/* Sidebar styles */
.side-menu {
    position: fixed;
    background: var(--secondary-color);
    width: 20vw;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    box-shadow: 3px 3px 6px var(--nav-color);
    transition: background-color 0.3s ease;
}

.side-menu .brand-name {
    height: 10vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
    flex: 0.2;
    padding: 0;
    margin: 0;
}

.side-menu li {
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

.side-menu li:hover {
    background: var(--sidenav-color);
    color: #FFF;
    cursor: pointer;
}

.side-menu li a {
    color: #fff;
    text-decoration: none;
    display: flex;
    margin-left: 20px;
    align-items: center;
}

.side-menu li i {
    font-size: 20px;
    margin-right: 10px;
}

/* Main container styles */
.container {
    position: absolute;
    top: 90px;
    right: 200px;
    width: 60vw;
    height: 120vh;
    display: flex;
    flex-direction: column;
    background-color: var(--nav-color);
}

.container .header {
    position: fixed;
    top: 0;
    right: 0;
    width: 80vw;
    height: 8vh;
    background: var(--secondary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 3px 3px 6px var(--nav-color);
    transition: background-color 0.3s ease;
}

.container .header .nav {
    width: 90%;
    display: flex;
    align-items: center;
}

.container .header .nav .search {
    flex: 3;
    display: flex;
    justify-content: center;
}

.container .header .nav .search button {
    width: 40px;
    height: 40px;
    border: none;
}

.container .header .nav .search input[type="text"] {
    border: none;
    padding: 10px;
    width: 50%;
    text-align: center;
}

.container .header .nav .user {
    justify-content: space-between;
    display: flex;
    align-items: center;
    flex: 1;
}

.container .header .nav .user img {
    width: 40px;
    height: 40px;
}

.container .header .nav .user .image-case {
    position: relative;
    width: 50px;
    height: 50px;
}

.container .header .nav .user .image-case img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.container .content {
    position: relative;
    margin-top: 10vh;
    min-height: 90vh;
    padding: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container .content .form-container {
    width: 100%;
    max-width: 880px;
    background: #6a994e;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 0 10px 10px rgb(41, 33, 33);
}

.input-container {
    position: relative;
    margin: 1rem 0;
    left: 200px;
}

.input {
    width: 50%;
    outline: none;
    border: 2px solid #fafafa;
    background: none;
    padding: 0.6rem 1.2rem;
    color: #fff;
    font-weight: 500;
    font-size: 0.95rem;
    letter-spacing: 0.5px;
    border-radius: 25px;
    transition: 0.3s;
    justify-content: center;
}

.input-container label {
    position: absolute;
    top: 30%;
    left: 15px;
    transform: translateY(-50%);
    padding: 0 0.4rem;
    color: #fafafa;
    font-size: 1rem;
    font-weight: 400;
    pointer-events: none;
    z-index: 1000;
    transition: 0.5s;
}

.input-container span {
    position: absolute;
    top: 0;
    left: 25px;
    transform: translateY(-50%);
    font-size: 0.8rem;
    padding: 0 0.4rem;
    color: transparent;
    pointer-events: none;
    z-index: 500;
}

.input-container span:before,
.input-container span:after {
    content: "";
    position: absolute;
    width: 10%;
    opacity: 0;
    transition: 0.3s;
    height: 5px;
    top: 50%;
    transform: translateY(-50%);
}

.input-container span:before {
    left: 50%;
}

.input-container span:after {
    right: 50%;
}

.input-container.focus label {
    top: 0;
    transform: translateY(-50%);
    left: 25px;
    font-size: 0.8rem;
}

.input-container.focus span:before,
.input-container.focus span:after {
    width: 50%;
    opacity: 1;
}

input[type="date"], input[type="time"], input[type="number"] {
    width: 50%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
}

input[type="submit"] {
    padding: 0.6rem 1.3rem;
    background-color: #fff;
    border: 2px solid #fafafa;
    font-size: 1.2rem;
    color: #1abc9c;
    width: 50%;
    padding: 15px;
    line-height: 1;
    border-radius: 20px;
    outline: none;
    cursor: pointer;
    transition: 0.3s;
    margin: 0;
}

input[type="submit"]:hover {
    background-color: #20ad4a;
    color: #000;
}

.title { 
  text-align: center;
  color: #fff;
  font-size: 2rem;
  padding: 20px 20px;
}


table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 40px;
}

th, td {
    padding: 8px;
    border: 1px solid #dee2e6;
    text-align: center;
}

th {
    background-color: #f1f3f5;
    color: #495057;
}



.profile-img{
    border-radius: 100%;
}  

.notify { 
  background-color: red;
  padding: 2px 8px;
  border-radius: 100%;
  height: 30px;
  width: 30px;
  margin-left: 4px;
}



/*Dark Mode*/
#icon{ 
  width: 35px;
  cursor:pointer;
  float: right;
  margin-top: 1.3%;
  font-size: 2rem;
  color: var(--mode-color);
  transition: background-color 0.3s ease;
}

:root{
  --bg-color:  #1b2d48;
  --secondary-color: #2c456b;
  --1-color:#5C8374;
  --2-color:#1B4242;
  --mode-color:#fff;
  --nav-color:  #4779c4;
  --sidenav-color:#1b2d48;
  --add-color:#4779c4;
  --addhover-color:#3c649f;

}
.white-theme{
  --bg-color: #fff;
  --secondary-color: #43766C;
  --1-color:#AFC8AD;
  --2-color:#4F6F52;
  --mode-color:#000;
  --nav-color: #4F6F52;
  --sidenav-color:#0000;
  --add-color:#7ABA78;
  --addhover-color: #0A6847;

}
#fa-user{
    font-size: 30px;
     margin-top: 1.3%;
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
            <li><a href="department.php"><i class="fa-solid fa-building-user"></i>Department</a></li>
            <li><a href="staffs.php"><i class="fa-solid fa-clipboard-user"></i>Staff</a></li>
            <li><a href="adminreport.php"><i class="fa-regular fa-pen-to-square"></i>Report</a></li>
            <!--<li><a href="staffs.php"><i class="fa-solid fa-calendar-days"></i>Events</a></li> -->
            <li><a href="adminleave.php"><i class="fa-solid fa-message">
            </i>Leave  Request <?php
          
                $sql = "SELECT * FROM leave_tbl WHERE status = 'pending' ";
                $result = $conn->query($sql);         
                echo '<span class="notify">'.$result->num_rows.'</span>';
                ?></a></li>
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
                   <a href="#" class="btn">+ Add employee  </a>
                 
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
                    <!--<img src="photo/sun.png" id="icon">-->
                    <i class="fa-solid fa-circle-half-stroke" id="icon"></i>
                </div>
            </div>
        </div>




        <div class="container1">
        <div class="item1">
            <div class="content-form">
            <div class="title">Shift Scheduling</div>
             <!-- <img src="../photos/shift.png" alt="" class="image">-->
            </div>

            <div class="submit-form">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" autocomplete="off" method="POST">
            
            <?php
               
            ?>
            <div class="input-container">
              <input type="text" name="id" class="input" placeholder="employee ID"/>
            </div>
            <div class="input-container">
              <input type="text" name="name" required class="input" />
              <label for="employee_name">Employee Name:</label>
              <span>name</span>
            </div>
            <div class="input-container">
              <input type="email" name="email" class="input" required />
              <label for="">Email</label>
              <span>Email</span>
            </div>
            <div class="input-container">
              <input type="tel" name="mobile" required class="input" />
              <label for="">Phone</label>
              <span>Phone</span>
            </div>
               

    
            <div class="input-container">
              <input type="Dept" name="Department"  class="input" placeholder="Department" />
            </div>
            <div class="input-container">
            <input type="date" id="shift_date" name="shift_date" >
              
            </div>

            
            <div class="input-container">
            <input type="number" id="shift_duration" name="shift_duration" placeholder="hours of shift">

            
            </div>





            
            <h3>Scheduled Shifts</h3>
        <table>
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Shift Date</th>
                    <th>Department</th>
                    <th>Shift Hours</th>
                </tr>
            </thead>
            <tbody>

                <!-- Data from the database will be displayed here -->
                  <td>1</td>
                  <td>20/20/20</td>
                  <td>IT</td>
                  <td>1week</td>

            </tbody>
        </table>


        <input type="submit" value="Send" class="btn">
      

</form>
    </div>











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

setInterval(function() 
    
    {
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
</body>
</html>