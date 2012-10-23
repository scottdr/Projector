// JavaScript Document

// AUDIO SUPPORT

function pfInitAudio(audioSourceM4A, audioSourceMP3, audioSourceOGG, audioStartCF, audioProgressCF, audioEndCF) {
	
	var swfFullPath = qualifyURL( "_scripts/jQuery.jPlayer.2.2.0" );
	
	// Providing multiple sources in the parameters does not work well in jPlayer.
	// Through rigorous testing, here is the best practice:
	/*Conditions:
	- If IE, or if only capable of mp3, provide only mp3.
	- If Firefox, provide only vorbis.
	- If not IE and if capable of aac, provide only aac.
	- anything else, provide all */
	
	// Determine base audio capabilities.
	var canAudio = false;
	var canAudioAAC = false;
	var canAudioMP3 = false;
	var canAudioVorbis = false;
	try {
		canAudio = !!document.createElement('audio').canPlayType;
	} catch(err) {
		// nothing
	}
	try {
		var a = document.createElement('audio');
		canAudioMP3 = !!(a.canPlayType && a.canPlayType('audio/mpeg;').replace(/no/, ''));
	} catch(err) {
		// nothing
	}
	try {
		var a2 = document.createElement('audio');
		canAudioVorbis = !!(a2.canPlayType && a2.canPlayType('audio/ogg; codecs="vorbis"').replace(/no/, ''));
	} catch(err) {
		// nothing
	}
	try {
		var a3 = document.createElement('audio');
		canAudioAAC = !!(a3.canPlayType && a3.canPlayType('audio/mp4; codecs="mp4a.40.2"').replace(/no/, ''));
	} catch(err) {
		// nothing
	}
	
	// Determine the playback environment.
	var audioCapability = "all";
	var isIE = isInternetExplorer();
	if ( isIE ) {
		// Internet Explorer. Run away. Very fast.
		// jPlayer IE9 fails using anything other than mp3 unless compatibility mode is messed with, and we don't want to do that.
		// Best approach: Don't. Use only mp3 with all flavors of IE. Retreat.
		audioCapability = "mp3Only";
	} else {
		if ( canAudioVorbis && !canAudioAAC ) {
			// Firefox. This has all the pawprints of Firefox.
			// jPlayer Firefox works best supplied only with vorbis. Otherwise it may revert to using Flash Player.
			audioCapability = "vorbisOnly";
		} else {
			if (canAudioAAC) {
				// Non-Firefox standards-compliant browser. E.g. Safari.
				// jPlayer gets all freaky when throwing in all the formats at once. Best to use it and just it if we got it.
				audioCapability = "aacOnly";
			}
		}
	}
	
	// Initialize jPlayer in the best way possible.
	switch(audioCapability) {
	
		case "aacOnly":
			// AAC only environments should not need the Flash fallback.
			$("#challengeAudioPlayer").jPlayer({
				ready: function () {
					$("#challengeAudioPlayer").jPlayer("setMedia", { m4a: audioSourceM4A } ).jPlayer("load");
					$("#challengeAudioPlayer").on($.jPlayer.event.loadeddata, function() {
						//pfAudioLoadedData();
					});
					$("#challengeAudioPlayer").on($.jPlayer.event.playing, function() {
						if (audioStartCF) audioStartCF();
						//pfAudioStarted();
					});
					$("#challengeAudioPlayer").on($.jPlayer.event.play, function() {
						if (audioStartCF) audioStartCF();
						//pfAudioStarted();
					});
		
					$("#challengeAudioPlayer").on($.jPlayer.event.timeupdate, function() {
						if (audioProgressCF) audioProgressCF();
						// pfAudioProgress();
					});
					
					$("#challengeAudioPlayer").on($.jPlayer.event.ended, function() {
						if (audioEndCF) audioEndCF();
						// pfAudioCompleted();
					});
					
					$("#challengeAudioPlayer").on($.jPlayer.event.error, function(event) {
						//alert("Error Event: type = " + event.jPlayer.error.type); // The actual error code string. Eg., "e_url" for $.jPlayer.error.URL error.
						switch (event.jPlayer.error.type) {
							case $.jPlayer.error.URL:
								// reportBrokenMedia(event.jPlayer.error); // A function you might create to report the broken link to a server log.
								// A function you might create to move on to the next media item when an error occurs.
								break;
							case $.jPlayer.error.NO_SOLUTION:
								// Do something
								break;
						}
					});
				},
				solution: "html",
				supplied: "m4a",
				wmode: "window",
				preload: "auto"
			});
			break;
			
		case "mp3Only":
			// mp3Only environments could use a Flash fallback. This is probably not modern browser.
			$("#challengeAudioPlayer").jPlayer({
				ready: function () {
					$("#challengeAudioPlayer").jPlayer("setMedia", { mp3: audioSourceMP3 } ).jPlayer("load");
					$("#challengeAudioPlayer").on($.jPlayer.event.loadeddata, function() {
						//pfAudioLoadedData();
					});
					$("#challengeAudioPlayer").on($.jPlayer.event.playing, function() {
						if (audioStartCF) audioStartCF();
						//pfAudioStarted();
					});
					$("#challengeAudioPlayer").on($.jPlayer.event.play, function() {
						if (audioStartCF) audioStartCF();
						//pfAudioStarted();
					});
		
					$("#challengeAudioPlayer").on($.jPlayer.event.timeupdate, function() {
						if (audioProgressCF) audioProgressCF();
						// pfAudioProgress();
					});
					
					$("#challengeAudioPlayer").on($.jPlayer.event.ended, function() {
						if (audioEndCF) audioEndCF();
						// pfAudioCompleted();
					});
					
					$("#challengeAudioPlayer").on($.jPlayer.event.error, function(event) {
						//alert("Error Event: type = " + event.jPlayer.error.type); // The actual error code string. Eg., "e_url" for $.jPlayer.error.URL error.
						switch (event.jPlayer.error.type) {
							case $.jPlayer.error.URL:
								// reportBrokenMedia(event.jPlayer.error); // A function you might create to report the broken link to a server log.
								// A function you might create to move on to the next media item when an error occurs.
								break;
							case $.jPlayer.error.NO_SOLUTION:
								// Do something
								break;
						}
					});
				},
				// set the Flash fallback path
		    	swfPath: swfFullPath,
				solution: "html, flash",
				supplied: "mp3",
				wmode: "window",
				preload: "auto"
			});
			break;
			
		case "vorbisOnly":
			// Vorbis only environments do not need a Flash Player fallback since Flash Player can't handle vorbis.
			$("#challengeAudioPlayer").jPlayer({
				ready: function () {
					$("#challengeAudioPlayer").jPlayer("setMedia", { oga: audioSourceOGG } ).jPlayer("load");
					$("#challengeAudioPlayer").on($.jPlayer.event.loadeddata, function() {
						//pfAudioLoadedData();
					});
					$("#challengeAudioPlayer").on($.jPlayer.event.playing, function() {
						if (audioStartCF) audioStartCF();
						//pfAudioStarted();
					});
					$("#challengeAudioPlayer").on($.jPlayer.event.play, function() {
						if (audioStartCF) audioStartCF();
						//pfAudioStarted();
					});
		
					$("#challengeAudioPlayer").on($.jPlayer.event.timeupdate, function() {
						if (audioProgressCF) audioProgressCF();
						// pfAudioProgress();
					});
					
					$("#challengeAudioPlayer").on($.jPlayer.event.ended, function() {
						if (audioEndCF) audioEndCF();
						// pfAudioCompleted();
					});
					
					$("#challengeAudioPlayer").on($.jPlayer.event.error, function(event) {
						//alert("Error Event: type = " + event.jPlayer.error.type); // The actual error code string. Eg., "e_url" for $.jPlayer.error.URL error.
						switch (event.jPlayer.error.type) {
							case $.jPlayer.error.URL:
								// reportBrokenMedia(event.jPlayer.error); // A function you might create to report the broken link to a server log.
								// A function you might create to move on to the next media item when an error occurs.
								break;
							case $.jPlayer.error.NO_SOLUTION:
								// Do something
								break;
						}
					});
				},
				// set the Flash fallback path
		    	swfPath: swfFullPath,
				solution: "html",
				supplied: "oga",
				wmode: "window",
				preload: "auto"
			});
			break;
			
		default:
			// Environment unclear, but not favorable to aac. Pack it up with all options under the sun, the way jPlayer is supposed to work (but does not).
			$("#challengeAudioPlayer").jPlayer({
			ready: function () {
					$("#challengeAudioPlayer").jPlayer("setMedia", { mp3: audioSourceMP3, oga: audioSourceOGG, m4a: audioSourceM4A } ).jPlayer("load");
					$("#challengeAudioPlayer").on($.jPlayer.event.loadeddata, function() {
						//pfAudioLoadedData();
					});
					$("#challengeAudioPlayer").on($.jPlayer.event.playing, function() {
						if (audioStartCF) audioStartCF();
						//pfAudioStarted();
					});
					$("#challengeAudioPlayer").on($.jPlayer.event.play, function() {
						if (audioStartCF) audioStartCF();
						//pfAudioStarted();
					});
		
					$("#challengeAudioPlayer").on($.jPlayer.event.timeupdate, function() {
						if (audioProgressCF) audioProgressCF();
						// pfAudioProgress();
					});
					
					$("#challengeAudioPlayer").on($.jPlayer.event.ended, function() {
						if (audioEndCF) audioEndCF();
						// pfAudioCompleted();
					});
					
					$("#challengeAudioPlayer").on($.jPlayer.event.error, function(event) {
						//alert("Error Event: type = " + event.jPlayer.error.type); // The actual error code string. Eg., "e_url" for $.jPlayer.error.URL error.
						switch (event.jPlayer.error.type) {
							case $.jPlayer.error.URL:
								// reportBrokenMedia(event.jPlayer.error); // A function you might create to report the broken link to a server log.
								// A function you might create to move on to the next media item when an error occurs.
								break;
							case $.jPlayer.error.NO_SOLUTION:
								// Do something
								break;
						}
					});
				},
			// set the Flash fallback path
	    	swfPath: swfFullPath,
			solution: "html, flash",
			supplied: "mp3, oga, m4a",
			wmode: "window",
			preload: "auto"
		});
			
	}
}

