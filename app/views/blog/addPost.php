<?php
	require_once APP_ROOT.'/views/includes/header.php';
?>
	<?php require_once APP_ROOT.'/views/includes/admin_side_nav.php'; ?>
	<main>
		<form method="post" action="<?php echo URL_ROOT; ?>/blog/addPost">
			<h2>Add New Post</h2>
			<div class="form_div_post">
				<label for="blog_title">Title: </label>
				<input id="blog_title" type="text" name="input_post_title" placeholder="Title goes here" value="<?php echo $data['postTitle']; ?>">
				<?php
					checkErrorMessage($data['errorPostTitle']);
				?>
			</div>
			<div class="form_div_post">
				<label for="blog_body">Post: </label>
				<textarea id="blog_body" name="input_post_body" placeholder="Post body goes here"><?php echo $data['postBody']; ?></textarea>
				<?php 
					checkErrorMessage($data['errorPostBody']);
				?>
			</div>
			<div id="div_add_button">
				<button type="submit" id="add_post_button" name="add_post_button">Post</button>
			<div>
		</form>
	</main>
<?php
require_once APP_ROOT.'/views/includes/footer.php';
