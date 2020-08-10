<?php
	class blogPost extends Database {
		/*
			Properties
		*/
		private $singlePostRow;
		private $allPostsRows;
		private $resultSet;
		private $postCount;
		/*
			Constructor
		*/
		public function __construct() {
			parent::__construct();
		}
		/*
			Methods
		*/
		// Get post data by post ID
		public function getPostById($postId) {
			try {
				$this->statement = $this->Connection->prepare('SELECT users.user_name, blog.post_id, blog.post_title, blog.post_body, UNIX_TIMESTAMP(blog.post_date_created_at) AS post_date FROM blog INNER JOIN users ON users.user_id = blog.post_user_id WHERE blog.post_id = ?');
				$this->statement->bind_param('i',$postId);
				if ($this->statement->execute()) {
					$this->resultSet = $this->statement->get_result();
					$this->statement->free_result();
					$this->statement->close();
					$this->singlePostRow = $this->resultSet->fetch_assoc();
					return $this->singlePostRow;
				} else {
					return FALSE;
				}	
			} catch (Exception $error) {
				return $error->getLine();
			}
		}
		// Get all blog posts
		public function getAllPosts() {
			try {
				$this->statement = $this->Connection->prepare('SELECT users.user_name, blog.post_id, blog.post_title, blog.post_body, UNIX_TIMESTAMP(blog.post_date_created_at) AS post_date_created_at_unix FROM blog INNER JOIN users ON users.user_id = blog.post_user_id ORDER BY post_date_created_at_unix DESC');
				if ($this->statement->execute()) {
					$this->resultSet = $this->statement->get_result();
					$this->statement->free_result();
					$this->statement->close();
					$this->allPostsRows = $this->resultSet->fetch_all(MYSQLI_ASSOC);
					return $this->allPostsRows;
				} else {
					return FALSE;
				}	
			} catch (Exception $error) {
				return $error->getLine();
			}
		}
		// Add a post with passed data
		public function addPost($userId, $postTitle, $postBody) {
			try {
				$this->statement = $this->Connection->prepare('INSERT INTO blog(post_user_id, post_title, post_body) VALUES(?,?,?)');
				$this->statement->bind_param('iss',$userId, $postTitle, $postBody);
				if ($this->statement->execute()) {
					$this->statement->close();
					return TRUE;
				} else {
					$this->statement->close();
					return FALSE;
				}
			} catch (Exception $error) {
				return $error->getLine();
			}
		}
		// Edit a post with passed data
		public function editPostById($data) {
			try {
				$this->statement = $this->Connection->prepare('UPDATE blog SET post_title = ?, post_body = ? WHERE post_id = ?');
				$this->statement->bind_param('ssi', $data['postTitle'], $data['postBody'], $data['postId']);
					if ($this->statement->execute()) {
						$this->statement->close();
						return TRUE;
					} else {
						$this->statement->close();
						return FALSE;
					}
			} catch (Exception $error) {
				return $error->getLine();
			}
		}
		// Delete a post by post ID
		public function deletePostById($postId) {
			try {
				$this->statement = $this->Connection->prepare('DELETE FROM blog WHERE post_id = ?');
				$this->statement->bind_param('i', $postId);
				if ($this->statement->execute()) {
					$this->statement->close();
					return TRUE;
				} else {
					$this->statement->close();
					return FALSE;
				}
			} catch (Exception $error) {
				return $error->getLine();
			}
		}
		// Check post's ownership by post ID and user ID
		public function checkPostOwnerById($postId, $postUserId) {
			try {
				$this->statement = $this->Connection->prepare('SELECT COUNT(*) AS postCount FROM blog WHERE post_id = ? AND post_user_id = ? LIMIT 1');
				$this->statement->bind_param('ii', $postId, $postUserId);
				if ($this->statement->execute()) {
					$this->postCount = $this->statement->get_result();
					$this->statement->free_result();
					$this->statement->close();
					$this->postCount = $this->postCount->num_rows;
					if ($this->postCount == 1) {
						return TRUE;
					} else {
						return FALSE;
					}
				}
			} catch (Exception $error) {
				return $error->getLine();
			}
		}
		// Checking if post exists by post ID
		public function checkPostExistById($postId) {
			try {
				$this->statement = $this->Connection->prepare('SELECT COUNT(*) FROM blog WHERE post_id = ? LIMIT 1');
				$this->statement->bind_param('i', $postId);
				if ($this->statement->execute()) {
					$this->postCount = $this->statement->get_result();
					$this->postCount = $this->postCount->fetch_all(MYSQLI_ASSOC);
					$this->postCount = $this->postCount[0]['COUNT(*)'];
					$this->statement->free_result();
					$this->statement->close();
					if ($this->postCount === 1) {
						return TRUE;
					} else {
						return FALSE;
					}
				} else {
					return FALSE;
				}
			} catch (Exception $error) {
				return $error->getLine();
			}
		}
	}