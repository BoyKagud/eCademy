<?php

if ( isset($_POST['step']) ) {
	$step = $_POST['step'];
	switch ($step) {
		case 2: break;
		case 3; break;
	}
}

?>
<?php require ROOT.DS.'application'.DS.'views'.DS.'sidebarCms.php';?>

<div class="content">
	<div class="centerBox">
		<?php echo getItemCountForm();?>
	</div>
</div>