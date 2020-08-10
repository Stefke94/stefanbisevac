<?php 
	require_once APP_ROOT.'/views/includes/header.php';
?>
		<?php require_once APP_ROOT.'/views/includes/admin_side_nav.php'; ?>
		<main>
			<h1>Welcome back <?php echo $_SESSION['userName']; ?></h1>
		</main>
<?php 
	require_once APP_ROOT.'/views/includes/footer.php';
?>