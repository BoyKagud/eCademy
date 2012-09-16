<?php 

	class UserAccounts extends CI_Controller {
		private $idNumber;
		private $password;
		private $name;
		
		public function __construct(){
			parent::__construct();
			$this->load->library('session');
		}
		
		public function index() {
			$this->load->model('userAccount');
			$this->load->view('header');
			$this->load->view('/userAccounts/index');
			$this->load->view('footer');
		}
		
		public function logIn() {
			print_r($_POST);
			if (isset($_POST['loginUname']) && isset($_POST['loginPass'])) {
				$uName = $_POST['loginUname'];
				$pWord = $_POST['loginPass'];
				$x = new userAccount();
				$x->confirmLogin($uName, $pWord);
				if ($x == true) {
					$array = array('isLoggedIn' => true);
					$this->session->set_userdata($array);
					header("Location: index.php/Courses/view");
				} else {
					unset($_POST);
					$alert = "<script type='text/javascript'>"
							."if(confirm('access denied')) {"
							."window.location = '".$_SERVER['REQUEST_URI']."'}"
							."</script>";
					echo $alert;
				}
			}
		}
		
		public function logout() {
			$this->session->sess_destroy();
			header("Location: /eCademy");
		}
		
		public function regUser($univIDnum, $fName, $lName, $regUname, $regPass) {
			if (isset($univIDnum) && isset($regUname) && isset($regPass) && isset($fName) && isset($lName)) {
				$encPass = md5($regPass);
				$reg = new userDB();
				$exec = $reg->registerUser($univIDnum, $fName, $lName, $regUname, $encPass);
				if($exec) return true; else return false;
			}
		}
		
		public static function getUserID() {
			return $this->session->userdata('uID');
		}
		
		public function getName() {
			return $name;
		}
		
	}
