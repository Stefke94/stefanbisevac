<?php
	class Projects extends Controller {
		/*
			Properties
		*/
		private $projectsModel;
		private $projectData = '';
		private $projectTitle = '';
		private $projectDescription = '';
		private $projectUrl = '';
		private $projectImageName = '';
		private $projectImageErrorCode = '';
		private $errorProjectTitle = '';
		private $errorProjectDescription = '';
		private $errorProjectUrl = '';
		private $errorProjectImage = '';
		private $errorMessage = '';
		
		
		/*
			Constructor
		*/
		public function __construct() {
			$this->projectsModel = $this->loadModel('Project');
		}
		/*
			Methods
		*/
		// Redirect to the main project page also known as work
		public function index() {
			redirect('projects/work');
		}
		// Displays all projects
		public function work() {
			$projects = $this->projectsModel->getProjects();
			$data = [
				'title' => 'Projects',
				'stylesheet' => 'projects_work',
				'projects' => $projects
			];
			$this->projectsModel->closeDatabaseConnection();
			$this->loadView('projects/work', $data);
		}
		// Displays all projects in admin area
		public function allProjects() {
			// Check if user is logged in
			if (!isLoggedIn()) {
				redirect('home');
			} else {
				$projects = $this->projectsModel->getProjects();
				$data = [
					'title' => 'All Projects',
					'stylesheet' => 'projects_allProjects',
					'projects' => $projects
				];
				$this->projectsModel->closeDatabaseConnection();
				$this->loadView('projects/allProjects', $data);
			}
		}
		// Displays form to add new project to the database and proccess the data and sends it to the database
		public function add() {
			// Checks if user is logged in
			if (!isLoggedIn()) {
				redirect('home');
			} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// If form submited, process it
				// Trim Input Data
				$this->projectTitle = trim($_POST['project_title']);
				$this->projectDescription = trim($_POST['project_description']);
				$this->projectUrl = trim($_POST['project_url']);
				$this->projectImageName = trim($_FILES['project_image']['name']);
				$this->projectImageErrorCode = $_FILES['project_image']['error'];
				$projectTempName = $_FILES['project_image']['tmp_name'];
				// Check title, description, url, image
				if (empty($this->projectTitle)) {
					$this->errorProjectTitle = 'Please fill in tittle field for project';
				} else {
					$this->projectTitle = filter_input(INPUT_POST,'project_title', FILTER_SANITIZE_STRING);
				}
				if (empty($this->projectDescription)) {
					$this->errorProjectDescription = 'Please fill in description for project';
				} else {
					$this->projectDescription = filter_input(INPUT_POST,'project_description', FILTER_SANITIZE_STRING);
				}
				if (empty($this->projectUrl)) {
					$this->errorProjectUrl = 'Please provide URL address for project';
				} else {
					$this->projectUrl = filter_input(INPUT_POST,'project_url', FILTER_SANITIZE_URL);
				}
				if ($this->projectImageErrorCode === 0) {
					$this->projectImageName = filter_var($_FILES['project_image']['name'], FILTER_SANITIZE_STRING);
				} else {
					$this->errorProjectImage = fileUploadErrorList($this->projectImageErrorCode);
				}
				// Init Data
				$data = [
					'title' => 'Add Project',
					'stylesheet' => 'projects_add',
					'userId' => $_SESSION['userId'],
					'projectTitle' => $this->projectTitle,
					'projectDescription' => $this->projectDescription,
					'projectUrl' => $this->projectUrl,
					'projectImageName' => $this->projectImageName,
					'errorProjectTitle' => $this->errorProjectTitle,
					'errorProjectDescription' => $this->errorProjectDescription,
					'errorProjectUrl' => $this->errorProjectUrl,
					'errorProjectImage' => $this->errorProjectImage
				];
				// Check all errors
				if (!empty($this->errorProjectTitle) || !empty($this->errorProjectDescription) || !empty($this->errorProjectUrl) || !empty($this->errorProjectImage)) {
					$this->loadView('projects/add', $data);
				} else {
					if (is_uploaded_file($projectTempName) && move_uploaded_file($projectTempName, 'images/project_images/'.$this->projectImageName) && file_exists('images/project_images/'.$this->projectImageName) && $this->projectsModel->addProject($data)) {
						$this->projectsModel->closeDatabaseConnection();
						redirect('projects/work');
					} else {
						$this->projectsModel->closeDatabaseConnection();
						$this->errorMessage = 'There has been a problem with uploading/moving/existing file #118PC';
						$data = [
							'title' => 'Add Project Error',
							'stylesheet' => 'error_style',
							'errorMessage' => $this->errorMessage
						];
						$this->loadView('errorPages/errorPage', $data);
					}
				}
			} else {
				// If post request has not been sent display add form
				$data = [
					'title' => 'Add Project',
					'stylesheet' => 'projects_add',
					'projectTitle' => '',
					'projectDescription' => '',
					'projectUrl' => '',
					'errorProjectTitle' => '',
					'errorProjectDescription' => '',
					'errorProjectUrl' => '',
					'errorProjectImage' => ''
				];
				$this->loadView('projects/add',$data);
			}
		}
		// Displays the form to edit project and proccess the data and update it in database by project ID
		public function edit($projectId = '') {
			// Check if user is logged in
			if (!isLoggedIn()) {
				redirect('home');
			} else if (empty($projectId) || $projectId == FALSE || !$this->projectsModel->checkProjectById($projectId)) {
				redirect('projects/allProjects');
			} else {
			// If post request has been sent, proccess data and update it in database
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					// If form is submited process the data
					// Trim input data
					$this->projectId = trim($projectId);
					$this->projectTitle = trim($_POST['project_title']);
					$this->projectDescription = trim($_POST['project_description']);
					$this->projectUrl = trim($_POST['project_url']);
					// Check if empty and sanitize data
					if (empty($this->projectTitle)) {
						$this->errorProjectTitle = 'Please enter Project title';
					} else {
						$this->projecttitle = filter_input(INPUT_POST, 'project_title', FILTER_SANITIZE_STRING);
					}
					if (empty($this->projectDescription)) {
						$this->errorProjectDescription = 'Please enter Project description';
					} else {
						$this->projectDescription = filter_input(INPUT_POST, 'project_description', FILTER_SANITIZE_STRING);
					}
					if (empty($this->projectUrl)) {
						$this->errorProjectUrl = 'Please provide URL Address for Project';
					} else {
						$this->projectUrl = filter_input(INPUT_POST, 'project_url', FILTER_SANITIZE_URL);
					}
					$data = [
						'title' => 'Edit Projects',
						'stylesheet' => 'projects_edit',
						'projectId' => $this->projectId,
						'projectTitle' => $this->projectTitle,
						'projectDescription' => $this->projectDescription,
						'projectUrl' => $this->projectUrl,
						'errorProjectTitle' => $this->errorProjectTitle,
						'errorProjectDescription' => $this->errorProjectDescription,
						'errorProjectUrl' => $this->errorProjectUrl
					];
					// Check if there are no errors
					if (!empty($this->errorProjectTitle) || !empty($this->errorProjectDescription) || !empty($this->errorProjectUrl)) {
						$this->loadView('projects/edit', $data);
					} else {
						if ($this->projectsModel->editProject($data)) {
							$this->projectsModel->closeDatabaseConnection();
							redirect('projects/allProjects');
						} else {
							$this->projectsModel->closeDatabaseConnection();
							$this->errorMessage = 'There has been a problem with editing project #194PC';
							$data = [
								'title' => 'Edit Projects Error',
								'stylesheet' => 'error_style',
								'errorMessage' => $this->errorMessage
							];
							$this->loadView('errorPages/errorPage', $data);
						}
					}
				} else {
					// If post request has not been sent, display edit form with data
					$project = $this->projectsModel->getProjectById($projectId);
					$data = [
						'title' => 'Edit Project',
						'stylesheet' => 'projects_edit',
						'projectId' => $projectId,
						'projectTitle' => $project[0]['project_title'],
						'projectDescription' => $project[0]['project_description'],
						'projectUrl' => $project[0]['project_url'],
						'errorProjectTitle' => '',
						'errorProjectDescription' => '',
						'errorProjectUrl' => ''
					];
					$this->projectsModel->closeDatabaseConnection();
					$this->loadView('projects/edit', $data);
				}
			}
		 }
		// Deletes project from the database
		public function delete($projectId = '') {
			// Check if user is logged in
			if (!isLoggedIn()) {
				redirect('home');
			}  else if (empty($projectId) || $projectId == FALSE || !$this->projectsModel->checkProjectById($projectId)){
				redirect('projects/work');
			} else {
			// If post request has been sent, proccess it and delete selected project from database
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$this->projectData = $this->projectsModel->getProjectById($projectId);
					$this->projectImageName = $this->projectData['project_image_name'];
					if ($this->projectsModel->deleteProject($projectId) && unlink('images/project_images/'.$this->projectImageName)) {
						$this->projectsModel->closeDatabaseConnection();
						redirect('projects/allProjects');
					} else {
						$this->projectsModel->closeDatabaseConnection();
						$this->errorMessage = 'There has been a problem with deleting project #240PC';
						$data = [
							'title' => 'Delete Projects Error',
							'stylesheet' => 'error_style',
							'errorMessage' => $this->errorMessage
						];
						$this->loadView('errorPages/errorPage', $data);
					}
				} else {
					// If post request has not been sent, if its just GET request then redirect to allProjects page
					redirect('projects/allProjects');
				}
			}
		}
	}