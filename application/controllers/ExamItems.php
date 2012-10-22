<?php

	class ExamItems extends CI_Controller {
		
		public function __construct(){
			parent::__construct();
			$this->load->model('examItem');
		}
		
		public static function regExamItems($query, $QS, $exam_id) {
			$reg = new ExamItem();
			$itemID = $reg->addExamItem($query, $QS, $exam_id);
			return $itemID;
		}
		
		public static function regItemChoices($key, $itemID, $query) {
			$reg = new ExamItem();
			if ( isset($query) ) {
				$reg->addItemChoices($key, $itemID);
			} else {
				$id = $reg->addItemChoices($key, $itemID, null);
				return $id;
			}
		}
		
		public static function regItemKey($itemKeyID, $itemID) {
			$reg = new ExamItem();
			$id = $reg->addItemKey($itemKeyID, $itemID);
			return $id;
		}
		
	}