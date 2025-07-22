<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        
        body {
            background-color: #ffffff;
            min-height: 100vh;
        }
        
        .header {
            background-color: #FF6B00;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .back-button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 24px;
            display: flex;
            align-items: center;
        }
        
        .header-title {
            color: white;
            font-size: 18px;
            font-weight: 500;
        }
        
        .main-content {
            padding: 16px;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .page-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 24px;
        }
        
        .form-group {
            margin-bottom: 24px;
            position: relative;
        }
        
        .form-control {
            width: 100%;
            padding: 8px 0;
            border: none;
            border-bottom: 1px solid #ccc;
            font-size: 16px;
            outline: none;
            padding-right: 40px;
        }
        
        .form-control:focus {
            border-bottom-color: #000;
        }
        
        .toggle-password {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
        }
        
        .password-guidelines {
            margin-top: 32px;
            margin-bottom: 32px;
        }
        
        .password-guidelines h2 {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .password-guidelines ul {
            list-style-type: none;
        }
        
        .password-guidelines li {
            font-size: 14px;
            color: #666;
            margin-bottom: 4px;
        }
        
        .submit-button {
            width: 100%;
            padding: 16px;
            background-color: #FFE5D1;
            border: none;
            border-radius: 24px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .submit-button:hover {
            background-color: #FFD6B8;
        }
        
        .alert {
            padding: 12px;
            margin-bottom: 16px;
            border-radius: 4px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <header class="header">
        <button class="back-button" onclick="history.back()">
            &larr;

        </button>
        <h1 class="header-title">Change Password</h1>
    </header>

    <main class="main-content">
        <h1 class="page-title">Change Password</h1>

        <?php
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cowfarm";
        $conn = null;
        session_start();
        // Process form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mobileNumber = $_SESSION['number'];
            $currentPassword = $_POST["currentPassword"];
            $newPassword = $_POST["newPassword"];
            $confirmPassword = $_POST["confirmPassword"];
            $error = "";
            $success = "";

            // Validate passwords match
            if ($newPassword !== $confirmPassword) {
                $error = "New passwords do not match";
            } 
            // Validate password requirements
            elseif (strlen($newPassword) < 6 || strlen($newPassword) > 15) {
                $error = "Password must be between 6 and 15 characters";
            }
            elseif (!preg_match('/[A-Z]/', $newPassword) || !preg_match('/[a-z]/', $newPassword)) {
                $error = "Password must contain at least one uppercase and one lowercase letter";
            }
            elseif (!preg_match('/[0-9]/', $newPassword)) {
                $error = "Password must contain at least one number";
            }
            elseif (!preg_match('/[^A-Za-z0-9]/', $newPassword)) {
                $error = "Password must contain at least one special character";
            }
            else {
                try {
                    // Create database connection
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    // Set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    // Verify current password
                    $stmt = $conn->prepare("SELECT password FROM users WHERE mobile_number = :mobile");
                    $stmt->bindParam(':mobile', $mobileNumber);
                    $stmt->execute();
                    
                    if ($stmt->rowCount() > 0) {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $storedPassword = $row['password'];
                        
                        // Verify if current password matches stored password
                        // Note: In a real application, you should use password_verify() if passwords are hashed
                        if ($currentPassword == $storedPassword) {
                            // Update password
                            $updateStmt = $conn->prepare("UPDATE users SET password = :newPassword WHERE mobile_number = :mobile");
                            $updateStmt->bindParam(':newPassword', $newPassword);
                            $updateStmt->bindParam(':mobile', $mobileNumber);
                            $updateStmt->execute();
                            
                            $success = "Password changed successfully";
                        } else {
                            $error = "Current password is incorrect";
                        }
                    } else {
                        $error = "Mobile number not found";
                    }
                } catch(PDOException $e) {
                    $error = "Database error: " . $e->getMessage();
                }
                
                // Close connection
                $conn = null;
            }

            // Display error or success message
            if (!empty($error)) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
            if (!empty($success)) {
                echo '<div class="alert alert-success">' . $success . '</div>';
            }
        }
        ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <input type="password" id="currentPassword" name="currentPassword" class="form-control" placeholder="Current Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword('currentPassword')">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </button>
            </div>
            
            <div class="form-group">
                <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="New Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword('newPassword')">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </button>
            </div>
            
            <div class="form-group">
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword('confirmPassword')">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </button>
            </div>

            <div class="password-guidelines">
                <h2>Password Guidelines</h2>
                <ul>
                    <li>1. At least 6 and max 15 characters</li>
                    <li>2. At least one upper and one lower case letter</li>
                    <li>3. At least one numeral</li>
                    <li>4. At least one special character</li>
                    <li>5. Should not contain frequently used words like your name</li>
                </ul>
            </div>

            <button type="submit" class="submit-button">Submit</button>
        </form>
    </main>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const button = input.nextElementSibling;
            
            if (input.type === "password") {
                input.type = "text";
                button.innerHTML = `
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                `;
            } else {
                input.type = "password";
                button.innerHTML = `
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                `;
            }
        }
    </script>
</body>
</html>