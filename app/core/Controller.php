<?php
	/*
		Base Controller Class
			* Main controller inherited by every other controller
			* Loads models
			* Loads views
	*/
	class Controller {
		/*
			Methods
		*/
		public function loadModel($model) {
			require_once APP_ROOT.'/models/'.$model.'.php';
			$Model = new $model;
			return $Model;
		}
		public function loadView($view, $data = []) {
			if (file_exists(APP_ROOT.'/views/'.$view.'.php')) {
				require_once APP_ROOT.'/views/'.$view.'.php';
			} else {
				die('This view does not exist!');
			}
		}
	}