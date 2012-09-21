<?php

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
// 			echo $QS;
			$sql = "SELECT * FROM exam_items WHERE "
					."question='{$QS}' AND "
					."exam_id='{$exam_id}';";
			$result = mysql_query($sql);
			if (!$result) die(mysql_error());
			
			$row = mysql_fetch_array($result);
			$itemID = $row['id'];
			return $itemID;
		}
		
		public static function addItemChoices($key, $itemID, $query) {
			if ( isset($query) ) {
				$result = mysql_query($query);
				if (!$result) die(mysql_error());
			} elseif ( ! isset($query) ) {
				$query = "INSERT INTO item_choices (`label`, `item_id`) "
					."VALUES ('{$key}', {$itemID});";
				echo $query;
				$result = mysql_query($query);
				if (!$result) die(mysql_error());
				
				return self::getChoiceID($key, $itemID);
			} 
		}
		
		public static function addItemKey($itemKeyID, $itemID) {
			echo $query = "INSERT INTO answer_keys (`item_id`, `choice_id`) "
					."VALUES ({$itemID}, {$itemKeyID});";
			$exec = mysql_query($query);
			if (!$exec) die (mysql_error());
			return;
		}
		
		public static function getChoiceID($key, $itemID) {
			$sql = "SELECT * FROM exam_items WHERE "
					."'label'='{$key}' AND "
					."'item_id'={$itemID};";
			$result = mysql_query($sql);
			if (!$result) die(mysql_error());
			
			echo "<br/>".$sql."<br/>";
				
			$row = mysql_fetch_array($result);
			print_r($row);
			$itemID = $row['id'];
			return $itemID;
		}
		
	}