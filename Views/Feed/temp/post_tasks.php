<?php
class UserPost extends model
{
	public function create($uid, $post, $img_l)
	{
		$sql = "INSERT INTO posts (`user_id`, post, img_l) VALUES (:u_id,:post,:imgl);";
		$req = Database::getBdd()->prepare($sql);
		return $req->execute([
			'u_id' => $uid,
			'post' => $post,
			'imgl' => $img_l
		]);
	}
	public function showUserPost($u_id)
	{
		$sql = "SELECT * FROM posts WHERE `user_id` =" . $u_id;
		$req = Database::getBdd()->prepare($sql);
		$req->execute();
		return $req->fetch();
	}
	public function showAllPosts()
	{
		$sql = "SELECT * FROM posts";
		$req = Database::getBdd()->prepare($sql);
		$req->execute();
		return $req->fetchAll();
	}
	public function edit($p_id, $post)
	{
		$sql = "UPDATE posts SET post = :post WHERE post_id = :p_id";
		$req = Database::getBdd()->prepare($sql);
		return $req->execute([
			'p_id' => $p_id,
			'post' => $post
		]);
	}
	public function delete($p_id)
	{
		$sql = 'DELETE FROM posts WHERE post_id = ?';
		$req = Database::getBdd()->prepare($sql);
		return $req->execute([$p_id]);
	}
}
?>
