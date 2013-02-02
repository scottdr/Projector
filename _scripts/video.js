// JavaScript Document


function initVideo() {
	if (!isVideoCapable()) {
		// If the browser is not HTML 5 video element capable, then load desired Javascript video framework.
		// For now, we use the Video.js (http://videojs.com) CDN.
		var vidCSS = document.createElement("link");
		vidCSS.href = "http://vjs.zencdn.net/c/video-js.css";
		vidCSS.rel = "stylesheet";
		document.getElementsByTagName("head")[0].appendChild(vidCSS);
	  
		var vidScript = document.createElement("script");
		vidScript.type = "text/javascript";
		vidScript.src = "http://vjs.zencdn.net/c/video.js";
		document.getElementsByTagName("head")[0].appendChild(vidScript);
	}
}

function isVideoCapable() {
	return !!document.createElement('video').canPlayType;
}


function isVideoH264Capable() {
	var v = document.createElement('video');
	return !!(v.canPlayType && v.canPlayType('video/mp4; codecs="avc1.42E01E, mp4a.40.2"').replace(/no/, ''));
}


function isVideoWebMCapable() {
	var v = document.createElement('video');
	return !!(v.canPlayType && v.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/no/, ''));
}