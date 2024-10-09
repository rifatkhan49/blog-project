<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
    <div class="admin_header w-[85%] h-[500px] mt-2 ml-3">
        <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Add New Category</h2>
        <div class="leading-8 ml-24 mt-6 pl-5 w-[600px] border-2 border-[#161819]">
            <?php 
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST['name'];
                    $name = mysqli_real_escape_string($db->link, $name);
                    if (empty($name)) {
                        echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Field must not be Empty !!</span>";
                    } else {
                        $query = "INSERT INTO tbl_category(name) VALUES('$name')";
                        $catinsert = $db->insert($query);
                        if ($catinsert) {
                            echo"<span style='color: green; font-size: 25px; font-weight: 700; margin-left: 30px;'>Category Inserted successfully.</span>";
                        } else {
                            echo"<span style='color: red; font-size: 25px; font-weight: 700; margin-left: 30px;'>Category Not Inserted !</span>";
                        }
                    }
                     
                }    
      
            ?>
            <form class="p-8 text-white form_section " action="" method="post" >
                <table>
                    <tr>
                        <td>
                        <input class="border text-black  border-[#cfc5b6] p-2 rounded" style="width: 350px; margin-bottom: 10px;" type="text" name="name" placeholder="Enter category name.."/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <input class="bg-gray-900 hover:bg-gray-800 hover:text-red-500 rounded text-white font-bold p-2 border-[b4aca1]" style="width: 100px;" type="submit" name="submit" value="Saved"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>