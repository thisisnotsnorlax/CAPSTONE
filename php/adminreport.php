<?php
session_start();
require_once "../connection/config.php";

$adminname = $_SESSION['admin_name'];

if(!isset($adminname)) { 
    echo 'not set';
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
    background-position: center;
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
    margin-right: 40vh;
    text-align: center;
    margin-top: 5px;
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
    background: var(--sidenav-color);
    color: #FFF;
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
    background-color: #f2f2f2;
    overflow: hidden;
    box-shadow: 3px 3px 6px var(--nav-color),
    2px 2px 4px  var(--nav-color)inset;
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
  }*/

.profile-img{
    border-radius: 100%;
    margin-left: 180px;
    border: 3px solid var(--span-color);
}  


.notify { 
  background-color: red;
  padding: 2px 8px;
  border-radius: 100%;
  height: 30px;
  width: 30px;
  margin-left: 4px;
}

/*
.container1 {
  background-color: #fff;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
  height: 500px;
  width: 80%;
  margin: 6rem auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
  transition: background-color 0.3s ease;
  box-shadow: 3px 3px 6px var(--nav-color),
  2px 2px 4px  var(--nav-color)inset;

}


.placed-container {
   height: 90%;
   width: 95%;
   margin-left: 2.2%;
   gap:1.5rem;
}

.placed-container .box-container .box{
   background-color: #fff; 
   padding:1rem 2rem;
   box-shadow:  3px 3px 5px #789461,3px 3px 5px #789461 inset;
   border-radius: .5rem;
   text-transform: none;
   margin-right: 5%;
   margin-bottom: 20%;
}


.box {
   box-shadow: 3px 3px 5px #789461, 3px 3px 5px #789461 inset;
   border-radius: .5rem;
   text-transform: none;
   color: #000;
   font-size: 2rem;
   
   width: 100%;
   height: 100%;
   display: flex;
   flex-direction: column;
   justify-content: center;
}


.box span {
   margin-left: 20px;
   font-size: 2rem;
   line-height: 1.5;
   color: #000;
}
.empty {
   background-color: #50623A;
   padding: 20px 20px;
   border-radius: 20px;
   box-shadow: 3px 3px 5px #789461,3px 3px 5px #789461 inset;
   color: #fff;
   text-transform: capitalize;
}*/

/*UPDATED REPORT*/
.container1 {
  background-color: #f7f7f7;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 10px;
  width: 80%;
  margin-left: 9rem;
  margin-top: 7rem;
  box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.1);
}

.box {
  padding: 20px;
  border-radius: 10px;
  box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.1);
}

.box p {
  margin-bottom: 10px;
}

.box span {
  font-size: 1.5rem;
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
                    <!--<img src="photo/sun.png" id="icon">-->
                    <i class="fa-solid fa-circle-half-stroke" id="icon"></i>
                </div>
            </div>
        </div>

       <?php
        $show_reports = mysqli_query($conn, "SELECT * FROM `reports_tbl`") or die(mysqli_error($conn));
      if(mysqli_num_rows($show_reports) > 0){
         while($view = mysqli_fetch_assoc($show_reports)){
          
      ?>

      <!--
          <div class="container1">
      <div class="placed-container">
        <div class="box-container">
            <div class="box">     
              <p> Name :       <span><?php echo $view['name']; ?></span> </p>
              <p> Department : <span><?php echo $view['dept_name']; ?></span> </p>
              <p> Date :       <span><?php echo $view['date']; ?></span> </p>
              <p> File: <span><a href="../photos/<?php echo $view['file']; ?>" download onclick="return confirm('Download file?')">Download</a></span></p>             
              <p> Report Type: <span><?php echo $view['report_type']; ?></span> </p>
              <p> Report:      <span><?php echo $view['report']; ?></span> </p>
            </div>
        </div>
      </div>

        </div>-->

        <div class="container1">
    <div class="box">
        <p> Name : <span><?php echo $view['name']; ?></span></p>
        <p> Department : <span><?php echo $view['dept_name']; ?></span></p>
        <p> Date : <span><?php echo $view['date']; ?></span></p>
        <p> File : <span><a href="../photos/<?php echo $view['file']; ?>" download onclick="return confirm('Download file?')">Download</a></span></p>
        <p> Report Type : <span><?php echo $view['report_type']; ?></span></p>
        <p> Report : <span><?php echo $view['report']; ?></span></p>
    </div>
    </div>
      <?php
         }
      }else{
         echo '<p class="empty">no bookings  yet!</p>';
      }
      ?>










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