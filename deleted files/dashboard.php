<?php
session_start();
require_once "../connection/config.php";
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

.side-menu li:last-child {
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

.profile-img {
    border-radius: 100%;
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
                    <a href="#" class="btn">Add new  </a>
                 
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

        <div class="content">
            <div class="cards">
                <div class="card">
                    <div class="box">
                        <h1>10</h1>
                        <h3>Department</h3>
                    </div>
                    <div class="icon-case">
                     
                    </div>

                </div>
                          



                <div class="card">
                    <div class="box">
                        <h1>2</h1>
                        <h3>Staff</h3>
                    </div>
                    <div class="icon-case">
                      
                    </div>

                </div>




                <div class="card">
                    <div class="box">
                        <h1>1</h1>
                        <h3>Salary paid</h3>
                    </div>
                    <div class="icon-case">
                         
                    </div>

                </div>


                <div class="card">
                    <div class="box">
                        <h1>1</h1>
                        <h3>Time and Leave request</h3>
                    </div>
                    <div class="icon-case">
                         
                    </div>

                </div>

                

                <div class="content-2">
                    <div class="recent-payment"></div>
                    <div class="new-students"></div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>