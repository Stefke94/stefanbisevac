<?php
	require_once APP_ROOT.'/views/includes/header.php';
?>
	<main>
		<section class="main_heading">
			<h1>Log In</h1>
		</section>
		<section id="form_section">
			<form method="post" action="<?php echo URL_ROOT.'/users/login'; ?>">
				<h3>Please fill in your account details to log in</h3>
				<div class="form_div">
					<label for="user_name">Your Username:</label>
					<input id="user_name" type="text" name="user_name" value="<?php echo $data['userName']; ?>">
					<?php 
						checkErrorMessage($data['errorUserName']);
					?>
				</div>
				<div class="form_div">
					<label for="user_password">Your Password: </label>
					<input id="user_password" type="password" name="user_password">
					<?php 
						checkErrorMessage($data['errorUserPassword']);
					?>
				</div>
				<div class="form_div">
					<button type="submit">Log In</button>
				</div>
			</form>
		</section>
	</main>
<?php
	require_once APP_ROOT.'/views/includes/footer.php';
