/** filename: enhancements.js
author: MD Kafil Uddin
Target: What html file are ther reference by the JS file
created: 1/10/2019
Purpose:This file is for validation
last modified: 1/10/2019 
description: [html files it refers to (if known)] 
Credits: Priyadhaduk
*/

"use strict";

// Enhancement 2 (Query Selector)
    var second = 45;

function ClockTime(){
   
    second -= 1;
    if(second >= 0){
        document.querySelector("#clock").innerHTML = "Time Left:" + second.toString();
        setTimeout(ClockTime,1000);
        
    }
    else{
        document.querySelector("#clock").innerHTML = "Time's up!";
    }
    
   
}

//Enhancements 1 (Timer for the quiz.After 45 seconds the alert box will pop-up and submit button will disappear.)
function Timer(){
    alert("Time is up.");
    document.querySelector("#submit").style.visibility = "hidden";
    var stdnt_ID = localStorage.getItem("stdnt_ID");
    pass = localStorage.getItem(stdnt_ID);
    
    
}


function DisplayQuiz(){
   // alert("hiddenquiz");
    document.querySelector("#quizform").style.visibility ="visible";
    document.querySelector("#details").style.visibility = "visible";
    setTimeout(Timer,45000);
    ClockTime();
}



function init2(){

    document.querySelector("#quizform").style.visibility = "hidden";
    var button = document.querySelector("#button");   
    button.onclick = DisplayQuiz; 
    //HideDetail();


    
}



window.addEventListener("load",init2);