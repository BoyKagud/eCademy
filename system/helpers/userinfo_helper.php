<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getCourseDetails')) {
	function getCourseDetails($id) {
		return fetchCourseDetails($id);
	}
}

if ( ! function_exists('fetchCourseDetails')) {
	function fetchCourseDetails($id) {
		$sql = "SELECT * FROM courses WHERE id='{$id}'";
		$result = mysql_query($sql);
		return $result;
	}
}

	

if ( ! function_exists('getUserCourses')) {
	function getUserCourses($id) {
		return fetchUserCourses($id);
	}
}

if ( ! function_exists('fetchUserCourses')) {
	function fetchUserCourses($id) {
		$sql = "SELECT * FROM users_courses WHERE user_id='{$id}'";
		$result = mysql_query($sql);
		return $result;
	}
}