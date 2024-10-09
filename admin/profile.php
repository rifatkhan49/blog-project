<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
<?php 
    $userid = Session::get('userId');
    $userrole = Session::get('userRole');
?>
    <div class="admin_header w-[85%] overflow-hidden mt-2 ml-3">
        <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Profile</h2>
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = mysqli_real_escape_string($db->link, $_POST['name']);
                $username = mysqli_real_escape_string($db->link, $_POST['username']);
                $email = mysqli_real_escape_string($db->link, $_POST['email']);
                $details = mysqli_real_escape_string($db->link, $_POST['details']);
                    $query = "UPDATE tbl_user SET 
                    name    = '$name',
                    username  = '$username',
                    email   = '$email',
                    details = '$details'
                    WHERE id='$userid'";
                $updated_row = $db->update($query);
                if ($updated_row) {
                    echo "<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>User Data Updated Successfully.</span>";
                    
                }else {
                    echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>User Data Not Updated !</span>";
                    }
                }
        ?>
        <div class="flex items-center justify-between mt-2">
            <div class="w-full p-5">
                <?php 
                    $query = "select * from tbl_user where id='$userid' AND role='$userrole'";
                    $getuser = $db->select($query);
                    if ($getuser) {
                    while ($result = $getuser->fetch_assoc()) {
                ?>               
                <form action="" method="post" enctype="multipart/form-data">
                   <table class="text-white form">
                      
                       <tr>
                           <td class="pr-32">
                               <label>Name</label>
                           </td>
                           <td>
                               <input class="text-black"  type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
                           </td>
                       </tr>
                       <tr>
                           <td class="pr-32">
                               <label>Username</label>
                           </td>
                           <td>
                               <input class="text-black"  type="text" name="username" value="<?php echo $result['username'];?>" class="medium" />
                           </td>
                       </tr>
                       <tr>
                           <td class="pr-32">
                               <label>Email</label>
                           </td>
                           <td>
                               <input class="text-black"  type="text" name="email" value="<?php echo $result['email'];?>" class="medium" />
                           </td>
                       </tr>
                    
                       <tr>
                           <td style="vertical-align: top; padding-top: 9px;">
                               <label>Details</label>
                           </td>
                           <td> 
                               <textarea class="text-black" style="width: 750px; height: 300px" name="details">
                                    <?php echo $result['details'];?>
                               </textarea>
                           </td>
                       </tr>
                       <tr>
                           <td></td>
                           <td>
                               <input type="submit" name="submit" Value="Update"/>
                           </td>
                       </tr>
                   </table>
                   </form>
                   <?php } } ?>
               </div>
        </div>
    </div>
    <?php include 'inc/footer.php';?>