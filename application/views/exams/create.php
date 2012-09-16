<?php 
function getCourseName($id) {
	$result = getCourseDetails($id);
	$row = mysql_fetch_array($result);
	return $row['name'].$row['section'];
}

function getExamDetailsForm($courses){
	$form = "<form id='createExamForm' action='/eCademy/index.php/Exams/' method='post'>";
	$form .= "<input type='text' name='itemCount' placeholder='Enter Number of Items'/><br/>";
	$form .= "<input type='text' name='reqTitle' placeholder='Enter Title'/><br/>"
			  ."<input type='text' name='reqDesc' placeholder='Description'/><br/>"
			  ."<input type='text' name='reqHps' placeholder='Highest Possible Score'/><br/>"
			  ."<select name='reqCourse'>";
	while ($row = mysql_fetch_assoc($courses)) {
		$form .= "<option value='{$row['course_id']}'>".getCourseName($row['course_id'])."</option>";
	}
	$form .= "</select>"
			."<input type='hidden' name='step' value='1'/>"
			."<input type='submit' value='Create'/></form>";
	echo $form;
}

?>

<div class="content">
	<h3>Setup Exam Details</h3>
	<?php getExamDetailsForm($courses);?>
</div>