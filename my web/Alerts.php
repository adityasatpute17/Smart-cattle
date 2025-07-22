<?php   
      require './config/connection.php';
      session_start();
       // At the top of your PHP file
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE); // Hide warnings and notices but show other errors
    ini_set('display_errors', 0); // Don't display errors to the screen
    ini_set('log_errors', 1); // Enable error logging
    ini_set('error_log', 'path/to/error.log'); // Set path to error log file
      
            
       
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
        <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding: top 21px;
        }
        .main-tabs {
            background-color: #CC4E00;
            padding: 1rem;
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            gap: 3rem;
            padding-top:80px;
            position: fixed;
            width: 100%;
            z-index: 99;
            font-weight: bold;

        
        }

        .main-tabs span {
            color: white;
            font-size: 1rem;
            cursor: pointer;
            
        }

        .main-tabs span.active {
                color: #000;
        }

        .sub-tabs {
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
            padding-top: 130px;
            position: fixed;
            width: 100%;
            z-index: 9;
            
        }

        .tab {
           
            border-radius: 20px;
            border: 1px solid #ddd;
            cursor: pointer;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 9999px;
            
            
        }

        .tab.active {
            background-color: #FFE4E1;
            color: #FF7F27;
        }

        .arrow {
            font-size: 1.5rem;
            color: #666;
            cursor: pointer;
        }

        .content {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #FFF5F2;
            min-height: calc(100vh - 112px);
            padding-top: 200px;
        }

        .alert-icon {
            width: 120px;
            height: 120px;
            background-color: #FF7F27;
            border-radius: 50%;
            position: relative;
            margin-bottom: 1rem;
        }

        .no-alerts {
            text-align: center;
            font-size: 1.2rem;
            color: #333;
            margin-top: 1rem;
        }

        .section {
            display: none;
        }

        .section.active {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        /* Heat monitoring cards styles */
        .heat-cards {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 1rem;
        }

        .heat-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .heat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .cow-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .cow-icon {
            width: 40px;
            height: 40px;
            background: #FFF5F2;
            border-color:rgb(0, 0, 0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            
        }

        .cow-name {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .take-action-btn {
            background: #FF7F27;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 24px;
            border: none;
            cursor: pointer;
        }

        .metrics {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .metric {
            text-align: center;
        }

        .metric-value {
            color: #4CAF50;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .metric-label {
            color: #666;
            font-size: 0.875rem;
        }

        .gauge {
            height: 8px;
            background: #eee;
            border-radius: 4px;
            position: relative;
            overflow: hidden;
        }

        .gauge-sections {
            display: flex;
            height: 100%;
            width: 100%;
        }

        .gauge-section {
            height: 100%;
            flex: 1;
        }

        .gauge-section.grey { background: #E0E0E0; }
        .gauge-section.green { background: #4CAF50; }
        .gauge-section.yellow { background: #FFC107; }
        .gauge-section.red { background: #F44336; }

        .gauge-pointer {
            position: absolute;
            top: -4px;
            left: 95%;
            width: 0;
            height: 0;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-top: 8px solid #000;
        }

        .instructions {
            max-width: 600px;
            width: 90%;
            margin: 0 auto;
        }

        .instructions h2 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .instructions ol {
            list-style-position: outside;
            padding-left: 1.5rem;
        }

        .instructions li {
            color: #333;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        .sub-tabs span 
        {
            display: inline-block;
            user-select: none;
            white-space: nowrap;
        }
        .sub-tabs 
        {
            list-style: none;
            overflow-x: scroll;
            -ms-overflow-style: none;
            scrollbar-width: none;
            scroll-behavior: smooth;
            
            
        }
        .badge {
            background-color: #FF6B3D;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            vertical-align: middle;
            text-align: center;
            
        }
        .modal-content {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
       
        .modal-content {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }
  
  .modal {
    position: fixed;
    top: 60%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 20px;
    border-radius: 12px;
    width: 90%;
    max-width: 400px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }
  
  .modal-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
  }
  
  .modal-button {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: white;
    cursor: pointer;
  }
  
  .modal-button.primary {
    background: #ff8c00;
    color: white;
    border: none;
  }
  .close {
            position: absolute;
            right: 24px;
            top: 8px;
            font-size: 24px;
            color: #ff6b00;
            cursor: pointer;
            background: none;
            border: none;
        }
  
       
    </style>

    <title>Alerts</title>
</head>
<>
   
    <nav1>
        <div class="nav-bar1">
            <i class='bx bx-menu sidebarOpen' ></i>
            <div class="logo navLogo"><a href="#">GauAmritpal</a></div>

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
                
            
            </div>
        </div>
    </nav1>
    <nav class="main-tabs">
        <span data-section="reproduction" class="active">Reproduction</span>
        <span data-section="milk">Milk</span>
        <span data-section="vaccination">Vaccination due</span>
        <span data-section="health">Health</span>
    </nav>

    <!-- Reproduction Section -->
    <section id="reproduction" class="section active">
        <div class="sub-tabs">
            <div class="tab" data-tab="heat">Heat<span class="badge">1</span></div>
            <div class="tab" data-tab="1st-pd">Pregnancy Detection
            <?php 
                        $sql = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'inseminated' AND DATE_ADD(LastAI, INTERVAL 60  DAY) <= CURDATE()";
                        $result = mysqli_query($conn, $sql);  
                    if ($result->num_rows > 0) {
                ?>
                    <span class="badge"><?php echo $result->num_rows; ?></span>
                <?php 
                    }
                    else {
                        }
                ?>
            </div>
           
            <div class="tab" data-tab="due-for-calving">Due for Calving
                <?php 
                        $sql = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'pregnant' AND DATE_ADD(LastAI, INTERVAL 269  DAY) <= CURDATE()";
                        $result = mysqli_query($conn, $sql);  
                    if ($result->num_rows > 0) {
                ?>
                    <span class="badge"><?php echo $result->num_rows; ?></span>
                <?php 
                    }
                    else {
                        }
                ?>
            </div>
            <div class="tab" data-tab="dry-off">Dry-off
            <?php 
                        $sql = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'pregnant' AND milking = 'lactating' AND DATE_ADD(LastAI, INTERVAL 220  DAY) <= CURDATE()";
                        $result = mysqli_query($conn, $sql);  
                    if ($result->num_rows > 0) {
                ?>
                    <span class="badge"><?php echo $result->num_rows; ?></span>
                <?php 
                    }
                    else {
                        }
                ?>
            </div>
            <div class="tab" data-tab="ready-for-breeding">Ready for Breeding
            <?php 
                          $sqll = "SELECT * FROM farm_setup ";
                          $resultt = mysqli_query($conn, $sqll);  
                          $roww = mysqli_fetch_assoc($resultt);
                        $sql = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'open' AND DATE_ADD(Lastcalving, INTERVAL $roww[period_post_calving] DAY) <= CURDATE()";

                        //$sql = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'pregnant' AND milking = 'lactating' AND DATE_ADD(LastAI, INTERVAL 220  DAY) <= CURDATE()";
                        $result = mysqli_query($conn, $sql);  
                    if ($result->num_rows > 0) {
                ?>
                    <span class="badge"><?php echo $result->num_rows; ?></span>
                <?php 
                    }
                    else {
                        }
                ?>
        </div>
        </div>
            <!--heat-->
        <div id="heat-content" class="content">
            <div class="heat-cards">
                <div class="heat-card">
                    <div class="heat-card-header">
                        <div class="cow-info">
                            <div class="cow-icon">🐮</div>
                            <div class="cow-name">Laxmi</div>
                        </div>
                        <button class="take-action-btn">Take action</button>
                    </div>
                    <div class="metrics">
                        <div class="metric">
                            <div class="metric-value">Optimal</div>
                            <div class="metric-label">Heat Window</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value">12hrs</div>
                            <div class="metric-label">AI remaining</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value">60</div>
                            <div class="metric-label">Heat Score</div>
                        </div>
                    </div>
                    <div class="gauge">
                        <div class="gauge-sections">
                            <div class="gauge-section grey"></div>
                            <div class="gauge-section green"></div>
                            <div class="gauge-section yellow"></div>
                            <div class="gauge-section red"></div>
                        </div>
                        <div class="gauge-pointer"></div>
                    </div>
                </div>


            </div>
            <h1>Coming Soon</h1>
        </div>
                <!--PD-->
                
                <div id="1St_PD" class="content" style="display: none;">
                <?php  
                        $sql = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'inseminated' AND DATE_ADD(LastAI, INTERVAL 60  DAY) <= CURDATE()";
                        $result = mysqli_query($conn, $sql);               
                    if ($result->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>
                            <div class="heat-cards">
                                <div class="heat-card">
                                    <div class="heat-card-header">
                                        <div class="cow-info">
                                            <div class="cow-icon">🐮</div>
                                            <div class="cow-name"><?php echo $row['cattlename'];?></div>
                                        </div>

                                        <button class="take-action-btn PD" <?php echo " data-id='{$row['id']}' ";?>>Add PD</button>
                                    </div>
                                    <div class="metrics" style="margin-bottom: 0.3rem;">
                                        <div class="metric">
                                            <div class="metric-label">Last AI</div>
                                            <div class="metric-value" style="font-size: 1.1rem;color:rgb(0, 0, 0);"><?php echo $row['Lastheat'];?></div>

                                        </div>
                                        
                                        <div class="metric">
                                            <div class="metric-value" > It's time for your first<br> checkup.</div>
                                            <div class="metric-label"></div>
                                        </div>
                                    </div>
                                    
                                </div>
                                


                            </div>
                            <?php 
                                        }

                                        } 
                                        else {
                          include 'bell.php';
                                                }
                                    
                                    ?>
    <div class="modal-content" id="actionModal" style="display: none;">
        <div class="modal">
            <button type="button" class="close" id="cll">&times;</button>
            <div class="modal-title">Have you done Pregnancy..?</div>
            <button class="modal-button primary" id="confirmDelete">Yes</button>
            <button class="modal-button" id="cancelDelete">No</button>
        </div>  
    </div>
    <script>
                // Close modal when clicking outside
                document.getElementById('actionModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('actionModal')) {
                document.getElementById('actionModal').style.display = 'none';
            }
        });
        document.getElementById('cll').addEventListener('click', (e) => {
            if (e.target === document.getElementById('cll')) {
                document.getElementById('actionModal').style.display = 'none';
            }
        });
    document.addEventListener("DOMContentLoaded", () => {
    const deleteBtns = document.querySelectorAll(".PD")
    const modal = document.getElementById("actionModal")
    const confirmBtn = document.getElementById("confirmDelete")
    const cancelBtn = document.getElementById("cancelDelete")
    const clb = document.getElementById("cl")

    let currentId = null
  
    deleteBtns.forEach((btn) => {
      btn.addEventListener("click", function () {
        currentId = this.getAttribute("data-id")
        modal.style.display = "block"
      })
    })
  
    confirmBtn.addEventListener("click", () => {
      if (currentId) {
        deleteData(currentId)
      }
      modal.style.display = "none"
    })
  
    cancelBtn.addEventListener("click", () => {
        if (currentId) {
        alterData(currentId)
      }
      modal.style.display = "none"    })
    clb.addEventListener("click", () => {
      modal.style.display = "none"
    })
  
    function deleteData(id) {
      // Send AJAX request to delete data
      fetch("PD1.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "id=" + id,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Remove the row from the table
            const row = document.querySelector(`button[data-id="${id}"]`).closest("tr")
            row.remove()
          } else {
            alert("Failed to delete data.")
          }
        })
        .catch((error) => {
          console.error("Error:", error)
            history.go(0);
        })
    }
    function alterData(id) {
      // Send AJAX request to delete data
      fetch("PD2.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "id=" + id,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Remove the row from the table
            const row = document.querySelector(`button[data-id="${id}"]`).closest("tr")
            row.remove()
          } else {
            alert("Failed to delete data.")
          }
        })
        .catch((error) => {
          console.error("Error:", error)
            history.go(0);
        })
    }
  })
  
  
                                    </script>
                        </div>
       
        <!--Due for Calving -->
        <div id="DueforCalving" class="content" style="display: none;">
        <?php 
                        $sql = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'pregnant' AND DATE_ADD(LastAI, INTERVAL 269  DAY) <= CURDATE()";
                        $result = mysqli_query($conn, $sql);  
                    if ($result->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>
            <div class="heat-cards">
                <div class="heat-card">
                    <div class="heat-card-header">
                        <div class="cow-info">
                            <div class="cow-icon">🐮</div>
                            <div class="cow-name"><?php echo $row['cattlename'];?></div>
                            </div>
                            <button class="take-action-btn cal" <?php echo " cdata-id='{$row['id']}' ";?>>Add Calving</button>

                        
                    </div>
                    <div class="metrics" style="margin-bottom: 0.3rem;">
                        <div class="metric">
                            
                            <div class="metric-value" style="font-size: 1.1rem;color:rgb(0, 0, 0);"><?php $inputDate = $row['LastAI'];
                             $date = new DateTime($inputDate);
            
                             // Add 200 days
                             $daysToAdd=275;
                 
                             $date->modify("+$daysToAdd days");            
                             // Format dates for display
                             $calculatedDate = $date->format('Y-m-j');
                             $inputDate = (new DateTime($inputDate))->format('F j, Y');
                             
                             // Create result message
                             $resultt = "$calculatedDate";
                             echo $resultt ; ?></div>
                            <div class="metric-label" style="font-size: 0.800rem;">Calving Date <br>Not comfirmed yet</div>
                        </div>
                        
                        <div class="metric">
                            <div class="metric-value" style=""> Time for calfe birth<br> has come.</div>
                            <div class="metric-label"></div>
                        </div>
                    </div>
                </div>
                
            </div>

    
            
            <?php 
                   }

                                        } 
                                        else {
                          include 'bell.php';
                                                }
                            
                                    ?>
<div class="modal-content" id="actionModal1" style="display: none;">
        <div class="modal">
            <button type="button" class="close" id="cll1">&times;</button>
            <div class="modal-title">Have you done Calving ?</div>
            <button class="modal-button primary" id="confirmDelete1">Yes</button>
            <button class="modal-button" id="cancelDelete1">No</button>
        </div>  
    </div>
    <script>
                // Close modal when clicking outside
                document.getElementById('actionModal1').addEventListener('click', (e) => {
            if (e.target === document.getElementById('actionModal1')) {
                document.getElementById('actionModal1').style.display = 'none';
            }
        });
        document.getElementById('cll1').addEventListener('click', (e) => {
            if (e.target === document.getElementById('cll1')) {
                document.getElementById('actionModal1').style.display = 'none';
            }
        });
    document.addEventListener("DOMContentLoaded", () => {
    const deleteBtns = document.querySelectorAll(".cal")
    const modal = document.getElementById("actionModal1")
    const confirmBtn = document.getElementById("confirmDelete1")
    const cancelBtn = document.getElementById("cancelDelete1")

    let currentId = null
  
    deleteBtns.forEach((btn) => {
      btn.addEventListener("click", function () {
        currentId = this.getAttribute("cdata-id")
        modal.style.display = "block"
      })
    })
  
    confirmBtn.addEventListener("click", () => {
      if (currentId) {
        deleteData(currentId)
      }
      modal.style.display = "none"
    })
  
    cancelBtn.addEventListener("click", () => {
 
      modal.style.display = "none"    })
    clb.addEventListener("click", () => {
      modal.style.display = "none"
    })
  
    function deleteData(id) {
      // Send AJAX request to delete data
      fetch("cal.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "id=" + id,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Remove the row from the table
            const row = document.querySelector(`button[cdata-id="${id}"]`).closest("tr")
            row.remove()
          } else {
            alert("Failed to delete data.")
          }
        })
        .catch((error) => {
          console.error("Error:", error)
            history.go(0);
        })
    }

  })
  
  
