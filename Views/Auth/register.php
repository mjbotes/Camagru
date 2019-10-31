<form method='post' action='#'>
<legend>REGISTER</legend>
	<div class="form-group">
		<label for="user">Username</label>
		<input type="text" class="form-control" id="user" name="user">
		<?php if (isset($this->vars['erUN'])){echo $this->vars['erUN'];} ?>
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" name="email">
		<?php if (isset($this->vars['erE'])){echo $this->vars['erE'];} ?>
	</div>

	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" class="form-control" id="name" name="name">
		<?php if (isset($this->vars['erN'])){echo $this->vars['erN'];} ?>
	</div>

	<div class="form-group">
		<label for="sname">Surname</label>
		<input type="text" class="form-control" id="sname" name="sname">
		<?php if (isset($this->vars['erSn'])){echo $this->vars['erSn'];} ?>
	</div>

	<div class="form-group">
		<label for="pass">Password</label>
		<input type="password" class="form-control" id="pass" name="pass">
		<?php if (isset($this->vars['erP'])){echo $this->vars['erP'];} ?>
	</div>

	<div class="form-group">
		<label for="pass">Confirm Password</label>
		<input type="password" class="form-control" id="Cpass" name="Cpass">
	</div>
	<button type="submit" class="btn btn-primary">Register</button>
</form>
