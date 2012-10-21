<?php

	class Course extends CI_Model {
		
		function __construct() {
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}
		
		function fetchUserCourses($id) {
			echo $sql = "SELECT * FROM users_courses WHERE user_id='{$id}'";
			$result = mysql_query($sql);
			if (!$result) die(mysql_error());
			return $result;
		}
		
		function getCourseReqs($type, $course_id) {
			if ( isset ($type) ) {
				$sql = "SELECT * FROM requirements WHERE course_id='{$course_id}' AND reqtype='{$type}'";
			} else {
				$sql = "SELECT * FROM requirements WHERE course_id='{$course_id}'";
			}
			$result = mysql_query($sql);
			if (!$result) die(mysql_error());
			return $result;
		}
		
		function getCourseExams($course_id) {
			return Course::getCourseReqs(2, $course_id);
		}
	}