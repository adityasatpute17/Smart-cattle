<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cowfarm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM farm_setup";
$res = mysqli_query($conn, $sql);
$ro = mysqli_fetch_array($res);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Initialize variables
$currentDate = isset($_SESSION['currentDate']) ? $_SESSION['currentDate'] : date('Y-m-d');
$message = '';
$messageClass = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
       
        if ($_POST['action'] == 'changeDate') {
            $currentDate = $_POST['date'];
            $_SESSION['currentDate'] = $currentDate;
            $newDate = $_POST['date'];
            // Check if the new date has been submitted before
            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM milk_records WHERE date = ?");
            $stmt->bind_param("s", $newDate);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($row['count'] == 0) {
                $currentDate = $newDate;
                $_SESSION['currentDate'] = $currentDate;
            } else {
                $message = "Cannot change to a date that has already been submitted.";
                $messageClass = "error";
            }
            $stmt->close();
        } elseif ($_POST['action'] == 'save') {
            try {
                // Check if records already exist for this date
                $checkStmt = $conn->prepare("SELECT COUNT(*) as count FROM milk_records WHERE date = ?");
                $checkStmt->bind_param("s", $currentDate);
                $checkStmt->execute();
                $result = $checkStmt->get_result();
                $row = $result->fetch_assoc();
                $recordsExist = $row['count'] > 0;
                $checkStmt->close();
                
                if (!$recordsExist) {
                    $stmt = $conn->prepare("INSERT INTO milk_records (date, cattle_id, session1, session2) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("sidd", $date, $cattle_id, $session1, $session2);

                    $date = $currentDate;
                    $success = true;

                    $conn->begin_transaction();

                    foreach ($_POST['cattle'] as $cattle_id => $sessions) {
                        $session1 = floatval($sessions['session1']);
                        $session2 = floatval($sessions['session2']);

                        if (!$stmt->execute()) {
                            $success = false;
                            break;
                        }
                    }

                    if ($success) {
                        $conn->commit();
                        $message = "Records saved successfully";
                        $messageClass = "success";
                    } else {
                        $conn->rollback();
                        $message = "Failed to save records: " . $stmt->error;
                        $messageClass = "error";
                    }

                    $stmt->close();
                } else {
                    $message = "Records for this date already exist and cannot be modified.";
                    $messageClass = "error";
                }
            } catch (Exception $e) {
                $conn->rollback();
                $message = "Error: " . $e->getMessage();
                $messageClass = "error";
            }
        }
    }
}

// Check if the milk_records table exists
$tableCheckQuery = "SHOW TABLES LIKE 'milk_records'";
$tableExists = $conn->query($tableCheckQuery)->num_rows > 0;

if (!$tableExists) {
    // Create the milk_records table if it doesn't exist
    $createTableQuery = "CREATE TABLE milk_records (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        date DATE NOT NULL,
        cattle_id INT(11) NOT NULL,
        session1 DECIMAL(10,2) NOT NULL DEFAULT 0,
        session2 DECIMAL(10,2) NOT NULL DEFAULT 0,
        UNIQUE KEY date_cattle (date, cattle_id)
    )";
    
    if ($conn->query($createTableQuery) === TRUE) {
        $message = "milk_records table created successfully";
        $messageClass = "success";
    } else {
        $message = "Error creating milk_records table: " . $conn->error;
        $messageClass = "error";
    }
}

// Fetch cattle data
$cattleData = [];
$result = $conn->query("SELECT id, cattlename FROM cattle WHERE milking='lactating'");
$totalCount = mysqli_num_rows($result);
while ($row = $result->fetch_assoc()) {
    $cattleData[] = $row;
}

// Fetch milk records for the current date
$milkRecords = [];
$stmt = $conn->prepare("SELECT cattle_id, session1, session2 FROM milk_records WHERE date = ?");
$stmt->bind_param("s", $currentDate);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $milkRecords[$row['cattle_id']] = $row;
}
$stmt->close();

// Check if records exist for the current date
$recordsExist = !empty($milkRecords);

// Close the database connection
$conn->close();

