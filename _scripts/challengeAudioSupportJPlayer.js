// JavaScript Document

// AUDIO SUPPORT

function pfInitAudio(audioSourceM4A, audioSourceMP3, audioSourceOGG, audioStartCF, audioProgressCF, audioEndCF) {
	
	// alert("pfInitAudio"); // debug
	
	// no auto-repeat
	// $("#challengeAudioPlayer").unbind($.jPlayer.event.repeat + ".jPlayer");
	
	var swfFullPath = qualifyURL( "_scripts/jQuery.jPlayer.2.2.0/" );
		
	$("#challengeAudioPlayer").jPlayer({
		ready: function () {
			// fire it up!
			$("#challengeAudioPlayer").jPlayer("setMedia", { m4a: audioSourceM4A, mp3: audioSourceMP3, oga: audioSourceOGG } ).jPlayer("load"); // auto-load the media
			//$("#challengeAudioPlayer").bind($.jPlayer.event.loadeddata + ".challengeAudioPlayer",
			$("#challengeAudioPlayer").on($.jPlayer.event.playing,
					function() { // Using ".challengeAudioPlayer" namespace so we can easily remove this event
					if (audioStartCF) audioStartCF();
					pfAudioStarted(); // Execute the desired callback
			});
			$("#challengeAudioPlayer").on($.jPlayer.event.play,
				function() { // Using ".challengeAudioPlayer" namespace so we can easily remove this event
				if (audioStartCF) audioStartCF();
				pfAudioStarted(); // Execute the desired callback
			});

			$("#challengeAudioPlayer").on($.jPlayer.event.timeupdate,
				function() { // Using ".challengeAudioPlayer" namespace so we can easily remove this event
				if (audioProgressCF) audioProgressCF();
				// pfAudioProgress(); // Execute the desired callback
			});
			
			$("#challengeAudioPlayer").on($.jPlayer.event.ended,
				function() { // Using ".challengeAudioPlayer" namespace so we can easily remove this event
				if (audioEndCF) audioEndCF();
				// pfAudioCompleted(); // Execute the desired callback
			});
			
			$("#challengeAudioPlayer").on($.jPlayer.event.error,
				function(event) { // Using ".challengeAudioPlayer" namespace
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
		supplied: "m4a, mp3, oga",
		wmode: "window",
		preload: "auto"
	});
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
function pfAudioStarted() {
	//alert("audio started callback");
}

function pfAudioProgress() {
	//alert("audio progress");
}

function pfAudioCompleted() {
	//alert("audio completed callback");
}

function qualifyURL(url) {
	var a = document.createElement('a');
	a.href = url;
	return a.href;
}

