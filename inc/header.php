<?php include 'config/config.php';?>
<?php include 'lib/Database.php';?>
<?php include 'helpers/Format.php';?>
<style>
	/* .navsection ul li:hover, #active {
    background: #FEF4E5;
    color: #333;

	min-height: 38px; */

	.navsection ul li:hover, #active {
    background-color: gold;
    color: black;
}
/* } */
</style>
<?php 
	$db = new Database();
	$fm = new Format();
?>

<!DOCTYPE html>
<html>
<head>
	<?php 
		if (isset($_GET['pageid'])) {
			$pagetitleid = $_GET['pageid'];
			$query = "select * from tbl_page where id='$pagetitleid'";
			$pages = $db->select($query);
			if ($pages) {
				while ($result = $pages->fetch_assoc()) { ?>
				<title><?php echo $result['name'];?>-<?php echo TITLE;?></title>
	<?php }	} }  elseif (isset($_GET['id'])) {
			$postid = $_GET['id'];
			$query = "select * from tbl_post where id='$postid'";
			$posts = $db->select($query);
			if ($posts) {
				while ($result = $posts->fetch_assoc()) { ?>
				<title><?php echo $result['title'];?>-<?php echo TITLE;?></title>
	<?php }	} } else { ?>
			<title><?php echo $fm->title(); ?>-<?php echo TITLE;?></title>
	<?php } ?>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php 
		if (isset($_GET['id'])) {
			$keywordsid = $_GET['id'];
			$query = "select * from tbl_post where id='$keywordsid'";
			$keywords  = $db->select($query);
			if ($keywords) {
				while ($result = $keywords->fetch_assoc()) { ?>
				<meta name="keywords" content="<?php echo $result['tags']?>">		
	<?php } } } else { ?>
		<meta name="keywords" content="<?php echo KEYWORDS;?>">
	<?php	 }?>
	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>
<body>
	<!--headerSection-->
    <div class= "headersection templete clear">
		<a href="index.php">
			<div class="float-left p-3 w-[580px] logo">
	
			<?php 
				$query = "select * from title_slogan where id='1'";
				$blog_title = $db->select($query);
				if ($blog_title) {
					while ($result = $blog_title->fetch_assoc()) {
			?>
				<img class="float-left" style="width: 115px;" src="admin/<?php echo $result['logo'];?>" alt="Logo"/>
				<h2 class="mt-3 text-4xl text-white ml-28 drop-shadow-2xl" style="padding-top: 18px; color:cyan; font-weight: bold;"><?php echo $result['title'];?></h2>
				<p class="text-white ml-28"><?php echo $result['slogan'];?></p>
			<?php } } ?>
			</div>
		</a>
		<div class="social clear" style="padding-top: 18px;">
			<div class="float-right p-2 mt-3 mr-3 text-white icon clear">
			<?php 
				$query = "select * from tbl_social where id='1'";
				$socialmedia = $db->select($query);
				if ($socialmedia) {
					while ($result = $socialmedia->fetch_assoc()) {
			?>
				<a class="p-2 mr-1 text-xl bg-blue-700 border border-blue-700 rounded-md" href="<?php echo $result['fb']?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a class="p-2 mr-1 text-xl bg-blue-700 border border-blue-700 rounded-md" href="<?php echo $result['tw']?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a class="p-2 mr-1 text-xl bg-blue-700 border border-blue-700 rounded-md" href="<?php echo $result['ln']?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a class="p-2 mr-1 text-xl bg-blue-700 border border-blue-700 rounded-md" href="<?php echo $result['gp']?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			<?php } } ?>
			</div>
			<div class="float-right p-2 mt-1 mr-3 searchbtn clear">
			<form action="search.php" method="post">
				<input class="p-1 text-black" type="text" name="search" placeholder="Search keyword..."/>
				<input class="p-1 text-gray-800 bg-white" type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
	<div class="navsection min-h-9 bg templete">
		<?php
			$path = $_SERVER['SCRIPT_FILENAME'];
            $currentpage = basename($path, '.php'); 
		?>
		<ul class="flex">
			<li class="p-2 text-xl"><a 
			<?php if ($currentpage == 'index') {echo 'id = "active"';}?>
			href="index.php">Home</a></li>
			<?php 
                    $query = "select * from tbl_page";
                    $pages = $db->select($query);
                    if ($pages) {
                        while ($result = $pages->fetch_assoc()) {      
                ?>
				<li class="p-2 text-xl">
				<a 
				<?php 
					if (isset($_GET['pageid']) && $_GET['pageid'] == $result['id']) {
						echo 'id = "active"';
					}
				?>
					href="page.php?pageid=<?php echo $result['id'];?>"><?php echo $result['name'];?></a>
				</li>
                
              <?php } } ?>	
			<li class="p-2 text-xl"><a <?php if ($currentpage == 'contact') {echo 'id = "active"';}?> href="contact.php">Contact</a></li>
		</ul>
	</div>
	<!--headerSection-->