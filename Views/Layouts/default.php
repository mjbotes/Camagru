<!doctype html>
<head>
    <meta charset="utf-8">
    <title>MVC Todo</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
	background-color: black;
	background-image: url(/Camagru/Public/imgs/bg.jpg);
	background-size: 100%;
}

.try {
	height: auto;
}

button {
	margin: 10 auto;
}

form {
	padding: 1vh;
}

legend {
	text-align: center;
}

form, .form {
	background-color: white;
}

header {
	background-color: whitesmoke;
	margin-bottom: 20px;
	display: relative;
	top: 0;
	width: 100%;
	height: 10vh;
}

.logo {
	display: block;
	margin: 0 auto;
}

.cam {
	height: 9vh;
	position: fixed;
	top: 0.2vh;
	left: 0.3vw;
}

.descp {
	width: 80%;
	margin: 0 auto;
	margin-bottom: 10px;;
}

.like {
	width: 30px;
	color: red;
	margin-left: 20px;
	margin-right: 10px;
}

.nLikes {
	font-size: 20px;
	display: inline;

}

.p_pic {
	width: 50px;
	display: inline-block;
	border-radius: 25px;
	margin: 5px 10px;
}

h3 {
	display: inline-block;
}

.post {
	background-color: whitesmoke;
	width: 75%;
	box-shadow: 5px;
	border-radius: 8%;
	padding: 10px;
	margin: 10px auto
}

.pic {
	width: 80%;
	margin: 5px auto;
	display: block;
	border-radius: 5%;
}

#recap, .dec {
	display: none;
}

.stickers {
	width: 80px;
	display: inline-block;

}

.wrapper {
	margin: 0 auto;
    position: relative;
    width: 400px;
    height: 300px;
}

.viewS {
    position: relative;
    top: 0;
	left: 0;
}

.wrapper {
	display: none;
}

#post {
	display: none;
}

.dec {
	height: 100px;
}

.view {
	position: absolute;
}

#post{
	display: block;
	margin: 1vh auto;
}

#reset {
	display: none;
}
	</style>
</head>

<body>
<header>
	
	<a href="http://localhost:8080/Camagru/Public/feed/post"><img class='cam' src='/Camagru/Public/imgs/post.png'></a>
	<img class='logo' src='/Camagru/Public/imgs/logo.png'>
</header>
<main role="main" class="container">
    <div class="starter-template">
        <?php
        echo $content_for_layout;
        ?>
    </div>
</main>
<footer>

</footer>
</body>
</html>