function pfPlayAudio() {
	// alert("playing");
	//$("#challengeAudioPlayer").jPlayer("play", 0);
	$("#challengeAudioPlayer").jPlayer("play");
	return false;
}

function pfPauseAudio() {
	// alert("paused!");
	$("#challengeAudioPlayer").jPlayer("pause");
	return false;
}

// callbacks for audio events
function pfAudioLoadedData() {
}

function pfAudioStarted() {
	//alert("audio started callback");
}

function pfAudioProgress() {
	//alert("audio progress");
}

function pfAudioCompleted() {
	//alert("audio completed callback");
}

function escapeHTML(s) {
    return s.split('&').join('&amp;').split('<').join('&lt;').split('"').join('&quot;');
}

function qualifyURL(url) {
	var el= document.createElement('div');
    el.innerHTML= '<a href="'+escapeHTML(url)+'">x</a>';
    return el.firstChild.href;
}

function isInternetExplorer(){
	return getInternetExplorerVersion() > -1;
}

function getInternetExplorerVersion()
// Returns the version of Internet Explorer or a -1
// (indicating the use of another browser).
{
  var rv = -1; // Return value assumes failure.
  if (navigator.appName == 'Microsoft Internet Explorer')
  {
    var ua = navigator.userAgent;
    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  }
  return rv;
}
