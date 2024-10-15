<?php
session_start();
require_once "../connection/config.php";



$adminname = $_SESSION['admin_name'];

if(!isset($adminname)) { 
    echo 'not set';
}


if(isset($_GET['id']) && isset($_GET['status']))
{
  $id = htmlspecialchars($_GET['id']);
  $status = htmlspecialchars($_GET['status']);

  mysqli_query($conn,"UPDATE leave_tbl SET status = '$status' WHERE id = '$id' ");
  header("location:adminleave.php");
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
  height: 550px;
  width: 90%;
  margin: 8rem auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
  box-shadow: 3px 3px 6px var(--nav-color),
  2px 2px 4px  var(--nav-color)inset;
  transition: background-color 0.3s ease;
  overflow: scroll;
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
  background-color: var(--add-color);
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
  background-color: var(--addhover-color);
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

.profile-img {
  border-radius: 100%;
  border: 3px solid var(--span-color);
  margin-left: 24px;
}

/* TABLES */
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  text-align: center;
}
th {
  background-color: #1B4242;
  color: #fff;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

th { 
  text-align: center;

}

tr:nth-child(even) {
  background-color: #dddddd;
}

.h1dept {
  font-size: 2rem;
  text-align: left;
  padding: 20px;
  color: #1B4242;
  
}

.h1dept span { 
  color: #092635;
}

.btns {
  text-align: center;
  width: 200px;
}

.btns a { 
  color: #fff;
  text-align: center;
  text-decoration: none;
  background-color: #102C57;
  padding: 3px 20px;
  border-radius: 2px;
  font-weight: 300;
  transition: .5s ease;
  font-size: .8rem;
}
.btns a:hover { 
  background-color: #092635;
  color: #c2c2c2;
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
            </i>Leave  Request </a></li>
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
                    <a href="adminleave.php" class="btn"> Back  </a>
                 
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

    

<div class="container1">
  <h1 class="h1dept">Overall Leave <span>Request</span></h1>
<table>
  <tr>
  <th>Name</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>From</th>
    <th>Until</th>
    <th>Number of Days</th>
    <th>leave type</th>
    <th>Reason</th>
    <th>Submission Date</th>
    <th>Status</th>
    <th>Action</th>
  </tr>

  <?php 
    

    $query = "SELECT * FROM leave_tbl";
    $result = $conn->query($query);
    if(!$result) {
      die($conn->error);
    }
    while($row = $result->fetch_assoc()) 
    {
        ?>

  <tr>
   <td><?php echo $row['name'];?> </td>
    <td><?php echo $row['email'];?> </td>
    <td><?php echo $row['mobile'];?> </td>
    <td><?php echo $row['fromdate'];?> </td>
    <td><?php echo $row['untildate'];?> </td>
    <td><?php echo $row['daysofleave'];?> </td>
    <td><?php echo $row['leavetype'];?> </td>
    <td><?php echo $row['reason'];?> </td>
    <td><?php echo $row['created_at'];?> </td>
    <td id="stat"><?php echo $row['status'];?> </td>
    
    <td class="btns">
    
     
   <form action="adminleave.php" method="POST">
      <select name='status' id="status" onchange="selected(this.options[this.selectedIndex].value,<?php echo $row['id'];?> )">
        <option hidden>ACTION</option>
        <option value="pending">Pending</option>
        <option value="accepted">Accept</option>
        <option value="rejected">Reject</option>

      </select>
      <input type="hidden" name="id" value="<?php echo $row['id'];?>">
    </form>
    </td>
  </tr>

  <?php
    }
    
  ?>
  
</table>                
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


function selected(value,id) { 

  //alert(id)

  let url = "http://localhost/EMS/EMSFULL/php/adminleave.php";
  window.location.href=url+"?id="+id+"&status="+value;

}





</script>




</body>
</html>