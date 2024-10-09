<?php include 'inc/header.php';?>
<?php include 'inc/slider.php';?>

<div class="p-4 contentsection templete contemplete clear">
	<div class="float-left border border-gray-600 maincontent clear" style="margin: 0 15px 15px 0 ; padding: 8px 15px; ">
	<!--pagination-->
	<?php 
		$per_page = 3;
		if (isset($_GET["page"])) {
			$page = $_GET["page"];
		} else {
			$page = 1;
		}
		$start_form = ($page-1) * $per_page;
	?>
	<?php 
		$query = "SELECT * FROM tbl_post limit $start_form, $per_page";
		$post  = $db->select($query);
		if ($post) {
		while ($result = $post->fetch_assoc()) {
	?>
		<div class="font-normal leading-6 text-justify samepost clear">
			<h2 class="mb-1 text-2xl text-black" style="border-bottom: 2px solid gray; padding: 10px 10px 10px 0;">
				<a class="font-bold text-white" href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a>
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
		<?php } ?>
		
		<!--pagination-->
		<?php
		$query = "SELECT * FROM tbl_post";
		$result  = $db->select($query);
		$total_rows = mysqli_num_rows($result);
		$total_pages = ceil($total_rows/$per_page);
		
		echo "<span class='pagination'><a href='index.php?page=1'>".'First Page'."</a>";
			for ($i=1; $i <= $total_pages ; $i++) { 
				echo "<a href='index.php?page=".$i."'>".$i."</a>";
			}
		echo "<a href='index.php?page=$total_pages'>".'Last Page'."</a></span>"?>
		<!--pagination-->

	<?php }  else { header ("Location: 404.php");}?>				
</div>


	
<?php include 'inc/sideber.php';?>
<?php include 'inc/footer.php';?>

	