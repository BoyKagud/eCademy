<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('regExam')) {
	function regExam() {
		$regReq = new Requirements();
		$regExam = new Exam();
		$data = $regExam->examInsertToDB($regReq->createReq(2), $_POST['itemCount']);
		if (!$data) return false; else return true;
	}		
}