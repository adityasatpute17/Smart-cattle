<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Alerts Present</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
           
        }
        .illustration {
            position: relative;
            width: 256px;
            height: 256px;
        }
        .background {
            position: absolute;
            inset: 0;
            background-color: #FFF5EE;
            border-radius: 50%;
        }
        .tree {
            position: absolute;
            width: 32px;
            height: 64px;
            background-color: rgba(255, 160, 100, 0.3);
            border-radius: 50%;
        }
        .tree-left {
            left: 25%;
            top: 33%;
        }
        .tree-right {
            right: 25%;
            top: 33%;
        }
        .bell-wrapper {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .bell {
            width: 80px;
            height: 80px;
            position: relative;
        }
        .bell::before {
            content: '🔔';
            font-size: 80px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 24px;
            height: 24px;
            background-color: #EF4444;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }
        .wave {
            position: absolute;
            top: 50%;
            width: 20px;
            height: 40px;
            border: 2px solid #FB923C;
            opacity: 0.3;
        }
        .wave-left {
            left: -16px;
            border-right: none;
            border-radius: 20px 0 0 20px;
        }
        .wave-right {
            right: -16px;
            border-left: none;
            border-radius: 0 20px 20px 0;
        }
        .text {
            margin-top: 15px;
            font-size: 24px;
            font-weight: 500;
            color: #1F2937;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="illustration">
            <div class="background"></div>
            <div class="tree tree-left"></div>
            <div class="tree tree-right"></div>
            <div class="bell-wrapper">
                <div class="bell">
                    <div class="notification-badge">×</div>
                    <div class="wave wave-left"></div>
                    <div class="wave wave-right"></div>
                </div>
            </div>
        </div>
        <p class="text">No Alerts Present</p>
    </div>
</body>
</html>