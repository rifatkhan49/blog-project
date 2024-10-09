<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
    <div class="admin_header w-[85%] mt-2 ml-3">
        <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Inbox</h2>
        <?php 
            if (isset($_GET['seenid'])) {
                $seenid = $_GET['seenid'];
                $query = "UPDATE tbl_contact SET status='1' WHERE id='$seenid'";
                    $update_rows = $db->update($query);
                    if ($update_rows) {
                        echo"<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>Message send in the seen box.</span>";
                    } else {
                        echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>something wrong.!</span>";
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
        <div class="mt-2 cat" style="padding-bottom: 100px;">
            <table class="w-[98%] mx-auto text-left">
                <thead style="background: radial-gradient(black, transparent); border: 1px solid gray;">
                    <tr class="text-white ">
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                <?php 
                        $query = "select * from tbl_contact where status='0' order by id desc";
                        $msg = $db->select($query );
                        if ($msg) {
                            $i = 0;
                            while ($result = $msg->fetch_assoc()) {
                                $i++;
                    ?>
                    <tr class="p-3">
                        <td class="px-2"><?php echo $i;?></td>
                        <td class="px-2"><?php echo $result['firstname'].' '. $result['lastname'];?></td>
                        <td class="px-2"><?php echo $result['email'];?></td>
                        <td class="px-2"><?php echo $fm->textShorten($result['body'], 30);?></td>
                        <td class="px-2"><?php echo $fm->formatDate($result['Date']); ?></td>
                        <td class="px-2">
                            <a href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a> ||
                            <a href="replymsg.php?msgid=<?php echo $result['id'];?>">Reply</a> ||
                            <a onclick="return confirm('Are you sure to Move Seen Box..!')" href="?seenid=<?php echo $result['id'];?>">Seen</a>
                        </td>
                    </tr>
                    
                    <?php } } ?>
                </tbody>
            </table>
            <div>
                <p class="text-white">Showing 1 to 8 of 8 entries</p>
            </div>
        </div>




        <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Seen Message</h2>
        <?php 
            if (isset($_GET['delid'])) {
                $delid = $_GET['delid'];
                $delquery = "delete from tbl_contact where id='$delid'";
                $deldata = $db->delete($delquery);
                if ($deldata) {
                    echo"<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>Message Deleted successfully.</span>";
                } else {
                    echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Message Not Deleted !</span>";
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
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                <?php 
                        $query = "select * from tbl_contact where status='1' order by id desc";
                        $msg = $db->select($query );
                        if ($msg) {
                            $i = 0;
                            while ($result = $msg->fetch_assoc()) {
                                $i++;
                    ?>
                    <tr class="p-3">
                        <td class="px-2"><?php echo $i;?></td>
                        <td class="px-2"><?php echo $result['firstname'].' '. $result['lastname'];?></td>
                        <td class="px-2"><?php echo $result['email'];?></td>
                        <td class="px-2"><?php echo $fm->textShorten($result['body'], 30);?></td>
                        <td class="px-2"><?php echo $fm->formatDate($result['Date']); ?></td>
                        <td class="px-2">
                            <a href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a> ||
                            <a onclick="return confirm('Are you sure to Delete !')" href="?delid=<?php echo $result['id'];?>">Delete</a>                    
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
