/**
* Author: MD Kafil Uddin
* Target: quiz.html
* Created: 27 Sep
* Last updated: 29 Sep
*/

"use strict";

function getServerName() {
	var serverName = "Unknown";
	var serverArray = document.getElementById("serverName").getElementsByTagName("input");
	for (var i = 0; i < serverArray.length; i++) {
		if (serverArray[i].checked) {
			serverName = serverArray[i].value;
		}
	}
	return serverName;
}

function getScore() {
	var score = 0;
	var serverName = getServerName();
	var recursive = document.getElementById("recursive").checked;
	var sequence = document.getElementById("sequence").checked;
	var nonrecursive = document.getElementById("nonrecursive").checked;
	var iterative = document.getElementById("iterative").checked;
	var selection = document.getElementById("selection").checked;
	var born_time = document.getElementById("born_time").value;
	var lookup = document.getElementById("lookup").value;

	if (serverName == "BLDS") {
		score += 20;
	}

	if (recursive) {
		score += 20;
	}

	if (nonrecursive) {
		score += 20;
	}

	if (iterative) {
		score += 20;
	}

	if (born_time == "early1980s") {
		score += 20;
	}

	if (lookup.match("1. The user type the URL, such as www.google.com in the web browser. 2. It will translate into the query,which is received by a DNS recursive resolver. 3. The resolver takes the query to the root nameserver. 4. The root nameserver receives the query and responds to the resolver with the address of a TLD nameserver. 5. The resolver then makes a request to the .com TLD. 6. The TLD server takes the query to the authoritative namesever. 7. The authoritative nameserver translates the query into the IP address. 8. Lastly, the resovler will respond  to the web browser with the IP address for www.google.com.")) {
		score += 50;
	}

	return score;
}

function validate() {
	var score = getScore();
	var errMsg = "";
	var result = true;
	var recursive = document.getElementById("recursive").checked;
	var sequence = document.getElementById("sequence").checked;
	var nonrecursive = document.getElementById("nonrecursive").checked;
	var iterative = document.getElementById("iterative").checked;
	var selection = document.getElementById("selection").checked;
	var born_time = document.getElementById("born_time").value;
	var dnslookup = document.getElementById("lookup").value;

	if (!(recursive || sequence || nonrecursive || iterative || selection)) {
		errMsg += "Please select at least one answer for question 2.\n";
		result = false;
	}

	if (born_time == "none") {
		errMsg += "Please select an answer for question 3.\n";
		result = false;
	}

	if (!dnslookup) {
		errMsg += "Please write down your answer for question 4.\n"
		result =false;
	}

	if (score == 0) {
		errMsg += "Please make at leas one right answer.";
		result = false;
	}

	if (errMsg != "") {
		alert(errMsg);
	}

	if (result) {
		var firstname = document.getElementById("fname").value;
		var middlename = document.getElementById("mname").value;
		var lastname = document.getElementById("lname").value;
		var id = document.getElementById("studentid").value;
		storeResult(firstname, middlename, lastname, id, score);
		getAttempts();
	}

	return result;
}

function init() {
	timer();
	var quiz = document.getElementById("quiz");
	quiz.onsubmit = validate;
}

function storeResult(firstname, middlename, lastname, id, score) {
	sessionStorage.firstname = firstname;
	sessionStorage.middlename = middlename;
	sessionStorage.lastname = lastname;
	sessionStorage.id = id;
	sessionStorage.score = score;
}

function getAttempts() {
	if (sessionStorage.attempts) {
		sessionStorage.attempts = Number(sessionStorage.attempts) + 1;
	}
	else {
		sessionStorage.attempts = 1;
	}
}

window.onload = init;