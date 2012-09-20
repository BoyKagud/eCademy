<?php
require_once 'exam.php';
	class ExamItem extends CI_Model {
		
		public function __construct(){
			parent::__construct();
			$sql = "CREATE TABLE IF NOT EXISTS exam_items("
					."`id` INT NOT NULL AUTO_INCREMENT, "
					."`question` TEXT NOT NULL, "
					."`numberOfChoices` INT NOT NULL, "
					."`exam_id` INT NOT NULL, "
					."PRIMARY KEY (id), "
					."FOREIGN KEY (exam_id) REFERENCES exams (id) ON DELETE CASCADE ON UPDATE CASCADE);";
			$exec = mysql_query($sql);
			if (!$exec) die (mysql_error());
		}
		
		public static function addExamItem($query, $QS, $exam_id) {
			$exec = mysql_query($query);
			if (!$exec) die (mysql_error());
			return self::getItemID($QS, $exam_id);
		}
		
		public static function getItemID($QS, $exam_id) {
			$sql = "SELECT * FROM requirements WHERE "
					."'question'='{$QS}' AND "
					."'exam_id'='{$exam_id}'";
			$result = mysql_query($sql);
			if (!$result) die(mysql_error());
			$row = mysql_fetch_array($result);
			return $row['id'];
		}
		
		public static function addItemChoices($key, $itemID, $query) {
			if ( ! isset($key) && ! isset($itemID) && isset($query) ) {
				$exec = mysql_query($query);
				if (!$exec) die (mysql_error());
			} elseif ( ! isset($query) && isset($key) && isset($itemID) ) {
				$query = "INSERT INTO item_choices (`label`, `item_id`) "
					."VALUES ({$key}, {$itemID});";
				$exec = mysql_query($query);
				if (!$exec) die (mysql_error());
			}
		}
		
		public static function addItemKey($itemKeyID, $itemID) {
			$query = "INSERT INTO answer_keys (`item_id`, `choice_id`) "
					."VALUES ('{$itemID}', '{$itemKeyID}');";
			$exec = mysql_query($query);
			if (!$exec) die (mysql_error());
			return;
		}
		
	}