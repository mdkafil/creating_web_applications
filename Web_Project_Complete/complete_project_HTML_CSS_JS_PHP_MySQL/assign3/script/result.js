/**
* Author: MD Kafil Uddin
* Target: result.html
* Created: 28 Sep
* Last updated: 28 Sep
*/

"use strict";

function getResult() {
	document.getElementById("result_name").textContent = sessionStorage.firstname + " " + sessionStorage.middlename + " " + sessionStorage.lastname;
	document.getElementById("result_id").textContent = sessionStorage.id;
	document.getElementById("result_score").textContent = sessionStorage.score;
	document.getElementById("result_attempts").textContent = sessionStorage.attempts;

	document.getElementById("firstname").value = sessionStorage.firstname;
	document.getElementById("middlename").value = sessionStorage.middlename;
	document.getElementById("lastname").value = sessionStorage.lastname;
	document.getElementById("id").value = sessionStorage.id;
	document.getElementById("score").value = sessionStorage.score;
}

function getIdArray() {
	var idArray = [];
	var attempts = sessionStorage.attempts;
	if (attempts == 1) {
		idArray[0] = sessionStorage.id;
		sessionStorage.setItem("idarray", JSON.stringify(idArray));
	}
	else {
		idArray = JSON.parse(sessionStorage.getItem("idarray")); 
		idArray[attempts - 1] = sessionStorage.id;
		sessionStorage.setItem("idarray", JSON.stringify(idArray)); 
	}
}

function redoQuiz() {
	var errMsg = "";
	var idArray = JSON.parse(sessionStorage.getItem("idarray")); 
	for (var i = 0; i < idArray.length - 1; i++) {
		if (sessionStorage.id == idArray[i]) {
			errMsg = "A user (identified by ID) only make two attempts.";
			alert(errMsg);
			document.getElementById("redoButton").style.visibility = "hidden";
			return false;
		}
	}
	window.location = "quiz.html"
}

function init() {
	getResult();
	getIdArray();
	var redo = document.getElementById("redoButton");
	redo.onclick = redoQuiz;
}

window.onload = init;