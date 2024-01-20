<?php
session_start();

include("database.php");


if(isset($_POST["register"])){
    $Username = $_POST["User"];
    $Password = $_POST["Pass"];
    $Email = $_POST["email"];
    $Re_Pass = $_POST["Re-Pass"];
    
    if($Password!=$Re_Pass or $Re_Pass==null){
    //  echo "<div class='alert' style = ' text-align: center;
    //  position: absolute;
    //  top: -1vw;
    //  font-size:1.2vw;
    //  height: 2vw;
    //  width: 60%;
    //  background-color: rgb(243, 82, 8);
    //  filter: opacity(.8);'>Password don't match! Please re-check your password</div>";
 }else{
    // $hashedpass =password_hash($_POST["Pass"], PASSWORD_DEFAULT);
    $sql = "INSERT INTO mytable(Username,Password,Email)
    VALUES ('$Username','$Password','$Email')";
    $result = mysqli_query($con, $sql);
    header("location: login.php");
 }
 

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Form</title>
  <script src="https://kit.fontawesome.com/36c3b57b6b.js" crossorigin="anonymous"></script>
  <title>Inventory Management System</title>


  <link rel="stylesheet" href="/InvenToWare-main/css/style.css">
</head>
<body>



  <div class="container">
    <h2>Register Here</h2>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <i class="fa-solid fa-user "  id="usericons"></i>
        <input type="text" id="username" name="User" required>
      </div>
      <div class="form-group">
         <label for="email">Email:</label>
         <i class="fa-solid fa-envelope" id="emailicons"></i>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <i class="fa-solid fa-lock" id="passicons"></i>
        <input type="password" id="password" name="Pass" required>
      </div>
      <div class="form-group">
        <label for="re_password">Re-enter Password:</label>
        <i class="fa-solid fa-lock" id="passicons"></i>
        <input type="password" id="re_password" name="Re-Pass" required>
      </div>
      
      <div class="form-group">
        <input type="submit" name="register" value="Register">
      </div>
    </form>
  </div>

</body>
</html>
