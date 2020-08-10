<?php
	require_once APP_ROOT.'/views/includes/header.php';
?>
	<?php require_once APP_ROOT.'/views/includes/admin_side_nav.php'; ?>
	<main>
		<table id="project_table">
			<caption>All Projects</caption>
			<thead>
				<th>Project ID</th>
				<th>Project Title</th>
				<th>Project Description</th>
				<th>Project URL</th>
				<th>Project Image Name</th>
				<th colspan="3">Action</th>
			</thead>
			<tbody>
				<?php
					if (empty($data['projects'])) {
						echo '<tr id="no_data_message_row">';
						echo '<td colspan="8">No data</td>';
					} else {
						foreach ($data['projects'] as $project) {
							echo '<tr>';
							echo '<td>'.$project['project_id'].'</td>';
							echo '<td>'.$project['project_title'].'</td>';
							echo '<td>'.$project['project_description'].'</td>';
							echo '<td>'.$project['project_url'].'</td>';
							echo '<td>'.$project['project_image_name'].'</td>';
							echo '<td><a href="'.$project['project_url'].'"><button class="project_table_button">Show project</button></a></td>';
							echo '<td><a href="'.URL_ROOT.'/projects/edit/'.$project['project_id'].'"><button class="project_table_button edit_button">Edit</button></a></td>';
							echo '<td><form method="post" action="'.URL_ROOT.'/projects/delete/'.$project['project_id'].'"><button class="project_table_button delete_button" type="submit">Delete</button></form></td>';
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