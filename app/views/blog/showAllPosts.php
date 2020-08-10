<?php 
	require_once APP_ROOT.'/views/includes/header.php';
?>
	<?php require_once APP_ROOT.'/views/includes/admin_side_nav.php'; ?>
	<main>
		<table id="posts_table">
			<caption>All Blog Posts</caption>
			<thead>
				<tr>
					<th>Blog Post ID</th>
					<th>Author</th>
					<th>Blog Title</th>
					<th>Blog Body</th>
					<th>Date</th>
					<th colspan="3">Action</td>
				</tr>
			</thead>
			<tbody>
				<?php
					if (empty($data['allPostsData'])) {
						echo '<tr id="no_data_message_row">';
						echo '<td colspan="8">No data</td>';
					} else {
						foreach ($data['allPostsData'] as $postData) {
							echo '<tr>';
							echo '<td>'.$postData['post_id'].'</td>';
							echo '<td>'.$postData['user_name'].'</td>';
							echo '<td>'.$postData['post_title'].'</td>';
							if (strlen($postData['post_body']) > 255) {
								echo '<td>'.substr($postData['post_body'],0,100).'...</td>';
							} else {
								echo '<td>'.substr($postData['post_body'],0,100).'</td>';
							}
							echo '<td>'.date('L-F-Y G:i', $postData['post_date_created_at_unix']).'</td>';
							echo '<td class="zeButtons"><a href="'.URL_ROOT.'/blog/showPost/'.$postData['post_id'].'"><button class="table_button show_button">Show Post</button></a></td>';
							echo '<td class="zeButtons"><a href="'.URL_ROOT.'/blog/editPost/'.$postData['post_id'].'"><button class="table_button edit_button">Edit</button></a></td>';
							echo '<td class="zeButtons"><form method="post" action="'.URL_ROOT.'/blog/deletePost/'.$postData['post_id'].'"><button class="table_button delete_button" type="submit">Delete</button></form></td>';
							echo '</tr>';
						}
					}
				?>
			</tbody>
			<tfoot>
			
			</tfoot>
		</table>
	</main>
<?php 
	require_once APP_ROOT.'/views/includes/footer.php';
?>