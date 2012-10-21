<?php
$this->load->view('sidebarCms');
?>
<script>
function slideDetails(id) {
	if ($(id).is(":hidden")) {
		$(id).slideDown("slow");
	} else {
		$(id).slideUp("slow");
	}
};
</script>

<div class='content'>
<?php 
if ( isset ($uCourses) && !isset ($courseID) ) {
	$divItr = 1;
	while ($row = mysql_fetch_assoc($uCourses)) {
    	$cDet = fetchCourseDetails($row['course_id']);
    	echo "<a onclick='slideDetails(cItemDetDiv{$divItr})'><div class='courseItemViewDiv'>".$cDet['name']." - ".$cDet['section']."</div></a>"
    			."<div id='cItemDetDiv{$divItr}' style='display:none; padding:15px; margin-left:30px; margin-top:5px; background:#fff;'>"
    			."Description and Course Statistics Summary goes Here........<br />"
    			."Description and Course Statistics Summary goes Here........<br />"
    			."Description and Course Statistics Summary goes Here........<br />"
    			."Description and Course Statistics Summary goes Here........<br />"
				."<a href='?viewCourseID={$row['course_id']}'><span style='float:right; font-size:12;'>More Details...</span></a>"
    			."</div>";
		$divItr++;
    }
} elseif ( isset ($courseID) ) {
	echo '<h3>Course Exams:</h3>';
	while ($exam = mysql_fetch_assoc($courseExams) ) {
		$eID = getExamID($exam['id']);
		echo "<a href='../Exams/take?eID={$eID}'>".$exam['title']."</a>";
	}
}
?>
</div>
