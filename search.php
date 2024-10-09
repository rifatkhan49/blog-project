<?php include 'inc/header.php';?>
<?php 
	if (!isset($_GET['search']) || $_GET['search'] == NULL) {
		header("Location: 404.php");
	} else {
		$search = $_GET['search'];
	}
?>

<div class="p-4 contentsection templete contemplete clear">
	<div class="float-left border border-gray-600 maincontent clear" style="margin: 0 15px 15px 0 ; padding: 8px 15px; ">
    <?php 
		$query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
		$post  = $db->select($query);
		if ($post) {
		    while ($result = $post->fetch_assoc()) {
	?>
    <div class="font-normal leading-6 text-justify samepost clear">
			<h2 class="mb-1 text-2xl text-black" style="border-bottom: 2px solid gray; padding: 10px 10px 10px 0;">
				<a class="font-bold text-white" href="post.php?id=<?php echo $result['id'] ?>"><?php echo $result['title'];?></a>
			</h2>
			<h4 class="mt-0 mb-3 font-normal"><?php echo $fm->formatDate($result['date']);?>, By
			    <a class="text-blue-700 no-underline" href="#"><?php echo $result['author'];?></a>
			</h4>
                <a href="#">
                    <img class="border border-gray-700 float-left mr-3 p-1 w-[200px]" src="admin/<?php echo $result['image'];?>" alt="post image"/>
                </a>
                <?php echo $fm->textShorten($result['body']);?>
			<div class="float-right mt-3 readmore clear">
				<a class="block text-gray-800 no-underline rounded" style="background: #fff none repeat scroll 0 0;
					border: 1px solid #b7801c; font-size: 17px; padding: 4px 8px;" href="post.php?id=<?php echo $result['id'];?>">Read More</a>
			</div>
		</div>
        <?php } }  else { ?>
            <p>Your Search Query Not Found !!</p>
        <?php } ?>	
    </div>
    <?php include 'inc/sideber.php';?>
    <?php include 'inc/footer.php';?>
</body>
</html>    