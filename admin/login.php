<?php
include '../classes/adminlogin.php';
?>
<?php
// goi class trong adminLogin()
$class = new adminlogin();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $adminUser = $_POST['adminUser'];
    $adminPass = md5($_POST['adminPass']);

    $login_check = $class->login_admin($adminUser,$adminPass);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen">
</head>
<body>
 
  <video autoplay muted loop id="bgVideo">
    <source src="img/adminbg.mp4" type="video/mp4" >
  </video>

  <div class="header-w3l">
    <h1>Admin Login</h1>
  </div>
 
  <div class="main-wlayouts-agileinfo">
    <!-- form starts here -->
    <div class="wthree-form">
      <h2>Fill out the form below to login</h2>
      <form action="login.php" method="post">
        <div class="form-sub-w3">
          <span>
            <?php
            if(isset($login_check)){
                echo $login_check;
            }
            ?>
          </span>
          <input type="text" placeholder="Username" required="" name="adminUser"/>
          <div class="icon-w3">
            <i class="fa fa-user" aria-hidden="true"></i>
          </div>
        </div>
        <div class="form-sub-w3">
          <input type="password" placeholder="Password" required="" name="adminPass"/>
          <div class="icon-w3">
            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
          </div>
        </div>
        <label class="anim">
          <input type="checkbox" class="checkbox" /> <span>Remember Me</span>
          <a href="#">Forgot Password</a>
        </label>
        <div class="clear"></div>
        <div class="submit-agileits">
          <input type="submit" value="Log in" />
        </div>
      </form>
    </div>
    <!-- /form ends here -->
  </div>
  <!-- /main -->
</body>
</html>
