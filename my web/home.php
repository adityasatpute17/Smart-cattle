<?php   
    		require './config/connection.php';
            session_start();
       
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
    
    
        main {
            padding: 1rem;
            max-width: 64rem;
            margin: 0 auto;
        }
        .alerts-section {
            margin-top: 4rem;
        }
        .alerts-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        h2 {
            font-size: 1.875rem;
            font-weight: bold;
        }
        .button-group {
            display: flex;
            gap: 0.5rem;
        }
        .button {
            padding: 0.5rem 1rem;
            border: 2px solid black;
            border-radius: 9999px;
            background-color: transparent;
            cursor: pointer;
        }
        .button.active {
            background-color: #fce7f3;
        }
        .alerts-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        @media (min-width: 768px) {
            .alerts-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        .alert-card {
            background-color: white;
            padding: 1rem;
            border-radius: 1.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .icon {
            background-color: #fff3e0;
            padding: 10px;
            border-radius: 50%;
            color: #ff6b00;
        }
        
        .alert-content {
            display: flex;
            flex-direction: column;
        }
        .alert-count {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .alert-label {
            color: #4b5563;
        }
        .Reproduction-status{
            margin-top: 2rem;
        }


        .milking-status {
            margin-top: 2rem;
        }
        .status-card {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        .status-indicators {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }
        .status-indicator {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .status-circle {
            width: 4rem;
            height: 4rem;
            background-color: #fce7f3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .status-label {
            font-size: 1.25rem;
        }
        .progress-bar {
            position: absolute;
            left: 50%;
            top: 90%;
            transform: translate(-50%, -50%);
            width: 60%;
            height: 0.75rem;
            background-color: #E5E7EB;
            border-radius: 9999px;
            overflow: hidden;
        }
        .progress-fill {
            width:          <?php 
                             $qu = "SELECT * FROM cattle ";
                             $re = mysqli_query($conn, $qu);
                             $total = mysqli_num_rows($re);
                             $query = "SELECT * FROM cattle where milking='lactating' ";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo ($totalCount/$total)*100 ;
                            ?>%;
            height: 100%;
            background-color: #F97316;
            border-radius: 9999px;
            transition: width 0.3s ease;
        }
        
        .lifecycle-section {
            margin-top: 2rem;
        }

</style>
    <title>Home page</title>
</head>
<body>
   
    <nav1>
        <div class="nav-bar1">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">GauAmritpal.Dashboard</a> </span>

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
                
                        <a href="logout.php">
                        <div class="menu-item">
                            <div class="icon1">
                                <svg viewBox="0 0 24 24">
                                    <path d="M13 3h-2v10h2V3zm4.83 2.17l-1.42 1.42C17.99 7.86 19 9.81 19 12c0 3.87-3.13 7-7 7s-7-3.13-7-7c0-2.19 1.01-4.14 2.58-5.42L6.17 5.17C4.23 6.82 3 9.26 3 12c0 4.97 4.03 9 9 9s9-4.03 9-9c0-2.74-1.23-5.18-3.17-6.83z"/>
                                </svg>
                            </div>
                            <span class="menu-item-text">Log Out</span>
                            <span class="arrow">›</span>
                        </div>
                        </a>
                    </div>

                
            </div>
            <div class="darkLight-searchBox">
                
           
                <div class="searchBox">
                   
                </div>
            </div>
            
        </div>
    </nav1>
    <main>
        <section class="alerts-section">
            <div class="alerts-header">
                <h2>Alerts</h2>
                <div class="button-group">
                    <button class="button active">Last 24 hrs</button>
                    <button class="button">All Alerts</button>
                </div>
            </div>

            <div class="alerts-grid">
                <div class="alert-card">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-thermometer"><path d="M14 4v10.54a4 4 0 1 1-4 0V4a2 2 0 0 1 4 0Z"/></svg>
                    </div>
                    <div class="alert-content">
                        <div class="alert-count">1</div>
                        <div class="alert-label">Heat</div>
                    </div>
                </div>
                <div class="alert-card">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                    </div>
                    <div class="alert-content">
                        <div class="alert-count">0</div>
                        <div class="alert-label">Health</div>
                    </div>
                </div>
                <div class="alert-card">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-syringe"><path d="m14.5 4-2 2 2 2"/><path d="m8.5 10 4-4"/><path d="m16.5 10-2-2"/><path d="M18 6.5 6 18.5"/><path d="m6 11 5 5"/><path d="m4 18 2 2"/></svg>
                    </div>
                    <div class="alert-content">
                        <div class="alert-count"><?php 
                        $sql = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'inseminated' AND DATE_ADD(LastAI, INTERVAL 60  DAY) <= CURDATE()";
                        $result = mysqli_query($conn, $sql);  
                    if ($result->num_rows > 0) {
                ?>
                    <span class="badge"><?php echo $result->num_rows; ?></span>
                <?php 
                    }
                    else {
                        }
                ?></div>
                        <div class="alert-label">PD</div>
                    </div>
                </div>
                <div class="alert-card">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-stethoscope"><path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"/><path d="M8 15v1a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6v-4"/><circle cx="20" cy="10" r="2"/></svg>
                    </div>
                    <div class="alert-content">
                        <div class="alert-count"><?php 
                          $sqll = "SELECT * FROM farm_setup ";
                          $resultt = mysqli_query($conn, $sqll);  
                          $roww = mysqli_fetch_assoc($resultt);
                        $sql = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'open' AND DATE_ADD(Lastcalving, INTERVAL $roww[period_post_calving] DAY) <= CURDATE()";

                        $result = mysqli_query($conn, $sql);  
                    if ($result->num_rows > 0) {
                ?>
                    <span class="badge"><?php echo $result->num_rows; ?></span>
                <?php 
                    }
                    else {
                        }
                ?></div>
                        <div class="alert-label">Breeding</div>
                    </div>
                </div>
                <div class="alert-card">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    </div>
                    <div class="alert-content">
                        <div class="alert-count"><?php 
                        $sql = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'pregnant' AND DATE_ADD(LastAI, INTERVAL 269  DAY) <= CURDATE()";
                        $result = mysqli_query($conn, $sql);  
                    if ($result->num_rows > 0) {
                ?>
                    <span class="badge"><?php echo $result->num_rows; ?></span>
                <?php 
                    }
                    else {
                        }
                ?></div>
                        <div class="alert-label">Calving</div>
                    </div>
                </div>
                <div class="alert-card">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-droplet"><path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"/></svg>
                    </div>
                    <div class="alert-content">
                        <div class="alert-count">  <?php 
                        $sql = "SELECT * FROM cattle WHERE 	ReproductionStatus = 'pregnant' AND milking = 'lactating' AND DATE_ADD(LastAI, INTERVAL 220  DAY) <= CURDATE()";
                        $result = mysqli_query($conn, $sql);  
                    if ($result->num_rows > 0) {
                ?>
                    <span class="badge"><?php echo $result->num_rows; ?></span>
                <?php 
                    }
                    else {
                        }
                ?></div>
                        <div class="alert-label">Dry-Off</div>
                    </div>
                </div>
                <div class="alert-card">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-milk"><path d="M8 2h8"/><path d="M9 2v2.789a4 4 0 0 1-.672 2.219l-.656.984A4 4 0 0 0 7 10.212V20a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-9.789a4 4 0 0 0-.672-2.219l-.656-.984A4 4 0 0 1 15 4.788V2"/><path d="M7 15a6.472 6.472 0 0 1 5 0 6.47 6.47 0 0 0 5 0"/></svg>
                    </div>
                    <div class="alert-content">
                        <div class="alert-count">0</div>
                        <div class="alert-label">Low Milk</div>
                    </div>
                </div>
                <div class="alert-card">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    </div>
                    <div class="alert-content">
                        <div class="alert-count">0</div>
                        <div class="alert-label">Vaccination</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="Reproduction-status">
            <h2>Reproduction Status</h2>
            <div style=" background-color: white;
                        padding: 15px;
                        border-radius: 0.5rem;
                        margin-top: 1rem;
                        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);">
                <div style="display: flex;
                    justify-content: space-between;
                    align-items: center;
                    position: relative;
                    margin-bottom: 10px;
                    padding: 15px; 
                    ">
                    <div style="display: flex;
                                align-items: center;">
                        
                        <div style="font-size: 1.25rem;">Open</div>
                    </div>
                    
                    <div style="display: flex;
                                align-items: center;">
                        <div style="display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-size: 1.5rem;
                                    font-weight: bold;"><?php 
                             $query = "SELECT * FROM cattle where ReproductionStatus='open'";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo '<h4>'.$totalCount.'</h4>';
                            ?></div>  
                    </div>
                    
                    <div class="progress-bar" 
                    style="position: absolute;
                            left: 50%;
                            top: 60px;
                            transform: translate(-50%, -50%);
                            width: 90%;
                            height: 0.60rem;
                            background-color: #E5E7EB;
                            border-radius: 9999px;
                            overflow: hidden;">
                    <div class="progress-fill" 
                            style="width:          <?php 
                             $qu = "SELECT * FROM cattle ";
                             $re = mysqli_query($conn, $qu);
                             $total = mysqli_num_rows($re);
                             $query = "SELECT * FROM cattle where ReproductionStatus='open' ";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo ($totalCount/$total)*100 ;
                            ?>%;
                            height: 100%;
                            background-color: #F97316;
                            border-radius: 9999px;
                            transition: width 0.3s ease;"></div>
                    </div>
                </div>
                <div style="display: flex;
                    justify-content: space-between;
                    align-items: center;
                    position: relative;
                    margin-bottom: 10px;
                    padding: 15px;
                    ">
                    <div style="display: flex;
                                align-items: center;">
                        
                        <div style="font-size: 1.25rem;">Inseminated</div>
                    </div>
                    
                    <div style="display: flex;
                                align-items: center;">
                        <div style="display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-size: 1.5rem;
                                    font-weight: bold;"><?php 
                             $query = "SELECT * FROM cattle where ReproductionStatus='inseminated'";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo '<h4>'.$totalCount.'</h4>';
                            ?></div>  
                    </div>
                    
                    <div class="progress-bar" 
                    style="position: absolute;
                            left: 50%;
                            top: 60px;
                            transform: translate(-50%, -50%);
                            width: 90%;
                            height: 0.60rem;
                            background-color: #E5E7EB;
                            border-radius: 9999px;
                            overflow: hidden;">
                    <div class="progress-fill" 
                            style="width:          <?php 
                             $qu = "SELECT * FROM cattle ";
                             $re = mysqli_query($conn, $qu);
                             $total = mysqli_num_rows($re);
                             $query = "SELECT * FROM cattle where ReproductionStatus='inseminated'";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo ($totalCount/$total)*100 ;
                            ?>%;
                            height: 100%;
                            background-color: #F97316;
                            border-radius: 9999px;
                            transition: width 0.3s ease;"></div>
                    </div>
                </div>
                <div style="display: flex;
                    justify-content: space-between;
                    align-items: center;
                    position: relative;
                    margin-bottom: 10px;
                    padding: 15px;
                    ">
                    <div style="display: flex;
                                align-items: center;">
                        
                        <div style="font-size: 1.25rem;">Pregnant</div>
                    </div>
                    
                    <div style="display: flex;
                                align-items: center;">
                        <div style="display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-size: 1.5rem;
                                    font-weight: bold;"><?php 
                             $query = "SELECT * FROM cattle where ReproductionStatus='pregnant'";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo '<h4>'.$totalCount.'</h4>';
                            ?></div>  
                    </div>
                    
                    <div class="progress-bar" 
                    style="position: absolute;
                            left: 50%;
                            top: 60px;
                            transform: translate(-50%, -50%);
                            width: 90%;
                            height: 0.60rem;
                            background-color: #E5E7EB;
                            border-radius: 9999px;
                            overflow: hidden;">
                    <div class="progress-fill" 
                            style="width:          <?php 
                             $qu = "SELECT * FROM cattle ";
                             $re = mysqli_query($conn, $qu);
                             $total = mysqli_num_rows($re);
                             $query = "SELECT * FROM cattle where ReproductionStatus='pregnant' ";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo ($totalCount/$total)*100 ;
                            ?>%;
                            height: 100%;
                            background-color: #F97316;
                            border-radius: 9999px;
                            transition: width 0.3s ease;"></div>
                    </div>
                </div>
                <div style="display: flex;
                    justify-content: space-between;
                    align-items: center;
                    position: relative;
                    margin-bottom: 10px;
                    padding: 15px;
                    ">
                    <div style="display: flex;
                                align-items: center;">
                        
                        <div style="font-size: 1.25rem;">Fresh</div>
                    </div>
                    
                    <div style="display: flex;
                                align-items: center;">
                        <div style="display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-size: 1.5rem;
                                    font-weight: bold;"><?php 
                             $query = "SELECT * FROM cattle where ReproductionStatus='fresh'";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo '<h4>'.$totalCount.'</h4>';
                            ?></div>  
                    </div>
                    
                    <div class="progress-bar" 
                    style="position: absolute;
                            left: 50%;
                            top: 60px;
                            transform: translate(-50%, -50%);
                            width: 90%;
                            height: 0.60rem;
                            background-color: #E5E7EB;
                            border-radius: 9999px;
                            overflow: hidden;">
                    <div class="progress-fill" 
                            style="width:          <?php 
                             $qu = "SELECT * FROM cattle ";
                             $re = mysqli_query($conn, $qu);
                             $total = mysqli_num_rows($re);
                             $query = "SELECT * FROM cattle where ReproductionStatus='fresh' ";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo ($totalCount/$total)*100 ;
                            ?>%;
                            height: 100%;
                            background-color: #F97316;
                            border-radius: 9999px;
                            transition: width 0.3s ease;"></div>
                    </div>
                </div>
                
            </div>
        </section>
        <section class="milking-status">
            <h2>Milking Status</h2>
            <div class="status-card">
                <div class="status-indicators">
                    <div class="status-indicator">
                        <div class="status-circle"><?php 
                             $query = "SELECT * FROM cattle where milking='lactating' ";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo '<h4>'.$totalCount.'</h4>';
                            ?></div>
                        <div class="status-label">Lactating</div>
                    </div>
                    
                    <div class="status-indicator">
                        <div class="status-label">Dry</div>
                        <div class="status-circle"><?php 
                             $query = "SELECT * FROM cattle where milking='dry' ";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo '<h4>'.$totalCount.'</h4>';
                            ?></div>  
                    </div>
                    
                    <div class="progress-bar">
                    <div class="progress-fill"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="lifecycle-section">
            <div class="alerts-header">
                <h2>Herd Lifecycle</h2>
                
            </div>

            <div class="alerts-grid">
                <div class="alert-card">
                    <div class="icon">
                    🐮
                    </div>
                    <div class="alert-content">
                        <div class="alert-count">
                            <?php 
                             $query = "SELECT * FROM cattle where lifecycle_Status='calf' ";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo '<h4>'.$totalCount.'</h4>';
                            ?>
                        </div>
                        <div class="alert-label">Calf</div>
                    </div>
                </div>
                <div class="alert-card">
                    <div class="icon">
                    🐮
                    </div>
                    <div class="alert-content">
                        <div class="alert-count"><?php 
                             $query = "SELECT * FROM cattle where lifecycle_Status='heifer' ";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo '<h4>'.$totalCount.'</h4>';
                            ?></div>
                        <div class="alert-label">Heifer</div>
                    </div>
                </div>
                <div class="alert-card">
                    <div class="icon">
                    🐮
                    </div>
                    <div class="alert-content">
                        <div class="alert-count"><?php 
                             $query = "SELECT * FROM cattle where lifecycle_Status='adult' ";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo '<h4>'.$totalCount.'</h4>';
                            ?></div>
                        <div class="alert-label">Adult</div>
                    </div>
                </div>
                <div class="alert-card">
                    <div class="icon">
                    🐮 
                    </div>
                    <div class="alert-content">
                        <div class="alert-count"><?php 
                             $query = "SELECT * FROM cattle where lifecycle_Status='retired' ";
                             $result = mysqli_query($conn, $query);
                             $totalCount = mysqli_num_rows($result);
                             echo '<h4>'.$totalCount.'</h4>';
                            ?></div>
                        <div class="alert-label">Retired</div>
                    </div>
                </div>
                
                
            </div>
        </section>
        

    </main>
    <header class="header" id="header">
            <nav class="nav container">
                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="Milk Entry.php" class="nav__link">
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
                            <a href="home.php" class="nav__link active-link">
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
                            <?php include './Alert/alt.php';?>
                        </li>
                    </ul>
                </div>

               
            </nav>
            <!---- plus icon -->>
            <div class="fabs" onclick="toggleBtn()">
                <div class="action">
                    <i class='bx bx-plus a' id="add"></i>
                  <i class='bx bx-x a'id="remove" style="display: none"></i>
                </div>
          
                <div class="btns">
                  <a href="cattle add form/cow.php" class="btn"
                    ><i class='bx bx-message-square-detail nav__icon'></i></a>
                  <a href="#" class="btn">
                    <i class='bx bx-calendar-plus nav__icon'></i>
                    </a>
                </div>
              </div>
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
});

//js code to plus icon
function toggleBtn() {
                const Btns = document.querySelector(".btns");
                const add = document.getElementById("add");
                const remove = document.getElementById("remove");
                const btn = document.querySelector(".btns").querySelectorAll("a");
                Btns.classList.toggle("open");
                if (Btns.classList.contains("open")) {
                  remove.style.display = "block";
                  add.style.display = "none";
                  btn.forEach((e, i) => {
                    setTimeout(() => {
                      bottom =60* i;
                      e.style.bottom = bottom + "px";
                      console.log(e);
                    }, 100 * i);
                  });
                } else {
                  add.style.display = "block";
                  remove.style.display = "none";
                  btn.forEach((e, i) => {
                    e.style.bottom = "";
                  });
                }
              }

</script>
     
     
     
</body>
</html>