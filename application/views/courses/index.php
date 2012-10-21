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
if (isset ($uCourses) ) {
	$divItr = 1;
	while ($row = mysql_fetch_assoc($uCourses)) {
    	$cDet = fetchCourseDetails($row['course_id']);
    	echo "<a href='#' onclick='slideDetails(cItemDetDiv{$divItr})'><div class='courseItemViewDiv'>".$cDet['name']." - ".$cDet['section']."</div></a>";
    	echo "<div id='cItemDetDiv{$divItr}' style='display:none; padding:15px; margin-left:30px; margin-top:5px; background:#fff;'>"
    			."Description and Course Statistics Summary goes Here........<br />"
    			."Description and Course Statistics Summary goes Here........<br />"
    			."Description and Course Statistics Summary goes Here........<br />"
    			."Description and Course Statistics Summary goes Here........<br />"
    			."</div>";
		$divItr++;
    }
} 
?>
</div>
