<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
<?php 
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
        echo "<script>window.location = 'index.php';</script>";
        //header("Location: catlist.php");
    } else {
        $id = $_GET['pageid'];
    }
?>
<style>
    .actiondel { margin-left: 10px;}
    .actiondel a {border: 1px solid #e6af4b; color: #fff; cursor: pointer; font-size: 20px; padding: 4px 10px;}
    .actiondel a:hover {background: #FEF4E5; color: #000;}
</style>
<div class="admin_header w-[85%] h-[500px] mt-2 ml-3">
    <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Edit Page</h2>
    <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            if ($name == "" || $body == "" ) {
                echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Field Must Not be Emptyt !</span>";
            }  else {
                $query = "UPDATE tbl_page SET
                    name='$name',
                    body='$body' 
                    WHERE id='$id'";
                $update_rows = $db->update($query);
                if ($update_rows) {
                echo "<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>Page Updated Successfully.</span>";
                }else {
                echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Page Not Updated !</span>";
                }
            }
        }
    ?>
<div class="flex items-center justify-between mt-2">
    <div class="w-full p-5">  
    <?php 
        $pagequery = "select * from tbl_page where id='$id'";
        $pagedetails = $db->select($pagequery);
        if ($pagedetails) {
            while ($result = $pagedetails->fetch_assoc()) {      
    ?>
        <form action="" method="post">
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
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
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
                        <input type="submit" name="submit" Value="update" />
                        <span class="actiondel"><a onclick="return confirm('Are you sure to Delete This Page !.')" href="deletepage.php?delpage=<?php echo $result['id'];?>">Delete</a></span>
                    </td>
                </tr>
            </table>
            </form>
            <?php } } ?>
        </div>
    </div>
</div>
    <?php include 'inc/footer.php';?>