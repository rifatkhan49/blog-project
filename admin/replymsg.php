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
            $to = $fm->validation($_POST['toemail']);
            $from = $fm->validation($_POST['fromemail']);
            $subject = $fm->validation($_POST['subject']);
            $message = $fm->validation($_POST['message']);

            $sendmail = mail ($to, $from, $subject, $message);
            if ($sendmail) {
                echo "<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>Message sent Successfully.</span>";
            } else {
                echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Something went wrong..!</span>";
            }
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
                        <label>To</label>
                    </td>
                    <td>
                        <input class="text-black" name="toemail" type="text" readonly value="<?php echo $result['email']?>"  class="medium" />
                    </td>
                </tr>
                <tr>
                    <td class="pr-32">
                        <label>From</label>
                    </td>
                    <td>
                        <input class="text-black" name="fromemail" type="text"  placeholder="Please enter your email address.."  class="medium" />
                    </td>
                </tr>
                <tr>
                    <td class="pr-32">
                        <label>Subject</label>
                    </td>
                    <td>
                    <input class="text-black" name="subject" type="text"  placeholder="Please enter your subject.."  class="medium" />
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Message</label>
                    </td>
                    <td>
                        <textarea style="width: 550px; height: 200px;" class="text-black" name="message">
                            
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Send" />
                    </td>
                </tr>
            </table>
            <?php } } ?>
            </form>
        </div>
    </div>
</div>
    <?php include 'inc/footer.php';?>