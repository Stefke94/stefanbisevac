<?php 
	require_once APP_ROOT.'/views/includes/header.php'; 
?>
	<?php require_once APP_ROOT.'/views/includes/admin_side_nav.php'; ?>
	<main>
		<form id="project_form" method="post" action="<?php echo URL_ROOT.'/projects/edit/'.$data['projectId']; ?>">
			<h2>Edit Project</h2>
			<div class="project_div_form">
				<label for="project_title">Project Title: </label>
				<input id="project_title" type="text" name="project_title" value="<?php echo $data['projectTitle']; ?>">
				<?php 
					checkErrorMessage($data['errorProjectTitle']);
				?>
			</div>
			<div class="project_div_form">
				<label for="project_description">Project Description: </label>
				<input id="project_description" type="text" name="project_description" value="<?php echo $data['projectDescription']; ?>">
				<?php 
					checkErrorMessage($data['errorProjectDescription']);
				?>
			</div>
			<div class="project_div_form">
				<label for="project_url">Project URL: </label>
				<input id="project_url" type="text" name="project_url" value="<?php echo $data['projectUrl']; ?>">
				<?php 
					checkErrorMessage($data['errorProjectUrl']);
				?>
			</div>
			<div class="project_div_form">
				<button type="submit">Edit Project</button>
			</div>
		</form>
	</main>
<?php
	require_once APP_ROOT.'/views/includes/footer.php'; 