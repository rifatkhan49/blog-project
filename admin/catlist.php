<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
    <div class="admin_header w-[85%] h-[500px] mt-2 ml-3">
        <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Category List</h2>
        <?php 
            if (isset($_GET['delcat'])) {
                $delid = $_GET['delcat'];
                $delquery = "delete from tbl_category where id='$delid'";
                $deldata = $db->delete($delquery);
                if ($deldata) {
                    echo"<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>Category Deleted successfully.</span>";
                } else {
                    echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Category Not Deleted !</span>";
                }
            }
        ?>
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
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <?php 
                        $query = "select * from tbl_category order by id desc";
                        $category = $db->select($query );
                        if ($category) {
                            $i = 0;
                            while ($result = $category->fetch_assoc()) {
                                $i++;
                    ?>
                    <tr class="p-3">
                        <td class="px-2"><?php echo $i; ?></td>
                        <td class="px-2"><?php echo $result['name']; ?></td>
                        <td class="px-2">
                            <a href="editcat.php?catid=<?php echo $result['id'];?>">Edit</a> || 
                            <a onclick="return confirm('Are you sure to Delete !')" href="?delcat=<?php echo $result['id'];?>">Delete</a>
                        </td>
                    </tr>
                  <?php } } ?>
                </tbody>
            </table>
            <div>
                <p class="text-white">Showing 1 to 8 of 8 entries</p>
            </div>
        </div>
    </div>
    <?php include 'inc/footer.php';?>
