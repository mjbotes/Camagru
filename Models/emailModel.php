<?php

	class emailModel extends Model
	{
		private function email($rec, $sub, $con)
		{
			$header = "From: noReply@camagru.com\r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";
		
			$retval = mail($rec,$sub,$con,$header);

			if( $retval != true ) {
			}else {
				echo "Message could not be sent...";
			}
		}

		public function verify($det)
		{
			$con="<h1>Welcome to Camagru</h1>\n";
			$con.="<p>{$det['name']} {$det['sname']} welcome to Camagru.
			Please click on the link below to Verify your Email.\n\n</p>
			<a href='".WEBROOT."/Public/auth/verify/{$det['email']}'>Click Here</a><p>
			\n\nThank You.\n
			AI MIKE</p>";
			$this->email($det['email'], "Email Verification", $con);
		}

		public function fPass($det, $pass)
		{
			$con="<h1>Camagru</h1>\n";
			$con.="<p>{$det['uname']} {$det['sname']} Your new password is: {$pass}</p>
			\n\nThank You.\n
			AI MIKE</p>";
			$this->email($det['email'], "Forgot Password", $con);
		}

		public function notify($det)
		{
			$con="<h1>Camagru</h1>\n";
			$con.="<p>{$det['uname']} {$det['sname']} Someone liked or commented on your post</p>
			\n\nThank You.\n
			AI MIKE</p>";
			$this->email($det['email'], "NOTIFICATION", $con);
		}
	}
	?>
