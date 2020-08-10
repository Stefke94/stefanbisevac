<?php 
	class Users extends Controller {
		public $userModel;
		/*
			Constructor
		*/
		public function __construct() {
			$this->userModel = $this->loadModel('User');
		}
		/*
			Methods
		*/
		// Redirects to the homepage
		public function index() {
			redirect('home/homepage');	
		}
		// Displays form and logs in user
		public function login() {
			// Check if user is logged in
			if (isLoggedIn()) { 
				redirect('users/profile'); 
			} else {
				// If post request has been sent, proccess input data and log in user
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					//If submited
					$sanitizedInput = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
					$data = [
						'title' => 'Log In',
						'stylesheet' => 'users_login',
						'userId' => '',
						'userName' => trim($sanitizedInput['user_name']),
						'userPassword' => trim($sanitizedInput['user_password']),
						'errorUserName' => '',
						'errorUserPassword' => ''
					];
					// Check for username/password
					if (empty($data['userName'])) $data['errorUserName'] = 'Please enter your Username';
					if (empty($data['userPassword'])) $data['errorUserPassword'] = 'Please enter your Password';
					// Check if they are errors
					if (empty($data['errorUserName']) && empty($data[' errorUserPassword'])) {
						// There are no errors procees with login
						if ($this->userModel->findUserByUserName($data['userName'])) {
							if ($this->userModel->loginUser($data['userName'], $data['userPassword'])) {
								// Passwords match
								$data['userId'] = $this->userModel->getUserIdByUserName($data['userName']);
								$this->userModel->closeDatabaseConnection();
								$this->createUserSession($data);
							} else {
								// Paswords dont match, load view with error messages
								$this->userModel->closeDatabaseConnection();
								$data[' errorUserPassword'] = 'Incorrect password';
								$this->loadView('users/login',$data);
							}
						} else {
							// User not found
							$this->userModel->closeDatabaseConnection();
							$data['error_user_name'] = 'That user doesnt exist';
							$this->loadView('users/login', $data);
						}
					} else {
						// Load form with errors to fill in form fields
						$this->loadView('users/login', $data);
					}
				} else {
					//If POST request has not been sent, load login form 
					$data = [
						'title' => 'Log In',
						'stylesheet' => 'users_login',
						'userName' => '',
						'userPassword' => '',
						'errorUserName' => '',
						'errorUserPassword' => ''
					];
					$this->loadView('users/login', $data);
				}
			}
		}
		// Creates session for user with user data
		public function createUserSession($user) {
			$_SESSION['userId'] = $user['userId'];
			$_SESSION['userName'] = $user['userName'];
			redirect('users/profile');
		}
		// Logs out user
		public function logout() {
			unset($_SESSION['userId']);
			unset($_SESSION['userName']);
			session_destroy();
			redirect('users');
		}
		// Displays profile page
		public function profile() {
			if (!isLoggedIn()) {
				redirect('home');
			} else {
				$data = [
					'title' => 'User Profile',
					'stylesheet' => 'users_profile'
				];
				$this->loadView('users/profile',$data);
			}
		}
		
	}
