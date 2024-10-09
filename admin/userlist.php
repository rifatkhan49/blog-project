<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
    <div class="admin_header w-[85%] h-[500px] mt-2 ml-3">
        <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">User List</h2>
        <?php 
            if (isset($_GET['deluser'])) {
                $deluser = $_GET['deluser'];
                $delquery = "delete from tbl_user where id='$deluser'";
                $deldata = $db->delete($delquery);
                if ($deldata) {
                    echo"<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>User Deleted successfully.</span>";
                } else {
                    echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>User Not Deleted !</span>";
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
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <?php 
                        $query = "select * from tbl_user order by id desc";
                        $alluser = $db->select($query );
                        if ($alluser) {
                            $i = 0;
                            while ($result = $alluser->fetch_assoc()) {
                                $i++;
                    ?>
                    <tr class="p-3">
                        <td class="px-2"><?php echo $i; ?></td>
                        <td class="px-2"><?php echo $result['name']; ?></td>
                        <td class="px-2"><?php echo $result['username']; ?></td>
                        <td class="px-2"><?php echo $result['email']; ?></td>
                        <td class="px-2"><?php echo $fm->textShorten($result['details'], 30); ?></td>
                        <td class="px-2">
                            <?php 
                                if ($result['role'] == '0') {
                                    echo "Admin";
                                } elseif ($result['role'] == '1') {
                                    echo "Rifat";
                                } elseif ($result['role'] == '2') {
                                    echo "Editor";
                                }
                            ?> 
                        </td>
                        <td class="px-2">
                            <a href="viewuser.php?userid=<?php echo $result['id'];?>">View</a>
                            <?php if (Session::get('userRole') == '0') { ?>
                            || <a onclick="return confirm('Are you sure to Delete !')" href="?deluser=<?php echo $result['id'];?>">Delete</a>
                            <?php } ?>
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
