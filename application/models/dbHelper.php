<?php

	class dbHelper {
		private $DB_NAME = "univCMSdb";
		private $DB_TABLE;
		
		public function __construct() {
			$dbCon = mysql_connect("localhost", "cjcUser", "admin");
			if (!$dbCon) {
				die ("could not connect: ".mysql_error());
			}
			$dbQuery = mysql_query("CREATE DATABASE IF NOT EXISTS ". $this->DB_NAME, $dbCon);
			if(!$dbQuery) die(mysql_error());
		}
		
		public function __destruct() {
			$dbCon = mysql_connect("localhost", "cjcUser", "admin");
			mysql_close($dbCon);
		}
	}

