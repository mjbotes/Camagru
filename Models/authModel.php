<?php
class authModel extends Model
{
	public function getUser($user)
	{
		try {
		$sql="SELECT * FROM users WHERE email=:email OR userN=:user;";
		$req = Database::getBdd()->prepare($sql);
		$req->execute([
			'user' => $user,
			'email'=> $user
		]);
		return $req->fetch();
		}
		catch(PDOException $e)
		{
			echo "A thing went wrong: ".$e->getMessage();
		}
	}
	public function getUserI($user)
	{
		try {
		$sql="SELECT * FROM users WHERE `user_id`=:user;";
		$req = Database::getBdd()->prepare($sql);
		$req->execute([
			'user' => $user
		]);
		return $req->fetch();
		}
		catch(PDOException $e)
		{
			echo "A thing went wrong: ".$e->getMessage();
		}
	}

	public function getUserC($user)
	{
		try {
		$sql="SELECT count(*) AS nR FROM users WHERE email=:email OR userN=:user;";
		$req = Database::getBdd()->prepare($sql);
		$req->execute([
			'user' => $user,
			'email'=> $user
		]);
		return $req->fetch();
		}
		catch(PDOException $e)
		{
			echo "A thing went wrong: ".$e->getMessage();
		}
	} 

	public function login($userArr)
	{
		$res = $this->getUser($userArr['user']);
		if (password_verify($userArr['pass'],$res['hPass']))
		{
			session_start();
			$_SESSION['isLogin']=true;
			$_SESSION['userID'] = $res['user_id'];
			$_SESSION['uN'] = $res['userN'];
			session_write_close();
			return TRUE;
		}
		else
			return FALSE;
	}

	public function register($userArr)
	{
		$sql = "INSERT INTO `users`(userN, `uname`, sname, email, hPass) VALUES (:userN, :uname, :sName, :email, :hPass);";
		try
		{
			$req = Database::getBdd()->prepare($sql);
			$req->execute([
				'userN' => $userArr['userN'],
				'email' => $userArr['email'],
				'uname' => $userArr['name'],
				'sName' => $userArr['sname'],
				'hPass' => password_hash($userArr['pass'], PASSWORD_DEFAULT)
			]);
			
		}
		catch(PDOException $e)
		{
			echo "A thing went wrong: ".$e->getMessage();
		}
	}

	public function logout()
	{
		session_start();
		if (isset($_SESSION["isLogin"]) && $_SESSION["isLogin"] === TRUE)
		{
			session_unset();
			session_destroy();
			
		}
		header("location: /login");
	}

	public function setProfileP($pid)
	{
		try{
		$sql = 'UPDATE `users` SET `p_pic`=:c WHERE `user_id`=:p';
		$req = Database::getBdd()->prepare($sql);
		$req->execute([
			'p' => $_SESSION["userID"],
			'c' => $pid.".png"
		]);
		}
		catch(PDOException $e)
		{
			echo "A thing went wrong: ".$e->getMessage();
		}
	}

	public function update($det,$arr)
		{
			if (isset($arr["pass"]))
			{
				try
				{
					$sql = 'UPDATE `users` SET `hPass`=:c WHERE `user_id`=:p';
					$req = Database::getBdd()->prepare($sql);
					$req->execute([
						'p' => $det["user_id"],
						'c' => $arr["pass"]
					]);
				}
				catch(PDOException $e)
				{
					echo "A thing went wrong: ".$e->getMessage();
				}
			}
			if (isset($arr["email"]))
			{
				try
				{
					$sql = 'UPDATE `users` SET `email`=:c WHERE `user_id`=:p';
					$req = Database::getBdd()->prepare($sql);
					$req->execute([
						'p' => $det["user_id"],
						'c' => $arr["email"]
					]);
				}
				catch(PDOException $e)
				{
					echo "A thing went wrong: ".$e->getMessage();
				}
			}
			if (isset($arr["userN"]))
			{
				try
				{
					$sql = 'UPDATE `users` SET `userN`=:c WHERE `user_id`=:p';
					$req = Database::getBdd()->prepare($sql);
					$req->execute([
						'p' => $det["user_id"],
						'c' => $arr["userN"]
					]);
				}
				catch(PDOException $e)
				{
					echo "A thing went wrong: ".$e->getMessage();
				}
			}
			if (isset($arr["uname"]))
			{
				try
				{
					$sql = 'UPDATE `users` SET `uname`=:c WHERE `user_id`=:p';
					$req = Database::getBdd()->prepare($sql);
					$req->execute([
						'p' => $det["user_id"],
						'c' => $arr["uname"]
					]);
				}
				catch(PDOException $e)
				{
					echo "A thing went wrong: ".$e->getMessage();
				}
			}
			if (isset($arr["sname"]))
			{
				try
				{
					$sql = 'UPDATE `users` SET `sname`=:c WHERE `user_id`=:p';
					$req = Database::getBdd()->prepare($sql);
					$req->execute([
						'p' => $det["user_id"],
						'c' => $arr["sname"]
					]);
				}
				catch(PDOException $e)
				{
					echo "A thing went wrong: ".$e->getMessage();
				}
			}
			if (isset($arr["notifications"]))
			{
				try
				{
					$sql = 'UPDATE `users` SET `notifications`=:c WHERE `user_id`=:p';
					$req = Database::getBdd()->prepare($sql);
					$req->execute([
						'p' => $det["user_id"],
						'c' => $arr["notifications"]
					]);
				}
				catch(PDOException $e)
				{
					echo "A thing went wrong: ".$e->getMessage();
				}
			}
		}
}
?>