<?php

	class Requirement extends CI_Model {
		
		public function __construct() {
			parent::__construct();
			$sql = "CREATE TABLE IF NOT EXISTS requirements ("
					."`id` INT NOT NULL AUTO_INCREMENT, "
					."`reqType` INT NOT NULL, "
					."`title` VARCHAR(50) NOT NULL, "
					."`description` TEXT NOT NULL, "
					."`hps` INT NOT NULL, " 
					."`dueDate` DATE NOT NULL, "
					."`classSection` VARCHAR(10) NOT NULL, "
					."`user` INT NOT NULL, "
					."PRIMARY KEY (id),"
					."FOREIGN KEY (user) REFERENCES users (id));";
			$exec = mysql_query($sql);
			if(!$exec) die (mysql_error());
			else return true;
		}
		
		//instructor methods
		
		public static function addReq($type, $title, $desc, $hps, $sec) {
			$sql = "INSERT INTO requirements ("
					."`reqType`, `title`, `description`, `hps`, `course_id`) "
					."VALUES ("
					."'{$type}', "
					."'{$title}', "
					."'{$desc}', "
					."'{$hps}', "
					."'{$sec}')";
			$exec = mysql_query($sql);
			if(!$exec) die(mysql_error());
			return self::getReqID($type, $title, $sec);
		}
		
		public static function getReqID($type, $title, $sec) {
			$sql = "SELECT * FROM requirements WHERE "
					."`reqType`='{$type}' AND "
					."`title`='{$title}' AND "
					."`course_id`='{$sec}'";
			$result = mysql_query($sql);
			if (!$result) die(mysql_error());
			$row = mysql_fetch_array($result);
			return $row['id'];
		}
		
		
		
	}