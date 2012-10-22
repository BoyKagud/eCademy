<?php 
function getCourseName($id) {
	$result = getCourseDetails($id);
	return $result['name'].$result['section'];
}

function getExamDetailsForm($courses){
	$form = "<form id='createExamForm' action='".base_url()."/Exams/create' method='POST'>";
	$form .= "<input type='text' name='itemCount' placeholder='Enter Number of Items'/><br/>";
	$form .= "<select name='itemChoices'>";
	for ($x=1; $x<=10; $x++) {
		$form .= "<option value='{$x}'>{$x}</option>";
	}
	$form .= "</select>";
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

function setItems($itemsNum, $exam_id, $itemChoices) {
	$form = "<form id='createExamForm' action='".base_url()."Exams/create' method='POST'>";
	$form .= "<table cellpadding='10px'><tbody>"
			."<tr>"."<th>Item #</th>"
			."<th>Questions</th></tr>";
	for ($i=1; $i<=$itemsNum; $i++) { //loop each item
		$form .= "<tr>"
				."<td>{$i}</td>"
				."<td><input class='itemQuestionTB' type='text' name='itemQ{$i}' placeholder='Enter Item Question' />"
				."<table>";
				for ($s=1; $s<=$itemChoices; $s++) { //loop for item's total number of choices
					$form .= "<tr><td><input type='text' name='item{$i}choice{$s}'";
							if ($s==1) $form .= "placeholder='Enter The Correct Answer'"; else $form .= "placeholder='Choice{$s}'";
					$form .=" style='margin-left: 20px; width:300px;'/></td></tr>";
				}

		$form .= "</table></td></tr>";
	}
	
	$form .= "</tbody></table>"
			."<input type='hidden' name='itemChoices' value='{$itemChoices}' />"
			."<input type='hidden' name='itemCount' value='{$itemsNum}' />"
			."<input type='hidden' name='exam_id' value='{$exam_id}' />"
			."<input type='hidden' name='step' value='3' />"
			."<input type='submit' value='Submit' /></form>";
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
			case 2 : echo '<h1>Set Exam Items</h1>';
					setItems($itemsNum, $exam_id, $itemChoices);
					break;
			default : echo 'ERROR 799: a \'Step error\' has occured. Report this bug.';
					break;
		}
	}
	
?>

</div>