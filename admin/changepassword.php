<?php include 'inc/header.php';?>
<?php include 'inc/sideber.php';?>
    <div class="admin_header w-[85%] h-[500px] mt-2 ml-3">
        <h2 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800">Update Site Title and Description</h2>
        <div class="mt-3">
            <form class="form_section" action="" method="" >
                <table>
                    <tr>
                        <td class="text-white ">
                            <label class="ml-6" for="">Old Password</label>
                        </td>
                        <td>
                        <input class="border ml-[500px] border-[#cfc5b6] p-1 rounded" style="margin-left: 435px; width: 600px;" type="password" name="old_pass" placeholder="Enter Old Password.." required="1"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-white ">
                            <label class="ml-6" for="">New Password</label>
                        </td>
                        <td>
                        <input class="border mt-2 border-[#cfc5b6] p-1 rounded" style="margin-left: 435px; width: 600px;" type="password" name="new_pass"   placeholder="Enter New Password.." required="1"/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                        <input class="bg-gray-900 mt-2 hover:bg-gray-800 hover:text-red-500 rounded text-white font-bold p-2 border-[b4aca1]" style="width: 100px; margin-left: 435px;" type="submit" name="submit" value="Update"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php include 'inc/footer.php';?>