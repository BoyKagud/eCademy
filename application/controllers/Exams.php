<?php
require 'Requirements.php';
require 'UserAccounts.php';
	class Exams extends Requirements {
		
		public function __construct() {
			parent::__construct();
			$this->load->database();
			$this->load->helper('userinfo_helper');
			$this->load->helper('exam_helper');
		}
		
		//Routing Methods
		
		public function index() {
			$this->load->model('exam');
			$this->load->view('header');
			$this->load->view('/exams/index');
			$this->load->view('footer');
		}
		
		public function create() {
			$coursesResult = getUserCourses($this->session->userdata('uID'));	
			$data['courses'] = $coursesResult;
			$uType = $this->session->userdata('uType');
			if ($uType == 2) {
				$this->load->model('exam');
				$this->load->view('header');
				$this->load->view('/exams/create', $data);
				$this->load->view('footer');
			} else {
				$this->load->view('index');
			}
		}
		
		public function takeWindow() {
			$data = $this->session->userdata('uType');
			if ($data == 3) {
				$examWindow = "<script>"
							."examWindow = window.open("
							."'', "
							."'', "
							."'fullscreen=yes,"
							."toolbar=no,"
							."location=no,"
							."directories=no,"
							."status=no,"
							."menubar=no,"
							."scrollbars=yes,"
							."copyhistory=no,"
							."resizable=no');"
							."examWindow.focus();"
							."</script>";
				echo $examWindow;
			} else {
				$this->load->view('index');
			}
		}
		
		// Instructor Methods
				
		public function setExamItems() {
			//to communicate with jquery and ajax
		}		
		
		//Student Methods
		
		public function takeExam() {
			
		}
		
	}

