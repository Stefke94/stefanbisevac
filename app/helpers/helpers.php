<?php
	function redirect($url = '') {
		header('Location: '.URL_ROOT.'/'.$url);
	}
	function isLoggedIn() {
			if (isset($_SESSION['userId']) && isset($_SESSION['userName'])) {
				return TRUE;
			} else{
				return FALSE;
			}
		}
	function checkErrorMessage($error_message) {
		if (!empty($error_message)) {
				echo '<p class="error_message">'.$error_message.'</p>';
			}
	}
	function checkPostIdType($postId) {
		$convertedPostId = intval($postId);
		if ($convertedPostId > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function fileUploadErrorList($errorCode) {
		$phpFileUploadErrors = [
			0 => 'There is no error, the file uploaded with success',
			1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
			2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
			3 => 'The uploaded file was only partially uploaded',
			4 => 'No file was uploaded',
			6 => 'Missing a temporary folder',
			7 => 'Failed to write file to disk.',
			8 => 'A PHP extension stopped the file upload.'
		];
		if (array_key_exists($errorCode, $phpFileUploadErrors)) {
			return $phpFileUploadErrors[$errorCode] ;
		}
	}