// Helper function to generate date navigation
function generateDateNav($currentDate) {
    $output = '';
    $today = new DateTime();
    $current = new DateTime($currentDate);
    $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    for ($i = 0; $i < 6; $i++) {
        $date = clone $today;
        $date->modify("-$i days");
        $dateString = $date->format('Y-m-d');
        $isActive = $dateString === $currentDate ? ' activee' : '';
        $dayName = $i === 0 ? 'Today' : $days[$date->format('w')];

        $output .= "
        <div class='date-item{$isActive}'>
            <form method='post'>
                <input type='hidden' name='action' value='changeDate'>
                <input type='hidden' name='date' value='{$dateString}'>
                <button type='submit' class='date-button'>
                    <div class='day'>{$dayName}</div>
                    <div class='date'>{$date->format('d')}</div>
                </button>
            </form>
        </div>";
    }

    return $output;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="style/stylehome.css">
    <link rel="stylesheet" href="style/stylesnev.css">
    
        
    <!-- ===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    

    <title>Milk Entry</title>
    <style>
            .div{
        padding-top:80px;
    }
    .frm{
        padding-bottom: 30px;
    }
    .date-nav {
        display: flex;
        justify-content: space-around;
        padding: 15px;
        border-bottom: 1px solid #ddd;
        background: white;
    }

    .date-item {
        text-align: center;
    }

    .date-button {
        background: none;
        border: none;
        cursor: pointer;
        font-family: inherit;
        
    }
    .activee .day, .activee .date {
        color: #FF6B00;
        
    }

    .activee {
        position: relative;
    }
    .activee::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #FF6B00;
    }

    .day {
        color: #666;
        font-size: 0.9em;
    }

    .date {
        font-size: 1.2em;
        font-weight: bold;
    }
    .search-container {
       
        
       left: 0;
       right: 0;
       padding-top:10px;
   }

   .search-bar {
       background-color: white;
       border-radius: 25px;
       padding: 12px 20px;
       display: flex;
       align-items: center;
       box-shadow: 0 2px 4px rgba(0,0,0,0.1);
   }

   .search-bar input {
       border: none;
       flex: 1;
       margin: 0 12px;
       font-size: 16px;
       outline: none;
   }

.table-container {
        margin-top: 10px;
        background: white;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background-color: #FF6B00;
        color: white;
        padding: 12px;
        text-align: left;
    }

    td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    .total-column {
        background-color: #e8f5e9;
    }

    .summary-row {
        font-weight: bold;
    }

           .session-input {
        width: 50px;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-align: center;
    }

    .session-input:focus {
        outline: none;
        border-color: #FF6B00;
    }

    .save-button {
        background-color: #FF6B00;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
    }

    .save-button:hover {
        background-color: #e65c00;
    }

    .message {
        margin-top: 10px;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        
    }
    .messagealt{
        padding-bottom:30px;
    }
    .success {
        background-color: #d4edda;
        color: #155724;
    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
    }

    .readonly-input {
        background-color: #f0f0f0;
        color: #666;
        cursor: not-allowed;
    }

    </style>
</head>
<body>
   
