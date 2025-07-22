<?php   
    		require './config/connection.php';
           
            
       
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
    

    <title>Cattle List</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding-bottom:100px ;
        }

        .status-bar {
            background-color: #ffffff;
            padding: 4px 12px;
            display: flex;
            justify-content: space-between;
            color: #333;
            font-size: 14px;
        }

        

        
        .tabs {
            background-color: #cc4400;
            padding: 12px 16px;
            position: fixed;
            left: 0;
            right: 0;
            display: flex;
            gap: 32px;
            overflow-x: auto;
            white-space: nowrap;
            padding-top:80px;
        }

        .tab {
            color: rgba(255, 255, 255, 0.8);
            font-size: 18px;
            cursor: pointer;
        }

        .tab.active {
            color: white;
        }

        .search-container {
            padding: 16px;
            position: fixed;
            left: 0;
            right: 0;
            padding-top:130px;
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
        .cattle{
            padding-top: 175px;
        }
        .cattle-card {
            background-color: white;
            margin: 16px;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .cattle-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .checkbox {
            width: 20px;
            height: 20px;
        }

        .cow-icon {
            background-color: #fff3e0;
            padding: 8px;
            border-radius: 50%;
            color: #ff6b00;
        }

        .badge {
            background-color: #4a0072;
            color: white;
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 14px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .stat-item {
            display: flex;
            gap: 12px;
        }

        .stat-icon {
            color: #ff6b00;
            font-size: 20px;
        }

        .stat-text h3 {
            font-size: 20px;
            margin-bottom: 4px;
        }

        .stat-text p {
            color: #666;
            font-size: 14px;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            border-top: 1px solid #e5e7eb;
            padding: 1rem;
            display: flex;
            justify-content: space-around;
        }
        .size{
            
            padding: 12px 12px;

        }
        #submitButton {
            display: none;
            cursor: pointer;
        }
        #act{
            display: block;
        }
        .trigger-button {
            background: #ffae00;
        position: absolute;
  height: 50px;
  width: 50px;
  border-radius: 50%;
            
            cursor: pointer;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 24px;
            border-radius: 20px;
            width: 90%;
            max-width: 400px;
            position: relative;
        }

        .close {
            position: absolute;
            right: 24px;
            top: 24px;
            font-size: 24px;
            color: #ff6b00;
            cursor: pointer;
            background: none;
            border: none;
        }

        h2 {
            font-size: 32px;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .confirmation-text {
            font-size: 28px;
            line-height: 1.3;
            margin-bottom: 32px;
            font-weight: 500;
        }

        .date-section h2 {
            color: #666;
            margin-bottom: 16px;
            font-size: 24px;
        }

        .date-inputs {
            display: flex;
            gap: 16px;
            margin-bottom: 32px;
            align-items: center;
        }

        .date-input {
            border: none;
            border-bottom: 2px solid #ddd;
            font-size: 18px;
            padding: 8px;
            width: 80px;
            text-align: center;
        }

        .options {
            display: flex;
            justify-content: space-between;
            background-color: #f5f5f5;
            border-radius: 20px;
            padding: 16px;
            margin-bottom: 32px;
        }

        .radio-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .radio-option input[type="radio"] {
            display: none;
        }

        .radio-option label {
            cursor: pointer;
            color: #666;
        }

        .radio-option input[type="radio"]:checked + label {
            color: #ff6b00;
            font-weight: bold;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .confirm-btn {
            background-color: #ff6b00;
            color: white;
            border: none;
            padding: 16px;
            border-radius: 50px;
            font-size: 18px;
            cursor: pointer;
        }

        .cancel-btn {
            background-color: white;
            color: #ff6b00;
            border: 2px solid #ff6b00;
            padding: 16px;
            border-radius: 50px;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>

   
    <nav1>
        <div class="nav-bar1">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">GauAmritpal</a></span>

            <div class="menu1">
                
                    <div class="header1" style="padding:19px;">
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
    <div class="tabs">
        <div class="tab active">Cows</div>
        <div class="tab">Bulls</div>
    </div>
<div>
     <!-- Search Modal -->
    <div class="search-container">
        <div class="search-bar">
            <span>🔍</span>
            <input type="text" placeholder="Search In  Cattle" id="searchInput">
            
        </div>
    </div>
    <div class="cattle">
    <form action="delete.php" id="my-form" method="post"> 
    <?php 
              $query = "SELECT * FROM cattle";
              $result = mysqli_query($conn, $query);               
                while($rows= mysqli_fetch_assoc($result))
                {
            ?>
    <div class="cattle-card">
        <div class="card-header">
            <div class="cattle-info">
                <input type='checkbox' class='checkbox' id="checkbox" name="checkbox[]" value="<?php echo $rows['id']; ?>" onchange='toggleButton()'>
                <span class="cow-icon">🐮</span>
                <h3><?php echo $rows['cattlename'];?></h3>
            </div>
            <a href="viewcattle.php?id=<?php echo $rows['id']; ?>" name="view[]" class="badge">Read More</a>
            
        </div>
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-icon">🔒</span>
                <div class="stat-text">
                    <h3><?php echo $rows['milking'];?></h3>
                    <p>Milking</p>
                </div>
            </div>
            <div class="stat-item">
                <span class="stat-icon">🥛</span>
                <div class="stat-text">
                    <h3><?php echo $rows['lifecycle_Status'];?></h3>
                    <p>Lifecycle Status</p>
                </div>
            </div>
            <div class="stat-item">
                <span class="stat-icon">🐮</span>
                <div class="stat-text">
                    <h3><?php echo $rows['ReproductionStatus'];?></h3>
                    <p>Reproduction</p>
                </div>
            </div>
            <div class="stat-item">
                <span class="stat-icon">❤</span>
                <div class="stat-text">
                    <h3 style="color: #008000;"><?php echo $rows['Health_Status'];?></h3>
                    <p>Health</p>
                </div>
                
            </div>
            
        </div>
       
    </div> 
    <?php
                }
            ?>
    </div>
      <!-- First Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <button type="button" class="close">&times;</button>
            <h2>Delete Cattle</h2>
            
            <div class="date-section">
                <h2>Date Of Removal</h2>
                <div class="date-inputs">
                    <input type="text" class="date-input" name="day" placeholder="dd" maxlength="2">
                    <span>/</span>
                    <input type="text" class="date-input" name="month" placeholder="mm" maxlength="2">
                    <span>/</span>
                    <input type="text" class="date-input" name="year" placeholder="yyyy" maxlength="4">
                </div>
            </div>

            <div class="options">
                <div class="radio-option">
                    <input type="radio" id="sold" name="reason" value="sold" checked>
                    <label for="sold">Sold</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="death" name="reason" value="death">
                    <label for="death">Death</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="dry" name="reason" value="dry">
                    <label for="dry">Dry</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="other" name="reason" value="other">
                    <label for="other">Other</label>
                </div>
            </div>

            <div class="buttons">
                <button type="button" class="confirm-btn" id="firstConfirmBtn">Confirm</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </div>
        </div>
    </div>
     <!-- Second Modal (Confirmation) -->
     <div class="modal" id="confirmationModal">
        <div class="modal-content">
            <button type="button" class="close">&times;</button>
            <h2>Please Confirm</h2>
            <p class="confirmation-text">Are you sure you want to delete cattle permanently?</p>
            <div class="buttons">
                <button type="submit" form="my-form" class="confirm-btn" name="delete"> Confirm</button>               
                <button type="button" class="cancel-btn">Cancel</button>
            </div>
        </div>
    </div>
    </form>
   
</div>
    <!---bottom nev--->
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
                            <a href="Cattle List.php" class="nav__link active-link">
                                <i class='bx bx-message-square-detail nav__icon'></i>
                                <span class="nav__name">Cattle List</span>
                            </a>
                        </li>
                       

                        <li class="nav__item">
                            <a href="Alerts.php" class="nav__link">
                                <i class='bx bx-bell nav__icon'>
                                    
                                </i>
                                <span class="nav__name">Alerts</span>
                            </a>
                            <?php include 'Alert/alt.php';?>
                        </li>
                    </ul>
                </div>

               
            </nav>
            <!---- plus icon -->
            <div class="fabs" onclick="toggleBtn()" >
               <div class="act">
                <div class="action">
                    <i class='bx bx-plus a' id="add"></i>
                  <i class='bx bx-x a'id="remove" style="display: none"></i>
                </div>
          
                <div class="btns">
                  <a href="cattle add form/cow.php" class="btn"
                    ><i class='bx bx-message-square-detail nav__icon'></i></a>
                </div>
               </div>
              </div>
              
               <!---- Delete icon -->
              <div class="fabs" id="submitButton" >
                <div class="action" >
                <button  class="trigger-button">
                <svg viewBox="0 0 24 24" class="size" >
                <path fill="currentColor" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                </svg>
                </button>
                </div>
              </div>
              
        </header>
          
   
   
    
    <script>
        const deleteModal = document.getElementById('deleteModal');
        const confirmationModal = document.getElementById('confirmationModal');
        const triggerButton = document.querySelector('.trigger-button');
        const closeButtons = document.querySelectorAll('.close');
        const cancelButtons = document.querySelectorAll('.cancel-btn');
        const firstConfirmBtn = document.getElementById('firstConfirmBtn');

        // Open first modal
        triggerButton.addEventListener('click', () => {
            deleteModal.style.display = 'flex';
        });

        // Open second modal from first modal's confirm button
        firstConfirmBtn.addEventListener('click', () => {
            deleteModal.style.display = 'none';
            confirmationModal.style.display = 'flex';
        });

        // Close buttons functionality
        closeButtons.forEach(button => {
            button.addEventListener('click', () => {
                deleteModal.style.display = 'none';
                confirmationModal.style.display = 'none';
            });
        });

        // Cancel buttons functionality
        cancelButtons.forEach(button => {
            button.addEventListener('click', () => {
                deleteModal.style.display = 'none';
                confirmationModal.style.display = 'none';
            });
        });

        // Close on outside click
        window.addEventListener('click', (e) => {
            if (e.target === deleteModal) {
                deleteModal.style.display = 'none';
            }
            if (e.target === confirmationModal) {
                confirmationModal.style.display = 'none';
            }
        });
    </script>
        <script>
        function toggleButton() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var submitButton = document.getElementById('submitButton');
            var act = document.getElementById('act');
            var anyChecked = false;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    anyChecked = true;
                }
            });

            submitButton.style.display = anyChecked ? 'block' : 'none';
            act.style.display = anyChecked ? 'none' : 'block';
        }
    </script>
     <script src="js/script.js">
        
     </script>
     <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const cattleCards = document.querySelectorAll('.cattle-card');

        searchInput.addEventListener('input', function() {
            const searchQuery = this.value.toLowerCase().trim();

            cattleCards.forEach(card => {
                const cattleName = card.querySelector('h3').textContent.toLowerCase();
                const milking = card.querySelector('.stat-text h3').textContent.toLowerCase();
                const lifecycleStatus = card.querySelectorAll('.stat-text h3')[1].textContent.toLowerCase();
                const reproductionStatus = card.querySelectorAll('.stat-text h3')[2].textContent.toLowerCase();
                const healthStatus = card.querySelectorAll('.stat-text h3')[3].textContent.toLowerCase();

                const matchesSearch = cattleName.includes(searchQuery) ||
                                      milking.includes(searchQuery) ||
                                      lifecycleStatus.includes(searchQuery) ||
                                      reproductionStatus.includes(searchQuery) ||
                                      healthStatus.includes(searchQuery);

                card.style.display = matchesSearch ? 'block' : 'none';
            });
        });
    });
</script>
     
</body>
</html>