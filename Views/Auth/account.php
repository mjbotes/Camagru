<div class="container emp-profile">
<h1 class="center">Account Mangement</h1>
				<div class="profile-img thrtyp center">
					<img src="<?=WEBROOT?>Public/imgs/users/<?php if($p_pic === NULL){echo "default.png";}else{echo $p_pic;}?>" alt=""/>
				</div>
			<div class="col-md-6 center">
				<form>
					<legend>Update Details</legend>
					<label>First Name</label><input class="form-control" type="text" value="<?=$uname?>"><br />
					<label>Surname</label><input class="form-control" type="text" value="<?=$sname?>"><br />
					<label>Username</label><input class="form-control" type="text" value="<?=$userN?>"><br />
					<label>Email</label><input class="form-control" type="text" value="<?=$email?>"><br />
					<input class="btn center btn-primary" type="submit" value="Update Details">
				</form>
				<form>
					<legend>Update Password</legend>
					<label>Password</label><input class="form-control" type="password"><br />
					<label>Confirm Password</label><input class="form-control" type="password"><br />
					<input class="btn center btn-primary" type="submit" value="Update Password">
				</form>
			</div>
		</div>
	<form>
</div>
