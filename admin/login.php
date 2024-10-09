<?php 
  include '../lib/Session.php';
  Session::checklogin();
?>
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../helpers/Format.php';?>
<?php 
	$db = new Database();
	$fm = new Format();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="stylesheet" href="css/styleindex.css">
    <title>Login Page</title>
</head>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0)) none repeat scroll 0 0;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0px 8px 12px 0 rgba(0, 0, 0, 0.37);
        min-height: 100vh;
        width: 100%;
        overflow: hidden;
    }
</style>
<body>
    <!--ring div starts here-->
    <div class="ring admin_header" style="width: 30%">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>
        <div class="login" style="width: 310px">
          <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              $username = $fm->validation($_POST['username']);
              $password = $fm->validation(md5($_POST['password']));

              $username = mysqli_real_escape_string($db->link, $username);
              $password = mysqli_real_escape_string($db->link, $password);

              $query = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
              $result = $db->select($query);
              if ($result != false) {
                  //$value = mysqli_fetch_array($result);
                  $value = $result->fetch_assoc();
                      Session::set("login", true);
                      Session::set("username", $value['username']);
                      Session::set("userId", $value['id']);
                      Session::set("userRole", $value['role']);
                      header("Location: index.php");
                 } else {
                echo "<span style='color: red; font-size: 18px;'>Username or Password not matched !!</span>";
              }
            }
          ?>
          <form action="login.php" method="post">
              <h2 style="padding: 10px; margin-botoom: 10px;">Admin Login</h2>
              <div class="inputBx" style="margin-top:10px; margin-bottom:10px;">
                <input name="username" type="text" placeholder="Username">
              </div>
              <div class="inputBx">
                <input style="margin-top:10px; margin-bottom:10px;" type="password" name="password" placeholder="Password">
              </div>
              <div style="margin-top:10px; margin-bottom:10px;" class="inputBx">
                <input type="submit" value="Sign in">
              </div>
              <div style="margin-top:10px; margin-bottom:10px;" class="links">
                <a href="forgetpas.php">Forget Password</a>
                <a href="#">Signup</a>
              </div>
          </form>
        </div>
      </div>
  <!--ring div ends here-->
</body>
</html>
