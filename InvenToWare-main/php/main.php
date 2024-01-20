<?php
session_start();
// echo ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/InvenToWare-main/css/dashboard.css">
    <title>Inventory Management System</title>

    <link rel="stylesheet" href="/InvenToWare-main/css/container_dashboard.css">

</head>
<body>
    <?php 
    include ("./dashboardnav.php");
    
    ?>
     <div class="side_content_container">
<?php 
    include ("./sidenav.php");
    ?>
        <div class="container_dashboard"></div>
    </div>
</body>
</html>