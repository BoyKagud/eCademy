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
	$form = "<form id='createExamForm' action='".base_url()."Exams/create' method='POST'>";
	$form .= "<table><tbody>"
			."<tr>"."<th>Item #</th>"
			."<th>Questions</th>"
			."<th>Total Options</th>"
			."<th></th>"."</tr>";
	for ($i=1; $i<=$itemsNum; $i++) { //loop each item
		$form .= "<tr>"
				."<td>{$i}</td>"
				."<td><input class='itemQuestionTB' type='text' name='itemQ{$i}' placeholder='Enter Item Question' /></td>"
				."<td><select name='item{$i}TotalChoices'>";
				
				for ($s=1; $s<=10; $s++) { //loop for item's total number of choices
					$form .= "<option value='{$s}'>{$s}</option>";
				}
				
		$form .= "</select></td></tr>";
	}
	
	$form .= "</tbody></table>"
			."<input type='hidden' name='exam_id' value='{$exam_id}' />"
			."<input type='submit' value='Submit' /></form>";
	echo $form;
}

function setItemsChoices() {
	
}

function setItemsAns() {
	
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
					setItems($itemsNum, $exam_id);
					break;
			case 3 : echo '<h1>Set Items\' Choices</h1>';
					setItemsChoices();
					break;
			case 4 : echo '<h1>Set Items\' Answers</h1>';
					setItemsAns();
					break;
			default : echo 'ERROR 799: a Step error has occured. Report this bug.';
					break;
		}
	}
	
?>

</div>