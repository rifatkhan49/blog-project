<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
<?php 
    if (!Session::get('userRole') == '0') { 
        echo "<script>window.location = 'index.php';</script>";
    }
?>
<div class="admin_header w-[85%] h-[500px] mt-2 ml-3">
    <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Add New User</h2>
    <div class="leading-8 ml-24 mt-6 pl-5 w-[600px] border-2 border-[#161819]">
    <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $fm->validation($_POST['name']);
            $username = $fm->validation($_POST['username']);
            $password = $fm->validation(md5($_POST['password']));
            $email = $fm->validation($_POST['email']);
            $role = $fm->validation($_POST['role']);

            $name = mysqli_real_escape_string($db->link, $name);
            $username = mysqli_real_escape_string($db->link, $username);
            $password = mysqli_real_escape_string($db->link, $password);
            $email = mysqli_real_escape_string($db->link, $email);
            $role = mysqli_real_escape_string($db->link, $role);
            if (empty($username) || empty($username) || empty($password) || empty($role) || empty($email)) {
                echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Field must not be Empty !!</span>";
            } else {
                $mailquery = "select * from tbl_user where email='$email' limit 1";
                $mailcheck = $db->select($mailquery );
                if ($mailcheck != false) {
                    echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Email Already Exixt !</span>";
                }
                else {
                $query = "INSERT INTO tbl_user(name, username, password, email, role) VALUES('$name', '$username', '$password', '$password', '$role')";
                $catinsert = $db->insert($query);
                if ($catinsert) {
                    echo"<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>User Created successfully.</span>";
                } else {
                    echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>User Not Created !</span>";
                }
            }
        } 
    }   
?>
        <form class="p-8 text-white form_section " action="" method="post" >
            <table>
            <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                    <input class="border text-black  border-[#cfc5b6] p-2 ml-6 rounded" style="width: 350px; margin-bottom: 10px;" type="text" name="name" placeholder="Enter name.."/>
                    </td>
            </tr>
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                    <input class="border text-black  border-[#cfc5b6] p-2 ml-6 rounded" style="width: 350px; margin-bottom: 10px;" type="text" name="username" placeholder="Enter username.."/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                    <input class="border text-black  border-[#cfc5b6] p-2 ml-6 rounded" style="width: 350px; margin-bottom: 10px;" type="text" name="password" placeholder="Enter password.."/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                    <input class="border text-black  border-[#cfc5b6] p-2 ml-6 rounded" style="width: 350px; margin-bottom: 10px;" type="email" name="email" placeholder="Enter valid email.."/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>User Role</label>
                    </td>
                    <td>
                    <select  class="border text-black  border-[#cfc5b6] p-2 ml-6 rounded" style="margin-bottom: 10px;" name="role" id="select">
                        <option>Select User Role</option>
                        <option value="0">Admin</option>
                        <option value="1">Rifat</option>
                        <option value="2">Editor</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <input class="bg-gray-900 hover:bg-gray-800 ml-6 hover:text-red-500 rounded text-black font-bold p-2 border-[b4aca1]" style="width: 100px;" type="submit" name="submit" value="Create"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    </div>
</div>
<?php include 'inc/footer.php';?>