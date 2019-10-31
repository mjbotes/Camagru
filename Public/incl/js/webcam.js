const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const snap = document.getElementById("cap");
const recap = document.getElementById("recap");
const errorMsgElement = document.querySelector('span#errorMsg');
var cur = document.getElementById("view");
var	prevI = 0;
var s = [];


const constraints = {
	audio: false,
	video: {
		width: video.width, height: video.height
	}
};

async function init() {
	try {
		const stream = await navigator.mediaDevices.getUserMedia(constraints);
		handleSuccess(stream);
	} catch (e) {
		console.log(`navigator.getUserMedia error:${e.toString()}`);
	}
}

function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
}

init();

snap.addEventListener("click", function() {
	video.pause();
	var prev = document.querySelector(".wrapper");
	prev.style.display="contents";
	var prev = document.querySelector("#post");
	prev.style.display="block";
	var prev = document.querySelector("#viewS");
	prev.style.display="block";
	prev.width=video.offsetWidth;
	prev.height=video.offsetHeight;
	var prev = document.querySelector("#view");
	prev.style.display="block";
	prev.width=video.offsetWidth;
	prev.height=video.offsetHeight;
	var context = cur.getContext('2d');
	context.drawImage(video, 0, 0, 640, 480);
	var prev = document.querySelector("#video");
	prev.style.display = "none";
	var prev = document.querySelector("#recap");
	prev.style.display="inline-block";
	var prev = document.querySelector("#reset");
	prev.style.display="inline-block";
	var prev = document.querySelector("#cap");
	prev.style.display="none";
	var prev = document.querySelector(".dec");
	prev.style.display="block";
});

recap.addEventListener("click", function() {
	video.play();
	var prev = document.querySelector("#video");
	prev.style.display="block";
	prev.width=video.offsetWidth;
	prev.height=video.offsetHeight;
	var prev = document.querySelector(".wrapper");
	prev.style.display="none";
	var prev = document.querySelector(".view");
	prev.style.display="none";
	var prev = document.querySelector(".viewS");
	prev.style.display="none";
	var prev = document.querySelector(".wrapper");
	prev.style.display="none";
	var prev = document.querySelector("#post");
	prev.style.display="none";
	var prev = document.querySelector("#cap");
	prev.style.display="block";
	var prev = document.querySelector("#recap");
	prev.style.display="none";
	var prev = document.querySelector("#reset");
	prev.style.display="none";
	var prev = document.querySelector(".dec");
	prev.style.display="none";
});

function addImg(img) {
	cur = document.getElementById("viewS");
	var context = cur.getContext('2d');
	base_image = new Image();
	var str = '../imgs/stickers/'
	  base_image.src = str.concat(img);
	  s.push(img);
  	context.drawImage(base_image, 60, 60);
}

function reset(){
	const canvas = document.getElementById('viewS');
	const context = canvas.getContext('2d');
	context.clearRect(0, 0, canvas.width, canvas.height);
	s=[];
}

function saveImg() {
	cur = document.getElementById("view");
	var imgUrl = cur.toDataURL('image/png');
	imgL = document.getElementById("imgUrl");
	imgL.value=imgUrl;
	cur = document.getElementById("viewS");
	var imgUrl = cur.toDataURL('image/png');
	imgL = document.getElementById("sURL");
	console.log(imgL);
	imgL.value=imgUrl;
}
