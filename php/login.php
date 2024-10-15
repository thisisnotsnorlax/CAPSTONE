<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css ">

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">

</head>
<style type="text/css">

  body{
    background-image: url("../photos/tree.jpg");
    background-size: 1500px;

  }
  
h2{
   font-size: 4rem;
   margin-left: 4rem;
   margin-top: 3rem;
   color: #fff;
   text-align: center;
  }

.login { 
  background-color:#5C8374;
  width: 400px;
  height: 300px;
  text-align: center;
  margin-left: 35.5rem;
  margin-top: 3rem;
  border-radius: 10px;
  box-shadow: 3px 3px 6px #A8FF3E,
  2px 2px 4px #A8FF3E inset;
}

.login h3 {
  font-size: 20px;
  font-weight: 400px;
  margin-bottom: 10px;
  color: #1B4242;
}

.login form input { 
  margin-top: 5px;
  margin-bottom: 10px;
  margin-left: 1rem;
  padding: 10px 30px;
  border-radius: 2px;
  border: none;
  font-weight: 100;
  transition: .7s ease-in;
  outline: none;
  background-color: #fff;
}

.login form select { 
  padding: 5px 85px;
  border-radius: 2px;
  border: none;
  font-weight: 100;
  outline: none;
  background-color: #fff;
  margin-bottom: 5px;
}

.login form a {
  text-decoration: none;
  color: #000;
  transition: .5s ease-in-out;
}

.login form a:hover{
  text-decoration: underline;
}

.btn-submit:hover { 
  background-color: #9EC8B9;
  font-weight: 100;
}

.logo2{
  border-radius: 100%;
  width: 5rem;
  height: 5rem;
  margin-top: 1px;
  margin-left: 1px;
}

.block {
  position: absolute;
  width: 5rem;
  height: 5rem;
  margin-left: 9.5rem;
  background-repeat: no-repeat;
}

.glow::before,
.glow::after {
  content: "";
  position: absolute;
  left: -2px;
  top: -2px;
  background: linear-gradient(
    -45deg,
   
    #27AA80,
    #32FF6A,
    #A8FF3E,
    #27AA80
  );
  background-size: 400%;
  height: calc(100% + 5px);
  width: calc(100% + 5px);
  z-index: -1;
  animation: change 40s linear infinite;
  border-radius: 100%;
}


@keyframes change{
   0%{
      background-position: 0 0;
   }
   50%{
      background-position: 400% 0;
   }
   100%{
      background-position: 0 0;
   }
}

.glow::after{
   filter: blur(40px);
   opacity: .5;
}

.fa-solid {
  position: relative;
  right: 8%;
}


</style>

<?php
  include "../connection/logcon.php";
?>
<body>

  
  <div class="block glow">
        <img src="../photos/logo2.png" class="logo2"> 
    </div>
  <h2>Ritetrack Enviro Services, Inc.</h2>


  <div class="login"><br>
        <h3>Ritetrack Employee Management System</h3>
        <hr>
      <form action="../connection/logcon.php" method="post">
      <!-- <input type="text" name="name"  placeholder="enter your name"> <br>--> 
          
       <input type="email" name="email" placeholder="enter your email" class="input"><i class="fa-solid fa-envelope"></i> <br>
          
       <input type="password" id="password" name="password" placeholder="enter your password" class="input"><i class="fa-solid fa-eye-slash" id="eye" onclick="toggle()"></i> <br>
       <select name="usertype" id="">
        <option disabled selected hidden>login as</option>
        <option value="user">user</option>
        <option value="admin">admin</option>
       </select> <br>
       <input type="submit" value="Login" name="submit" class="btn-submit">  

      </form>
  </div>


  <script src="../js/script.js">  </script>

</body>
</html>