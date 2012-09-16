<?php
require 'requirement.php';
	class Exam extends Requirement {
		
		public function __construct() {
			parent::__construct();
			$sql = "CREATE TABLE IF NOT EXISTS exams ("
					."`exam_id` INT NOT NULL AUTO_INCREMENT, "
					."`numOfItems` INT NOT NULL, "
					."`req_id` INT NOT NULL, "
					."PRIMARY KEY (exam_id), "
					."FOREIGN KEY (req_id) REFERENCES requirements (id) ON DELETE CASCADE ON UPDATE CASCADE);";
			$exec = mysql_query($sql);
			if (!$exec) die(mysql_error());
		}
		
		public function examInsertToDB($reqId, $items) {
			$sql = "INSERT INTO exams (`numOfItems`, `req_id`)"
					."VALUES( {$items}, {$reqId} );";
			$exec = mysql_query($sql);
			if (!$exec) die (mysql_error()); else return true;
		}
		
		public function addExamItems($reqId, $items) {
			
		}
		
	}