<?php

	class Courses extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->model('course');
			$this->load->library('session');
			$this->load->helper('userinfo_helper');
			$this->load->helper('exam_helper');
		}
		
		public function view() {
			$this->load->view('header');
			if ( !isset ($_GET['viewCourseID']) ) {
				$data['uCourses'] = Course::fetchUserCourses($this->session->userdata('uID'));
				$this->load->view('/courses/index', $data);
			} else {
				$data['courseID'] = $_GET['viewCourseID'];
				$data['courseExams'] = Course::getCourseExams($_GET['viewCourseID']);
				$this->load->view('/courses/index', $data);
			}
			$this->load->view('footer');
		}
		
	}