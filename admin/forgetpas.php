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
              $email = $fm->validation($_POST['email']);
              $email = mysqli_real_escape_string($db->link, $email);

              if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<span style='color: red; font-size: 18px;'>Invalid Email Address !</span>";
            } else {
                $mailquery = "select * from tbl_user where email='$email' limit 1";
                $mailcheck = $db->select($mailquery );
                if ($mailcheck != false) {
                    while ($value = $mailcheck->fetch_assoc()) {
                        $userid = $value['id'];
                        $username = $value['username'];
                    }
                    $text = substr($email, 0, 3);
                    $rand = rand(10000, 99999);
                    $newpass = $text.$rand;
                    $password = md5($newpass);
                    $updatequery = "UPDATE tbl_user
                                    SET 
                                    $password = 'password'
                                    WHERE id='$userid'";
                    $updated_rows = $db->update($updatequery);
                    $to = "$email";
                    $from = "ss@gmail.com";
                    $headers  .= 'MIME-Version: 1.0' . "\r\r";
                    $headers  .= 'Content-type: text/html; charset=iso-8859-1' . "\r\r";
                    $message = "Your Username is ".$username." and Password is ".$newpass."Please visit website to login.";

                    $sendmail = mail($to, $subject, $message, $headers);
                    if ($sendmail) {
                        echo "<span style='color: green; font-size: 18px;'>Please Check Your Email for new password!!</span>";
                    }
                    else {
                        echo "<span style='color: red; font-size: 18px;'>Email Not Send!!</span>";
                        }
                    
                    } else {
                        echo "<span style='color: red; font-size: 18px;'>Email Not Exist!!</span>";
                        }
                    }
                }
            ?>
          <form action="" method="post">
              <h2 style="padding: 10px; margin-botoom: 10px;">Password Recovery</h2>
              <div class="inputBx" style="margin-top:10px; margin-bottom:10px;">
                <input name="email" type="text" placeholder="Enter valid email">
              </div>
              <div style="margin-top:10px; margin-bottom:10px;" class="inputBx">
                <input type="submit" value="Send Mail">
              </div>
              <div style="margin-top:10px; margin-bottom:10px;" class="links">
                <a href="login.php">Login</a>
                <a href="#">Signup</a>
              </div>
          </form>
        </div>
      </div>
  <!--ring div ends here-->
</body>
</html>
