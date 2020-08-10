<?php
	require_once APP_ROOT.'/views/includes/header.php';
?>
		<main>
			<section class="main_heading">
				<h1>My Work</h1>
			</section>
				<?php
					if (empty($data['projects'])) {
						echo '<section id="noPostsMessage">';
						echo '<p>Currently there are no projects that have been done....yet!</p>';
						echo '</section>';
					} else {
				?>
			<section id="project_section">
					<?php	foreach ($data['projects'] as $project): ?>
				<article class="single_project_article">
					<section class="single_project_section">
						<a href="<?php echo $project['project_url']; ?>"><img src="<?php echo URL_ROOT.'/images/project_images/'.$project['project_image_name']; ?>"></a>
						<div id="project_div_description">
							<a href="<?php echo $project['project_url']; ?>"><h3><?php echo $project['project_title']; ?></h3></a>
							<p><?php echo $project['project_description']; ?></p>
						</div>
					</section>	
				</article>
				<?php 
						endforeach; 
					} ?>
			</section>
					
		</main>
<?php
	require_once APP_ROOT.'/views/includes/footer.php';