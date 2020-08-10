<?php
	class Home extends Controller {
		/*
			Methods
		*/
		public function index() {
			redirect('home/homepage');
		}
		// Displays Main page also knowns as homepage
		public function homepage() {
			$data = [
				'title' => 'Homepage',
				'stylesheet' => 'home_homepage'
			];
			$this->loadView('home/homepage',$data);
		}
		// Displays About me page
		public function about() {
			$data = [
				'title' => 'About Me',
				'stylesheet' => 'home_about'
			];
			$this->loadView('home/about',$data);
		}
		// Displays Contact page
		public function contact() {
			$data = [
				'title' => 'Contact',
				'stylesheet' => 'home_contact'
			];
			$this->loadView('home/contact',$data);
		}
	}