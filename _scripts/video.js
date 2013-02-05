// JavaScript Document

// Attach any needed video-handling JavaScript for browsers incapable of handling video.
function initVideo() {
	var videoCSSUrl = "http://vjs.zencdn.net/c/video-js.css";
	var videoScriptUrl = "http://vjs.zencdn.net/c/video.js";
	
	var videoScriptIsAttached = 0;
	
	if (!isVideoCapable()) {
		// If the browser is not HTML 5 video element capable, then load desired Javascript video framework.
		// For now, we use the Video.js (http://videojs.com) CDN.
		
		// Test if video script has already been added.
		// Do this by checking for the existence of the unique url of the auxiliary video.js css file.
		var linkElements = Array.prototype.slice.call(document.getElementsByTagName("link"), 0);
		for (var i = 0; i < linkElements.length; i++) {
			if (linkElements[i].href == videoCSSUrl) {
				videoScriptIsAttached = 1;
			}
		 }
		
		if (!videoScriptIsAttached) {
		  var vidCSS = document.createElement("link");
		  vidCSS.href = videoCSSUrl;
		  vidCSS.rel = "stylesheet";
		  document.getElementsByTagName("head")[0].appendChild(vidCSS);
		
		  var vidScript = document.createElement("script");
		  vidScript.type = "text/javascript";
		  vidScript.src = videoScriptUrl;
		  document.getElementsByTagName("head")[0].appendChild(vidScript);
		  _videoScriptAdded = 1;
		}
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