<?php

class feedController extends Controller
{
	var $cIndex=0;

	function index()
	{
		$cIndex=0;
		require(ROOT . 'Models/feedModel.php');
		$feed= new feedModel();
		$d = array('posts' => $feed->load($cIndex));
		$this->set($d);
		$this->render('index');
		$i = 1;
		if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_MEHOD'] === "POST")
		{
			$feed->loadP($i * 5);
			$i++;
		}
	}

	function post()
	{
		session_start();
		require(ROOT . 'Models/feedModel.php');
		$feed= new feedModel();
		$this->render('post');
		if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER["REQUEST_METHOD"] === "POST")
		{
			session_start();
			$_SESSION["u_id"] = 28;
			$postA = ['caption' => $_POST['caption'], 'user'=>$_SESSION["u_id"], 'type'=> 'png'];
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
			echo "upload Sucess";
		}
	}

	function loadP($i)
	{
		require(ROOT . 'Models/feedModel.php');
		$feed= new feedModel();
		$feed->loadP($i * 5);
	}

	function postV($params)
	{
		$pID = $params;
		require(ROOT . 'Models/feedModel.php');
		$feed= new feedModel();
		$pDet = $feed->getPost($pID);
		$pCom = $feed->getComm($pID);
		$owner = FALSE;
		session_start();
		if ($_SESSION['userID'] === $pDet['user_id'])
		{
			$owner = TRUE;
		}
		$d = array('v' => $pDet, 'com' => $pCom, 'owner' => $owner);
		$this->set($d);
		$this->render("viewPost");
		if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST")
		{
			$feed->comment($pID, $_POST["comment"]);
			header ("location: ".WEBROOT."Public/feed/postV/".$pID);
		}
		// if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "GET")
		// {
		// 	if ($_SESSION["isLogin"] === TRUE)
		// 	{
		// 		$owner = FALSE;
		// 		if ($_SESSION['userID'] === $pDet['user_id'])
		// 		{
		// 			$owner = TRUE;
		// 			echo "here";
		// 		}
		// 		if ($owner === TRUE)
		// 		{
		// 			$feed->caption($pID, $_GET["caption"]);
		// 			header("location: ".WEBROOT."Public/feed/index");
		// 		}
		// 	}
		// 	header ("location: ".WEBROOT."Public/feed/postV/".$pID);
		// }
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
				echo "here";
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
