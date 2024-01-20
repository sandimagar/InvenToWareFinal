<?php
$_SESSION['logUser'] = 0;
$Username = 0;
session_start();
$Username = $_SESSION["logUser"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/InvenToWare-main/css/dashboard.css">
    <script src="https://kit.fontawesome.com/36c3b57b6b.js" crossorigin="anonymous"></script>
<style>
    
</style>
</head>
<body>
<div class="dashboard_nav">
        <div class="dashboard_nav_left"></div>
        <div class="dashboard_nav_right">

          
            
            <div class="userCreds_dashboard_nav">
                <div class="usericon"><div class="Username"><?php echo $Username?></div><i class="fa-solid fa-user"></i>
                
</div>
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">

                    <div class="dropdown_logs">
                        <a href="http://127.0.0.1:5501/index.html">Log Out</a></div></div>
                </form>

            </div>
        </div>
    </div>
</body>
<script src="/InvenToWare-main/javascript/dashboard.js"></script>

</html>