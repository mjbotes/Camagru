<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=WEBROOT?>Public/incl/style.css" rel="stylesheet" id="bootstrap-css">

</head>

<body>
<header>
	
	<a href="<?=WEBROOT?>Public/feed/post"><img class='cam' src='/Camagru/Public/imgs/post.png'></a>
	<a href="<?=WEBROOT?>Public/feed/index"><img class='logo' src='/Camagru/Public/imgs/logo.png'></a>
	<div class="wText uBar">
		<?php require_once ROOT."Views/Auth/userB.php";?>
	</div>
</header>
<main role="main" class="container">
    <div class="starter-template">
        <?php
        echo $content_for_layout;
        ?>
    </div>
</main>
<footer>
<img class='fimg center' src='/Camagru/Public/imgs/footer.png'>
</footer>
</body>
</html>
