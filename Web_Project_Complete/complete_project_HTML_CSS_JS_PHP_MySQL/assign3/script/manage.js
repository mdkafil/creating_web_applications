/**
* Author: MD Kafil Uddin
* Target: manage,php
* Created: 28 Oct
* Last updated: 28 Oct
*/

"use strict";

function toLogout() {
	window.location = "logout.php"; //location to logout page.
}

function init() {
	var logout = document.getElementById("logout");
	logout.onclick = toLogout;	//create an onclick event.
}

window.onload = init;