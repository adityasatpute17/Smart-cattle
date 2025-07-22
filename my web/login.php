
           <?php
require './config/connection.php';
session_start();

if (isset($_POST['submit'])) {
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
    $passwordInput = filter_var($_POST['passwordInput'], FILTER_SANITIZE_STRING);
    $status='Active';

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE mobile_number = ? AND password = ? AND status = ?");
    $stmt->bind_param("sss", $mobile, $passwordInput, $status);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['number'] = $row['mobile_number'];
        $_SESSION['pass'] = $row['password'];
        header("Location: home.php");
    } else {
        echo "<div class='message' id='toast'><p>Invalid mobile number or password.!</p></div><br>";}
}
?>

           
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Login GauAmritpal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #fff;
            padding: 20px;
        }

        .container {
            max-width: 400px;
            margin: 15px auto;
        }

        h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 40px;
            line-height: 1.2;
        }

        .tabs {
            display: flex;
            background: #f5f5f5;
            border-radius: 50px;
            margin-bottom: 30px;
        }

        .tab {
            flex: 1;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            border-radius: 50px;
            font-weight: 500;
        }

        .tab.active {
            background: #ff6f1e;
            color: white;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 15px 0;
            border: none;
            border-bottom: 1px solid #ddd;
            outline: none;
            font-size: 16px;
        }

        .input-group input::placeholder {
            color: #999;
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

        .forgot-password {
            text-align: right;
            margin-bottom: 30px;
        }

        .forgot-password a {
            color: #000;
            text-decoration: none;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 50px;
            background: #ffe4d6;
            color: #ff6f1e;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 30px;
        }

        .signup-prompt {
            text-align: center;
            margin-bottom: 20px;
        }

        .signup-prompt a {
            color: #ff6f1e;
            text-decoration: none;
            font-weight: 500;
        }

        .terms {
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .terms a {
            color: #000;
            text-decoration: none;
        }

        #passwordSection {
            display: none;
        }

        .password-input {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }
        .input-label {
            color: #666;
            font-size: 16px;
            margin-bottom: 1px;
        }
        .send-otp {
            position: absolute;
            right: 0;
            bottom: 12px;
            color: #e67e22;
            font-weight: 500;
            display: none;
            cursor: pointer;
        }
        .message{
            text-align: center;
            padding: 15px 0px;
            border-radius: 5px;
            margin-bottom: 10px;
            color: red;
            position: fixed;
            width: 320px;
            margin-left: 30%;
            right: 30%;
            }   
    </style>
</head>
<body>

    <form action="" method="post">
    <div class="container">
        <h1>Log in to GauAmritpal</h1>
        
        <div class="tabs">
            <div class="tab" onclick="switchTab('otp')">OTP</div>
            <div class="tab active" onclick="switchTab('password')">Password</div>
        </div>

        <div class="input-group">
            <div class="input-label">Email ID / Mobile No.</div>
            <input type="text" placeholder="Mobile No." id="mobile" value="+91" name="mobile" maxlength="13" required>
            <div class="send-otp" id="sendOtp">Send OTP</div>
        </div>
        <div id="otpSection" style="display: none;">
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
        </div>

        <div id="passwordSection" style="display: block;">
           
            <div class="input-group password-input">
                <input type="text" placeholder="Password" id="passwordInput" name="passwordInput" required>
                <span class="password-toggle"><i class='bx bx-hide'></i></span>

            </div>
            <div class="forgot-password">
                <a href="#">Forgot Password?</a>
            </div>
        </div>

        <button type="submit" name="submit" class="login-btn">Log In</button>

        <div class="signup-prompt">
            New on GauAmritpal? <a href="sing up.php">Sign Up here</a>
        </div>

       
    </div>
  </form>

    <script>
        // Tab switching
        function switchTab(tab) {
            const tabs = document.querySelectorAll('.tab');
            const sendOtp = document.getElementById('sendOtp');
            const otpSection = document.getElementById('otpSection');
            const passwordSection = document.getElementById('passwordSection');

            tabs.forEach(t => t.classList.remove('active'));
            if (tab === 'otp') {
                tabs[0].classList.add('active');
                otpSection.style.display = 'block';
                sendOtp.style.display = 'none';
                passwordSection.style.display = 'none';
            } else {
                tabs[1].classList.add('active');
                otpSection.style.display = 'none';
                sendOtp.style.display = 'none';
                passwordSection.style.display = 'block';
            }
        }

        // OTP input handling
        const mobileInput = document.getElementById('mobile');
        const sendOtpButton = document.getElementById('sendOtp');
        const otpContainer = document.getElementById('otpContainer');
        const otpInputs1 = document.querySelectorAll('.otp-input');

        // Mobile number validation and Send OTP button visibility
        mobileInput.addEventListener('input', function() {
            if(this.value.length === 10 && /^\d+$/.test(this.value)) {
                sendOtpButton.style.display = 'block';
            } else {
                sendOtpButton.style.display = 'none';
            }
        });

        // Send OTP button click handler
        sendOtpButton.addEventListener('click', function() {
            otpInputs1[0].focus();
        });

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
        function closeToast() {
            document.getElementById('toast').style.display = 'none';
        }

        // Auto-hide toast after 10 seconds
        setTimeout(function() {
            closeToast();
        }, 10000);
    </script>

</body></html>