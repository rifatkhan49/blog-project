<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
<?php 
    if (!isset($_GET['editpostid']) || $_GET['editpostid'] == NULL) {
        echo "<script>window.location = 'postlist.php';</script>";
        //header("Location: catlist.php");
    } else {
        $postid = $_GET['editpostid'];
    }
?>
    <div class="admin_header w-[85%] overflow-hidden mt-2 ml-3">
        <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Edit Post</h2>
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = mysqli_real_escape_string($db->link, $_POST['title']);
                $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
                $body = mysqli_real_escape_string($db->link, $_POST['body']);
                $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
                $author = mysqli_real_escape_string($db->link, $_POST['author']);
                $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "upload/".$unique_image;

                if ($title == "" || $cat == "" || $body == "" || $tags == "" ||  $author == "") {
                    echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Field Must Not be Emptyt !</span>";
                } else {
                if (!empty($file_name)) {
                    if ($file_size >1048567) {
                    echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Image Size should be less then 1MB!</span>";

                    } elseif (in_array($file_ext, $permited) === false) {
                        echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>You can upload only:-".implode(', ', $permited)."</span>";

                    } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_post SET 
                        cat    = '$cat',
                        title  = '$title',
                        body   = '$body',
                        image  = '$uploaded_image',
                        author = '$author',
                        tags   = '$tags',
                        userid   = '$userid'
                        WHERE id='$postid'";
                    $updated_row = $db->update($query);
                    if ($updated_row) {
                        echo "<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>Data Updated Successfully.</span>";
                        
                    } else {
                        echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Data Not Updated !</span>";
                    }
                }
                } else {
                    $query = "UPDATE tbl_post SET 
                    cat    = '$cat',
                    title  = '$title',
                    body   = '$body',
                    author = '$author',
                    tags   = '$tags',
                    userid   = '$userid'
                    WHERE id='$postid'";
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
        <div class="flex items-center justify-between mt-2">
            <div class="w-full p-5">
                <?php 
                    $query = "select * from tbl_post where id='$postid' order by id desc";
                    $getpost = $db->select($query);
                    while ($postresult = $getpost->fetch_assoc()) {
                ?>               
                <form action="" method="post" enctype="multipart/form-data">
                   <table class="text-white form">
                      
                       <tr>
                           <td class="pr-32">
                               <label>Title</label>
                           </td>
                           <td>
                               <input class="text-black"  type="text" name="title" value="<?php echo $postresult['title'];?>" class="medium" />
                           </td>
                       </tr>
                    
                       <tr>
                           <td class="pr-32">
                               <label>Category</label>
                           </td>
                           <td>
                               <select class="text-black" id="select" name="cat">
                                   <option>Select Category</option>
                                   <?php 
                                        $query = "SELECT * FROM tbl_category";
                                        $category = $db->select($query);
                                        if ($category ) {
                                            while ($result = $category->fetch_assoc()) {
                                   ?>
                                   <option
                                   <?php 
                                        if ($postresult['cat'] == $result['id']) { ?>
                                        selected="selected"
                                   <?php } ?> value="<?php echo $result['id'];?>"><?php echo $result['name'];?>
                                    </option>
                                   <?php } } ?>
                                   
                               </select>
                           </td>
                       </tr>

                       <tr>
                           <td class="pr-32">
                               <label>Upload Image</label>
                           </td>
                           <td>
                               <img style="margin-top: 5px;" src="<?php echo $postresult['image'];?>" width="200px">
                               <input type="file" name="image" />
                           </td>
                       </tr>
                       <tr>
                           <td style="vertical-align: top; padding-top: 9px;">
                               <label>Content</label>
                           </td>
                           <td> 
                               <textarea class="text-black" style="width: 750px; height: 300px" name="body">
                                    <?php echo $postresult['body'];?>
                               </textarea>
                           </td>
                       </tr>
                       <tr>
                           <td class="pr-32">
                               <label>Tags</label>
                           </td>
                           <td>
                               <input class="text-black" type="text" name="tags" value="<?php echo $postresult['tags'];?>" class="medium" />
                           </td>
                       </tr>
                       <tr>
                           <td class="pr-32">
                               <label>Author</label>
                           </td>
                           <td>
                               <input class="text-black" type="text" name="author" value="<?php echo $postresult['author'];?>" class="medium" />
                           </td>
                       </tr>
                       <tr>
                            <td></td>
                            <td>
                                <input class="text-black" type="hidden" name="userid" value="<?php echo Session::get('userId')?>" class="medium" />
                            </td>
                       </tr>
                       <tr>
                           <td></td>
                           <td>
                               <input type="submit" name="submit" Value="Update" />
                           </td>
                       </tr>
                   </table>
                   </form>
                   <?php } ?>
               </div>
        </div>
    </div>
    <?php include 'inc/footer.php';?>