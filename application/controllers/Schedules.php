<?php

	class Schedule extends CI_Controller {
		
		private $isActive;
		
		public function __construct() {
			parent::__construct();
			$this->load->library('session');
		}
		
		public function getSchedule() {
			
		}
		
	}
