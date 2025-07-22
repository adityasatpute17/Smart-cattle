<?php
      require '../config/connection.php';
    
      $id = $_GET['id']; 
      
    ?>  
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    
    <style>
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);

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
            background: #FF8C00;
            color: white;
            border: none;
        }
    </style> 
</head>
<body>
<div class="modal-content" id="actionModal">
<a href="..\Alerts.php"class="modal-content">
</a>

                        <div class="modal">
                            <div class="modal-title">Have you done Calving ?</div>
                            <a href="cal.php?id=<?php echo $id; ?>" name="view[]"><button class="modal-button primary">Yes</button></a>
                            <a href="..\Alerts.php"> <button class="modal-button">No</button></a>
                           
                        </div>
</div> 
</body>
<script>
                        
                        // Handle Take Action button clicks
                       document.querySelectorAll('.take-action-btn').forEach(button => {
                            button.addEventListener('click', () => {
                                document.getElementById('actionModal').style.display = 'block';
                            });
                        });
                       
            </script>
</html>



   