<?php

if (!function_exists("getLanguageString")) {
function getLanguageString($languageCode) 
{
	$theValue = $languageCode = strtolower($languageCode);
	switch ($languageCode) {
		case "en":
	      $theValue = "English";
	      break;
		case "en-US":
	      $theValue = "American English";
	      break;
	    case "es":
	      $theValue = "Spanish";
	      break;
	}
	return $theValue;
}
}

?>