<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Stefan Bisevac | <?php echo $data['title']; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT; ?>/css/main_style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT.'/css/'.$data['stylesheet']; ?>.css">
	</head>
	<body>
		<div id="wrapper">
			<header <?php if(isLoggedIn()) echo 'id="add"'; ?>>
				<?php include APP_ROOT.'/views/includes/nav.php'; ?>
			</header>
			<div id="main_div">
	