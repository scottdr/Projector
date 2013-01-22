<?php
$PROJECTOR['editMode'] = true;
$PROJECTOR['disableSlideShow'] = true;
$PROJECTOR['cc'] = true;	// true if this is common core site otherwise Projector
$GLOBALS['instance'] = "ccsoc"; // This is for the Common Core System of Courses - Pearson Content
$GLOBALS['s3Bucket'] = "CCSoC_Assets";
if ($GLOBALS['instance'] == "ccsoc") {
	$PROJECTOR['name'] = "CCSoC";
	$PROJECTOR['thename'] = "CCSoC";
} elseif ($PROJECTOR['cc'] == true) {	// Common Core
	$PROJECTOR['name'] = "Common Core";
	$PROJECTOR['thename'] = "Common Core";
} else {	// Projector
	$PROJECTOR['name'] = "Projector";
	$PROJECTOR['thename'] = "The Projector";
	$PROJECTOR['logo'] = "_images/headerlogo.png";  // path to logo for the header
}
?>