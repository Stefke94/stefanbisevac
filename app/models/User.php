<?php
	class User extends Database {
		/*
			Constructor
		*/
		public function __construct() {
			parent::__construct();
		}
		/*
			Methods
		*/
		// Finds a user by username
		public function findUserByUserName($userName) {
			if ($this->statement = $this->Connection->prepare('SELECT COUNT(*) FROM users WHERE user_name = ?')) {
				$this->statement->bind_param('s',$userName);
				if ($this->statement->execute()) {
					$result = $this->statement->get_result();
					$this->statement->free_result();
					$numRows = $result->num_rows;
					if ($numRows === 1) {
						return TRUE;
					} else {
						return FALSE;
					}
				} else {
					die('Something went wrong with findUserByUserName');
				}
			} else {
				die('Something went wrong'); 
			}
		}
		// Logs in user with user name and password
		public function loginUser($userName, $password) {
			if ($this->statement = $this->Connection->prepare('SELECT * FROM users WHERE users.user_name = ? LIMIT 1')) {
				$this->statement->bind_param('s',$userName);
				if ($this->statement->execute()) {
					$result = $this->statement->get_result();
					$this->statement->free_result();
					$result = $result->fetch_all(MYSQLI_ASSOC);
					$hashed_password = $result[0]['user_password'];
					if (password_verify($password,$hashed_password)) {
						return TRUE;
					} else {
						return FALSE;
					}	
				} else {
					die('Something went wrong with loginUser');
				}
			}
		}
		public function getUserIdByUserName($userName) {
			if ($this->statement = $this->Connection->prepare('SELECT user_id FROM users WHERE users.user_name = ? LIMIT 1')) {
				$this->statement->bind_param('s', $userName);
				if ($this->statement->execute()) {
					$result = $this->statement->get_result();
					$result = $result->fetch_all(MYSQLI_ASSOC);
					$this->statement->free_result();
					$userId = $result[0]['user_id'];
					return $userId;
				} else {
					die('Something went wrong with getUserIdByUserName');
				}
			} else {
				die('Something went wrong with getUserIdByUserName');
			}
		}
	}