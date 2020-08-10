<?php require_once APP_ROOT.'/views/includes/header.php'; ?>
	<?php require_once APP_ROOT.'/views/includes/admin_side_nav.php'; ?>
	<main>
		<form method="post" action="<?php echo URL_ROOT.'/blog/editPost/'.$data['postId']; ?>">
			<h2>Edit Blog Post</h2>
			<div class="form_divs">
				<label for="input_post_title">Title: </label>
				<input id="input_post_title" type="text" name="input_post_title" placeholder="Title here..." value="<?php echo $data['postTitle']; ?>">
				<?php
					checkErrorMessage($data['errorPostTitle']);
				?>
			</div>
			<div class="form_divs">
				<label for="input_post_body">Blog Post: </label>
				<textarea id="input_post_body" name="input_post_body" placeholder="Post here..."><?php echo $data['postBody']; ?></textarea>
				<?php 
					checkErrorMessage($data['errorPostBody']);
				?>
			</div>
			<div id="edit_button_div">
				<button type="submit">Edit</button>
			<div>
		</form>
	</main>
<?php 
	require_once APP_ROOT.'/views/includes/footer.php'; 