<?php

	class Courses extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->library('session');
		}
		
		public function view() {
			$this->load->model('course');
			$this->load->view('header');
			$this->load->view('/courses/index');
			$this->load->view('footer');
		}
		
	}