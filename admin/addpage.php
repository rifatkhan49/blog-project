<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
<div class="admin_header w-[85%] h-[500px] mt-2 ml-3">
    <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Add New Page</h2>
    <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            if ($name == "" || $body == "" ) {
                echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Field Must Not be Emptyt !</span>";
            }  else {
                $query = "INSERT INTO tbl_page(name, body) VALUES('$name',  '$body')";
                $inserted_rows = $db->insert($query);
                if ($inserted_rows) {
                echo "<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>Page Created Successfully.</span>";
                }else {
                echo "<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Page Not Created !</span>";
                }
            }
        }
    ?>
<div class="flex items-center justify-between mt-2">
    <div class="w-full p-5">               
        <form action="" method="post">
            <table class="text-white form">  
                <tr>
                    <td class="pr-32">
                        <label>Name</label>
                    </td>
                    <td>
                        <input class="text-black"  type="text" name="name" placeholder="Enter page Title..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea style="width: 550px; height: 200px;" class="text-black" name="body"></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
    <?php include 'inc/footer.php';?>