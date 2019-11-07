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
			return TRUE;
		}
		return FALSE;
	}

	public function register($userArr)
	{
		$sql = "INSERT INTO `users`(userN, `name`, sname, email, hPass) VALUES (:userN, :uname, :sName, :email, :hPass);";
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
}
