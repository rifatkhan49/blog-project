<?php 
  include '../lib/Session.php';
  Session::checkSession();
?>
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../helpers/Format.php';?>
<?php 
	$db = new Database();
	$fm = new Format();
?>
<?php 
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: Sat, 5 jul 2024 11:00:00 GMT");
    header("Cache-Control: Max-age= 2592000");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="stylesheet" href="css/styleindex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>admin</title>
</head>
<body>
    <div class="w-[98%] mx-auto p-2 admin_header">
		<div class="w-full ">
            <div class="flex w-full"">
                <div class="">
                    <img class="max-w-20" src="image/rainbow.png" alt="Logo" />        
                </div>
                <div style="width: 163%; margin-left: 10px;">
                  <h1 class="text-2xl font-semibold text-white">Training with live project</h1>
                  <p class="text-[15px] text-white">www.trainingwithliveproject.com</p>
                </div>
                <div class="flex items-center w-full" style="margin-left: 66%;">
                    <div class="">
                        <img class="max-w-20" src="image/img-profile.jpg" alt="Profile Pic" />
                    </div>
                    <?php 
                        if (isset($_GET['action']) && $_GET['action'] == "logout") {
                            Session::destroy();
                        }    
                    ?>
                    <div class="">
                        <ul class="flex">
                            <li class="ml-2 mt-0.5 text-[15px] text-white">Hello <?php echo Session::get('username');?></li>
                            <li class="ml-2 text-white">|</li>
                            <li class="ml-2 mt-0.5 text-[15px] font-bold text-blue-700"><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
	</div>

    <div class="admin_nav w-[98%] mx-auto mt-2">
        <div class="grid_12">
            <ul class="flex p-3 nav main">
                <li class="mr-8 ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href="profile.php"><span>User Profile</span></a></li>
				<li class="ml-2 mr-8 ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
				<li class="mr-8 ic-grid-tables"><a href="inbox.php"><span>Inbox
                <?php 
                    $query = "select * from tbl_contact where status='0' order by id desc";
                    $msg = $db->select($query );
                    if ($msg) {
                        $count = mysqli_num_rows($msg);
                        echo "(".$count.")";
                    } else {
                        echo "(0)";
                    }
                ?>
                </span></a></li>
                <?php 
                    if (Session::get('userRole') == '0') { ?>
                <li class="ic-charts"><a href="adduser.php"><span>Add User</span></a></li>
                <?php } ?>
                <li class="ml-6 ic-charts"><a href="userlist.php"><span>User List</span></a></li>
            </ul>
        </div>
    </div>
    

