<?php
	require_once APP_ROOT.'/views/includes/header.php';
?>
	<main>
		<section id="main_heading_section">
			<h1>:(</h1>
			<h4>Wild Error Appeared</h4>
		</section>
		<section id="error_message_section">
			<p>Sorry for this error! It will be fixed as soon as possible!<br>
			If you are wondering what caused this error, here is a brief explanation:</p>
			<p><b><?php echo $data['errorMessage']; ?></b>.</p>
			<p>Click onto this button to take you back to home page:</p>
			<p><a href="<?php echo URL_ROOT;?>" id="homepage_button">Return to Home page</a></p>
		</section>
	</main>
<?php
	require_once APP_ROOT.'/views/includes/footer.php';