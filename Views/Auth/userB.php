<?php
	session_start();
	if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === TRUE)
	{
		?>
		<a class="wText" href="<?=WEBROOT?>Public/auth/account"><?=$_SESSION['uN'];?></a> | 
		<a class="wText" href="<?=WEBROOT?>Public/auth/logout">Logout</a>
		<?php
	} else {
		?>
		<a class="wText" href="<?=WEBROOT?>Public/auth/login">Login</a> | 
		<a class="wText" href="<?=WEBROOT?>Public/auth/register">Register</a>
		<?php
	}
?>
