<?php include 'inc/header.php';?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fname = $fm->validation($_POST['firstname']);
        $lname = $fm->validation($_POST['lastname']);
        $email = $fm->validation($_POST['email']);
        $body = $fm->validation($_POST['body']);

        $fname = mysqli_real_escape_string($db->link, $fname);
        $lname = mysqli_real_escape_string($db->link, $lname);
        $email = mysqli_real_escape_string($db->link, $email);
        $body = mysqli_real_escape_string($db->link, $body);

        $errorf = "";
        $errorl = "";
        $errore = "";
        $errorb = "";
        if (empty($fname)) {
            $errorf = "First name must not be empty !";
        }
        if (empty($lname)) {
            $errorl = "Last name must not be empty !";
        }
        if (empty($email)) {
            $errore = "Email file must not be empty !";
        }
        if (empty($body)) {
            $errorb = "Body must not be empty !";
        }
        if (empty($fname)) {
            $error = "First name must not be empty !";
        } elseif (empty($lname)) {
            $error = "Last name must not be empty !";
        } elseif (empty($email)) {
            $error = "Email name must not be empty !";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid Email Address !";
        } elseif (empty($body)) {
            $error = "Message field must not be empty !";
        }
        else {
            $query = "INSERT INTO tbl_contact(firstname, lastname, email, body) VALUES('$fname', '$lname', '$email', '$body')";
            $inserted_rows = $db->insert($query);
            if ($inserted_rows) {
                $msg = "Message Sent Successfully.";
            }else {
                $error = "Message Not Sent !";
            }
        }
    }
?>
	<div class="p-4 contentsection templete contemplete clear">
		<div class="float-left border border-gray-600 maincontent clear" style="margin: 0 15px 15px 0 ; padding: 8px 15px; ">
		    <div class="leading-6 text-justify about clear" style="font-size: 16px;">
                    <h2 class="mb-1 font-bold text-2xl mb-3 text-[cornsilk]" style="padding: 10px 10pxs 10px 0; border-bottom: 2px solid cornsilk;">contact us</h2>
                    <?php
                        if (isset($error)) {
                            echo "<span style='color: red;''>$error</span>";
                        }
                        if (isset($msg)) {
                            echo "<span style='color: green;''>$msg</span>";
                        }
                    ?>
                    <form action="" method="post">
                        <table class="w-[98%]">
                        <tr>
                            <td class="p-2 text-white">Your First Name:</td>
                            <td>
                            <?php
                                if (isset($errorf)) {
                                    echo "<span style='color: red;'>$errorf</span>";
                                }
                            ?>
                            <input class="p-1 w-[300px]" type="text" name="firstname" placeholder="Enter first name"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1 text-white">Your Last Name:</td>
                            <td>
                            <?php 
                                if (isset($errorl)) {
                                    echo "<span style='color: red;'>$errorl</span>";
                                }
                            ?>
                            <input class="p-1 w-[300px]" type="text" name="lastname" placeholder="Enter Last name"/>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="p-2 text-white">Your Email Address:</td>
                            <td>
                            <?php
                                if (isset($errore)) {
                                    echo "<span style='color: red;'>$errore</span>";
                                }
                             ?>
                            <input class="p-1 w-[300px]" type="email" name="email" placeholder="Enter Email Address"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-1 text-white">Your Message:</td>
                            <td>
                            <?php 
                                if (isset($errorb)) {
                                    echo "<span style='color: red;'>$errorb</span>";
                                }
                            ?>
                            <textarea name="body" class=" p-1 w-[300px]"></textarea>
                            </td>
                        </tr>
                        <tr class="">
                            <td></td>
                            <td class="pt-2">
                            <input class="p-2 text-white bg-[goldenrod]" type="submit" name="submit" value="Send"/>
                            </td>
                        </tr>
                </table>
            <form>	
            </div>			
        </div>
	
        <?php include 'inc/sideber.php';?>
<?php include 'inc/footer.php';?>