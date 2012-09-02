// JavaScript Document

function goToURL(url) {
	window.location = url;
}

function getQueryVariable(variable,defaultValue)
{
		 var query = window.location.search.substring(1);
		 var vars = query.split("&");
		 for (var i=0;i<vars.length;i++) {
				 var pair = vars[i].split("=");
				 if(pair[0] == variable){return pair[1];}
		 }
		 if (defaultValue)
		 	return defaultValue;
		 else
		 	return(false);
}