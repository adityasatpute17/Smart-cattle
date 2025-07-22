<?php   
$conn=mysqli_connect("localhost","root","","cowfarm") or die("Couldn't connect");
// At the top of your PHP file
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE); // Hide warnings and notices but show other errors
    ini_set('display_errors', 0); // Don't display errors to the screen
    ini_set('log_errors', 1); // Enable error logging
    ini_set('error_log', 'path/to/error.log'); // Set path to error log file

                        $sql = "SELECT * FROM cattle WHERE 	ReproductionStatus != 'pregnant' AND DATE_ADD(LastAI, INTERVAL 60  DAY) <= CURDATE()";
                        $sql1 = "SELECT * FROM cattle WHERE 	ReproductionStatus != 'pregnant' AND DATE_ADD(LastAI, INTERVAL 90  DAY) <= CURDATE()";
                        $sql2 = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'pregnant' AND DATE_ADD(LastAI, INTERVAL 269  DAY) <= CURDATE()";
                        $sql3 = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'pregnant' AND milking = 'lactating' AND DATE_ADD(LastAI, INTERVAL 220  DAY) <= CURDATE()";
                        $result= mysqli_query($conn, $sql);  
                        $result1 = mysqli_query($conn, $sql1);
                        $result2= mysqli_query($conn, $sql2);
                        $result3= mysqli_query($conn, $sql3);
                    if ($result->num_rows > 0) 
                    {include 'altp.php';}
                    elseif($result1->num_rows > 0)
                    {include 'altp.php';}
                    elseif($result2->num_rows > 0)
                    {include 'altp.php';}
                    elseif($result3->num_rows > 0)
                    {include 'altp.php';}
                    

else {}
?>
