
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm setup</title>
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

        .back-arrow {
            font-size: 24px;
            color: white;
            text-decoration: none;
            cursor: pointer;
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
            color:rgb(255, 0, 0);
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

        

        .range-label {
            color: #666;
            font-size: 0.8rem;
        }
        .radio-group {
            display: flex;
            gap: 2rem;
            margin: 1rem 0;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        input[type="radio"] {
            width: 20px;
            height: 20px;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <a class="back-arrow">←</a>
        <h1>Farm setup</h1>
    </div>

    <div class="container">
        <form action="" id="setup" method="post">
        <?php 
require './config/connection.php';

// Fetch existing data
$sql = "SELECT * FROM farm_setup";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if (isset($_POST["Farmsetup"])) {
    $Lowmilkalert = $_POST["Low-milk-alert"];
    $milkingUnit = $_POST["milkingUnit"];
    $periodpostcalving = $_POST["period-post-calving"];
    $CalftoHeiferg = $_POST["Calf-to-Heiferg"];
    $PregnancyPeriod = $_POST["Pregnancy-Period"];
    $firstPregnancyCheck = $_POST["1st-Pregnancy-Check"];
    $secondPregnancyCheck = $_POST["2nd-Pregnancy-Check"];
    $Dryoffperiod = $_POST["Dry-off-period"];

    $update = "UPDATE farm_setup SET 
               Low_milk = '$Lowmilkalert',
               milkingUnit = '$milkingUnit',
               period_post_calving = '$periodpostcalving',
               Calf_to_Heiferg = '$CalftoHeiferg',
               Pregnancy_Period = '$PregnancyPeriod',
               1st_Pregnancy_Check = '$firstPregnancyCheck',
               2nd_Pregnancy_Check = '$secondPregnancyCheck',
               Dry_off_period = '$Dryoffperiod'";

    if (mysqli_query($conn, $update)) {
       
    } else {
        echo "<script>alert('Error updating farm setup:');</script>";
    }
}
?>
            <!-- Basic Details -->
            <div class="section">
                <h2 class="section-title">Milking</h2>
                
                <div class="form-group">
                    <label>Low milk yield alert</label>
                    <input type="number" class="form-control" name="Low-milk-alert" value="<?php echo $row["Low_milk"]; ?>"  >
                    <div class="range-label">% of 7-Days average yield</div>
                </div>

                <div class="form-group">
                    <label>Milking Unit</label>
                    <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="milkingUnit" <?php if($row["milkingUnit"]=="kg"){echo "checked";} ?> value="kg" >
                        <span>Kg</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="milkingUnit" <?php if($row["milkingUnit"]=="litres"){echo "checked";} ?> value="litres">
                        <span>Litres</span>
                    </label>
                </div>
                </div>
            </div>

            <!-- Lifecycle & Calving -->
            <div class="section">
                <h2 class="section-title">Lifecycle & Calving</h2>
                
                <div class="form-group">
                    <label>Wait period post calving</label>
                    <input type="number" class="form-control" name="period-post-calving" value="<?php echo $row["period_post_calving"]; ?>"   min="40" max="100">
                    <div class="range-label">45-100 Days</div>  
                </div>
                <div class="form-group">
                    <label>Calf to Heiferg</label>
                    <input type="number" class="form-control" name="Calf-to-Heiferg" value="<?php echo $row["Calf_to_Heiferg"]; ?>"   min="0" max="6">
                    <div class="range-label">0-6 Months</div>
                
                </div>
                
            </div>

            <!-- Pregnancy & Dry Off -->
            <div class="section">
                <h2 class="section-title">Pregnancy & Dry Off</h2>
                
                <div class="form-group">
                    <label>Pregnancy Period</label>
                    <input type="number" class="form-control" name="Pregnancy-Period" value="<?php echo $row["Pregnancy_Period"]; ?>"   min="265" max="300">
                    <div class="range-label">265-300 Days</div>
                </div>
                <div class="form-group">
                    <label>1st Pregnancy Check</label>
                    <input type="number" class="form-control" name="1st-Pregnancy-Check" value="<?php echo $row["1st_Pregnancy_Check"]; ?>"   min="40" max="75">
                    <div class="range-label">40-75 Days</div>
                </div>
                <div class="form-group">
                    <label>2nd Pregnancy Check</label>
                    <input type="number" class="form-control" name="2nd-Pregnancy-Check" value="<?php echo $row["2nd_Pregnancy_Check"]; ?>"   min="80" max="100">
                    <div class="range-label">80-100 Days</div>
                </div>

                <div class="form-group">
                    <label>Dry off period</label>
                    <input type="number" class="form-control" name="Dry-off-period" value="<?php echo $row["Dry_off_period"]; ?>"   min="30" max="250">
                    <div class="range-label">Days before calving due date 30-90 days</div>
                </div>

            </div>
            <button type="submit" form="setup" name="Farmsetup" class="save-button">Save</button>
        </form>
    </div>
    <script>
     // Back button functionality
        document.querySelector('.back-arrow').addEventListener('click', function() {
            // You can change this to your actual back navigation logic
            window.history.back();
        });</script>
</body>
</html>