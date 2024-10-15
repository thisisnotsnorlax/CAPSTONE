<?php
session_start();
include "config.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {

  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $mobile = htmlspecialchars($_POST['mobile']);
  $password = htmlspecialchars($_POST['password']);
  $usertype = htmlspecialchars($_POST['user_type']);
  $address = htmlspecialchars($_POST['address']);
  $dept = htmlspecialchars($_POST['department']);
  $city = htmlspecialchars($_POST['city']);
  $image = $_FILES['image']['name'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_folder = '../photos/'.$image;

  $errorMessage = "";

  if(!isset($name,$email,$password,$usertype,$address,$image)) 
  {
      exit(mysqli_error($conn));
  }
  
  
  //  check if merong textbox na walang laman
  if( empty($name) || empty($email) || empty($mobile) || empty($password) || empty($usertype) || empty($address) || empty($image) || empty($dept) || empty($city)) {
  
   $_SESSION['errorMessage'] = 'Fill out all the blank fields';
   header("Location: ../php/addstaff.php");

   exit(); // Stop execution after mag redirect
}



  //  check if existing na yung username
  $check_query = mysqli_prepare($conn, "SELECT COUNT(*) FROM `users_tbl` WHERE email = ?");
  mysqli_stmt_bind_param($check_query, 's', $email);
  mysqli_stmt_execute($check_query);
  mysqli_stmt_bind_result($check_query, $count);
  mysqli_stmt_fetch($check_query);
  mysqli_stmt_close($check_query);

if($count > 0){
    $_SESSION['errorMessage1'] = 'This Email Already Exists.';
    header("Location: ../php/addstaff.php");

    exit(); // Stop execution after ng redirection
}

else {

    // Insert the users info into the database
    $insert_query = mysqli_prepare($conn, "INSERT INTO `users_tbl` (name, email, mobile, pw, user_type,loc,image,dept_name, city) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)");
    mysqli_stmt_bind_param($insert_query, 'sssssssss', $name, $email, $mobile, $password, $usertype,$address,$image, $dept, $city);

if(mysqli_stmt_execute($insert_query)){
    move_uploaded_file($image_tmp_name, $image_folder);

    $_SESSION['successMessage'] = "Staff Added.";
    header("Location: ../php/addstaff.php");

    exit(); // Stop execution after redirection
} else {
    $_SESSION['errorMessage2'] = 'Cannot Add Staff.';
    header("Location: ../php/staffs.php");

    exit(); // Stop execution after redirection
}
 }
  
}





