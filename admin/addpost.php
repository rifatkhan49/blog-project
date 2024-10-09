<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
    <div class="admin_header w-[85%] h-[500px] mt-2 ml-3">
        <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Add New Post</h2>
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

                if ($title == "" || $cat == "" || $body == "" || $tags == "" ||  $author == "" || $file_name == "" ) {
                    echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Field Must Not be Emptyt !</span>";
                } elseif ($file_size >1048567) {
                    echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Image Size should be less then 1MB!</span>";

                   } elseif (in_array($file_ext, $permited) === false) {
                    echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>You can upload only:-".implode(', ', $permited)."</span>";

                   } else { move_uploaded_file($file_temp, $uploaded_image);
                   $query = "INSERT INTO tbl_post(cat, title, body, image, author, tags, userid) VALUES('$cat', '$title',  '$body', '$uploaded_image', '$author', '$tags', '$userid')";
                   $inserted_rows = $db->insert($query);

                   if ($inserted_rows) {
                    echo "<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>Data Inserted Successfully.</span>";
                    
                   }else {
                    echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Data Not Inserted !</span>";
                   }
                }
            }
        ?>
        <div class="flex items-center justify-between mt-2">
            <div class="w-full p-5">               
                <form action="addpost.php" method="post" enctype="multipart/form-data">
                   <table class="text-white form">
                      
                       <tr>
                           <td class="pr-32">
                               <label>Title</label>
                           </td>
                           <td>
                               <input class="text-black"  type="text" name="title" placeholder="Enter Post Title..." class="medium" />
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
                                   <option value="<?php echo $result['id'];?>"><?php echo $result['name'];?></option>
                                   <?php } } ?>
                                   
                               </select>
                           </td>
                       </tr>

                       <tr>
                           <td class="pr-32">
                               <label>Upload Image</label>
                           </td>
                           <td>
                               <input type="file" name="image" />
                           </td>
                       </tr>
                       <tr>
                           <td style="vertical-align: top; padding-top: 9px;">
                               <label>Content</label>
                           </td>
                           <td>
                               <textarea class="text-black" style="width: 500px;" name="body"></textarea>
                           </td>
                       </tr>
                       <tr>
                           <td class="pr-32">
                               <label>Tags</label>
                           </td>
                           <td>
                               <input class="text-black" type="text" name="tags" placeholder="Enter Tags.." class="medium" />
                           </td>
                       </tr>
                       <tr>
                           <td class="pr-32">
                               <label>Author</label>
                           </td>
                           <td>
                               <input class="text-black" type="text" name="author" value="<?php echo Session::get('username')?>" class="medium" />
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
               </div>
        </div>
    </div>
    <?php include 'inc/footer.php';?>

    