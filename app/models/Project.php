<?php
	class Project extends Database {
		/*
			Constructor
		*/
		public function __construct() {
			parent::__construct();
		}
		/*
			Properties
		*/
		public $projectId = '';
		
		
		/*
			Methods
		*/
		// Get Project data from database by project ID
		public function getProjectById($projectId) {
			if ($statement = $this->Connection->prepare('SELECT * FROM projects WHERE project_id = ? LIMIT 1')) {
				$statement->bind_param('i', $projectId);
				if ($statement->execute()) {
					$result = $statement->get_result();
					$statement->free_result();
					$statement->close();
					$result = $result->fetch_all(MYSQLI_ASSOC);
					return $result[0];
				} else {
					die('Something went wrong with gettProjectById');
				}
			}
		}
		// Checks if project exists in database by project ID
		public function checkProjectById($projectId) {
			if ($statement = $this->Connection->prepare('SELECT * FROM projects WHERE project_id = ? LIMIT 1')) {
				$statement->bind_param('i', $projectId);
				if ($statement->execute()) {
					 $result = $statement->get_result();
					 $statement->free_result();
					 $statement->close();
					 if ($result->num_rows == 1) {
						 return TRUE;
					 } else {
						 return FALSE;
					 }
				} else {
					die('Something went wrong with checkProjectId');
				}
			}
		}
		// Returns data of all projects from database
		public function getProjects() {
			if ($statement = $this->Connection->prepare('SELECT * FROM projects')) {
				if ($statement->execute()) {
					$result = $statement->get_result();
					$statement->free_result();
					$statement->close();
					$result = $result->fetch_all(MYSQLI_ASSOC);
					return $result;
				} else {
					die('Something went wrong with getProjects');
				}
			}
		}
		// Adds project to the databse
		public function addProject($data) {
			if ($statement = $this->Connection->prepare('INSERT INTO projects(project_user_id, project_title, project_description, project_url, project_image_name) VALUES(?,?,?,?,?)')) {
				$statement->bind_param('issss', $data['userId'], $data['projectTitle'], $data['projectDescription'], $data['projectUrl'], $data['projectImageName']);
				if ($statement->execute()) {
					$statement->close();
					return TRUE;
				} else {
					$statement->close();
					return FALSE;
				}
			}
		}
		// Updates project data in database with passed data
		public function editProject($data) {
			if ($statement = $this->Connection->prepare('UPDATE projects SET project_title = ?, project_description = ?, project_url = ? WHERE project_id = ?')) {
				$statement->bind_param('sssi', $data['projectTitle'], $data['projectDescription'], $data['projectUrl'], $data['projectId']);
				if ($statement->execute()) {
					$statement->close();
					return TRUE;
				} else {
					$statement->close();
					return FALSE;
				}
			}
		}
		// Deletes project from database by project ID
		public function deleteProject($projectId) {
			if ($statement = $this->Connection->prepare('DELETE FROM projects WHERE project_id = ?')) {
				$statement->bind_param('i',$projectId);
				if ($statement->execute()) {
					$statement->close();
					return TRUE;
				} else {
					$statement->close();
					return FALSE;
				}
			}
		}
	}