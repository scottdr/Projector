// JavaScript Document

function isMathMLCapable() {
	var e = document.createElement('div');
    e.innerHTML = '<math></math>';
    return e.firstChild && "namespaceURI" in e.firstChild && e.firstChild.namespaceURI == 'http://www.w3.org/1998/Math/MathML';
}