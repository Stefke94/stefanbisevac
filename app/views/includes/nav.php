<nav>
	<div id="nav_logo">
		<a href="<?php echo URL_ROOT; ?>"><img src="<?php echo URL_ROOT; ?>/images/logos/stefanBisevac.png"></a>
	</div>
	<ul>
		<li><a href="<?php echo URL_ROOT.'/home/homepage'; ?>"><button class="nav_button">Home</button></a></li>
		<li><a href="<?php echo URL_ROOT.'/home/about'; ?>"><button class="nav_button">About</button></a></li>
		<li><a href="<?php echo URL_ROOT.'/projects'; ?>"><button class="nav_button">My Work</button></a></li>
		<li><a href="<?php echo URL_ROOT.'/blog/posts'; ?>"><button class="nav_button">Blog</button></a></li>
		<li><a href="<?php echo URL_ROOT.'/home/contact'; ?>"><button class="nav_button">Contact</button></a></li>
		<?php 
			if(isLoggedIn()){
				echo '<li><a href="'.URL_ROOT.'/users/profile"><button class="nav_button">Profile</button></a></li>';
			}
		?>
	</ul>
</nav>