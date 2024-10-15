<?php

require_once "../connection/config.php";  



//STAFF DELETE
if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  $delete_query = mysqli_query($conn, "DELETE FROM `users_tbl` WHERE id = $delete_id ") or die('query failed');
  if($delete_query){
     echo '<script>alert("Data Deleted") 
           window.location.href = "staffs.php";
           ;</script>';
  }else{
    
     echo '<script>alert("Cannot Delete Data");
     window.location.href = "staffs.php";
              </script>';
  };
};



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Staffs</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <!-- <link rel="stylesheet" href="../css/style.css">-->

</head>

<style>
* { 
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, Helvetica, sans-serif;
} 

body { 
  background-color: #c0bfbb;

}

.lagayan { 
 display: flex;
 flex-direction: column;
 gap: 20px 20px;
}

.wrapper {
  width: auto;
  height: auto;
  margin: 0 27%;
  padding: 20px 20px;
  width: 70%;
}

.btn-action { 
  padding: 5px;
  margin: 2px 0;
  text-decoration: none;
  color: #000;
  border-radius: 20px;
  transition: .5s ease-in-out;

}

.btn-action:hover  {

  color: #3e3e3e;

}

.add-staff {
  background-color: #334045;
  padding: 20px;
  color: #fff;
  transition: .5s ease-in-out;
  border-radius: 15px;
  text-decoration: none;
}

.add-staff:hover{
  
  color: rgb(3, 3, 3);
  background-color: #466672;

}

.wrapper .add-staff { 
  margin-bottom: 13px;
}

.wrapper h2 {
  margin-bottom: 40px;
}

.table-container { 
  overflow-y: scroll;
  max-height: 310px;
  margin-bottom: 10%;
  margin-left: 0%;
  width: 100%;
  align-items: center;
}
 
.table {
  margin-left: 27%;
  background: #ffffff;
  width: 70%;
  height: 100%;
  border-radius: 5px;
  box-shadow: 4px 4px 8px solid rgb(0, 0, 0);
  border-spacing: 1px;
}

.table thead {
  background-color: #0f1215;
 
}

th, td {
  text-align: center;
}

.table thead tr th {
  color: #fff;
  border-collapse:separate ;
  background-color:#092635 ;
  padding: 10px 0;
  border-bottom: 1px solid #000000;

}

.table tbody tr td { 
  background-color: #fff;
  padding: 20px 0;
  border-bottom: 1px solid #dedede;
}

</style>
<body>

<div class="lagayan">
  <div class="wrapper">
    <h2>List of Staffs</h2>
    <a href="addstaff.php" class="add-staff">New Staffs</a>
    <a href="view.php" class="add-staff">View All</a>
  </div>

  <div class="table-container">

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>User Type</th>
        <th>Address</th>
        <th>Created At</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php

      $query = "SELECT * FROM users_tbl";
      $result = $conn->query($query);
      if(!$result) {
        die($conn->error);
      }
      while($row = $result->fetch_assoc()) 
      {
          ?>
          
          <tr>
          <td> <?php echo $row['id'] ?></td>
          <td> <?php echo $row['name']?></td>
          <td> <?php echo $row['email']?></td>
          <td> <?php echo $row['mobile']?></td>
          <td> <?php echo $row['user_type']?></td>
          <td> <?php echo $row['loc']?></td>
          <td> <?php echo $row['created_at']?></td>
          <td> <img src="../photos/<?php echo $row['image']; ?>" height="70"; width="70"></td>
          <td>
           
           <a href='edit.php?edit=<?php echo $row['id'] ?>' class='btn-action'><i class="fa-solid  fa-pen"></i></a>
            <a href='staffs.php?delete=<?php echo $row['id'] ?>' class='btn-action' onclick="return confirm('are your sure you want to delete this?')";><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
          
          <?php
        }
      ?>
    </tbody>
    

  </table>
  </div>

</div>
</body>
</html>