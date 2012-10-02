// JavaScript Document

// TRS 0.9.2

// AUDIO SUPPORT

function pfInitAudio(audioSourceM4A, audioSourceOGG, audioStartCF, audioProgressCF, audioEndCF) {
	
	// alert("pfInitAudio"); // debug
	
	// no auto-repeat
	// $("#challengeAudioPlayer").unbind($.jPlayer.event.repeat + ".jPlayer");
		
	$("#challengeAudioPlayer").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", { m4a: audioSourceM4A, oga: audioSourceOGG } ).jPlayer("load"); // auto-load the media
			//$("#challengeAudioPlayer").bind($.jPlayer.event.loadeddata + ".challengeAudioPlayer",
			$(this).bind($.jPlayer.event.playing + ".challengeAudioPlayer",
				function() { // Using ".challengeAudioPlayer" namespace so we can easily remove this event
				if (audioStartCF) audioStartCF();
				// pfAudioStarted(); // Execute the desired callback
			});
			
			//$("#challengeAudioPlayer").bind($.jPlayer.event.timeupdate + ".challengeAudioPlayer",
			$(this).bind($.jPlayer.event.timeupdate + ".challengeAudioPlayer",
				function() { // Using ".challengeAudioPlayer" namespace so we can easily remove this event
				if (audioProgressCF) audioProgressCF();
				// pfAudioProgress(); // Execute the desired callback
			});
			
			//$("#challengeAudioPlayer").bind($.jPlayer.event.ended + ".challengeAudioPlayer",
			$(this).bind($.jPlayer.event.ended + ".challengeAudioPlayer",
				function() { // Using ".challengeAudioPlayer" namespace so we can easily remove this event
				if (audioEndCF) audioEndCF();
				// pfAudioCompleted(); // Execute the desired callback
			});
			
			//$("#challengeAudioPlayer").bind($.jPlayer.event.error + ".challengeAudioPlayer", function(event) { // Using ".challengeAudioPlayer" namespace
			$(this).bind($.jPlayer.event.error + ".challengeAudioPlayer", function(event) { // Using ".challengeAudioPlayer" namespace
				alert("Error Event: type = " + event.jPlayer.error.type); // The actual error code string. Eg., "e_url" for $.jPlayer.error.URL error.
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
    	swfPath: "./jQuery.jPlayer.2.2.0",
		supplied: "m4a, oga",
		wmode: "window",
		preload: "auto"
	});
}

function pfPlayAudio() {
	// alert("playing");
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
	alert("audio started callback");
}

function pfAudioProgress() {
	alert("audio progress");
}

function pfAudioCompleted() {
	alert("audio completed callback");
}

