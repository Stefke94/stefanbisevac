<?php
	/*
		Database class
			* Connects to the Database
			* Inherited by other models
	*/
	class Database {
		/*
			Properties
		*/
		private $host = DB_HOST;
		private $user = DB_USER;
		private $password = DB_PASSWORD;
		private $dbName = DB_NAME;
		protected $Connection;
		protected $statement;
		/*
			Constructor
		*/
		public function __construct() {
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			try {
				$this->Connection = new mysqli($this->host, $this->user, $this->password, $this->dbName);
			} catch (Exception $e) {
				echo '<p class="exceptionErrors">There has been a problem with database connecting</p>';
			}
		}
		/*
			Methods
		*/
		public function closeDatabaseConnection() {
			$this->Connection->close();
		}
		
	}