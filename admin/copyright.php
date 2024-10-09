<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
<div class="admin_header w-[85%] h-[500px] mt-2 ml-3">
    <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Update Copyright Text</h2>
    <?php 
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $note = $fm->validation($_POST['note']);

          $note = mysqli_real_escape_string($db->link, $note);
          
          if ($note == "") {
              echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Field Must Not be Emptyt !</span>";
            } else { 
                $query = "UPDATE tbl_footer SET 
                note   = '$note'
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
    <div class="leading-8 ml-24 mt-6 pl-5 w-[600px] border-2 border-[#161819] ">
      <?php 
          $query = "select * from tbl_footer where id='1'";
          $footernote = $db->select($query);
          if ($footernote) {
              while ($result = $footernote->fetch_assoc()) {
      ?>
        <form class="p-8 form_section" action="copyright.php" method="post" >
            <table>
              <tr>
                <td>
                  <input class="border  border-[#cfc5b6] p-2 rounded" style="width: 350px; margin-bottom: 10px;" type="text" name="note" value="<?php echo $result['note']?>"/>
                </td>
            </tr>
            <tr>
                <td>
                  <input class="bg-gray-900 hover:bg-gray-800 hover:text-red-500 rounded text-white font-bold p-2 border-[b4aca1]" style="width: 100px;" type="submit" name="submit" value="Update"/>
                </td>
            </tr>
            </table>
        </form>
     <?php } } ?>   
    </div>
</div>
    <?php include 'inc/footer.php';?>