<div class="w-[98%] mx-auto flex">
        <div class="dropdown w-[16%] mt-[10px] h-[886px]">
            <h1 class="w-full p-3 font-bold text-white border-b-4 bg-gradient-to-r from-black to-gray-800" >Site Option</h1>
            <div class="sidenav">
                <button class="dropdown-btn">Title & Slogan
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                  <a href="titleslogan.php">Title & Slogan</a>
                  <a href="social.php">Social Media</a>
                  <a href="copyright.php">Copyright</a>
                </div>

                <button class="dropdown-btn">Pages<i class="fa fa-caret-down"></i></button>
                <div class="dropdown-container">
                <a href="addpage.php">Add New Pages</a>
                <?php 
                    $query = "select * from tbl_page";
                    $pages = $db->select($query);
                    if ($pages) {
                        while ($result = $pages->fetch_assoc()) {      
                ?>
                <a href="page.php?pageid=<?php echo $result['id'];?>"><?php echo $result['name'];?></a>
              <?php } } ?>
                </div>

                <button class="dropdown-btn">Category Option
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                  <a href="addcat.php">Add Category</a>
                  <a href="catlist.php">Category List</a>
                </div>

                <button class="dropdown-btn">Post Option
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                  <a href="addpost.php">Add Post</a>
                  <a href="postlist.php">Post List</a>
                </div>
              </div>     
              
              <script>
              var dropdown = document.getElementsByClassName("dropdown-btn");
              var i;
              
              for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function() {
                  this.classList.toggle("active");
                  var dropdownContent = this.nextElementSibling;
                  if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                  } else {
                    dropdownContent.style.display = "block";
                  }
                });
              }
              </script>
        </div>