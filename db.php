<?php

	class dbHelper {
		private $DB_NAME = "univCMSdb";
		private $DB_TABLE;
		
		public function __construct() {
			$dbCon = mysql_connect("localhost", "cjcUser", "admin");
			if (!$dbCon) {
				die ("could not connect: ".mysql_error());
			}
			echo 0;
			
			$del = mysql_query("DROP DATABASE IF EXISTS ". $this->DB_NAME);
			if (!$del) die (mysql_error());
			echo 1;
			
			$dbQuery = mysql_query("CREATE DATABASE IF NOT EXISTS ". $this->DB_NAME);
			if(!$dbQuery) die(mysql_error());
			echo 2;
			
			$sel = mysql_select_db('univCMSdb');
			if (!$sel) die (mysql_error());
			echo 3;
		}
		
		public function a() {
			$sql = "CREATE TABLE IF NOT EXISTS users ("
					."`id` INT NOT NULL AUTO_INCREMENT, "
					."`univIDnum` VARCHAR(15) NOT NULL, "
					."`firstName` VARCHAR(50) NOT NULL, "
					."`lastName` VARCHAR(50) NOT NULL, "
					."`username` VARCHAR(15) NOT NULL, "
					."`password` VARCHAR(15) NOT NULL, "
					."`userType` INT NOT NULL, "
					."`lastLoggedIn` DATE, "
					."PRIMARY KEY (id));";
			$exec = mysql_query($sql);
			if(!$exec) die (mysql_error());
			
			$sql = "CREATE TABLE IF NOT EXISTS courses ("
					."`id` INT NOT NULL AUTO_INCREMENT, "
					."`name` VARCHAR(50) NOT NULL, "
					."`description` VARCHAR(50) NOT NULL, "
					."`section` VARCHAR(15) NOT NULL, "
					."`inst_id` INT NOT NULL, "
					."PRIMARY KEY (id))";
			$exec = mysql_query($sql);
			if (!$exec) die (mysql_error());
			
			$sql = "CREATE TABLE IF NOT EXISTS users_courses ("
					."`id` INT NOT NULL AUTO_INCREMENT, "
					."`user_id` INT NOT NULL, "
					."`course_id` INT NOT NULL, "
					."PRIMARY KEY (id), "
					."FOREIGN KEY (user_id) REFERENCES users (id), "
					."FOREIGN KEY (course_id) REFERENCES courses (id))";
			$exec = mysql_query($sql);
			if (!$exec) die (mysql_error());
			
			$sql = "CREATE TABLE IF NOT EXISTS requirements ("
					."`id` INT NOT NULL AUTO_INCREMENT, "
					."`reqType` INT NOT NULL, "
					."`title` VARCHAR(50) NOT NULL, "
					."`description` TEXT NOT NULL, "
					."`hps` INT NOT NULL, " 
					."`dueDate` DATE, "
					."`course_id` INT NOT NULL, "
					."PRIMARY KEY (id),"
					."FOREIGN KEY (course_id) REFERENCES courses (id))";
			$exec = mysql_query($sql);
			if(!$exec) die (mysql_error());
			
			$sql = "CREATE TABLE IF NOT EXISTS assignments ("
					."`id` INT NOT NULL AUTO_INCREMENT, "
					."`date_submitted` DATE, "
					."`req_id` INT NOT NULL, "
					."PRIMARY KEY (id), "
					."FOREIGN KEY (req_id) REFERENCES requirements (id) ON DELETE CASCADE ON UPDATE CASCADE);";
			$exec = mysql_query($sql);
			if (!$exec) die (mysql_error());
			
			$sql = "CREATE TABLE IF NOT EXISTS exams ("
					."`id` INT NOT NULL AUTO_INCREMENT, "
					."`numOfItems` INT NOT NULL, "
					."`req_id` INT NOT NULL, "
					."PRIMARY KEY (id), "
					."FOREIGN KEY (req_id) REFERENCES requirements (id) ON DELETE CASCADE ON UPDATE CASCADE);";
			$exec = mysql_query($sql);
			if (!$exec) die(mysql_error());
			
			$sql = "CREATE TABLE IF NOT EXISTS exam_items("
					."`id` INT NOT NULL AUTO_INCREMENT, "
					."`question` TEXT NOT NULL, "
					."`numberOfChoices` INT NOT NULL, "
					."`exam_id` INT NOT NULL, "
					."PRIMARY KEY (id), "
					."FOREIGN KEY (exam_id) REFERENCES exams (id) ON DELETE CASCADE ON UPDATE CASCADE);";
			$exec = mysql_query($sql);
			if (!$exec) die (mysql_error());
			
			$sql = "CREATE TABLE IF NOT EXISTS item_choices ("
					."`id` INT NOT NULL AUTO_INCREMENT, "
					."`label` TEXT NOT NULL, "
					."`item_id` INT NOT NULL, "
					."PRIMARY KEY (id), "
					."FOREIGN KEY (item_id) REFERENCES exam_items (id) ON DELETE CASCADE ON UPDATE CASCADE);";
			$exec = mysql_query($sql);
			if (!$exec) die (mysql_error());
			
			$sql = "CREATE TABLE IF NOT EXISTS answer_keys ("
					."`id` INT NOT NULL AUTO_INCREMENT, "
					."`item_id` INT NOT NULL, "
					."`choice_id` INT NOT NULL, "
					."PRIMARY KEY (id), "
					."FOREIGN KEY (item_id) REFERENCES exam_items (id), "
					."FOREIGN KEY (choice_id) REFERENCES item_choices (id));";
			$exec = mysql_query($sql);
			if (!$exec) die (mysql_error());
			
			$source = "INSERT INTO users (`univIDnum`, `firstName`, `lastName`, `username`, `password`, `userType`) ";
			$sql = $source."VALUES ('10-1-00549', 'ricardo', 'benitez', 'emong', 'admin', '3')";
			$sql2 = $source."VALUES ('20-0-38298', 'sensei', 'sensei', 'sensei', 'admin', '2')";
			$sql3 = $source."VALUES ('12-3-00398', 'master', 'shifu', 'master', 'admin', '1')";
			$exec = mysql_query($sql);
			$exec2 = mysql_query($sql2);
			$exec3 = mysql_query($sql3);
			if (!$exec && !$exec2 && !$exec3) die (mysql_error());
			
			$source = "INSERT INTO courses (`name`, `description`, `section`) ";
			$sql = $source."VALUES ('REL61', 'Christian Ethics', 'Y')";
			$exec = mysql_query($sql);
			if (!$exec) die (mysql_error());
			
			$source = "INSERT INTO users_courses (`user_id`, `course_id`) ";
			$sql = $source."VALUES ('2', '1')";
			$exec = mysql_query($sql);
			if (!$exec) die (mysql_error());
		}
		
		public function __destruct() {
			$dbCon = mysql_connect("localhost", "cjcUser", "admin");
			mysql_close($dbCon);
		}
	} 
	$a = new dbHelper();
	$a->a();