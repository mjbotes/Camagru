<?php
	require_once "config.php";
	session_start();
	$_SESSION["uid"] = 2;
	define('UPLOAD_DIR', '../imgs/posts/');
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['imgUrl'])){
				$img = $_POST['imgUrl'];
				$img = str_replace('data:image/png;base64,', '', $img);
				$img = str_replace(' ', '+', $img);
				$fileData = base64_decode($img);
				$filen = uniqid() . '.png';
				$file = UPLOAD_DIR . $filen;
				$sucess = file_put_contents($file, $fileData);
				$sql = "INSERT INTO posts (`user_id`, post, img_l) VALUES (?,?,?);";
				$stmt = mysqli_init($link);
				if (mysqli_prepare($stmt, $sql))
				{
					mysqli_stmt_bind_param($stmt, "iss", $u_id, $post, $img_l);
					$u_id = $_SESSION["uid"];
					$post = $_POST["post"];
					$img_l = $filen;
					if(mysqli_stmt_execute($stmt)){
						header ("location: ../index.php");
					} else {
						//header ("location: ../upload.php");
						echo "problem here";
					}
				} else {
					echo "or here";
					//header ("location: ../upload.php");
				}
		} else {
			header ("location: ../upload.php");
		}
	} else {
		header ("location: ../upload.php");
	}
?>
