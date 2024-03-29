<?php

	class feedModel extends Model
	{
		public function loadUser($start = 0, $userID)
		{
			try
			{
				if ($start != 0)
				{
					$sql = 'SELECT `post_id`, `post`
					FROM `feed` WHERE `user_id` = :u ORDER BY `time` LIMIT 18';
					$req = Database::getBdd()->prepare($sql);
					$req->execute([
						'st' => $start,
						'u' => $userID
					 ]);
				} else {
					$sql = 'SELECT `post_id`, `post` FROM `feed`
					ORDER BY `time` DESC LIMIT 5';
					$req = Database::getBdd()->prepare($sql);
					$req->execute();
				}
				return $req->fetchAll();
			}
			catch(PDOException $e)
			{
				echo "A thing went wrong: ".$e->getMessage();
			}
		}

		public function getLikes($pid)
		{
			$sql = 'SELECT post_id, count(*) AS nL FROM likes WHERE `post_id` = :p';
			$req = Database::getBdd()->prepare($sql);
			$req->execute([
				'p' => $pid
			]);
			return $req->fetch();
		}

		public function load($start)
		{
			try
			{
				if ($start === 0)
				{
					$sql = 'SELECT u.`p_pic`, `feed`.`post_id`, u.`userN`, `feed`.`post`, `feed`.`img_t`,
					count(l.like_id) AS likes FROM `feed`
					LEFT JOIN `likes` AS l on l.`post_id` = `feed`.`post_id`
					JOIN `users` AS u on u.`user_id` = `feed`.`user_id` 
					GROUP BY `feed`.`post_id` ORDER BY `time` DESC LIMIT 5';
					$req = Database::getBdd()->prepare($sql);
					$req->execute();
				} else {
					$sql = 'SELECT u.`p_pic`, `feed`.`post_id`, u.`userN`, `feed`.`post`, `feed`.`img_t`,
					count(l.like_id) AS likes FROM `feed`
					LEFT JOIN `likes` AS l on l.`post_id` = `feed`.`post_id`
					JOIN `users` AS u on u.`user_id` = `feed`.`user_id` 
					GROUP BY `feed`.`post_id` ORDER BY `time` DESC LIMIT '.$start;
					$req = Database::getBdd()->prepare($sql);
					$req->execute();
				}

				return $req->fetchAll();
			}
			catch(PDOException $e)
			{
				echo "A thing went wrong: ".$e->getMessage();
			}
		}

		public function post($pAr)
		{
			try
			{
				$sql = "INSERT INTO `feed`(`user_id`, `post`, `img_t`) VALUES (:u,:p,:t)";
				$req = Database::getBdd()->prepare($sql);
				$req->execute([
					'u' => $pAr['user'],
					'p' => $pAr['caption'],
					't' => $pAr['type']
				]);
			}
			catch(PDOException $e)
			{
				echo "A thing went wrong: ".$e->getMessage();
			}
			try
			{
				$sql = "SELECT `post_id` FROM `feed` WHERE `user_id`=:u ORDER BY `time` DESC LIMIT 1;";
				$req = Database::getBdd()->prepare($sql);
				$req->execute([
					'u' => $pAr['user']
				]);
				$ret = $req->fetch();
				return $ret['post_id']; 
			}
			catch(PDOException $e)
			{
				echo "A thing went wrong: ".$e->getMessage();
			}
		}

		public function getCid($p_id)
		{
			$sql = "SELECT `user_id` FROM `feed` WHERE `post_id`=:p";
			$req = Database::getBdd()->prepare($sql);
			$req->execute([
				'p' => $p_id
			]);
			$ret = $req->fetch();
			return $ret["user_id"];
		}
		
		public function like($p_id)
		{
			session_start();
			if (isset($_SESSION["isLogin"]) && $_SESSION["isLogin"] === TRUE)
			{
				try {
					$sql = "SELECT count(*) AS nL FROM likes WHERE `user_id`=:u AND post_id=:p";
					$req = Database::getBdd()->prepare($sql);
					$req->execute([
						'u' => $_SESSION['userID'],
						'p' => $p_id
					]);
					$lik = $req->fetch();
				} catch(PDOException $e)
				{
					echo "A thing went wrong: ".$e->getMessage();
				}
				if ($lik['nL'] === "0")
				{
					try
					{
						$sql = "INSERT INTO `likes`(`user_id`, `post_id`) VALUES (:u, :p)";
						$req = Database::getBdd()->prepare($sql);
						$res = $req->execute([
							'u' => $_SESSION['userID'],
							'p' => $p_id
						]);
					}
					catch(PDOException $e)
					{
						echo "A thing went wrong: ".$e->getMessage();
					}
				}
				else
				{
					$sql = "DELETE FROM likes WHERE `user_id`=:u AND post_id=:p";
					$req = Database::getBdd()->prepare($sql);
					$req->execute([
						'u' => $_SESSION['userID'],
						'p' => $p_id
					]);
				}
			}
			echo "DONE";
		}

		public function comment($p_id, $comment)
		{
			session_start();
			if (isset($_SESSION["isLogin"]) && $_SESSION["isLogin"] === TRUE)
			{
				try
				{
					$sql = "INSERT INTO `comment`(`user_id`, `post_id`, `comment`) VALUES (:u, :p, :c);";
					$req = Database::getBdd()->prepare($sql);
					$res = $req->execute([
						'u' => $_SESSION['userID'],
						'p' => $p_id,
						'c' => $comment
					]);
					
					return TRUE;
				}
				catch(PDOException $e)
				{
					echo "A thing went wrong: ".$e->getMessage();
				}
			}
		}

		public function getPost($pID)
		{
			try
			{
				$sql = 'SELECT u.`p_pic`, u.`user_id`, `feed`.`post_id`, u.`userN`, `feed`.`post`, `feed`.`img_t`
					AS liky FROM `feed`
					JOIN `users` AS u on u.`user_id` = `feed`.`user_id`
					WHERE `feed`.`post_id`=:p';
				$req = Database::getBdd()->prepare($sql);
				$req->execute([
					'p' => $pID
				]);
				return $req->fetch();
			}
			catch(PDOException $e)
			{
				echo "A thing went wrong: ".$e->getMessage();
			}
		}

		public function getComm($pID)
		{
			try
			{
				$sql = 'SELECT u.`p_pic`,  u.`userN`, `comment`.`comment` FROM `comment`
					JOIN `users` AS u on u.`user_id` = `comment`.`user_id`
					WHERE `comment`.`post_id`=:p';
				$req = Database::getBdd()->prepare($sql);
				$req->execute([
					'p' => $pID
				]);
				return $req->fetchAll();
			}
			catch(PDOException $e)
			{
				echo "A thing went wrong: ".$e->getMessage();
			}
		}

		private function deleteComments($pID)
		{
			try
			{
				$sql = 'DELETE FROM `comment` WHERE `post_id`=:p';
				$req = Database::getBdd()->prepare($sql);
				$req->execute([
					'p' => $pID
				]);
			}
			catch(PDOException $e)
			{
				echo "A thing went wrong: ".$e->getMessage();
			}
		}

		public function deletePost($pID)
		{
			try
			{
				$this->deleteComments($pID);
				$sql = 'DELETE FROM feed WHERE `post_id`=:p';
				$req = Database::getBdd()->prepare($sql);
				$req->execute([
					'p' => $pID
				]);
				unlink(ROOT."Public/imgs/posts/".$pID.".png");
			}
			catch(PDOException $e)
			{
				echo "A thing went wrong: ".$e->getMessage();
			}
		}

		public function caption($pID, $caption)
		{
			try
			{
				$sql = 'UPDATE `feed` SET `post`=:c WHERE `post_id`=:p';
				$req = Database::getBdd()->prepare($sql);
				$req->execute([
					'p' => $pID,
					'c' => $caption
				]);
			}
			catch(PDOException $e)
			{
				echo "A thing went wrong: ".$e->getMessage();
			}
		}
	}

?>
