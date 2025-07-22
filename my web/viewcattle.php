<?php
   require './config/connection.php';
   session_start();
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cattle Details</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }
        .header {
            background-color: #FF6B00;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header h1 {
            color: white;
            font-size: 20px;
            font-weight: 500;
        }

        .back-button {
            font-size: 24px;
            color: white;
            text-decoration: none;
        }

        .tabs {
            background-color: #D84315;
            display: flex;
            justify-content: space-around;
            padding: 15px 0;
        }

        .tab {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 5px 20px;
        }

        .tab.active {
            border-bottom: 2px solid white;
        }

        .actions {
            padding: 15px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 25px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-edit {
            background-color: white;
            border: 1px solid #ccc;
            color: #333;
            text-decoration: none;
        }

        .btn-add {
            background-color: #FF6B00;
            color: white;
        }

        .section {
            background-color: white;
            margin: 15px;
            padding: 20px;
            border-radius: 10px;
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .detail-label {
            color: #666;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .detail-value {
            font-weight: 500;
        }

        .attach-device {
            color: #D84315;
            text-decoration: underline;
        }

        .icon {
            color: #D84315;
            width: 20px;
            display: inline-block;
        }
          /* Edit Styles */

        .container {
            padding: 20px 16px;
        }

        .section-title1 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #000000;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            color: #666666;
            margin-bottom: 8px;
        }

        .required::after {
            content: ' *';
            color: #666666;
        }

        .form-control {
            width: 100%;
            height: 48px;
            border: 1px solid #DDDDDD;
            border-radius: 4px;
            padding: 0 12px;
            font-size: 16px;
            color: #333333;
            background-color: #ffffff;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23666666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 40px;
        }

        .date-group {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .date-group .form-control {
            text-align: center;
        }

        .time-input {
            position: relative;
        }

        .time-input::after {
            content: '';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23666666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='12' cy='12' r='10'%3E%3C/circle%3E%3Cpolyline points='12 6 12 12 16 14'%3E%3C/polyline%3E%3C/svg%3E");
            background-size: contain;
        }
        .save-button {
            width: 100%;
            bottom: 16px;
            left: 16px;
            right: 16px;
            background-color: #FF6B00;
            color: white;
            border: none;
            border-radius: 8px;
            height: 48px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
        }

        .section {
            margin-bottom: 32px;
        }

        /* Add margin to the last section to account for fixed save button */
        .section:last-of-type {
            margin-bottom: 80px;
        }
        /* Edit Mode Styles */
                .edit-mode {
            display: none;
        }

        .edit-mode .form-group {
            margin-bottom: 20px;
        }

        .edit-mode label {
            display: block;
            color: #666;
            margin-bottom: 5px;
        }

        .edit-mode input,
        .edit-mode select {
            width: 100%;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            font-size: 16px;
            background: transparent;
        }

        

       
    </style>
</head>
<body>
      <!-- View Mode -->
    <div id="viewMode">
    <?php 
    require './config/connection.php';
    
    // At the top of your PHP file
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE); // Hide warnings and notices but show other errors
    ini_set('display_errors', 0); // Don't display errors to the screen
    ini_set('log_errors', 1); // Enable error logging
    ini_set('error_log', 'path/to/error.log'); // Set path to error log file

        $id = $_GET['id'];
        if ($id) {
            $sql = "SELECT * FROM cattle WHERE id =$id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result))
        {
    ?>
    <header class="header">
        <a href="Cattle List.php" class="back-button">←</a>
        <h1><?php echo $row["cattlename"]; ?></h1>
    </header>

    <nav class="tabs">
        <a href="#" class="tab active">Profile</a>
        <a href="#" class="tab">Charts</a>
        <a href="#" class="tab">Logs</a>
    </nav>

    <div class="actions">
        <a class="btn btn-edit" onclick="toggleEditMode()">✎ Edit</a>
        <button class="btn btn-add">📅 Add Event</button>
    </div>

    <section class="section">
        <h2 class="section-title">Basic Details</h2>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">🐮</span>Cattle Type</span>
            <span class="detail-value"><?php echo $row["cattletype"]; ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">🐄</span>Breed</span>
            <span class="detail-value"><?php echo $row["breed"]; ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">🏠</span>Housing</span>
            <span class="detail-value">Tied-up</span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">📅</span>Date Of Birth</span>
            <span class="detail-value"><?php echo $row["Date_Of_Birth"]; ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">⏳</span>Age</span>
            <span class="detail-value"><?php

function calculateDetailedAge($birthdate) {
    $today = new DateTime();
    $birth = new DateTime($birthdate);
    $diff = $today->diff($birth);
    
    return [
        'years' => $diff->y,
        'months' => $diff->m,
        'days' => $diff->d
    ];
}

function formatAge($age) {
    $parts = [];
    if ($age['years'] > 0) {
        $parts[] = $age['years'] . ' year' . ($age['years'] > 1 ? 's' : '');
    }
    if ($age['months'] > 0) {
        $parts[] = $age['months'] . ' month' . ($age['months'] > 1 ? 's' : '');
    }
    if ($age['days'] > 0) {
        $parts[] = $age['days'] . ' day' . ($age['days'] > 1 ? 's' : '');
    }
    
    return implode(', ', $parts);
}
$birthdate = $row["Date_Of_Birth"]; // Format: YYYY-MM-DD
$age = calculateDetailedAge($birthdate);
echo "" . formatAge($age) . "\n";
?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">📊</span>Lifecycle Status</span>
            <span class="detail-value"><?php echo $row["lifecycle_Status"]; ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">🥛</span>Milking</span>
            <span class="detail-value"><?php echo $row["milking"]; ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">❤</span>Health</span>
            <span class="detail-value"><?php echo $row["Health_Status"]; ?></span>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">Reproduction Details</h2>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">🤰</span>Reproduction Status</span>
            <span class="detail-value"><?php echo $row["ReproductionStatus"]; ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">📅</span>Last Heat Date</span>
            <span class="detail-value"><?php echo $row["Lastheat"]; ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">💉</span>Last AI Date</span>
            <span class="detail-value"><?php echo $row["LastAI"]; ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">🔢</span>Days in Pregnancy</span>
            <span class="detail-value"><?php echo $row["cattlename"]; ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">📅</span>Dry Off Date</span>
            <span class="detail-value"><?php   echo $row['Dry Off Date'];?></span>
        </div>
        
    </section>

    <section class="section">
        <h2 class="section-title">Identification Details</h2>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">🆔</span>Pashu Aadhar Number</span>
            <span class="detail-value"><?php echo $row["PashuAadhar"]; ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">⚖</span>Weight</span>
            <span class="detail-value"><?php echo $row["Weight"]; ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">🏷</span>Identification Mark</span>
            <span class="detail-value"><?php echo $row["IdentificationMark"]; ?></span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label"><span class="icon">📱</span>Neck Tag RSN</span>
            <span class="detail-value attach-device">Coming Soon</span>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">Parents Details</h2>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">🐮</span>Dam (Mother)</span>
            <span class="detail-value"><?php echo $row["Mother"]; ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><span class="icon">🐮</span>Sire (Father)</span>
            <span class="detail-value"><?php echo $row["Father"]; ?></span>
        </div>
    </section>
    <?php
                }
            }
            else{
                echo "<h3>No found</h3>";
            }
            ?>
    </div>
    <!-- Edit Mode -->

    <div id="editMode" class="edit-mode">
    <header class="header">
        <a href="" class="back-button">←</a>   
        <h1>Edit Cattle Profile</h1>
    </header>
    
    <div class="container">
    <form action="" id="editForm" method="post" >
    <?php 
    require './config/connection.php';
    if (isset($_POST["edit"])) {
        $cattlename=$_POST["cattlename"];
        $cattletype=$_POST["cattletype"];
        $breed=$_POST["breed"];
    
        $bday=$_POST["bday"];
        $bmonth=$_POST["bmonth"];
        $byear=$_POST["byear"];
        $Date_Of_Birth="$byear-$bmonth-$bday";
    
        $lifecycle_Status=$_POST["lifecycle_Status"];
        $milking=$_POST["milking"];
        $Health_Status=$_POST["Health_Status"];
        $ReproductionStatus=$_POST["ReproductionStatus"];
    
        $hday=$_POST["hday"];
        $hmonth=$_POST["hmonth"];
        $hyear=$_POST["hyear"];
        $Lastheat="$hyear-$hmonth-$hday";
    
        $aiday=$_POST["aiday"];
        $aimonth=$_POST["aimonth"];
        $aiyear=$_POST["aiyear"];
        $LastAI="$aiyear-$aimonth-$aiday";
    
        $calvingday=$_POST["calvingday"];
        $calvingmonth=$_POST["calvingmonth"];
        $calvingyear=$_POST["calvingyear"];
        $Lastcalving="$calvingyear-$calvingmonth-$calvingday";
    
        $PashuAadhar=$_POST["PashuAadhar"];
        $Weight=$_POST["Weight"];
        $IdentificationMark=$_POST["IdentificationMark"];
        $Mother=$_POST["Mother"];
        $Father=$_POST["Father"];
        
        $sqlUpdate = "UPDATE cattle SET cattlename='$cattlename',cattletype='$cattletype',breed='$breed',Date_Of_Birth='$Date_Of_Birth',lifecycle_Status='$lifecycle_Status',milking='$milking',Health_Status='$Health_Status',ReproductionStatus='$ReproductionStatus',Lastheat='$Lastheat',LastAI='$LastAI',Lastcalving='$Lastcalving',PashuAadhar='$PashuAadhar',Weight='$Weight',IdentificationMark='$IdentificationMark',Mother='$Mother',Father='$Father' WHERE id='$id'";
        if(mysqli_query($conn,$sqlUpdate)){
    
        }else{
            die("Something went wrong");
        }
    }
        $id = $_GET['id'];
        if ($id) {
            $sql = "SELECT * FROM cattle WHERE id =$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        
        
    ?>
        <section class="section">
            <h2 class="section-title1">Basic Details</h2>
            <div class="form-group">
                <label class="form-label required">Cattle Name/No.</label>
                <input type="text" name="cattlename" class="form-control" value="<?php echo $row["cattlename"]; ?>">
            </div>
            <div class="form-group">
                <label class="form-label required">Cattle Type</label>
                <select class="form-control" name="cattletype">
                <option value="Cow" <?php if($row["cattletype"]=="Cow"){echo "selected";} ?>>Cow</option>
                <option value="Buffalo" <?php if($row["cattletype"]=="Buffalo"){echo "selected";} ?>>Buffalo</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label required">Breed</label>
                <select class="form-control" name="breed">
                    <option value="HF" <?php if($row["breed"]=="HF"){echo "selected";} ?>>HF</option>
                    <option value="HF Cross" <?php if($row["breed"]=="HF Cross"){echo "selected";} ?>>HF Cross</option>
                    <option value="Jersey" <?php if($row["breed"]=="Jersey"){echo "selected";} ?>>Jersey</option>
                    <option value="Jersey cross" <?php if($row["breed"]=="Jersey cross"){echo "selected";} ?>>Jersey Cross</option>
                    <option value="Gir" <?php if($row["breed"]=="Gir"){echo "selected";} ?>>Gir</option>
                    <option value="Sahiwal" <?php if($row["breed"]=="Sahiwal"){echo "selected";} ?>>Sahiwal</option>
                    <option>HF Cross</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label required">Housing Type</label>
                <select class="form-control">
                    <option>Tied-up</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Date Of Birth</label>
                <div class="date-group">
                    <input type="text" name="bday" class="form-control" value="<?php $date = $row['Date_Of_Birth'];
    echo $year = date('d', strtotime($date));?>" placeholder="DD">
                    <input type="text"  name="bmonth" class="form-control" value="<?php $date = $row['Date_Of_Birth'];
    echo $year = date('m', strtotime($date));?>" placeholder="MM">
                    <input type="text"  name="byear" class="form-control" value="<?php $date = $row['Date_Of_Birth'];
    echo $year = date('Y', strtotime($date));?>" placeholder="YYYY">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label required">Lifecycle Status</label>
                <select class="form-control" name="lifecycle_Status">

                            <option value="calf" <?php if($row["lifecycle_Status"]=="calf"){echo "selected";} ?>>Calf</option>
							<option value="heifer" <?php if($row["lifecycle_Status"]=="heifer"){echo "selected";} ?>>Heifer</option>
							<option value="adult" <?php if($row["lifecycle_Status"]=="adult"){echo "selected";} ?>>Adult</option>
							<option value="retired" <?php if($row["lifecycle_Status"]=="retired"){echo "selected";} ?>>Retired</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label required">Milking</label>
                <select class="form-control" name="milking">
                    <option value="" <?php if($row["milking"]==""){echo "selected";} ?>></option>
                    <option value="NO" <?php if($row["milking"]=="NO"){echo "selected";} ?>>NO</option>
                    <option value="lactating" <?php if($row["milking"]=="lactating"){echo "selected";} ?>>Lactating</option>
					<option value="dry" <?php if($row["milking"]=="dry"){echo "selected";} ?>>Dry</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Health Status</label>
                <select class="form-control" name="Health_Status">
                <option value="Good" <?php if($row["Health_Status"]=="Good"){echo "selected";} ?>>Good</option>
                <option value="Not Good" <?php if($row["Health_Status"]=="Not Good"){echo "selected";} ?>>Not Good</option>
                </select>
            </div>
        </section>

        <section class="section">
            <h2 class="section-title1">Reproduction Details</h2>
            <div class="form-group">
                <label class="form-label required">Reproduction Status</label>
                <select class="form-control" name="ReproductionStatus">
                <option value="Ready for Breeding" <?php if($row["ReproductionStatus"]=="Ready for Breeding"){echo "selected";} ?>>Ready for Breeding</option>
                <option value="open" <?php if($row["ReproductionStatus"]=="open"){echo "selected";} ?>>open</option>
                <option value="inseminated" <?php if($row["ReproductionStatus"]=="inseminated"){echo "selected";} ?>>Inseminated</option>
                <option value="pregnant" <?php if($row["ReproductionStatus"]=="pregnant"){echo "selected";} ?>>Pregnant</option>
                <option value="fresh" <?php if($row["ReproductionStatus"]=="fresh"){echo "selected";} ?>>fresh</option>
                <option value="NO" <?php if($row["ReproductionStatus"]=="NO"){echo "selected";} ?>>NO</option>
                <option value="" <?php if($row["ReproductionStatus"]==""){echo "selected";} ?>></option>

                </select>
            </div>
            <div class="form-group">
                <label class="form-label required">Date Of Last Heat</label>
                <div class="date-group">
                    
                <input type="text" name="hday" class="form-control" value="<?php $date = $row['Lastheat'];
    echo $year = date('d', strtotime($date));?>" placeholder="DD">
                    <input type="text" name="hmonth" class="form-control" value="<?php $date = $row['Lastheat'];
    echo $year = date('m', strtotime($date));?>" placeholder="MM">
                    <input type="text" name="hyear" class="form-control" value="<?php $date = $row['Lastheat'];
    echo $year = date('Y', strtotime($date));?>" placeholder="YYYY">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label required">Date Of Last AI</label>
                <div class="date-group">
                <input type="text" name="aiday" class="form-control" value="<?php $date = $row['LastAI'];
    echo $year = date('d', strtotime($date));?>" placeholder="DD">
                    <input type="text" name="aimonth" class="form-control" value="<?php $date = $row['LastAI'];
    echo $year = date('m', strtotime($date));?>" placeholder="MM">
                    <input type="text" name="aiyear" class="form-control" value="<?php $date = $row['LastAI'];
    echo $year = date('Y', strtotime($date));?>" placeholder="YYYY">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Date Of Last Calving</label>
                <div class="date-group">
                <input type="text" name="calvingday" class="form-control" value="<?php $date = $row['Lastcalving'];
    echo $year = date('d', strtotime($date));?>" placeholder="DD">
                    <input type="text" name="calvingmonth" class="form-control" value="<?php $date = $row['Lastcalving'];
    echo $year = date('m', strtotime($date));?>" placeholder="MM">
                    <input type="text" name="calvingyear" class="form-control" value="<?php $date = $row['Lastcalving'];
    echo $year = date('Y', strtotime($date));?>" placeholder="YYYY">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Date of Dry Off</label>
                <div class="date-group">
                <?php 
                     $inputDate =$row['	Dry Off Date'];
                     
                ?>
                <input type="text" class="form-control" value="<?php $date = $inputDate;
    echo $year = date('d', strtotime($date));?>" placeholder="DD">
                    <input type="text" class="form-control" value="<?php $date = $inputDate;
    echo $year = date('m', strtotime($date));?>" placeholder="MM">
                    <input type="text" class="form-control" value="<?php $date = $inputDate;
    echo $year = date('Y', strtotime($date));?>" placeholder="YYYY">  
                
                </div>
            </div>
        </section>
        <section class="section">
            <h2 class="section-title1">Identification Details</h2>
            <div class="form-group">
                <label class="form-label">Pashu Aadhar Number</label>
                <input type="text" name="PashuAadhar" value="<?php echo $row["PashuAadhar"]; ?>"  class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Weight</label>
                <input type="text" name="Weight" value="<?php echo $row["Weight"]; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Identification Mark</label>
                <input type="text" name="IdentificationMark" value="<?php echo $row["IdentificationMark"]; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Neck Tag RSN</label>
                <input type="text" value="Coming Soon" class="form-control">

            </div>
        </section>

        <section class="section">
            <h2 class="section-title1">Parents Details</h2>
            <div class="form-group">
                <label class="form-label">Dam (Mother)</label>
                <input type="text" name="Mother" value="<?php echo $row["Mother"]; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Sire (Father)</label>
                <input type="text" name="Father" value="<?php echo $row["Father"]; ?>" class="form-control">
            </div>
        </section>

        <button type="submit" form="editForm" name="edit" class="save-button">Save</button>
        <?php
                }
            else{
                echo "<h3>No found</h3>";
            }
            ?>
        </form>
    </div>

    </div>
    <script>
        function toggleEditMode() {
            document.getElementById('viewMode').style.display = 'none';
            document.getElementById('editMode').style.display = 'block';
        }

        // Simple tab functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
            });
        });
    </script>
</body>
</html>