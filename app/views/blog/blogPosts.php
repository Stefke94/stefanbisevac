<?php
	require_once APP_ROOT.'/views/includes/header.php';
?>
		<main>
			<section class="main_heading">
				<h1>Blog Posts</h1>
			</section>
			<section id="posts_section">
			<?php 
				if (empty($data['allPostsData'])) { 
					echo '<article id="noPostsMessage">';
					echo '<p>There are no posts currently, but fear not as there will be posts!<br>Stay tuned!</p>';
					echo '</article>';
				} else {
					foreach ($data['allPostsData'] as $postData):
				?>
				<article class="single_post_article">
					<section>
						<h3><a href="<?php echo URL_ROOT.'/blog/showPost/'.$postData['post_id'] ;?>"><?php echo $postData['post_title']; ?></a></h3>
						<p>Written by: <?php echo $postData['user_name']; ?></p>
						<p>On: <?php echo date('d-F-Y G:i', $postData['post_date_created_at_unix']); ?></p>
						<p class="post_body">
							<?php
								if (strlen($postData['post_body']) > 500) {
									echo substr($postData['post_body'], 0, 500).' ... <a class="read_more_link" href="'.URL_ROOT.'/blog/showPost/'.$postData['post_id'].'">[Read More]</a>';
								} else {
									echo $postData['post_body'];
								}
							?>
						</p>
					</section>
				</article>
				<?php
						endforeach;
					}
				?>
			</section>
			
		</main>
	</div>
		
<?php
	require_once APP_ROOT.'/views/includes/footer.php';
