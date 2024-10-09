<?php include 'inc/header.php';?>
<?php 
	if (!isset($_GET['id']) || $_GET['id'] == NULL) {
		header("Location: 404.php");
	} else {
		$id = $_GET['id'];
	}
?>
	<div class="p-4 contentsection templete contemplete clear">
		<div class="float-left border border-gray-600 maincontent clear" style="margin: 0 15px 15px 0 ; padding: 8px 15px; ">
			<div class="font-normal leading-6 text-justify samepost clear">
			<?php 
				$query = "SELECT * FROM tbl_post WHERE id=$id";
				$post  = $db->select($query);
				if ($post) {
				while ($result = $post->fetch_assoc()) {
			?>
				<h2 class="mb-1 text-2xl text-black" style="border-bottom: 2px solid gray; padding: 10px 10px 10px 0;"><a class="font-bold text-white" href=""><?php echo $result['title'];?></a></h2>
				<h4 class="mt-0 mb-3 font-normal"><?php echo $fm->formatDate($result['date']);?>, By 
					<a class="text-blue-700 no-underline" href="#"><?php echo $result['author'];?></a>
				</h4>
				 <a href="post.php?id=<?php echo $result['id'];?>">
					<img class="border border-gray-700 float-left mr-3 p-1 w-[200px]" src="admin/<?php echo $result['image'];?>"/>
				</a>
				<?php echo $result['body'];?>	
	
                <div class="relatedpost clear">
					<h2 class="mt-4 text-xl text-white " style="padding: 10px 10px 10px 0; margin-bottom: 8px !important; padding-left: 10px !important; border-bottom: 2px solid gray; background-color: dimgray">Related articles</h2>
					<?php 
						$catid = $result['cat'];
						$queryrelated = "SELECT * FROM tbl_post WHERE cat='$catid' order by rand() limit 6";
						$relatedpost  = $db->select($queryrelated);
						if ($relatedpost) {
						while ($rresult = $relatedpost->fetch_assoc()) {
					?>
					<a href="post.php?id=<?php echo $rresult['id'];?>">
						<img class="float-left w-48 p-1 mb-3 mr-3 border border-gray-600 h-28" src="admin/<?php echo $rresult['image'];?>" alt="post image"/>
					</a>
					<?php } } else {echo "No Related Post Available !!";}?>
				</div>
				<?php  } } else { header ("Location: 404.php");}?>
				
			</div>
		</div>

		<?php include 'inc/sideber.php';?>
<?php include 'inc/footer.php';?>