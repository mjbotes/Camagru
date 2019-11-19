<?php

class authController extends Controller
{
	function login()
	{
		session_start();
		if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true)
		{
			header("location: ".WEBROOT."Public/feed/index");
		}
		if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$userArr = array('user' => $_POST['user'], 'pass' => $_POST['pass']);
			$this->secure_form($userArr);
			if (empty(trim($userArr['user'])))
			{
				$erUser="Please Enter Username or Email.";
			}
			if (empty(trim($userArr['pass'])))
			{
				$erPass="Please Enter Password.";
			}
			if (empty($erUser) && empty($erPass))
			{
				require(ROOT . 'Models/authModel.php');
				$auth= new authModel();
				if ($auth->login($userArr) === TRUE)
				{
					header("location: ".WEBROOT."Public/feed/index");
				} else
				{
					$error="Username/Email or Password is incorrect";
				}
			}
		}
		$this->render('login');
	}

	function logout()
	{
		if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true)
		{
			header("location: ".WEBROOT."Public/feed/index");
		}
		require(ROOT . 'Models/authModel.php');
		$auth= new authModel();
		$auth->logout();
		header("Location: ".WEBROOT."Public/auth/login");
	}

	function register()
	{
		require(ROOT . 'Models/authModel.php');
		$auth= new authModel();
		session_start();
		if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true)
		{
			header("location: ".WEBROOT."Public/feed/index");
		}
		if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$userArr = array('userN' => $_POST['user'], 'email' => $_POST['email'], 'pass' => $_POST['pass'], 'name' => $_POST['name'], 'sname' => $_POST['sname']);
			if (empty(trim($userArr['userN'])))
			{
				$d=array('erUN'=>"Please enter a Username");
				$this->set($d);
			}
			elseif (filter_var($userArr['userN'],FILTER_VALIDATE_EMAIL))
			{
				$d=array('erUN'=>"Username cannot have email format.");
				$this->set($d);
			}
			else
			{
				$res = $auth->getUserC($userArr['userN']);
				if ($res['nR'] != 0)
				{
					$d=array('erUN'=>"Username is already taken");
					$this->set($d);
				}
			}
			if (empty(trim($userArr['email'])))
			{
				$d=array('erE'=>"please Enter your email");
				$this->set($d);
			}
			else
			{
				$res = $auth->getUserC($userArr['email']);
				if ($res['nR'] != 0)
				{
					$d=array('erE'=>"Email is already used");
					$this->set($d);
				}
			}
			if (empty(trim($userArr['pass'])))
			{
					$d=array('erP'=>"Please fill in a Password");
					 $this->set($d);
			}
			else
			{
				if (strLen($userArr['pass']) < 8)
				{
					 $d=array('erP'=>"Password has to be 8 characters or longer.");
					 $this->set($d);
				}
			}
			if (empty(trim($userArr['name'])))
			{
				$d=array('erN'=>"please Enter your Name");
				$this->set($d);
			}
			if (empty(trim($userArr['sname'])))
			{
				$d=array('erSn'=>"please Enter your Surname");
				$this->set($d);
			}
			if (!(isset($this->vars['erN']) || isset($this->vars['erS'])  || isset($this->vars['erUN'])  || isset($this->vars['erUN'])  || isset($this->vars['erE'])))
			{
				try{
				$this->secure_form($userArr);
				$auth->register($userArr);
				require(ROOT . 'Models/emailModel.php');
				$email= new emailModel();
				$email->verify($userArr);
				header("Location: ".WEBROOT."Public/auth/login");
				} catch(PDOException $e) {
					echo $e->getMessage();
				}
			}
		}
		$this->render('register');
	}

		public function password($param)
		{
			if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST")
			{
				require(ROOT . 'Models/authModel.php');
				$auth= new authModel();
				$auth->changePass();
			}
			$this->render("password");
		}

		public function forgotP()
		{
			if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true)
			{
				header("location: ".WEBROOT."Public/feed/index");
			}
			if ($_SERVER["REQUEST_METHOD"] === "POST")
			{
				$pass = uniqid();
				require(ROOT . 'Models/authModel.php');
				$auth= new authModel();
				$det = $auth->getUser($_POST["user"]);
				$hPass = password_hash($pass, PASSWORD_DEFAULT);
				$a = array("pass" => $hPass);
				$auth->update($det,$a);
				require(ROOT . 'Models/emailModel.php');
				$email= new emailModel();
				$email->fPass($det,$pass);
				header("Location: ".WEBROOT."Public/auth/login");
			}
			$this->render("forgotP");
		}

		public function account()
		{
			require(ROOT . 'Models/authModel.php');
			$auth= new authModel();
			session_start();
			$usr = $auth->getUserI($_SESSION["userID"]);
			if (isset($_SERVER["REQUEST_METHOD"]) && ($_SERVER["REQUEST_METHOD"] === "POST")&& $_POST["up"]==="pas")
			{
				$arr = array("pass" => $_POST["pass"], "cpass"=>$_POST["cpass"]);
				$arr = $this->secure_form($arr);
				$erP = "";
				if ($arr["pass"] === $arr["cpass"])
				{
					$uppercase = preg_match('@[A-Z]@', $arr["pass"]);
					$lowercase = preg_match('@[a-z]@', $arr["pass"]);
					$number = preg_match('@[0-9]@', $arr["pass"]);
					$special_chars = preg_match('@[^\w]@', $arr["pass"]);
					if(strlen($arr["pass"]) < 6) {
						$erP = "<li>Password must be at least 6 characters long.";
					}					
					if(!$uppercase) {
						$erP =$erP. "<li>Password must include at least one uppercase letter.";
					}
					if(!$lowercase) {
						$erP = $erP."<li>Password must include at least on lowercase letter.";
					}
					if(!$number) {
						$erP = $erP."<li>Password must include at least one number.";
					}
					if(!$special_chars) {
						$erP = $erP."<li>Password must include at least one special character.";
					}
					if ($erP === "") {
						$arr["pass"] = password_hash($arr["pass"], PASSWORD_DEFAULT);
						$auth->update($usr,$arr);
						header("location: ".WEBROOT."Public/auth/account");
					}
				}
				else
				{
					$erP = "Passwords don't match.";
				}
			}
			if (isset($_SERVER["REQUEST_METHOD"]) && ($_SERVER["REQUEST_METHOD"] === "POST") && $_POST["up"]==="det")
			{
				if(isset($_POST["uname"]))
				{
					$userArr = array("uname" => $_POST["uname"]);
					$userArr = $this->secure_form($userArr);
					if ($usr["uname"] != $userArr["uname"])
					{
						$number = preg_match('@[0-9]@', $userArr["uname"]);
						if($number)
						{
							$d=array("erN"=>"name cannot contain numbers or special characthers");
							$this->set($d);
						}else{
							$auth->update($usr,$userArr);
						}
					}
				}
				if(isset($_POST["sname"]))
				{
					$userArr = array("sname" => $_POST["sname"]);
					$userArr = $this->secure_form($userArr);
					if ($usr["sname"] != $userArr["sname"])
					{
						$number = preg_match('@[0-9]@', $userArr["sname"]);
						if($number)
						{
							$d=array("erSN"=>"Surname cannot contain numbers or special characthers");
							$this->set($d);
						}else{
							$auth->update($usr,$userArr);
						}
					}
				}
				if(isset($_POST["userN"]))
				{
					$userArr = array("userN" => $_POST["userN"]);
					$userArr = $this->secure_form($userArr);
					$res = $auth->getUserC($userArr['userN']);
					if ($usr["userN"] != $userArr["userN"]);
					{
						if (filter_var($userArr['userN'],FILTER_VALIDATE_EMAIL))
						{
							$d=array('erUN'=>"Username cannot have email format.");
							$this->set($d);
						}
						elseif ($res['nR'] != 0)
						{
							$d=array('erUN'=>"Username is already taken");
							$this->set($d);
						}else{
							$auth->update($usr,$userArr);
						}
					}

				}
				if(isset($_POST["email"]))
				{
					$userArr = array("email" => $_POST["email"]);
					$userArr = $this->secure_form($userArr);
					$res = $auth->getUserC($userArr['email']);
					if ($usr["email"] != $userArr["email"]);
					{
						if (!(filter_var($userArr['email'],FILTER_VALIDATE_EMAIL)))
						{
							$d=array('erE'=>"Email must be in email format.");
							$this->set($d);
						}
						elseif ($res['nR'] != 0)
						{
							$d=array('erE'=>"Email is already taken");
							$this->set($d);
						}else{
							$auth->update($usr,$userArr);
						}
					}
				}
				if(isset($_POST["not"]))
				{
					$userArr = array("notifications" => $_POST["not"]);
					$userArr = $this->secure_form($userArr);
					if ($usr["notifications"] === "")
					{
						$usr["notifications"] = "0";
					}
					if ($usr["notifications"] != $userArr["notifications"]);
						$auth->update($usr,$userArr);

				}
			}
			$this->set($auth->getUserI($_SESSION['userID']));
			$this->render("account");
		}		
}

?>
