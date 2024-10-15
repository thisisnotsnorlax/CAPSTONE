<?php

require_once "../connection/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>


<style>

.placed-container {
   max-width: 500px;
   max-height: 400px;
   margin: 0 auto;
   display: grid;
   grid-template-columns: repeat(2, 1fr);
   grid-template-rows: repeat(2, 1fr);
   grid-gap: 1rem;
   box-sizing: border-box;

}

.box-container {
   display: flex;
   justify-content: center;
   align-items: center;
}

.box {
   background-color: #50623A;
   padding: 1rem;
   box-shadow: 3px 3px 5px #789461, 3px 3px 5px #789461 inset;
   border-radius: .5rem;
   text-transform: none;
   color: #fff;
   width: 100%;
   height: 100%;
   display: flex;
   flex-direction: column;
   justify-content: center;
   align-items: center;
}

.box p {
   margin: 1rem 0;
   font-size: 2rem;
   line-height: 1.5;
}
</style>
<body>
  

<?php
        $show_reports = mysqli_query($conn, "SELECT * FROM `reports_tbl`") or die(mysqli_error($conn));
      if(mysqli_num_rows($show_reports) > 0){
         while($view = mysqli_fetch_assoc($show_reports)){

   
?>
<div class="placed-container">
        <div class="box-container">
            <div class="box">     
              <p> Name : <span><?php echo $view['name']; ?></span> </p>
              <p> Department : <span><?php echo $view['dept_name']; ?></span> </p>
              <p> Date : <span><?php echo $view['date']; ?></span> </p>
              <p> Report Type: <span><?php echo $view['report_type']; ?></span> </p>
              <p> Report: <span><?php echo $view['report']; ?></span> </p>
            </div>
        </div>
      </div>

      <?php
         }
        }
      ?>

</body>
</html>