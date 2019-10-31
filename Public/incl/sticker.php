<?php
	if ($handle = opendir(ROOT.'Public/imgs/stickers')) {
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				echo "<button onclick='addImg(\"$entry\")'><img class='stickers' src='".WEBROOT."Public/imgs/stickers/".$entry."'></button>";
			}
		}
		closedir($handle);
	}
?>
