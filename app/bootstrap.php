<?php
	session_start();
	//Load config file
	require_once 'configuration/appConfig.php';
	//Load helpers
	require_once APP_ROOT.'/helpers/helpers.php';
	//Load core files
	spl_autoload_register(function($class){
		require_once APP_ROOT.'/core/'.$class.'.php';
	});