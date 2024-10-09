<?php include 'inc/header.php';?>
<?php 
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
        header("Location: 404.php");
    } else {
        $id = $_GET['pageid'];
    }
?>
<?php 
    $pagequery = "select * from tbl_page where id='$id'";
    $pagedetails = $db->select($pagequery);
    if ($pagedetails) {
        while ($result = $pagedetails->fetch_assoc()) {      
?>
	<div class="p-4 contentsection templete contemplete clear">
		<div class="float-left border border-gray-600 maincontent clear" style="margin: 0 15px 15px 0 ; padding: 8px 15px; ">
		    <div class="leading-6 text-justify about clear" style="font-size: 16px;">
                    <h2 class="mb-1 font-bold text-2xl text-[cornsilk]" style="padding: 10px 10pxs 10px 0; border-bottom: 2px solid cornsilk;"><?php echo $result['name']; ?></h2>
                    <p class="text-[16px] mb-3 text-justify"><?php echo $result['body']; ?></p>
  
                    
                   
            </div>			
        </div>
        <?php } } else { header("Location: 404.php");} ?>
    <?php include 'inc/sideber.php';?>
    <?php include 'inc/footer.php';?>