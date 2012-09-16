<?php

	class userAccount extends CI_Model {
		private $user;

		public function __construct(){
			parent::__construct();
			$this->load->database();
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
		}
		
		public function confirmLogin($username, $password){
			$sql = "SELECT * FROM users WHERE `username`='".$username."';";
			$exec = mysql_query($sql);
			if (!$exec) die (mysql_error());
			if (mysql_affected_rows() > 0) {
				$row = mysql_fetch_array($exec);
// 				print_r($row);
				$passToEnc = $password;
				if (strcmp($row['password'], $passToEnc) == 0) {
					$data = array('uID' => $row['id'], 'uType' => $row['userType']);
					$this->session->set_userdata($data);
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
		
		private function setLastLoggedIn() {
			$time = mktime(0,0,0, date("m"), date("d"), date("Y"));
			$now = date("Y-m-d", $time);
			$sql = "UPDATE users SET `lastLoggedIn`=".$now
					." WHERE "
					."`username`='".$this->user."'";
			$execThis = mysql_query($sql);
			if(!$execThis) die (mysql_error());
		}
		
		public function registerUser($univIDnum, $fName, $lName, $regUname, $encPass){
			$sql = "SELECT * FROM users WHERE "
					."`univIDnum`=".$univIDnum." AND "
					."`firstName`=".$fName." AND "
					."`lastName`".$lName.";";
			$exec = mysql_query($sql);
			if(!$exec) die (mysql_error());
			if (mysql_affected_rows() > 0) {
				$sql = "UPDATE users SET `username`=".$regUname." AND "
						."`password`=".$encPass
						."WHERE "
						."`univIDnum`=".$univIDnum." AND "
						."`firstName`=".$fName." AND "
						."`lastName`".$lName.";";
				$exec = mysql_query($sql);
				if (!$exec) die(mysql_error());
			}
			return true;
		}		
	}
