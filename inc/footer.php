</div>
	<div class="h-24 text-center footersection templete clear">
		<div class="mt-6 footermenu clear">
		  <ul class="flex justify-center p-0 m-0 text-center list-none">
			  <li class="inline-block p-1 mr-2"><a class="mr-1 text-xl text-white" href="index.php">Home</a></li>
			  <li class="inline-block p-1 mr-2"><a class="mr-1 text-xl text-white" href="about.php">About</a></li>
			  <li class="inline-block p-1 mr-2"><a class="mr-1 text-xl text-white" href="contact.php" >Contact</a></li>
			  <li class="inline-block p-1 mr-2"><a class="mr-1 text-xl text-white" href="#">Privacy</a></li>
		  </ul>
		</div>
		<?php 
			$query = "select * from tbl_footer where id='1'";
			$footernote = $db->select($query);
			if ($footernote) {
				while ($result = $footernote->fetch_assoc()) {
		?>
		<p class="text-[15px]  text-white"><?php echo $result['note']?> <?php echo date('Y'); ?> </p>
		<?php } } ?>
	  </div>
	<!--footerSection-->
</body>
</html>