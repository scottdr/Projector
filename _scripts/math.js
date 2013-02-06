// JavaScript Document

// Add MathJax scripts via CDN only on browsers that can't handle display of MathML.
if (!isMathMLCapable()) {
	if ((window.unsafeWindow == null ? window : unsafeWindow).MathJax == null) {
	  if ((document.getElementsByTagName("math").length > 0) ||
		  (document.getElementsByTagNameNS == null ? false :
		  (document.getElementsByTagNameNS("http://www.w3.org/1998/Math/MathML","math").length > 0))) {
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=MML_HTMLorMML";
		document.getElementsByTagName("head")[0].appendChild(script);
	  }
	}
}

function isMathMLCapable() {
	var e = document.createElement('div');
    e.innerHTML = '<math></math>';
    return e.firstChild && "namespaceURI" in e.firstChild && e.firstChild.namespaceURI == 'http://www.w3.org/1998/Math/MathML';
}