</script>
        </div>
                 <!--Dry off-->
        <div id="dryoff" class="content" style="display: none;">
        <?php 
                        $sql = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'pregnant' AND milking = 'lactating' AND DATE_ADD(LastAI, INTERVAL 220  DAY) <= CURDATE()";
                        $result = mysqli_query($conn, $sql);  
                    if ($result->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>
        <div class="heat-cards">
                <div class="heat-card">
                    <div class="heat-card-header">
                        <div class="cow-info">
                            <div class="cow-icon">🐮</div>
                            <div class="cow-name"><?php echo $row['cattlename'];?></div>
                        </div>
                        <button class="take-action-btn dry" <?php echo " ddata-id='{$row['id']}' ";?>>Dry off</button>
                    </div>
                    <div class="metrics">
                        <div class="metric">
                            <div class="metric-value" style="font-size: 1.1rem;color:rgb(0, 0, 0);"><?php echo $row['Dry Off Date'];?></div>
                            <div class="metric-label">Dry off Date</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value"><?php 
                            $input_date = $row['LastAI'];
        
                            // Validate the date format
                            if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $input_date)) {
                                $date_obj = date_create($input_date);
                                $current_date = date_create();
                                
                                if ($date_obj && $current_date) {
                                    $interval = date_diff($date_obj, $current_date);
                                    $days = $interval->format('%r%a'); // %r for sign, %a for total days
                                    
                                    echo $days;
                    
                                } 
                            } 
                            ?></div>
                            <div class="metric-label">Days in Pregnancy</div>
                        </div>
                    </div>
                    
                </div>


            </div>
            <?php 
                                        }

                                        } 
                                        else {
                          include 'bell.php';
                                                }
                                    
                                    ?>
    <div class="modal-content" id="actionModal2" style="display: none;">
        <div class="modal">
            <button type="button" class="close" id="cll2">&times;</button>
            <div class="modal-title">Have you done Dry Off ?</div>
            <button class="modal-button primary" id="confirmDelete2">Yes</button>
            <button class="modal-button" id="cancelDelete2">No</button>
        </div>  
    </div>
    <script>
                // Close modal when clicking outside
                document.getElementById('actionModal2').addEventListener('click', (e) => {
            if (e.target === document.getElementById('actionModal2')) {
                document.getElementById('actionModal2').style.display = 'none';
            }
        });
        document.getElementById('cll2').addEventListener('click', (e) => {
            if (e.target === document.getElementById('cll2')) {
                document.getElementById('actionModal2').style.display = 'none';
            }
        });
    document.addEventListener("DOMContentLoaded", () => {
    const deleteBtns = document.querySelectorAll(".dry")
    const modal = document.getElementById("actionModal2")
    const confirmBtn = document.getElementById("confirmDelete2")
    const cancelBtn = document.getElementById("cancelDelete2")

    let currentId = null
  
    deleteBtns.forEach((btn) => {
      btn.addEventListener("click", function () {
        currentId = this.getAttribute("ddata-id")
        modal.style.display = "block"
      })
    })
  
    confirmBtn.addEventListener("click", () => {
      if (currentId) {
        deleteData(currentId)
      }
      modal.style.display = "none"
    })
  
    cancelBtn.addEventListener("click", () => {
 
      modal.style.display = "none"    })
    clb.addEventListener("click", () => {
      modal.style.display = "none"
    })
  
    function deleteData(id) {
      // Send AJAX request to delete data
      fetch("dry.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "id=" + id,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Remove the row from the table
            const row = document.querySelector(`button[ddata-id="${id}"]`).closest("tr")
            row.remove()
          } else {
            alert("Failed to delete data.")
          }
        })
        .catch((error) => {
          console.error("Error:", error)
            history.go(0);
        })
    }

  })
  
  
