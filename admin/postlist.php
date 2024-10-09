<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
<div class="admin_header w-[85%] overflow-hidden mt-2 ml-3">
<h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Add New Category</h2>
<div class="flex items-center justify-between mt-2">
    <div class="flex mt-3 mb-3 ml-5">
        <p class="mr-1 font-semibold text-white">show</p>
        <select name="select" id="select" class="border border-gray-600">
            <option value="select">10</option>
            <option value="select">30</option>
            <option value="select">50</option>
            <option value="select">50</option>
        </select>
        <p class="ml-1 font-semibold text-white">entries</p>
    </div>
    <div class="mr-5">
        <label class="mr-1 font-semibold text-white" for="search_R">Search:</label>
        <input type="text" id="search_R" name="searchbtn">
    </div>
</div>
<div class="mt-2 cat">
    <table class="w-[98%] mx-auto text-left">
        <thead style="background: radial-gradient(black, transparent); border: 1px solid gray;">
            <tr class="text-white ">
                <th width="5%">No.</th>
                <th width="15%">Post title</th>
                <th width="20%">Description</th>
                <th width="10%">Category</th>
                <th width="10%">Image</th>
                <th width="10%">Author</th>
                <th width="10%">Tags</th>
                <th width="10%">Date</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody class="text-white">
            <?php 
                $query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat = tbl_category.id ORDER BY tbl_post.title DESC";
                $post = $db->select($query);
                if ($post) {
                    $i=0;
                    while ($result = $post->fetch_assoc()) {
                        $i++;
            ?>
            <tr class="p-3">
                <td class="px-2"><?php echo $i; ?></td>
                <td class="px-2"><?php echo $result['title'];?></td>
                <td class="px-2"><?php echo $fm->textShorten($result['body'], 50);?></td>
                <td class="px-2"><?php echo $result['name'];?></td>
                <td class="px-2"><img src="<?php echo $result['image'];?>" height="40px" width="60px"></td>
                <td class="px-2"><?php echo $result['author'];?></td>
                <td class="px-2"><?php echo $result['tags'];?></td>
                <td class="px-2"><?php echo $fm->formatDate($result['date']);?></td>
                <td class="px-2">
                    <a href="viewpost.php?viewpostid=<?php echo $result['id'];?>">View</a>
                    <?php 
                        if (Session::get('userId') == $result['userid'] || Session::get('userRole') == '0') { ?>
                           || <a href="editpost.php?editpostid=<?php echo $result['id'];?>">Edit</a> ||
                            <a onclick="return confirm('Are you sure to Delete !')" href="deletepost.php?deletepostid=<?php echo $result['id'];?>">Delete</a>
                    <?php } ?> 
                    
                </td>
            </tr>
            <?php } } ?>
        </tbody>
    </table>
    <div>
        <p class="text-white" style="margin-left: 25px;">Showing 1 to 8 of 8 entries</p>
    </div>
</div>
</div>
    
    <?php include 'inc/footer.php';?>
