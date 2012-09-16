<?php

	class Requirements extends CI_Controller {
		
		static private $hps;
		static private $title;
		static private $classSection;
		static private $reqDescription;
		
		public function __construct() {
			parent::__construct();
			$this->load->library('session');
		}
		
		// Instructor Methods
		
		public static function setDetails() {
			if (isset($_POST['reqTitle']) && isset($_POST['reqHps']) && isset($_POST['reqDesc'])) {
				self::$title = $_POST['reqTitle'];
				self::$hps = $_POST['reqHps'];
				self::$classSection = $_POST['reqCourse'];
				self::$reqDescription = $_POST['reqDesc'];
			} else {
				echo "ERROR";
			}
		}
		
		public static function createReq($type) { //reqTypes: exam=1, assignment=2
			$req = new Requirements();
			$req->setDetails();
			$reqMod = new Requirement();
			return $reqMod->addReq($type, self::$title, self::$reqDescription, self::$hps, self::$classSection);
		}		
		
	}

