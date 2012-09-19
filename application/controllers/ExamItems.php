<?php
require_once 'Exams.php';
	class ExamItems extends CI_Controller {
		
		public function __construct(){
			parent::__construct();
			$this->load->model('examItem');
		}
		
		public static function regExamItems($query, $QS, $exam_id) {
			$reg = new ExamItem();
			return $reg->addExamItem($query, $QS, $exam_id);
		}
		
	}