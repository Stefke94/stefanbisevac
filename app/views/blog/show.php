<?php 
	require_once APP_ROOT.'/views/includes/header.php';
?>
	<main>
		<section id="post_section">
			<article>
				<h3 class="headings"><?php echo $data['postTitle']; ?></h3>
				<h4 class="headings">On: <?php echo date('d.m.Y' , $data['postDate']); ?></h4>
				<p class="body_text">
					<?php echo $data['postBody']; ?>
				</p>
				
			</article>
			<?php 
				if (isset($_SESSION['userId']) && isset($_SESSION['userName'])) {
					echo '<div id="post_section_controlls">';
					echo '<a href="'.URL_ROOT.'/blog/editPost/'.$data['postId'].'"><button>Edit</button></a>';
					echo '<form action="'.URL_ROOT.'/blog/deletePost/'.$data['postId'].'" method="post"><button type="submit">Delete</button></form>';
					echo '</div>';
				}
			?>
		</section>
	</main>
<?php 
	require_once APP_ROOT.'/views/includes/footer.php';