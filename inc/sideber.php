<!--sidebersection-->
<div class="sidebar float-right mb-4 mt-0 p-3 w-[253px] border border-gray-600 clear">
	<div class="samesidebar clear">
		<h2 class="p-3 mb-2 text-white" style="border-bottom: 2px solid gray; background-color: dimgray;">Categories</h2>
			<ul>
			<?php 
				$query = "SELECT * FROM  tbl_category";
				$category  = $db->select($query);
				if ($category) {
				while ($result = $category->fetch_assoc()) {
			?>
				<li style="border-bottom: 1px dashed gray; font-size: 16px; padding: 5px 8px 5px 0;"><a href="posts.php?category=<?php echo $result['id'];?>"><?php echo $result['name'];?></a></li>
				<?php } } else {?>
					<li>No Category Created</li>
				<?php } ?>	
			</ul>
	</div>

	<div class="mt-2 mb-3 samesidebar clear">
		<h2  class="p-3 mb-2 text-white" style="border-bottom: 2px solid gray; background-color: dimgray;">Latest articles</h2>
		<?php 
			$query = "SELECT * FROM tbl_post limit 5";
			$post  = $db->select($query);
			if ($post) {
			while ($result = $post->fetch_assoc()) {
		?>
			<div class="mb-5 popular clear">
				<h3 class="pb-1 mb-3 text-xl font-normal" style="border-bottom: 1px dashed gray;"><a class="text-white no-underline" href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h3>
				<a href="post.php?id=<?php echo $result['id'];?>">
					<img class="h-10 p-1 mt-1 mr-3 border border-gray-700 float-start rounded-3xl w-14" src="admin/<?php echo $result['image'];?>" alt="post image"/>
				</a>
				<?php echo $fm->textShorten($result['body'], 125);?>	
			</div>
		<?php } }  else { header ("Location: 404.php");}?>	
	</div>	
</div>
		<!--sidebersection-->