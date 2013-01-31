// JavaScript Document


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