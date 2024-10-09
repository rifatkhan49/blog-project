<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
<?php 
    if (!isset($_GET['userid']) || $_GET['userid'] == NULL) {
        echo "<script>window.location = 'userlist.php';</script>";
    } else {
        $id = $_GET['userid'];
    }
?>
    <div class="admin_header w-[85%] overflow-hidden mt-2 ml-3">
        <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">User Details</h2>
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<script>window.location = 'userlist.php';</script>";
            }
        ?>
        <div class="flex items-center justify-between mt-2">
            <div class="w-full p-5">
                <?php 
                    $query = "select * from tbl_user where id='$id'";
                    $getuser = $db->select($query);
                    if ($getuser) {
                    while ($result = $getuser->fetch_assoc()) {
                ?>               
                <form action="" method="post">
                   <table class="text-white form">
                       <tr>
                           <td class="pr-32">
                               <label>Name</label>
                           </td>
                           <td>
                               <input class="text-black" readonly type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
                           </td>
                       </tr>
                       <tr>
                           <td class="pr-32">
                               <label>Username</label>
                           </td>
                           <td>
                               <input class="text-black" readonly type="text" name="username" value="<?php echo $result['username'];?>" class="medium" />
                           </td>
                       </tr>
                       <tr>
                           <td class="pr-32">
                               <label>Email</label>
                           </td>
                           <td>
                               <input class="text-black" readonly type="text" name="email" value="<?php echo $result['email'];?>" class="medium" />
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
                               <input type="submit" name="submit" Value="Ok"/>
                           </td>
                       </tr>
                   </table>
                   </form>
                   <?php } } ?>
               </div>
        </div>
    </div>
    <?php include 'inc/footer.php';?>