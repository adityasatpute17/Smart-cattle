<?php
   
   
  
   require './config/connection.php';
   

   if(isset($_POST['delete'])){
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $reason = $_POST['reason'];
    $removalDate = "$year-$month-$day";
    $all_id = $_POST['checkbox'];
    $extract = implode(',', $all_id);
   //echo $extract;
   $quer="INSERT INTO cattle_removals VALUES ('$extract','$removalDate','$reason')";
   $que=mysqli_query($conn,$quer );
   $sql = "DELETE from cattle WHERE id IN($extract)";
   $query = mysqli_query($conn,$sql);
   if($query)
        {
            header('Location:Cattle List.php');
        }
        else
        {
            echo "Error";
        }


 
}

?>
