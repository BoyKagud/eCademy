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
		
		public static function regItemChoices($key, $itemID, $query) {
			$reg = new ExamItem();
			if ( ! isset($key) && ! isset($itemID) && isset($query) ) {
				$reg->addItemChoices($key, $itemID);
			} elseif ( ! isset($query) && isset($key) && isset($itemID) ) {
				return $reg->addItemChoices($key, $itemID);
			}
		}
		
		public static function regItemKey($itemKeyID, $itemID) {
			$reg = new ExamItem();
			return $reg->addItemKey($itemKeyID, $itemID);
		}
		
	}