<nav1>
        <div class="nav-bar1">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">GauAmritpal</a></span>

            <div class="menu1">
                
                    <div class="header1">
                        <h1>My Account</h1>
                        <i class='bx bx-x siderbarClose'></i>
                    </div>
                    <div class="menu-container">
                         <a href="profile.php">

                        <div class="menu-item">
                            <div class="icon1">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                            <span class="menu-item-text">My Profile</span>
                            <span class="arrow">›</span>
                        </div>
                    </a>
                
                        <div class="menu-item">
                            <div class="icon1">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12.87 15.07l-2.54-2.51.03-.03c1.74-1.94 2.98-4.17 3.71-6.53H17V4h-7V2H8v2H1v1.99h11.17C11.5 7.92 10.44 9.75 9 11.35 8.07 10.32 7.3 9.19 6.69 8h-2c.73 1.63 1.73 3.17 2.98 4.56l-5.09 5.02L4 19l5-5 3.11 3.11.76-2.04zM18.5 10h-2L12 22h2l1.12-3h4.75L21 22h2l-4.5-12zm-2.62 7l1.62-4.33L19.12 17h-3.24z"/>
                                </svg>
                            </div>
                            <span class="menu-item-text">Language</span>
                            <span class="arrow">›</span>
                        </div>
                        <a href="pass change.php">
                        <div class="menu-item">
                            <div class="icon1">
                                <svg viewBox="0 0 24 24">
                                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                                </svg>
                            </div>
                            <span class="menu-item-text">Change Password</span>
                            <span class="arrow">›</span>
                        </div>
                        </a>
                
                        <a href="Farm setup.php"><div class="menu-item">
                            <div class="icon1">
                                <svg viewBox="0 0 24 24">
                                    <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.07.63-.07.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/>
                                </svg>
                            </div>
                            <span class="menu-item-text">Farm Settings</span>
                            <span class="arrow">›</span>
                        </div></a>
                
                        <div class="menu-item">
                            <div class="icon1">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                </svg>
                            </div>
                            <span class="menu-item-text">About JioGauSamriddhi</span>
                            <span class="arrow">›</span>
                        </div>
                
                        <div class="menu-item">
                            <div class="icon1">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
                                </svg>
                            </div>
                            <span class="menu-item-text">Help & Support</span>
                            <span class="arrow">›</span>
                        </div>
                
                        <div class="menu-item">
                            <div class="icon1">
                                <svg viewBox="0 0 24 24">
                                    <path d="M13 3h-2v10h2V3zm4.83 2.17l-1.42 1.42C17.99 7.86 19 9.81 19 12c0 3.87-3.13 7-7 7s-7-3.13-7-7c0-2.19 1.01-4.14 2.58-5.42L6.17 5.17C4.23 6.82 3 9.26 3 12c0 4.97 4.03 9 9 9s9-4.03 9-9c0-2.74-1.23-5.18-3.17-6.83z"/>
                                </svg>
                            </div>
                            <span class="menu-item-text">Log Out</span>
                            <span class="arrow">›</span>
                        </div>
                    </div>

                
            </div>
            <div class="darkLight-searchBox">
                
           
                <div class="searchBox">
                   
                </div>
            </div>
            
        </div>
    </nav1>
    <body class="div">
        
         <div class="date-nav">
        <?php echo generateDateNav($currentDate); ?>
    </div>
    <div class="search-container">
        <div class="search-bar">
            <span>🔍</span>
            <input type="text" placeholder="Search In  Cattle" id="searchInput">
            
        </div>
    </div>

    <form method="post" class="frm">
        <input type="hidden" name="action" value="save">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Cattle</th>
                        <th>Session1</th>
                        <th>Session2</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="cattleTableBody">
                    <?php
                    $session1Total = 0;
                    $session2Total = 0;
                    $grandTotal = 0;

                    foreach ($cattleData as $cattle) {
                        $record = isset($milkRecords[$cattle['id']]) ? $milkRecords[$cattle['id']] : ['session1' => 0, 'session2' => 0];
                        $total = $record['session1'] + $record['session2'];
                        $session1Total += $record['session1'];
                        $session2Total += $record['session2'];
                        $grandTotal += $total;

                        $readonlyClass = $recordsExist ? 'readonly-input' : '';
                        $readonlyAttr = $recordsExist ? 'readonly' : '';

                        echo "
                        <tr>
                            <td>{$cattle['cattlename']}</td>
                            <td><input type='number' class='session-input {$readonlyClass}' name='cattle[{$cattle['id']}][session1]' value='{$record['session1']}' min='0' step='0.1' {$readonlyAttr}></td>
                            <td><input type='number' class='session-input {$readonlyClass}' name='cattle[{$cattle['id']}][session2]' value='{$record['session2']}' min='0' step='0.1' {$readonlyAttr}></td>
                            <td class='total-column'>{$total}.$ro[milkingUnit]</td>
                        </tr>";
                    }
                    ?>
                    <tr class="summary-row">
                        <td style="background-color: #FF6B00;
            color: white;">Total Cattle</td>
                        <td colspan="2" style="background-color: #FF6B00;
            color: white;">Totalsession</td>
                        
                        <td style="background-color: #FF6B00;
                        color: white; text-align:center;">Total</td>
                    </tr>
                    <tr class="summary-row">
                        <td><?php 
                             echo $totalCount;
                            ?></td>
                        <td id="session1Total"><?php echo $session1Total; ?></td>
                        <td id="session2Total"><?php echo $session2Total; ?></td>
                        <td class="total-column" id="grandTotal"><?php echo $grandTotal; ?>.<?php echo $ro["milkingUnit"];?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php if (!$recordsExist): ?>
        <button type="submit" class="save-button">Save</button>
        <?php endif; ?>
    </form>
    <div class="messagealt">
    <?php if ($message): ?>
        <div class="message <?php echo $messageClass; ?>"><?php echo $message; ?></div>
    <?php endif; ?>
    </div>

