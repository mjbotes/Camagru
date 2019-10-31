<div class="post">
	<?php 
		$p_pic = "default.png";
		$v = $this->vars[v];
		if (isset($v['o_pic']))
		{
			$p_pic = $v['o_pic'];
		}
		echo "<img class='p_pic' src='/Camagru/Public/imgs/users/".$p_pic."'><h3>".$v['userN'].'</h3>';
	?>
	<img class='pic' src=<?php echo WEBROOT."Public/imgs/posts/{$v['post_id']}.png"; ?>>
	<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="gratipay" class="like" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
	<path fill="currentColor" d="M248 8C111.1 8 0 119.1 0 256s111.1 248 248 248 248-111.1 248-248S384.9 8 248 8zm114.6 226.4l-113 152.7-112.7-152.7c-8.7-11.9-19.1-50.4 13.6-72 28.1-18.1 54.6-4.2 68.5 11.9 15.9 17.9 46.6 16.9 61.7 0 13.9-16.1 40.4-30 68.1-11.9 32.9 21.6 22.6 60 13.8 72z">
	</path></svg><p class="nLikes"><?php echo $v['likes']." likes";?></p>
	<p class="descp"><?php echo $v['post']; ?></p>
	<h3>comments</h3>
	<?php
		foreach ($com as $row => $link) {
			$p_pic = "default.png";
			if (isset($link['o_pic']))
			{
			$p_pic = $link['o_pic'];
			}
			echo "<div class='comment'><img class='p_pic' src='".WEBROOT."Public/imgs/users/{$p_pic}'><h3>{$link['userN']}</h3><br />";
			echo "<p>{$link['comment']}</p></div>";
		}
		session_start();
		if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === TRUE)
		{
		?>
			<form method="post" action="#">
			<div class='comment'><input type="text" name="comment">
			<input type="submit" value="comment">
			</form>
		<?php
		}
	?>
</div>
