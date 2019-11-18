<div class="container emp-profile">
<form method="post">
		<div class="row">
			<div class="col-md-4">
				<div class="profile-img">
					<img src="<?=$p_pic?>" alt=""/>
					<div class="file btn btn-lg btn-primary">
						Change Photo
						<input type="file" name="file"/>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="profile-head">
					<h5>
						<?=$name?>
					</h5>
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
							</li>
						</ul>
				</div>
			</div>
			<div class="col-md-2">
				<input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
			</div>
		</div>
	<form>
</div>
