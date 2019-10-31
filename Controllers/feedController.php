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
			$stiData = base64_decode($sti);
			$w = imagesx ($imgData);
			$h = imagesy ($imgData);
			imagecopymerge($imgData, $stiData, 0, 0, 0, 0, $x, $h, 100);
			$file = ROOT . "Public/imgs/posts/" . $pID .'.png';
			$sucess = file_put_contents($file, $stiData);
			if (!$sucess)
			{
				echo "ohh FUCK";
				$feed->delete($pID);				
			} else
			{
				echo "upload Sucess";
			}
		}
	}

	function postV($params)
	{
		$pID = $params;
		require(ROOT . 'Models/feedModel.php');
		$feed= new feedModel();
		$pDet = $feed->getPost($pID);
		$pCom = $feed->getComm($pID);
		$d = array('v' => $pDet, 'com' => $pCom);
		$this->set($d);
		$this->render("viewPost");
		if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST")
		{
			$feed->comment($pID, $_POST["comment"]);
			header ("location: ".WEBROOT."Public/feed/postV/".$pID);
		}
	}
}

?>
