<?php 

if ( isset($_POST['step']) ) {
	$regReq = new Requirements();
	$regExam = new Exam();
	$data = $regExam->examInsertToDB($regReq->createReq(2), $_POST['itemCount']);
	if (!$data) echo 'ERROR'; else echo 'success';
}

if ( isset($_SESSION['path']) ) {
	$action = $_SESSION['path'];
	$this->load->view($action);
	unset($_SESSION['path']);
} else {
	 $this->load->view('sidebarCms');
?>
	<div class="content">
		<a href="create">CREATE</a>
	</div>
<?php }

function getItemsForm($items = 5) {		//test num of items
	$ajaxTotalItems = null;
	for ($i=0; i < $items; $i++) {
		$form .= "<br/>Item # ".$i.": <input type='text' name='itemQuestion{$i}' />";
		$form .= "<br/>Total Choices: 	<select id='itemTO' name='itemTO{$i}'>"
		."<option label='specify...' value='-1' />";
		$iter = 1;
		while ($iter < 10) {
			$form .= "<option label='{$iter}' value='{$iter}'>";
		}
		$form .= "</select>";

		$form .= " Number of Choices to be Displayed: <select id='itemOD' name='itemOD".$i."'>"
				."<option label='specify...' value='-1' />";
		$iter = 1;
		while ($iter < 10) {
			$form .= "<option label='{$iter}' value='{$iter}'>";
		}
		$form .= "</select>";
	}
	$form .= "<input type='submit' value='Next'></select>";
}

?>