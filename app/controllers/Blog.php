<?php
	/*
		Blog controller
		 * Add, Edit, Removes Posts
		 * Posts are read by everyone but only added, edited and removed by admin
	*/
	class Blog extends Controller {
		/*
			Properties
		*/
		private $singlePostData = '';
		private $allPostsData = '';
		private $postStatus = '';
		private $blogModel;
		private $postId = '';
		private $postAuthorId = '';
		private $postTitle = '';
		private $postBody = '';
		private $blogDate = '';
		private $errorMessage = '';
		private $errorPostAuthorId = '';
		private $errorPostTitle = '';
		private $errorPostBody = '';
		/*
			Constructor
		*/
		public function __construct() {
			$this->blogModel = $this->loadModel('blogPost');
		}
		/*
			Methods
		*/
		// Redirecting to posts
		public function index() {
			redirect('blog/blogPosts');
		}
		// Displays all posts
		public function blogPosts() {
			$this->allPostsData = $this->blogModel->getAllPosts();
			$this->blogModel->closeDatabaseConnection();
			if ($this->allPostsData === false) {
				$this->errorMessage = 'Loading all posts failed #42BC';
				$data = [
					'title' => 'BlogPosts Error',
					'stylesheet' => 'errorStyle',
					'errorMessage' => $this->errorMessage
				];
				$this->loadView('errorPages/errorPage', $data);
			} else if (is_int($this->allPostsData) && !is_array($this->allPostsData)) {
				$this->errorMessage = 'Error occured while loading all posts #50BC'.$this->allPostsData ;
				$data = [
					'title' => 'BlogPosts Error',
					'stylesheet' => 'error_style',
					'errorMessage' => $this->errorMessage
				];
				$this->loadView('errorPages/errorPage', $data);
			} else {
				$data = [
					'stylesheet' => 'blog_blogPosts',
					'title' => 'Blog Posts',
					'allPostsData' => $this->allPostsData
				];
				$this->loadView('blog/blogPosts',$data);
			}
		}
		// Displays form for adding blog and proccess the data and then store it to the database
		public function addPost() {
			// Check if user is logged in
			if (!isLoggedIn()) {
				redirect('homepage');
			} else {
			// If post request has been sent then proccess the data and store it in database
				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					// Sanitize data
					$sanitizedInput = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
					$this->postAuthorId = $_SESSION['userId'];
					// Validate post title 
					if (empty($sanitizedInput['input_post_title'])) {
						$this->errorPostTitle = 'Please enter title';
					} else {
						$this->postTitle = trim($sanitizedInput['input_post_title']);
					}
					// Validate post body
					if (empty($sanitizedInput['input_post_body'])) {
						$this->errorPostBody = 'Please write the post field';
					} else {
						$this->postBody = trim($sanitizedInput['input_post_body']);
					}
					// Check if there are any errors
					switch (true) {
						case !empty($this->errorPostTitle):
						case !empty($this->errorPostBody):
						// Found errors, load page with error messages
							$this->blogModel->closeDatabaseConnection();
							$data = [
								'title' => 'Add New Post',
								'stylesheet' => 'blog_addPost',
								'postTitle' => $this->postTitle,
								'postBody' => $this->postBody,
								'errorPostTitle' => $this->errorPostTitle,
								'errorPostBody' => $this->errorPostBody
							];
							$this->loadView('blog/addPost',$data);
							break;
						default:
						// No errors, procced with post proccessing
							$this->postStatus = $this->blogModel->addPost($this->postAuthorId, $this->postTitle, $this->postBody);
							$this->blogModel->closeDatabaseConnection();
							if ($this->postStatus === FALSE) {
								$this->errorMessage = 'Error occured while adding post to database #110BC';
								$data = [
									'title' => 'Add New Post Error',
									'stylesheet' => 'error_style',
									'errorMessage' => $this->errorMessage
								];
								$this->loadView('errorPages/errorPage', $data);
							} else if (is_int($this->postStatus) && !is_array($this->postStatus)) {
								$this->errorMessage = 'Error occured while adding new post #118BC|'.$this->postStatus;
								$data = [
									'title' => 'Add New Post',
									'stylesheet' => 'error_style',
									'errorMessage' => $this->errorMessage
								];
								$this->loadView('errorPages/errorPage', $data);
							} else {
								redirect('blog/blogPosts');
							}
					}
				} else {
					// If post request is not sent, then display form for adding posts
					$data = [
						'title' => 'Add New Post',
						'stylesheet' => 'blog_addPost',
						'postTitle' => '',
						'postBody' => '',
						'errorPostTitle' => '',
						'errorPostBody' => ''
					];
					$this->loadView('blog/addPost',$data);
				}
			}
		}
		// Display all posts in admin area
		public function showAllPosts() {
			// Check if user is logged in
			if (!isLoggedIn()) {
				redirect('home/homepage');
			} else {
				$this->allPostsData = $this->blogModel->getAllPosts();
				$this->blogModel->closeDatabaseConnection();
				if ($this->allPostsData === FALSE) {
					$this->errorMessage = 'This page failed to show all posts #152BC';
					$data = [
						'title' => 'Show All Posts',
						'stylesheet' => 'error_style',
						'errorMessage' => $this->errorMessage
					];
					$this->loadView('errorPages/errorPage', $data);
				} else if (is_int($this->allPostsData) && !is_array($this->allPostsData)) {
					$this->errorMessage = 'Error occured while loading all posts #160BC';
					$data = [
						'title' => 'Show All Posts',
						'stylesheet' => 'error_style',
						'errorMessage' => $this->errorMessage
					];
					$this->loadView('errorPages/errorPage', $data);
 				} else {
					$data = [
						'title' => 'Blog Posts',
						'stylesheet' => 'blog_showAllPosts',
						'allPostsData' => $this->allPostsData
					];
					$this->loadView('blog/showAllPosts', $data);
				}
			}
		}
		// Display single post by post ID
		public function showPost($blogPostId = '') {
			switch (true) {
				case empty($blogPostId):
				case (!checkPostIdType($blogPostId)):
				case (!$this->blogModel->checkPostExistById($blogPostId)):
					$this->blogModel->closeDatabaseConnection();
					redirect('blog/blogPosts');
					break;
				default:
					$resultSet = $this->blogModel->getPostById($blogPostId);
					$this->blogModel->closeDatabaseConnection();
					$data = [
						'title' => $resultSet['post_title'],
						'stylesheet' => 'blog_show',
						'postId' => $resultSet['post_id'],
						'postTitle' => $resultSet['post_title'],
						'postBody' => $resultSet['post_body'],
						'postDate' => $resultSet['post_date']
					];
					$this->loadView('blog/show', $data);
			}
		}
		// Edit a post by post ID
		public function editPost($blogPostId = '') {
			switch (true) {
				case (!isLoggedIn()):
				case empty($blogPostId):
				case (!$this->blogModel->checkPostExistById($blogPostId)):
				case (!$this->blogModel->checkPostOwnerById($blogPostId, $_SESSION['userId'])):
					$this->blogModel->closeDatabaseConnection();
					redirect('home/homepage');
					break;
				default:
						if ($_SERVER['REQUEST_METHOD'] == 'POST') {
							// If is submited update post
							// Sanitize Input data Data
							$sanitizedInput = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
							$this->postId = trim($blogPostId);		
							// Validate postTitle
							if (empty($sanitizedInput['input_post_title'])) {
								$this->errorPostTitle = 'Please, enter a title';
							} else {
								$this->postTitle = trim($sanitizedInput['input_post_title']);
							}
							// Validate postBody
							if (empty($sanitizedInput['input_post_body'])) {
								$this->errorPostBody = 'Please, write something';
							} else {
								$this->postBody = trim($sanitizedInput['input_post_body']);
							}
							// Check if there are any errors
							if (!empty($this->errorPostTitle) || !empty($this->errorPostBody)) {
							// Load view with errors
								$data = [
									'title' => 'Edit Post',
									'stylesheet' => 'blog_editPost',
									'postId' => $this->postId,
									'postTitle' => $this->postTitle,
									'postBody' => $this->postBody,
									'errorPostTitle' => $this->errorPostTitle,
									'errorPostBody' => $this->errorPostBody
								];
								$this->loadView('blog/edit', $data);
							} else {
								// if there are no errors procced with editing the post
								$data = [
									'postId' => $this->postId,
									'postTitle' => $this->postTitle,
									'postBody' => $this->postBody,
								];
								$this->postStatus = $this->blogModel->editPostById($data);
								$this->blogModel->closeDatabaseConnection();
								if ($this->postStatus === FALSE) {
									$this->errorMessage = 'This page failed to edit this post #251BC';
									$data = [
										'title' => 'Edit Post',
										'stylesheet' => 'error_style',
										'errorMessage' => $this->errorMessage
									];
									$this->loadView('errorPages/errorPage', $data);
								} else if (is_int($this->postStatus) && !is_array($this->postStatus)) {
									$this->errorMessage = 'Error occured while editing this post #259BC';
									$data = [
										'title' => 'Edit Post',
										'stylesheet' => 'error_style',
										'errorMessage' => $this->errorMessage
									];
									$this->loadView('errorPages/errorPage', $data);
								} else {
									redirect('blog/showPost/'.$this->postId);
								}
							}
						} else {
							// If not submited display form
							$this->postId = trim($blogPostId);
							$this->singlePostData = $this->blogModel->getPostById($this->postId);
							$this->blogModel->closeDatabaseConnection();
							$data = [
								'title' => 'Edit Blog Post',
								'stylesheet' => 'blog_editPost',
								'postId' => $this->postId,
								'postTitle' => $this->singlePostData['post_title'],
								'postBody' => $this->singlePostData['post_body'],
								'errorPostTitle' => '',
								'errorPostBody' => ''
							];
							$this->loadView('blog/edit', $data);
						}
				}
		}
		// Delete a post by post ID
		public function deletePost($blogPostId) {
			switch (true) {
				case (!isLoggedIn()):
				case ($_SERVER['REQUEST_METHOD'] != 'POST'):
					redirect('blog/blogPosts');
					break;
				case (!$this->blogModel->checkPostExistById($blogPostId)):
				case (!$this->blogModel->checkPostOwnerById($blogPostId, $_SESSION['userId'])):
					$this->blogModel->closeDatabaseConnection();
					redirect('blog/blogPosts');
					break;
				default:
					$this->postStatus = $this->blogModel->deletePostById($blogPostId);
					$this->blogModel->closeDatabaseConnection();
					if ($this->postStatus === FALSE) {
						$this->errorMessage = 'This page failed to delete a post #304BC';
						$data = [
							'title' => 'Delete Post',
							'stylesheet' => 'error_style',
							'errorMessage' => $this->errorMessage
						];
						$this->loadView('errorPages/errorPage', $data);
					} else if (is_int($this->postStatus) && !is_array($this->postStatus)) {
						$this->errorMessage = 'There has been an error with post deleting #312BC|'.$this->postStatus;
						$data = [
							'title' => 'Delete Post',
							'stylesheet' => 'error_style',
							'errorMessage' => $this->errorMessage
						];
						$this->loadView('errorPages/errorPage', $data);
					} else {
						redirect('blog/showAllPosts');
					}
			}
		}
	}