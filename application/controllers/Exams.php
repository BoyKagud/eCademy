<?php
require_once 'Requirements.php';
require_once 'ExamItems.php';
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
			$this->load->helper('url_helper');
			if ($uType == 2) {
				$this->load->model('exam');
				$this->load->view('header');
				// isolate views according to request
				if (isset ($_POST['step']) ) {
					switch ($_POST['step']) {
						
						case 2:	$regReq = new Requirements();
								$regExam = new Exam();
								$reqID = $regExam->examInsertToDB($regReq->createReq(2), $_POST['itemCount']);
								if (!$data) echo 'ERROR'; else echo 'success';
								
								$data['itemsNum'] = $_POST['itemCount'];
								$data['step'] = $_POST['step'];
								$data['itemChoices'] = $_POST['itemChoices'];
								$data['exam_id'] = $reqID;
								$this->load->view('exams/create', $data);
								break;
								
						case 3: for ($item=1; $item<=$_POST['itemCount']; $item++) {
									$arr = "itemQ".$item;
									$QS = $_POST[$arr];
									$itemQuery = "INSERT INTO exam_items (`question`, `numberOfChoices`, `exam_id`) "
											."VALUES ('{$QS}', '{$_POST['itemChoices']}', '{$_POST['exam_id']}'); ";
									$regEI = new ExamItems();
									$itemID = $regEI->regExamItems($itemQuery, $QS, $_POST['exam_id']); //must return item_id, to be coded
									$iChoice = 1;
									do {
										$choice = "'item{$item}choice{$iChoice}'";
										$query = "INSERT INTO item_choices (`label`, `item_id`) "
												."VALUES ({$choice}, {$itemID});";
										$iChoice++;
									} while ( isset($_POST[$choice]) ) ;
								}
								$this->load->view('exams/create', $data);
								break;
						case 4: $this->load->view('exams/create', $data);
								break;
					}
				} else {
					$this->load->view('exams/create', $data);
				}
				$this->load->view('footer');
			} else {
				$this->load->view('index');
			}
		}
		
		public function load() { // ajax routing
			$stepView = 'asdfasdfasdf';
			json_encode($stepView);
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

