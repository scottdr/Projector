<?php
$PROJECTOR['editMode'] = true;
$PROJECTOR['disableSlideShow'] = true;
$PROJECTOR['cc'] = false;	// true if this is common core site otherwise Projector
if ($PROJECTOR['cc'] == true) {	// Common Core
	$PROJECTOR['name'] = "Common Core";
	$PROJECTOR['thename'] = "Common Core";
} else {	// Projector
	$PROJECTOR['name'] = "Projector";
	$PROJECTOR['thename'] = "The Projector";
	$PROJECTOR['logo'] = "_images/headerlogo.png";  // path to logo for the header
}
?>