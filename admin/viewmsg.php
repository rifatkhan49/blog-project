<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
<?php 
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
        echo "<script>window.location = 'inbox.php';</script>";
    } else {
        $id = $_GET['msgid'];
    }
?>
<div class="admin_header w-[85%] h-[500px] mt-2 ml-3">
    <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">View Message</h2>
    <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script>window.location = 'inbox.php';</script>";
        }
    ?>
<div class="flex items-center justify-between mt-2">
    <div class="w-full p-5">               
        <form action="" method="post">
        <?php 
                        $query = "select * from tbl_contact where id='$id'";
                        $msg = $db->select($query );
                        if ($msg) {
                            while ($result = $msg->fetch_assoc()) {
                    ?>
            <table class="text-white form">  
                <tr>
                    <td class="pr-32">
                        <label>Name</label>
                    </td>
                    <td>
                        <input class="text-black"  type="text" readonly value="<?php echo $result['firstname'].' '.$result['lastname']?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td class="pr-32">
                        <label>Email</label>
                    </td>
                    <td>
                        <input class="text-black"  type="text" readonly value="<?php echo $result['email']?>"  class="medium" />
                    </td>
                </tr>
                <tr>
                    <td class="pr-32">
                        <label>date</label>
                    </td>
                    <td>
                        <input class="text-black"  type="text" readonly value="<?php echo $fm->formatDate($result['Date']); ?>"  class="medium" />
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Message</label>
                    </td>
                    <td>
                        <textarea style="width: 550px; height: 200px;" class="text-black" name="body">
                            <?php echo $result['body'];?> 
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Ok" />
                    </td>
                </tr>
            </table>
            <?php } } ?>
            </form>
        </div>
    </div>
</div>
    <?php include 'inc/footer.php';?>