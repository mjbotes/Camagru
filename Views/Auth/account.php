<div class="container emp-profile">
<h1 class="center">Account Mangement</h1>
				<div class="profile-img thrtyp center">
					<img src="<?=WEBROOT?>Public/imgs/users/<?php if($p_pic === NULL){echo "default.png";}else{echo $p_pic;}?>" alt=""/>
				</div>
			<div class="col-md-6 center">
				<form method="POST" action="#">
					<legend>Update Details</legend>
					<input name="up" value="det" type="hidden">
					<label>First Name</label><input name="uname" class="form-control" type="text" value="<?=$uname?>"><br />
					<?=$erN?><br />
					<label>Surname</label><input name="sname" class="form-control" type="text" value="<?=$sname?>"><br />
					<?=$erSN?><br />
					<label>Username</label><input name="userN" class="form-control" type="text" value="<?=$userN?>"><br />
					<?=$erUN?><br />
					<label>Email</label><input name="email" class="form-control" type="text" value="<?=$email?>"><br />
					<?=$erE?><br />
					<label>Notifications</label><div class="center"><input name="not" type="radio" value="1" <?php
					if ($notifications === "1"){echo "checked"; }?>>on <input name="not" type="radio" value="0" <?php
					if ($notifications === "0"){echo "checked"; }?>>off</div><br />
					<input class="btn center btn-primary" type="submit" value="Update Details">
				</form>
				<form method="POST" action="#">
					<legend>Update Password</legend>
					<div class="error">
						<?=$erP?>
					</div>
					<input name="up" value="pas" type="hidden">
					<label>Password</label><input class="form-control" type="password" name="pass"><br />
					<label>Confirm Password</label><input class="form-control" type="password" name="cpass"><br />
					<input class="btn center btn-primary" type="submit" value="Update Password">
				</form>
			</div>
		</div>
</div>