</body>
    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#cattleTableBody tr:not(.summary-row)');
            let session1Total = 0;
            let session2Total = 0;
            let grandTotal = 0;

            rows.forEach(row => {
                const cattleName = row.querySelector('td:first-child').textContent.toLowerCase();
                const display = cattleName.includes(searchTerm) ? '' : 'none';
                row.style.display = display;

                if (display === '') {
                    const session1 = parseFloat(row.querySelector('input[name$="[session1]"]').value) || 0;
                    const session2 = parseFloat(row.querySelector('input[name$="[session2]"]').value) || 0;
                    session1Total += session1;
                    session2Total += session2;
                    grandTotal += session1 + session2;
                }
            });

            document.getElementById('session1Total').textContent = session1Total.toFixed(1);
            document.getElementById('session2Total').textContent = session2Total.toFixed(1);
            document.getElementById('grandTotal').textContent = grandTotal.toFixed(1) + '.<?php echo $ro["milkingUnit"];?>';
        });

        // Update totals on input change
        document.querySelectorAll('.session-input').forEach(input => {
            input.addEventListener('input', updateTotals);
        });

        function updateTotals() {
            let session1Total = 0;
            let session2Total = 0;
            let grandTotal = 0;

            document.querySelectorAll('#cattleTableBody tr:not(.summary-row)').forEach(row => {
                if (row.style.display !== 'none') {
                    const session1Input = row.querySelector('input[name$="[session1]"]');
                    const session2Input = row.querySelector('input[name$="[session2]"]');
                    const session1Value = parseFloat(session1Input.value) || 0;
                    const session2Value = parseFloat(session2Input.value) || 0;
                    const rowTotal = session1Value + session2Value;

                    session1Total += session1Value;
                    session2Total += session2Value;
                    grandTotal += rowTotal;

                    row.querySelector('.total-column').textContent = rowTotal.toFixed(1) + '.<?php echo $ro["milkingUnit"];?>';
                }
            });

            document.getElementById('session1Total').textContent = session1Total.toFixed(1);
            document.getElementById('session2Total').textContent = session2Total.toFixed(1);
            document.getElementById('grandTotal').textContent = grandTotal.toFixed(1) + '.<?php echo $ro["milkingUnit"];?>';
        }
    </script>
    
    <header class="header" id="header">
            <nav class="nav container">
                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="Milk Entry.php" class="nav__link active-link">
                                <i class='bx bx-book-alt nav__icon'></i>
                                <span class="nav__name">Milk Entry</span>
                            </a>
                        </li>
                        
                        <li class="nav__item">
                            <a href="chart.html" class="nav__link">
                                <i class='bx bx-line-chart nav__icon'></i>
                                <span class="nav__name">Chart</span>
                            </a>
                        </li>

                        <li class="nav__item">
                            <a href="home.php" class="nav__link ">
                                <i class='bx bx-home-alt nav__icon'></i>
                                <span class="nav__name">Dashbord</span>
                            </a>
                            
                        </li>

                        <li class="nav__item">
                            <a href="Cattle List.php" class="nav__link">
                                <i class='bx bx-message-square-detail nav__icon'></i>
                                <span class="nav__name">Cattle List</span>
                            </a>
                        </li>
                        
                        <li class="nav__item">
                            <a href="Alerts.php" class="nav__link">
                                <i class='bx bx-bell nav__icon'></i>
                                <span class="nav__name">Alerts</span>
                            </a>
                            <?php include 'Alert/alt.php';?>
                        </li>
                    </ul>
                </div>

               
            </nav>
        </header>
     <script>const body = document.querySelector("body"),
      nav1 = document.querySelector("nav1"),
      searchToggle = document.querySelector(".searchToggle"),
      sidebarOpen = document.querySelector(".sidebarOpen"),
      siderbarClose = document.querySelector(".siderbarClose");

 
      
   //js code to toggle sidebar
sidebarOpen.addEventListener("click" , () =>{
    nav1.classList.add("active");
});

body.addEventListener("click" , e =>{
    let clickedElm = e.target;

    if(!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("menu1")){
        nav1.classList.remove("active");
    }
});</script>
     
     
</body>
</html>