
<?php
require './config/connection.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['username'];
    $last_name = $_POST['userlname'];
    $mobile_number = $_POST['Mnumber'];
    $password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];
    $role='User';
    $status='Active';
        // Validate mobile number format (assuming Indian format)
    if (!preg_match("/^\+91[6-9]\d{9}$/", $mobile_number)) {
        echo "<div class='message' id='toast'>
        <p>Invalid mobile number format!</p>
    </div> <br>";
    }
    else{
    $sql = "SELECT mobile_number FROM users WHERE mobile_number='$mobile_number'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0) {
        echo "<div class='message' id='toast'>
        <p>This mobail is used, Try another One Please!</p>
    </div>
    <br>";
    }
    else{
        // Prepare and bind
        $insertQuery="INSERT INTO users (first_name, last_name, mobile_number, password,role,status) VALUES ('$first_name','$last_name','$mobile_number','$password','$role','$status')";
        if($conn->query($insertQuery)==TRUE){
            header("Location: login.php");
        }
        else{
            echo "Error:";
        }
    }
}
}

$conn->close();
?>
<script>
        function closeToast() {
            document.getElementById('toast').style.display = 'none';
        }

        // Auto-hide toast after 10 seconds
        setTimeout(function() {
            closeToast();
        }, 10000);
    </script>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up GauAmritpal</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background-color: #fff;
            max-width: 400px;
            margin: 1px auto;
        
        }
        h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 40px;
            line-height: 1.2;
        }

        .container {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 25px;
            width: 450px;
        }

        .form-group label {
            display: block;
            color: #666;
            margin-bottom: 5px;
            font-size: 16px;
        }

        .form-group input {
            width: 85%;
            padding: 8px 0;
            border: none;
            border-bottom: 1px solid #999;
            font-size: 16px;
            outline: none;

        }

        .verified-badge {
            color: #2E8B57;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
        }

        .verified-badge::before {
            content: "✓";
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: #2E8B57;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
        }

        .otp-container {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
        }

        

        .button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .button-primary {
            background-color: #FF7722;
            color: white;
        }

        .button-secondary {
            background-color: white;
            color: #FF7722;
            border: 1px solid #FF7722;
        }

      

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 0;
            left: 350px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            cursor: pointer;
            font-size: 20px;
        }

        .screen {
            display: none;
        }

        .screen.active {
            display: block;
        }

        
       

        .error-message {
            color: #FF0000;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }
        .otp-inputs {
            display: flex;
            gap: 10px;
            margin: 30px 0;
        }

        .otp-inputs input {
            width: 40px;
            height: 40px;
            text-align: center;
            border: none;
            border-bottom: 2px solid #ddd;
            font-size: 20px;
            outline: none;
        }
        .signup-prompt {
            text-align: center;
            margin-bottom: 20px;
            margin-top:10px
        }

        .signup-prompt a {
            color: #ff6f1e;
            text-decoration: none;
            font-weight: 500;
        }
        .message{
            text-align: center;
            padding: 15px 0px;
            border-radius: 5px;
            margin-bottom: 10px;
            color: red;
            position: fixed;
            width: 320px;
            }

    </style>
</head>
<body>

    <form action="" id="form" method="post">
        
    <!-- First Screen -->
    <div class="screen active" id="screen1">
        <div class="container">
            <h1>Sing up to <br>GauAmritpal</h1>
            <div style="display: flex; gap: 20px;">
                <div class="form-group" style="flex: 4;">
                    <label>First Name</label>
                    <input type="text" value="" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="form-group" style="flex: 4;">
                    <label>Last Name</label>
                    <input type="text" value="" name="userlname" id="userlname" autocomplete="off" required>
                </div>
            </div>

            <div class="form-group" style=" position: relative;">
                <label>Mobile Number</label>
                <span style=" position: absolute;
                right:100%;
                top: 50%;
                transform: translateY(20%);
                font-size: 15px;"></span>
                <span> </span>
                <input type="tel" value="+91" maxlength="13" name="Mnumber" id="Mnumber" autocomplete="off" required>
            <!--<div class="verified-badge">OTP Verified</div>-->
            </div>

            <div class="otp-inputs">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]">
 
            </div>

            <button type="button" class="button button-primary" onclick="showScreen('screen2')" style="margin-top: 110px;">Continue</button>

            <div class="signup-prompt">
                Already on GauAmritpal? <a href="login.php">Login  here</a>
            </div>
    
        </div>
    </div>

    <!-- Second Screen -->
    <div class="screen" id="screen2">
        <div class="container">
            <h1>Sing up to <br>GauAmritpal</h1>

            <h2 style="color: #666; margin-bottom: 30px;">Please create a password</h2>

            <div class="form-group">
                <div class="password-container">
                    <input type="password" id="newPassword" name="newPassword" autocomplete="off" placeholder="New Password" required>
                    <span class="password-toggle"><i class='bx bx-hide'></i></span>
                </div>
            </div>

            <div class="form-group">
                <div class="password-container">
                    <input type="password" id="confirmPassword" name="confirmPassword" autocomplete="off" placeholder="Confirm Password" required>
                    <span class="password-toggle"><i class='bx bx-hide'></i></span>
                </div>
            </div>
            <div id="passwordError" class="error-message">Passwords do not match</div>

            <div style="display: flex; gap: 20px; margin-top: 180px;">
                <button type="button" class="button button-secondary" onclick="showScreen('screen1')">Skip</button>
                <button type="submit" form="form" class="button button-primary" onclick="validateAndProceed()">Next</button>
            </div>

           
        </div>
    </div>
</form>

    <script>
        function showScreen(screenId) {
            document.querySelectorAll('.screen').forEach(screen => {
                screen.classList.remove('active');
            });
            document.getElementById(screenId).classList.add('active');
        }

        // Toggle password visibility
        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bx-hide');
                    icon.classList.add('bx-show');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bx-show');
                    icon.classList.add('bx-hide');
                }
            });
        });

        function validateAndProceed() {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const errorMessage = document.getElementById('passwordError');

            if (newPassword !== confirmPassword) {
                errorMessage.style.display = 'block';
            } 
        }
        const otpInputs = document.querySelectorAll('.otp-inputs input');
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (e.target.value) {
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });

    </script>
</body>
</html>