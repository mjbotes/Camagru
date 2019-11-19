function getDocumentHeight() {
	const body = document.body;
	const html = document.documentElement;
	
	return Math.max(
		body.scrollHeight, body.offsetHeight,
		html.clientHeight, html.scrollHeight, html.offsetHeight
	);
};

function getScrollTop() {
	return (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
}

function Scroll(){
	let req = new XMLHttpRequest();
	req.open('POST', '/Camagru/Public/feed/index', true);
	req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	req.onload = function(){
		if (this.status == 200){
			document.documentElement.innerHTML = this.responseText;
		}
	};
	req.send("BOB");
}

window.addEventListener('scroll', scrolling);

function scrolling(){
	if (getScrollTop() < getDocumentHeight() - window.innerHeight) return;
	Scroll();
}
