<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<style>
		body {
	background-color: black;
	background-image: url(/Camagru/Public/imgs/bg.jpg);
	background-size: 100vw 100vh;
	background-attachment: fixed;
	margin-top: 11vh;
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
	position: fixed;
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

.viewS {
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

#video, .view {
	transform: rotateY(180deg);
    -webkit-transform:rotateY(180deg); /* Safari and Chrome */
    -moz-transform:rotateY(180deg); 
	display: block; 
}

.center {
	margin: 0 auto;
	text-align: center;
	display: block;
}

.wText {
	color: white;
}

.uBar {
	width: 10vw;
	text-align: center;
	position: fixed;
	top: 3vh;
	right: 2vw;
	background-color: grey;
	border-radius: 1.5vh;
	height: 3vh 
}

.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
	</style>
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

</footer>
</body>
</html>
