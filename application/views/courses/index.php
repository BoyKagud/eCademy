<?php
$this->load->view('sidebarCms');
?>
<?php
if (isset ($uCourses) ) {
	?>
    <table cellpadding="10px" border="0">
        <?php
        while ($row = mysql_fetch_assoc($uCourses)) {
            $execDet = fetchCourseDetails($row['id']);
            $cDet = mysql_fetch_array($execDet);
            echo "<tr><td><a href='view?CourseID={$cDet['id']}'>".$cDet['name']." - ".$cDet['section']."</a><td><tr>";
        }
        ?>
    </table>
<?php } ?>
