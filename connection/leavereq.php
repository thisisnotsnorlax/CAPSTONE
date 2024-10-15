<?php
session_start();
require_once("config.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') { 

  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);

  $fdate = htmlspecialchars($_POST['fdate']);
  $days =htmlspecialchars($_POST['days']);
  $leave_type = htmlspecialchars($_POST['leave_type']);
  $reason = htmlspecialchars($_POST['reason']);
  $udate = htmlspecialchars($_POST['udate']);


}


// check for empty textbox 

if(empty($fdate) || empty($udate) ||  empty($reason) || empty($days) || empty($leave_type))  {

    $_SESSION['emptyfields'] = 'Empty fields are not allowed';
    header("Location: ../php/leave.php");
}


else 
{
      
      $insert_leave = mysqli_prepare($conn, "INSERT INTO `leave_tbl`(name,email,mobile,fromdate,daysofleave,leavetype,reason,untildate) VALUES (?,?,?,?,?,?,?,?)");
      mysqli_stmt_bind_param($insert_leave, 'ssisssss', $name, $email,$phone,$fdate,$days, $leave_type, $reason,$udate );


          if(mysqli_stmt_execute($insert_leave))
          {
            $_SESSION['insertedMess'] = "Your Request is Sent.";
            header("Location: ../php/leave.php");

          }
          else
          {
            echo 'error';
          }

}
  





