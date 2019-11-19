<div class="form">
<div class="try">	
	<video id="video" autoplay width="640" hieght="480"></video>
	<div class="wrapper">

	<canvas display="none" id="view" class="view"></canvas>
	<canvas display="none" id="viewS" class="viewS"></canvas>
	</div>
	<button id="cap" class="btn btn-primary">Capture</button>
	<input type="file" name="u_pic" onchange="uploadToC()" id="ftu">
	<button id="recap" display="none" class="btn btn-primary">Recapture</button>
	<button id="reset" display="none" onClick="reset()" class="btn btn-primary">Reset Stickers</button>
</div>	
<div class="dec">
	<?php
		require_once ROOT."Public/incl/sticker.php";
	?>
</div>
<div>
		<form method="post" action="#">
		<input type="hidden" id="imgUrl" name="imgUrl">
		<input type="hidden" id="sURL" name="sURL">
		<label>Caption</label><br />
		<input type="text" name="caption" id="caption">
		<label>Profile Picture</label>
		<input type="checkbox" name="p_pic">
		<input type="submit" class="btn btn-primary postP" id="postP" onclick="saveImg()">POST PICTURE</button>
</form>
	</div>
<script type="text/javascript">
	<?php 
		require_once ROOT."Public/incl/js/webcam.js";
	?>
</script>
</div>

