/**
* Author: MD Kafil Uddin
* Target: quiz.html
* Created: 29 Sep
* Last updated: 29 Sep
*/

"use strict";

var deadline = 3 * 60;
var minutes = Math.floor(deadline/60);
var seconds = Math.floor(deadline%60);
function timer() {
	document.getElementById("timer").innerHTML = minutes + " " + "minutes" + " " + seconds + " " + "seconds";
	if (deadline <= 0) {
		setTimeout("autoSubmit()", 1);
	}
	else {
		deadline -= 1;
		minutes = Math.floor(deadline/60);
		seconds = Math.floor(deadline%60);
		setTimeout("timer()", 1000);
	}
}

function autoSubmit() {
	alert("Times out!");
	window.location = "enhancements2.html";
}
