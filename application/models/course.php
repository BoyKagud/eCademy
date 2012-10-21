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
	}