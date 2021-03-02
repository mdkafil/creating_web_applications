/**
* Author: MD Kafil Uddin
* Target: topic.php
* Created: 27 Sep
* Last updated: 28 Oct
*/

"use strict";

function linkQuiz() {
	window.location = "quiz.php";
}

function init() {
	var link = document.getElementById("link_quiz");
	link.onclick = linkQuiz;	
}

window.onload = init;