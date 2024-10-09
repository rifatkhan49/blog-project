<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
<div class="admin_header w-[85%] h-[500px] mt-2 ml-3">
<h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Update Social Media</h2>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fb = $fm->validation($_POST['fb']);
        $tw = $fm->validation($_POST['tw']);
        $ln = $fm->validation($_POST['ln']);
        $gp = $fm->validation($_POST['gp']);

        $fb = mysqli_real_escape_string($db->link, $fb);
        $tw = mysqli_real_escape_string($db->link, $tw); 
        $ln = mysqli_real_escape_string($db->link, $ln); 
        $gp = mysqli_real_escape_string($db->link, $gp);
        
        if ($fb == "" || $tw == "" || $ln == "" || $gp == "") {
            echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Field Must Not be Emptyt !</span>";
        } else { 
            $query = "UPDATE tbl_social SET 
            fb   = '$fb',
            tw  = '$tw', 
            ln  = '$ln',
            gp  = '$gp'
          WHERE id='1'";
      $updated_row = $db->update($query);
      if ($updated_row) {
          echo "<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>Data Updated Successfully.</span>";
          
      }else {
          echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Data Not Updated !</span>";
          }
        }
    }
?>
<div>
<?php 
    $query = "select * from tbl_social where id='1'";
    $socialmedia = $db->select($query);
    if ($socialmedia) {
        while ($result = $socialmedia->fetch_assoc()) {
?>
    <form class="form_section" action="social.php" method="post" >
        <table>
            <tr>
                <td class="text-white ">
                    <label class="ml-6" for="">Facebook</label>
                </td>
                <td>
                <input class="border mt-2 ml-[500px] border-[#cfc5b6] p-1 rounded" style="margin-left: 435px; width: 600px;" type="text" name="fb" value="<?php echo $result['fb']?>" required="1"/>
                </td>
            </tr>
            <tr>
                <td class="text-white ">
                    <label class="ml-6" for="">Twitter</label>
                </td>
                <td>
                <input class="border border-[#cfc5b6] p-1 rounded" style="margin-left: 435px; width: 600px;" type="text" name="tw" value="<?php echo $result['tw']?>" required="1"/>
                </td>
            </tr>
            <tr>
                <td class="text-white ">
                    <label class="ml-6" for="">LinkedIn</label>
                </td>
                <td>
                <input class="border border-[#cfc5b6] p-1 rounded" style="margin-left: 435px; width: 600px;" type="text" name="ln" value="<?php echo $result['ln']?>" required="1"/>
                </td>
            </tr>
            <tr>
                <td class="text-white ">
                    <label class="ml-6" for="">Google Plus</label>
                </td>
                <td>
                <input class="border border-[#cfc5b6] p-1 rounded" style="margin-left: 435px; width: 600px;" type="text" name="gp" value="<?php echo $result['gp']?>" required="1"/>
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
<?php } } ?>
</div>
</div>
<?php include 'inc/footer.php';?>