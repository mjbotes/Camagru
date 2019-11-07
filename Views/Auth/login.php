
<form method='post' action='#'>
	<legend>LOGIN</legend>
    <div class="form-group">
        <label for="user">Username or Email</label>
        <input type="text" class="form-control" id="user" name="user">
    </div>

    <div class="form-group">
        <label for="pass">Password</label>
        <input type="password" class="form-control" id="pass" name="pass">
    </div>
    <button type="submit" class="btn center btn-primary">Login</button>
	<br />
	<a class="center" href="<?=WEBROOT?>Public/auth/forgotP">FORGOT PASSWORD</a> | 
	<a class="center" href="<?=WEBROOT?>Public/auth/register">REGISTER</a>
</form>
