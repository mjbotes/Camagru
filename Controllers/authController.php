<?php

class authController extends Controller
{
	function login()
	{
		session_start();
		if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true)
		{
			header("Location: home");
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
				if ($auth->login($userArr))
				{
					header("loaction: ".WEBROOT."Public/feed/index");
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
			header("Location :home");
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
				//header("Location: ".WEBROOT."Public/auth/login");
				} catch(PDOException $e) {
					echo $e->getMessage();
				}
			}
		}
		$this->render('register');
	}
}

?>
