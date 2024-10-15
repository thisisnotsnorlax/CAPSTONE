<?php
session_start();
require_once "../connection/config.php";
$loggedInUserId= $_SESSION['admin_id'];
$adminname = $_SESSION['admin_name'];

if(!isset($adminname) && !isset($loggedInUserId)) { 
    header("Location: login.php");
}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css ">
    <title>Add staff</title>
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
  height: 500px;
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

.input { 
  width: 132%;

}

.city { 
  width:100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin-right: 80px;
  
}

.utype { 
  margin-left: 20px;
  width: 137%;
}

.deprt {
  width: 63%;
  margin-left: 40%;
}

.lblutype { 
  margin-left: 10%;
}

.lbldept { 
  margin-left: 40%;
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
  
  background-color: #092635;
  color: #fff;
  border: none;
  margin-left: 6px;
  padding: 0 110px;
  margin-top: 20px;
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
                    <a href="staffs.php" class="btn">Staff List</a>
                 
                    <div class="image-case">

                        <?php

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
    <form action="../connection/adddata.php" method="post" enctype="multipart/form-data">
      <div class="col-50">
        <h3>New Staffs</h3>

    
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
    <hr>
        <label for="fname"><i class="fa fa-user"></i>Full Name</label>
        <input type="text" id="fname" name="name" placeholder="Juan, Dela Cruz" class="txtb">

        

        <label for="email"><i class="fa fa-envelope"></i> Email</label>
        <input type="text" id="email" name="email" placeholder="exp@example.com" class="txtb">

        <label for="address"><i class="fa fa-location"></i> Address</label>
        <input type="text" id="address" name="address" placeholder="PhA Brgy. Bagong Silang" class="txtb">

        <label for="mobile"><i class="fa fa-phone"></i> Mobile</label>
        <input type="text" id="mobile" name="mobile" placeholder="09123123" class="txtb">

      <div class="small-textbox">

     
        <div class="row">
          <div class="col-50">
            <label for="city"><i class="fa fa-institution"></i>city</label>
            <input type="text" id="city" name="city" placeholder="Caloocan" class="city">
          </div>
          
          <div class="col-50">
            <label for="usertype"  class="lblutype"><i class="fa fa-user"></i>User type</label>
            <select name="user_type" id=""  class="input utype">
              <option disabled selected hidden>type</option>
              <option value="user">User</option>
              <option value="admin">Admin</option>

            </select>
          </div>


          <div class="col-50">
            <label for="department" class="lbldept"><i class="fa-solid fa-building"></i>Department</label>
            <select name="department" class="input deprt" >
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

   
         <input type="password" name="password" id="password" placeholder="password"> <i class="fa-solid fa-eye-slash" id="eye" onclick="toggle()"></i>
         <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" id="file" >  
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