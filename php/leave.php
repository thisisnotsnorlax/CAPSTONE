<?php
session_start();

include "../connection/config.php";

 $username = $_SESSION['user_name'];

 if(!$username) 
 {
  echo 'the name is not valid or set';
 }


 $user_id = $_SESSION['users_id'];
 $sql = "SELECT * FROM users_tbl WHERE id = $user_id";

 $result = $conn->query($sql);

 if($result->num_rows > 0){
  $row = $result->fetch_assoc();
  $user_name = $row['name'];
  $user_email = $row['email'];
  $user_mobile = $row['mobile'];

 }

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css ">
    <title>Leave</title>
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
    margin-right: 45%;
    font-size: 1.4rem;
    color: #fff;
    margin-bottom: 0.5rem;
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
    background: var(--sidenav-color) ;
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



.btn {
    margin-right: 30px;
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

.profile-img {
  border-radius: 100%;
  width: 50px;
  height: 50px;
  margin-right: 25px;
  border: 3px solid var(--span-color);
}

/*leave form*/
.leave-container {
    width: 600px;
    height: 700px;
    margin-top: 5rem;
    margin-left: 18rem;
    padding: 20px;
    background-color: #f2f2f2;
    box-shadow: 3px 3px 6px var(--nav-color),
    2px 2px 4px  var(--nav-color)inset;
    transition: background-color 0.3s ease;
    overflow-y: scroll;
  }
  
.leave {
    color: dimgray;

  }
  
  form {
    display: grid;
    grid-gap: 10px;
  }
  
  label {
    font-weight: 50%;
  }
  
  input[type="text"],
  input[type="email"],
  input[type="tel"],
  textarea,
  select,
  input[type="number"] {
    width: 100%;
    height: 70%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  button {
    width: 40%;
    padding: 5px;
    background-color: var(--add-color);
    font-size: 1.2rem;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
  }
  
  button:hover {
    background-color: var(--addhover-color);
    color: #fff;
  }
  select{
    height: 38px;
  }


/*MESSAGE */
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
                <a href="userleaverequest.php" class="btn">Your History</a>
                <?php
                       $loggedInUserId = $_SESSION['users_id'];

                        $query = "SELECT * FROM users_tbl";
                        $result = $conn->query($query);
                        if(!$result) {
                          die($conn->error);
                        }
                        while ($row = $result->fetch_assoc()) {

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

 <div class="leave-container">

    <?php
        
        if(isset($_SESSION['emptyfields'])) 
        { 
            echo '<div class="message">'.$_SESSION['emptyfields'].'</div>' ;
            unset($_SESSION['emptyfields']);
        }
        else if(isset($_SESSION['insertedMess']))
        { 
            echo '<div class="message">'.$_SESSION['insertedMess'].'</div>' ;
            unset($_SESSION['insertedMess']);
        }
        else 
        {
          
        }
    ?>

    <h2 class="leave">Leave management form</h2>
    <form action="../connection/leavereq.php" method="post">

      <?php

      ?> 
      <input type="hidden" id="name" name="name" value="<?php echo $user_name ?>">
    
      <input type="hidden" id="email" name="email" value="<?php echo $user_email ?>" >

      <input type="hidden" id="phone" name="phone" value="<?php echo $user_mobile ?>">


      <label for="fdate">From:</label>
      <input type="date" id="fdate" name="fdate" >

      <label for="udate">Until:</label>
      <input type="date" id="udate" name="udate" >


      <label for="name">Total Days of Leave\Absence:</label>
      <input type="Number" id="days" name="days" >

      <label for="leave_type">leave type:</label>
      <select id="leave_type" name="leave_type" >
        <option value="Casual">Casual</option>
        <option value="Medical">Medical</option>
        <option value="Sick">Sick</option>
        <option value="other">Other</option>
      </select>
      
      <label for="Date">Reason of leave request</label>
      <textarea name="reason" id="text" cols="30" rows="10"></textarea>



      <button type="submit">Submit form</button>
    </form>
  </div>
         
        
                </div>
            </div>
        </div>
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
    </script>
</body>
</html>