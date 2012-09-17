<?php 
function getCourseName($id) {
	$result = getCourseDetails($id);
	$row = mysql_fetch_array($result);
	return $row['name'].$row['section'];
}

function getExamDetailsForm($courses){
	$form = "<form id='createExamForm' action='".base_url()."/Exams/create' method='POST'>";
	$form .= "<input type='text' name='itemCount' placeholder='Enter Number of Items'/><br/>";
	$form .= "<input type='text' name='reqTitle' placeholder='Enter Title'/><br/>"
			  ."<input type='text' name='reqDesc' placeholder='Description'/><br/>"
			  ."<input type='text' name='reqHps' placeholder='Highest Possible Score'/><br/>"
			  ."<select name='reqCourse'>";
	while ($row = mysql_fetch_assoc($courses)) {
		$form .= "<option value='{$row['course_id']}'>".getCourseName($row['course_id'])."</option>";
	}
	$form .= "</select>"
			."<input type='hidden' name='step' value='2'/>"
			."<input type='submit' value='Next'/></form>";
	echo $form;
}

function setItems($itemsNum) {
	$form = null;
	echo $form;
}

?>
<div class="content">

<?php // switch for create View via $step on template engine 

	if ( !isset ($step) ) {
		echo "<h1>Set Exam Details</h1>";
		getExamDetailsForm($courses);
	} else {
		switch ($step) {
			case 2 : echo '<h1>Setup Exam Items</h1>';
			setItems($itemsNum);
		}
	}
	
?>

</div>