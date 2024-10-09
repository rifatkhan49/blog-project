<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
<style>
    .leftside {float: left; width: 70%;}
    .rightside {float: left; width: 20%;}
    .rightside img {height: 160px; width: 170px;}
</style>

<div class="admin_header w-[85%] h-[500px] mt-2 ml-3">
    
    <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Update Site Title and Description</h2>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $fm->validation($_POST['title']);
        $slogan = $fm->validation($_POST['slogan']);

        $title = mysqli_real_escape_string($db->link, $title);
        $slogan = mysqli_real_escape_string($db->link, $slogan);

        $permited  = array('png', 'svg', 'pdf');
        $file_name = $_FILES['logo']['name'];
        $file_size = $_FILES['logo']['size'];
        $file_temp = $_FILES['logo']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $same_image = 'logo'.'.'.$file_ext;
        $uploaded_image = "upload/".$same_image;

        if ($title == "" || $slogan == "") {
            echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Field Must Not be Emptyt !</span>";
        } else {
        if (!empty($file_name)) {
            if ($file_size >1048567) {
            echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Image Size should be less then 1MB!</span>";

            } elseif (in_array($file_ext, $permited) === false) {
                echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>You can upload only:-".implode(', ', $permited)."</span>";

            } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "UPDATE title_slogan SET 
                title  = '$title',
                slogan   = '$slogan',
                logo  = '$uploaded_image'
                WHERE id='1'";
            $updated_row = $db->update($query);
            if ($updated_row) {
                echo "<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>Data Updated Successfully.</span>";
                
            } else {
                echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Data Not Updated !</span>";
            }
        }
        } else {
            $query = "UPDATE title_slogan SET 
              title   = '$title',
              slogan  = '$slogan'
            WHERE id='1'";
        $updated_row = $db->update($query);
        if ($updated_row) {
            echo "<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>Data Updated Successfully.</span>";
            
        }else {
            echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Data Not Updated !</span>";
            }
        }
    } 
}
?>
<?php 
    $query = "select * from title_slogan where id='1'";
    $blog_title = $db->select($query);
    if ($blog_title) {
        while ($result = $blog_title->fetch_assoc()) {
?>
    <div>
        <div class="leftside">
            <form class="form_section" action="" method="post" enctype= multipart/form-data>
                <table>
                    <tr>
                        <td class="text-white ">
                            <label class="ml-6" for="">Website Title</label>
                        </td>
                        <td>
                        <input class="border mt-2 ml-[500px] border-[#cfc5b6] p-1 rounded" style="margin-left: 435px; width: 600px;" type="text" name="title" value="<?php echo $result['title'];?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-white ">
                            <label class="ml-6" for="">Website Slogan</label>
                        </td>
                        <td>
                        <input class="border border-[#cfc5b6] p-1 rounded" style="margin-left: 435px; width: 600px;" type="text" name="slogan" " value="<?php echo $result['slogan'];?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="pr-32">
                            <label class="ml-6 text-white">Logo</label>
                        </td>
                        <td>
                            <input class="border border-[#cfc5b6] p-1 rounded" style="margin-left: 435px; width: 250px;" type="file" name="logo" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                        <input class="bg-gray-900 hover:bg-gray-800 hover:text-red-500 rounded text-white font-bold p-2 border-[b4aca1]" style="width: 100px; margin-left: 435px;" type="submit" name="submit" value="Update"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="rightside">
            <img class="ml-[170px] mt-[70px]" src="<?php echo $result['logo'] ?>" alt="logo">
        </div>
    </div>
    <?php } } ?>
</div>
    <?php include 'inc/footer.php';?>
