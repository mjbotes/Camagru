
const posts = document.getElementById("posts");

window.onscroll = function() {
if (1 == 1) {
	console.log("bitch");
	request  = new Request ({
		url: '#',
		type: "POST",
	success: function (data) {
		   setTimeout(function() {
		posts.append(data);
		console.log("HERE");
	})
}
	})
}
}
