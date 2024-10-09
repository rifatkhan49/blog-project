<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
<?php 
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location = 'catlist.php';</script>";
    } else {
        $id = $_GET['catid'];
    }
?>
<div class="admin_header w-[85%] h-[500px] mt-2 ml-3">
    <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Update Category</h2>
    <div class="leading-8 ml-24 mt-6 pl-5 w-[600px] border-2 border-[#161819]">
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $name = mysqli_real_escape_string($db->link, $name);
                if (empty($name)) {
                    echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Field must not be Empty !!</span>";
                } else {
                    $query = "UPDATE tbl_category SET name='$name' WHERE id='$id'";
                    $update_rows = $db->update($query);
                    if ($update_rows) {
                        echo"<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>Category Updated successfully.</span>";
                    } else {
                        echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Category Not Updated !</span>";
                    }
                }
                    
            }    
    
        ?>
        <?php 
            $query = "SELECT * FROM tbl_category WHERE id='$id' ORDER BY id desc";
            $category = $db->select($query);
            while ($result = $category->fetch_assoc()) {
        ?>
        <form class="p-8 text-white form_section " action="" method="post" >
            <table>
                <tr>
                    <td>
                    <input class="border text-black  border-[#cfc5b6] p-2 rounded" style="width: 350px; margin-bottom: 10px;" type="text" name="name" value="<?php echo $result['name'];?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                    <input class="bg-gray-900 hover:bg-gray-800 hover:text-red-500 rounded text-white font-bold p-2 border-[b4aca1]" style="width: 100px;" type="submit" name="submit" value="Update"/>
                    </td>
                </tr>
            </table>
        </form>
        <?php } ?>
    </div>
</div>
</div>
<?php include 'inc/footer.php';?>