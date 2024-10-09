<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
<?php 
    if (!isset($_GET['viewpostid']) || $_GET['viewpostid'] == NULL) {
        echo "<script>window.location = 'postlist.php';</script>";
        //header("Location: catlist.php");
    } else {
        $postid = $_GET['viewpostid'];
    }
?>
    <div class="admin_header w-[85%] overflow-hidden mt-2 ml-3">
        <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Edit Post</h2>
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
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
                               <input class="text-black"  type="text"  readonly name="title" value="<?php echo $postresult['title'];?>" class="medium" />
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
                               <label>Image</label>
                           </td>
                           <td>
                               <img style="margin-top: 5px;" src="<?php echo $postresult['image'];?>" width="250px">
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
                               <input class="text-black" type="text" readonly name="tags" value="<?php echo $postresult['tags'];?>" class="medium" />
                           </td>
                       </tr>
                       <tr>
                           <td class="pr-32">
                               <label>Author</label>
                           </td>
                           <td>
                               <input class="text-black" type="text" readonly name="author" value="<?php echo $postresult['author'];?>" class="medium" />
                           </td>
                       </tr>
                       <tr>
                           <td></td>
                           <td>
                               <input type="submit" name="submit" Value="Ok" />
                           </td>
                       </tr>
                   </table>
                   </form>
                   <?php } ?>
               </div>
        </div>
    </div>
    <?php include 'inc/footer.php';?>