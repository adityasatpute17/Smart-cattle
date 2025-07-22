<?php   
    		require './config/connection.php';
            session_start();
            $num=$_SESSION['number'];
            $sql = "SELECT * FROM users WHERE 	mobile_number ='$num'";
            $resultt = mysqli_query($conn, $sql);  
            $roww = mysqli_fetch_assoc($resultt);
       
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit My Profile</title>
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
            gap: 12px;
        }
        
        .back-button {
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
            font-size: 24px;
            display: flex;
            align-items: center;
        }
        
        .header-title {
            color: #333;
            font-size: 18px;
            font-weight: 500;
        }
        
        .main-content {
            padding: 16px;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .form-group {
            margin-bottom: 24px;
            position: relative;
        }
        
        .form-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 4px;
            display: block;
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
        
        .edit-button {
            position: absolute;
            right: 0;
            bottom: 8px;
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
        }
        
        .delete-account {
            margin-top: 32px;
            padding: 16px 0;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .delete-text {
            color: #FF0000;
            font-size: 16px;
        }
        
        .delete-icon {
            color: #FF0000;
            cursor: pointer;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 20% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 400px;
        }
        
        .modal-title {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 16px;
        }
        
        .modal-input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }
        
        .modal-button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .cancel-button {
            background-color: #f2f2f2;
        }
        
        .save-button {
            background-color: #FF6B00;
            color: white;
        }
        
        .delete-modal-content {
            text-align: center;
        }
        
        .delete-modal-buttons {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 24px;
        }
        
        .delete-confirm-button {
            background-color: #FF0000;
            color: white;
        }
    </style>
</head>
<body>
    <header class="header">
        <button class="back-button" onclick="history.back()">
            &larr;
        </button>
        <h1 class="header-title">Edit My Profile</h1>
    </header>

    <main class="main-content">
        <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" id="fullName" class="form-control" value="<?php echo $roww['first_name']; echo $roww['last_name'];?>" readonly>
            <button class="edit-button" onclick="openEditModal('fullName', 'Full Name')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                </svg>
            </button>
        </div>
        
        <div class="form-group">
            <label class="form-label">Mobile No.</label>
            <input type="tel" id="mobileNo" class="form-control" value="<?php echo $_SESSION['number'];?>" readonly>
            <button class="edit-button" onclick="openEditModal('mobileNo', 'Mobile No.')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                </svg>
            </button>
        </div>
        
        <div class="delete-account">
            <span class="delete-text">Delete account</span>
            <button class="delete-icon" onclick="openDeleteModal()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
            </button>
        </div>
    </main>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h2 class="modal-title" id="modalTitle">Edit Field</h2>
            <input type="text" id="modalInput" class="modal-input">
            <div class="modal-buttons">
                <button class="modal-button cancel-button" onclick="closeEditModal()">Cancel</button>
                <button class="modal-button save-button" onclick="saveEdit()">Save</button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content delete-modal-content">
            <h2 class="modal-title">Delete Account</h2>
            <p>Are you sure you want to delete your account? This action cannot be undone.</p>
            <div class="delete-modal-buttons">
                <button class="modal-button cancel-button" onclick="closeDeleteModal()">Cancel</button>
                <button class="modal-button delete-confirm-button" onclick="deleteAccount()">Delete</button>
            </div>
        </div>
    </div>

    <script>
        let currentField = '';
        
        function openEditModal(fieldId, fieldName) {
            currentField = fieldId;
            document.getElementById('modalTitle').textContent = 'Edit ' + fieldName;
            document.getElementById('modalInput').value = document.getElementById(fieldId).value;
            document.getElementById('editModal').style.display = 'block';
        }
        
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
        
        function saveEdit() {
            const newValue = document.getElementById('modalInput').value;
            document.getElementById(currentField).value = newValue;
            
            // Here you would typically send an AJAX request to update the value in the database
            // For demonstration, we'll just simulate it with a PHP comment
            /*
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $field = $_POST["field"];
                $value = $_POST["value"];
                
                // Database connection
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "cowfarm";
                
                $conn = new mysqli($servername, $username, $password, $dbname);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Update the field
                $sql = "UPDATE users SET " . $field . " = '" . $value . "' WHERE mobile_number ='$num'";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
                
                $conn->close();
            }
            ?>
            */
            
            closeEditModal();
        }
        
        function openDeleteModal() {
            document.getElementById('deleteModal').style.display = 'block';
        }
        
        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }
        
        function deleteAccount() {
            // Here you would typically send an AJAX request to delete the account
            // For demonstration, we'll just simulate it with a PHP comment
            /*
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
                // Database connection
                $servername = "localhost";
                $username = "username";
                $password = "password";
                $dbname = "myDB";
                
                $conn = new mysqli($servername, $username, $password, $dbname);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Delete the account
                $sql = "DELETE FROM users WHERE id = 1";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Account deleted successfully";
                    // Redirect to login page
                    header("Location: login.php");
                } else {
                    echo "Error deleting account: " . $conn->error;
                }
                
                $conn->close();
            }
            ?>
            */
            
            alert("Account deleted successfully!");
            // In a real application, you would redirect to the login page
            window.location.href = "index.php";
        }
        
        // Close the modal if the user clicks outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById('editModal')) {
                closeEditModal();
            }
            if (event.target == document.getElementById('deleteModal')) {
                closeDeleteModal();
            }
        }
    </script>
</body>
</html>