</script>
         </div>
         <!--Ready for Breeding-->
         <div id="Ready-for-Breeding" class="content" style="display: none;">
         <?php 
                        $sqll = "SELECT * FROM farm_setup ";
                        $resultt = mysqli_query($conn, $sqll);  
                        $roww = mysqli_fetch_assoc($resultt);
                        $sql = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'open' AND DATE_ADD(Lastcalving, INTERVAL $roww[period_post_calving] DAY) <= CURDATE()";
                        $result = mysqli_query($conn, $sql);  
                    if ($result->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>  
         <div class="heat-cards">
                <div class="heat-card">
                    <div class="heat-card-header">
                        <div class="cow-info">
                            <div class="cow-icon">🐮</div>
                            <div class="cow-name"><?php echo $row['cattlename'];?></div>
                        </div>
                        <button class="take-action-btn">Take action</button>
                    </div>

                    
                </div>


            </div>
            <?php 
                                        }

                                        } 
                                        else {
                          include 'bell.php';
                                                }
                                    
                                    ?>
        </div>
        
        <div id="default-content" class="content" style="display: none;">
            <div  class="alert-icon"></div>
            <div class="no-alerts">No Alerts Present</div>
        </div>
    </section>

    <!-- Milk Section -->
    <section id="milk" class="section">
        <main class="content">
            <div class="no-alerts">No Alerts Present</div>
            <div class="instructions">
                <h2>In order to get low milk alert for any cattle:</h2>
                <ol>
                    <li>Go to the Milk Entry section.</li>
                    <li>Enter milk data for your cattle on a daily basis.</li>
                    <li>Whenever the 7 day milk average for a cattle falls below a certain threshold (defined in farm settings) then the low milk yield alert is raised.</li>
                </ol>
            </div>
        </main>
    </section>

    <!-- Vaccination Section -->
    <section id="vaccination" class="section">
        <main class="content">
            <div class="alert-icon"></div>
            <div class="no-alerts">No Alerts Present</div>
        </main>
    </section>

    <!-- Health Section -->
    <section id="health" class="section">
        <main class="content">
            <div class="alert-icon"></div>
            <div class="no-alerts">No Alerts Present</div>
        </main>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Main tabs switching
            const mainTabs = document.querySelectorAll('.main-tabs span');
            const sections = document.querySelectorAll('.section');

            function showSection(sectionId) {
                sections.forEach(section => {
                    section.classList.remove('active');
                });
                mainTabs.forEach(tab => {
                    tab.classList.remove('active');
                });

                const activeSection = document.getElementById(sectionId);
                const activeTab = document.querySelector('[data-section="' + sectionId + '"]');
                
                if (activeSection && activeTab) {
                    activeSection.classList.add('active');
                    activeTab.classList.add('active');
                }
            }

            mainTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const section = tab.getAttribute('data-section');
                    showSection(section);
                });
            });

            // Sub tabs functionality (for reproduction section)
            const subTabs = document.querySelectorAll('.tab');
            const subTabsContainer = document.querySelector('.sub-tabs');
            const heatContent = document.getElementById('heat-content');
            const fistPD = document.getElementById('1St_PD');
            //const secondPD = document.getElementById('2nd_PD');
            const Due_for_Calving = document.getElementById('DueforCalving');
            const dry= document.getElementById('dryoff');

            const ReadyforBreeding = document.getElementById('Ready-for-Breeding');

            function setActiveTab(clickedTab) {
                subTabs.forEach(tab => tab.classList.remove('active'));
                clickedTab.classList.add('active');

                if (clickedTab.getAttribute('data-tab') === 'heat') {
                    heatContent.style.display = 'block';
                    fistPD.style.display = 'none';
                   // secondPD.style.display = 'none';
                    Due_for_Calving.style.display = 'none';
                    dry.style.display = 'none';
                    ReadyforBreeding.style.display = 'none';
                } 
                
               
                else if(clickedTab.getAttribute('data-tab') === '1st-pd') {
                    heatContent.style.display = 'none';
                    fistPD.style.display = 'block';
                   // secondPD.style.display = 'none';
                    Due_for_Calving.style.display = 'none';
                    dry.style.display = 'none';
                    ReadyforBreeding.style.display = 'none';
                    
                }
                
                else if(clickedTab.getAttribute('data-tab') === 'due-for-calving') {
                    heatContent.style.display = 'none';
                    fistPD.style.display = 'none';
                   // secondPD.style.display = 'none';
                    Due_for_Calving.style.display = 'block';
                    dry.style.display = 'none';
                    ReadyforBreeding.style.display = 'none';
                    
                }
                else if(clickedTab.getAttribute('data-tab') === 'dry-off') {
                    heatContent.style.display = 'none';
                    fistPD.style.display = 'none';
                    //secondPD.style.display = 'none';
                    Due_for_Calving.style.display = 'none';
                    dry.style.display = 'block';
                    ReadyforBreeding.style.display = 'none';
                    
                }
                else {
                    heatContent.style.display = 'none';
                    fistPD.style.display = 'none';
                    //secondPD.style.display = 'none';
                    Due_for_Calving.style.display = 'none';
                    dry.style.display = 'none';
                    ReadyforBreeding.style.display = 'flex';
                }
            }

            subTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    setActiveTab(this);
                });
            });

           

            // Set initial active states
            setActiveTab(subTabs[0]);
        });



 
    </script>
    <header class="header" id="header">
            <nav class="nav container">
                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="Milk Entry.php" class="nav__link ">
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
                            <a href="Cattle List.php" class="nav__link ">
                                <i class='bx bx-message-square-detail nav__icon'></i>
                                <span class="nav__name">Cattle List</span>
                            </a>
                        </li>

                        <li class="nav__item">
                            <a href="Alerts.php" class="nav__link active-link">
                                <i class='bx bx-bell nav__icon'></i>
                                <span class="nav__name">Alerts</span>
                            </a>
                        </li>
                    </ul>
                </div>

               
            </nav>
        </header>
     <script src="js/script.js"></script>
     
     
</body>
</html>