<?php

class feedController extends Controller
{
	var $cIndex=0;

	function index()
	{
		$cIndex=0;
		require(ROOT . 'Models/feedModel.php');
		$feed= new feedModel();
		$i = 2;
		$posts = $feed->load($cIndex);
		if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER["REQUEST_METHOD"] === "POST")
		{
			$posts = $feed->load($i * 5);
			$i++;
		}
		$d = array('posts' => $posts);
		$this->set($d);
		$this->render('index');
	}

	function post()
	{
		session_start();
		if (!(isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true))
		{
			header("location: ".WEBROOT."Public/feed/index");
		}
		require(ROOT . 'Models/feedModel.php');
		$feed= new feedModel();
		if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER["REQUEST_METHOD"] === "POST")
		{
			$postA = ['caption' => $_POST['caption'], 'user'=>$_SESSION["userID"], 'type'=> 'png'];
			$pID = $feed->post($postA);
			$img = $_POST['imgUrl'];
			$sti = $_POST['sURL'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$sti = str_replace('data:image/png;base64,', '', $sti);
			$sti = str_replace(' ', '+', $sti);
			$imgData = base64_decode($img);
			$imgIMG = imagecreatefromstring($imgData);
			$stiData = base64_decode($sti);
			$stiIMG = imagecreatefromstring($stiData);
			$w = imagesx ($imgData);
			$h = imagesy ($imgData);;
			$file = ROOT . "Public/imgs/posts/" . $pID .'.png';
			imagealphablending($imgIMG, true);
			imagesavealpha($imgIMG, true);
			imagesavealpha($stiIMG, true);
			$w = imagesx ($imgIMG);
			$h = imagesy ($imgIMG);
			imagecopy($imgIMG, $stiIMG, 0, 0, 0, 0, $w, $h);
			imagePng($imgIMG, $file);
			if (isset($_POST["p_pic"]))
			{
				require(ROOT . 'Models/authModel.php');
				$auth= new authModel();
				$file = ROOT . "Public/imgs/users/" . $pID .'.png';
				imagePng($imgIMG, $file);
				$auth->setProfileP($pID);
			}
			header("location: /Camagru/Public/feed/index");
		}
		$this->render('post');
	}

	function postV($params)
	{
		$pID = $params;
		require(ROOT . 'Models/feedModel.php');
		$feed= new feedModel();
		if (isset($_SERVER["REQUEST_METHOD"]) && ($_SERVER["REQUEST_METHOD"] === "POST"))
		{
			$a = array("like" => $_POST['like'], 'p_id' => $_POST["p_id"], "comment" => $_POST["comment"]);
			$a = $this->secure_form($a);
			if (isset($a["like"]) && ($a["like"] === "1")){
				$feed->like($pID);
			}else{
				$feed->comment($pID, $a["comment"]);
				header ("location: ".WEBROOT."Public/feed/postV/".$pID);
			}
			require(ROOT . 'Models/emailModel.php');
			$email= new emailModel();
			require(ROOT . 'Models/authModel.php');
			$auth= new authModel();
			$email->notify($auth->getUserI($feed->getCid($a["p_id"])));
		}
		if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "GET")
		{
			if ($_SESSION["isLogin"] === TRUE)
			{
				if ($owner === TRUE)
				{
					$feed->caption($pID, $_GET["caption"]);
				}
			}
		}
		$pDet = $feed->getPost($pID);
		$pCom = $feed->getComm($pID);
		$pLik = $feed->getLikes($pID);
		$owner = FALSE;
		session_start();
		if ($_SESSION['userID'] === $pDet['user_id'])
		{
			$owner = TRUE;
		}
		$d = array('v' => $pDet, 'com' => $pCom, 'owner' => $owner, 'l' => $pLik);
		$this->set($d);
		$this->render("viewPost");
	}

	function delete($params)
	{
		session_start();
		if ($_SESSION["isLogin"] === TRUE)
		{
			$pID = $params;
			require(ROOT . 'Models/feedModel.php');
			$feed= new feedModel();
			$pDet = $feed->getPost($pID);
			$owner = FALSE;
			if ($_SESSION['userID'] === $pDet['user_id'])
			{
				$owner = TRUE;
			}
			if ($owner === TRUE)
			{
				$feed->deletePost($pID);
			}
		}
		header("location: ".WEBROOT."Public/feed/index");
	}
}

?>
