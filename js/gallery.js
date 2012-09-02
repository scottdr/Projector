// JavaScript Document

function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name)
{
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++)
	{
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name)
		{
			return unescape(y);
		}
	}
}

if (document.addEventListener) {
  document.addEventListener("DOMContentLoaded", domContentLoaded, false);
}

function domContentLoaded() 
{
	console.log("domContentLoaded");
	var element = document.getElementById("recordsPerPage");
	var recordCount = "3";
	var cookieCount = getCookie("recordsPerPage");
	console.log('cookie record count: ' + cookieCount);
	if (cookieCount != '' && cookieCount != undefined)
		recordCount = cookieCount;
	if (element) {
		console.log('selectValue: ' + element.value);
		element.value = recordCount;
	}
	element = document.getElementById("recordsPerPage2");
	if (element)
		element.value = recordCount;
}

/* Update the cookie containing the num of records to be displayed per page, then reload the page */
function updateRecordCount(newValue) {
	console.log('newCount: ' + newValue);
	setCookie("recordsPerPage",newValue,7);
	cookieCount = getCookie("recordsPerPage");
	console.log('cookie record count: ' + cookieCount);
	window.location.reload(true); 
}

function goToDetails(url) {
	window.location = url;
}
