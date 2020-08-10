<?php
	/*
		Core class
			* Reads URL
			* Loads Controller (Class), Method or Action (Method from Class), Parameters (Arguments passing to Method) from URL
			* URL format CONTROLLER()/METHOD or ACTION/PARAMETERS
	*/
	class Core {
		protected $currentController = 'Home';
		protected $currentMethod = 'index';
		protected $parameters = [];
		
		/*
			Constructor
		*/
		public function __construct() {
			$url = $this->getUrl();
			//Check for controller
			if (file_exists(APP_ROOT.'/controllers/'.ucwords($url[0]).'.php')) {
				$this->currentController = ucwords($url[0]);
				//Unset first index of url
				unset($url[0]);
			}
			//Require controller
			require_once APP_ROOT.'/controllers/'.$this->currentController.'.php';
			//Make instance of controller
			$this->currentController = new $this->currentController();
			//Check for method
			if (isset($url[1])) {
				if (method_exists($this->currentController, lcfirst($url[1]))) {
					$this->currentMethod = lcfirst($url[1]);
					//Unset second index of url
					unset($url[1]);
				}
			}
			//Rest of URLs are parameters
			if ($url) {
				$this->parameters = array_values($url);
			} else {
				$this->parameters = [];
			}
			//Call currentController's method with parameters
			call_user_func_array([$this->currentController, $this->currentMethod], $this->parameters);
		}
		/*
			Methods
		*/
		public function getUrl() {
			//Check URL
			if (isset($_GET['url'])) {
				$url = $_GET['url'];
				//Trim / from the URL
				$url = rtrim($url,'/');
				//Sanitaze URL
				$url = filter_var($url,FILTER_SANITIZE_URL);
				// Break URL string into array
				$url = explode('/' , $url);
				return $url;
			}
		}
	}