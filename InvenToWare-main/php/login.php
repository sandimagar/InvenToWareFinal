<?php
session_start();
include("database.php");

if(isset($_POST["login-btn"])){
$logpassword = $_POST['logpassword'];
$loguser = $_POST['loguser'];
 $query = "SELECT * FROM mytable WHERE Username = '$loguser'";
  $result = mysqli_query($con, $query);

  $_SESSION['logUser'] = $loguser; 
if(mysqli_num_rows($result) == 1){
  //  if(mysqli_num_rows($result) > 0){
      // $hash = password_hash($logpassword, PASSWORD_DEFAULT);
      while($row = mysqli_fetch_assoc($result)){
        if( $logpassword === $row["Password"]){
          echo"login successfull";
          
          header("location: /InvenToWare-main/php/dashboard.php");
session_start();
          $_SESSION["User"] = $row["Username"];
        }else{
          echo" <div class = 'alert'> Invalid password !</div>";
        }
    
      // }
    
     
    }
}else{
  echo "<div class = 'alert'> Invalid User !</div>";
  
}

}
?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link rel="stylesheet" href="/InvenToWare-main/css/style.css">
  <script src="https://kit.fontawesome.com/36c3b57b6b.js" crossorigin="anonymous"></script>
  <title>Inventory Management System</title>

<style>
  
    .alert {
      text-align: center;
      border-radius: 6px;
      position: absolute;
      top: 27%;
      left: 40%;
      width: 20vw;
  padding: 15px;
  background-color: #f44336; 
  color: white;
}

</style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
      <div class="input-group">
        
        <label for="username_email">Username</label>
        <i class="fa-solid fa-user "  id="usericons"></i>

        <input type="text" id="username_email" name="loguser" required>
      </div>
      <div class="input-group">
        <label for="password">Password:</label>
        <i class="fa-solid fa-lock" id="passicons"></i>

        <input type="password" id="password" name="logpassword" required>
      </div>
      <input type="submit" name="login-btn" value="Login">
    </form>
    <p class="not-signed-in" style="margin-top: 1vw;">
        <label for="text-sigin">Not signed in? </label>
      <a href="http://localhost/InvenToWare-main/php/register.php" style = "color:blue;margin-left:6px"> Sign up here.</a>

    </p>
  </div>
</body>
</html>
