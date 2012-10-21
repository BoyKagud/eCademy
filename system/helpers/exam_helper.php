<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('regExam') ) {
	function regExam() {
		$regReq = new Requirements();
		$regExam = new Exam();
		$data = $regExam->examInsertToDB($regReq->createReq(2), $_POST['itemCount']);
		if (!$data) return false; else return true;
	}
}

if ( ! function_exists('getExamID') ) {
	function getExamID($req_id) {
		$sql = "SELECT id FROM exams WHERE req_id='{$req_id}'";
		$result = mysql_query($sql);
		if (!$result) die (mysql_error());
		$conToArray = mysql_fetch_array($result);
		$id = $conToArray['id'];
		return $id;
	}
	
}