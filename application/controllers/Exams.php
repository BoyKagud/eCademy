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
									$reg = new ExamItems();
									
									// register Exam Items
									$itemID = $reg->regExamItems($itemQuery, $QS, $_POST['exam_id']);
									
									//register Item Answer Key
									$unit = "item{$item}choice1";
									$key = $_POST[$unit];
									$itemKeyID = $reg->regItemChoices($key, $itemID, null);
									$reg->regItemKey($itemKeyID, $itemID);
									
									//register other Item Choices
									$iChoice = 2;
									$query = null;
									do {
										$choice = "'item{$item}choice{$iChoice}'";
										$query .= "INSERT INTO item_choices (`label`, `item_id`) "
												."VALUES ({$choice}, {$itemID});";
										$iChoice++;
									} while ( isset($_POST[$choice]) ) ;
									$reg->regItemChoices(null, null, $query);
								}
								// Redirection code
								break;
						default: echo "an Error has occured";
					}
				} else {
					$this->load->view('exams/create', $data);
				}
				$this->load->view('footer');
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
			$fullS = "<script type='text/javascript'>"
					."var obj = new ActiveXObject('Wscript.shell');"
					."obj.SendKeys('{F11}');"
					."</script>";
			echo $fullS;
		/* iN ORDER TO START THE EXAM, USER MUST PRESS F11 
		 * TO GO FULLSCREEN (NEEDS AJAX ON CONTENT VIEW) 
		 * ALSO TO START THE TIMER */
		}
		
		public function take() {
			$data = $this->session->userdata('uType');
			if ($data != 3) {
				$examWindow = "<script>"
						."examWindow = window.open("
						."'takeExam', "
						."'', "
						."'toolbar=0, "
						."location=0, "
						."status=0, "
						."resizable=0');"
						."examWindow.focus();"
						."</script>";
				echo $examWindow;
			} else {
				$this->load->view('index');
			}
		}
		
		
	}

