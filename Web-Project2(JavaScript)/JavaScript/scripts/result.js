/** filename: result.js
author: MD Kafil Uddin
Target: What html file are ther reference by the JS file
created: 1/10/2019
Purpose:This file is for..
last modified: 1/10/2019 
description: [html files it refers to (if known)] 
Credits:
*/

"use strict";









// To display the contents in result page which is stored in local storage. 


function display(){

    var stdnt_ID = localStorage.getItem("stdnt_ID");
    document.getElementById("result_name").textContent = localStorage.getItem("first_name") + " " + localStorage.getItem("last_name");
    document.getElementById("result_id").textContent = localStorage.getItem("stdnt_ID");
    document.getElementById("result_score").textContent = localStorage.getItem("marks");

    var link = localStorage.getItem(stdnt_ID);    
    document.getElementById("result_attempts").textContent = (2 - link);
    document.getElementById("first_name").value = localStorage.getItem("first_name");
    document.getElementById("last_name").value = localStorage.getItem("last_name");
    document.getElementById("stdnt_ID").value = localStorage.getItem("stdnt_ID");
    document.getElementById("marks").value = localStorage.getItem("marks");
    document.getElementById("pass").value = localStorage.getItem("result");

}

//To hide the link of re-attempt when the user gives the quiz two times.

function HiddenLink() {
    var stdnt_ID = localStorage.getItem("stdnt_ID");
    var link = localStorage.getItem(stdnt_ID);
    
    //alert(link);
    if (link < 1){
        document.getElementById("reattempt").style.visibility = "hidden";
    }
}






function init () {
	          
    HiddenLink();
    display();
    
	//window.localStorage.clear();
}

window.onload = init;
