/** filename: quiz.js
author: MD Kafil Uddin
Target: What html file are ther reference by the JS file
created: 1/10/2019
Purpose:This file is for validation
last modified: 1/10/2019 
description: [html files it refers to (if known)] 
Credits: Priyadhaduk
*/

"use strict";



//To store marks in local storage.
//This is to calculate the no of attempts made by the user in the quiz. 
 
function storeMarks(first_name,last_name,stdnt_ID,marks, result){

    if (localStorage.getItem(stdnt_ID) == undefined){
        localStorage.setItem(stdnt_ID , pass = 1);
        
        localStorage.setItem("first_name",first_name = first_name);
        localStorage.setItem("last_name",last_name = last_name);
        localStorage.setItem("stdnt_ID",stdnt_ID = stdnt_ID);
        localStorage.setItem("marks",marks = marks);
        localStorage.setItem("result",result = result);
        localStorage.setItem("pass",pass = pass);
    }
    else{
        if (localStorage.getItem(stdnt_ID) < 1){
            alert("You have exceeded the limit of attempts.Better luck next time. ");
            result = false;
        } else  {
            var pass = localStorage.getItem(stdnt_ID);
            
            pass -= 1;
            localStorage.setItem(stdnt_ID, pass);
        
        }
    }

     
    

    //alert(" first name is " +  localStorage.getItem("first_name") + " last name is" +  localStorage.getItem("last_name") + " Student id is " + localStorage.getItem("stdnt_ID") + " marks scored is " + localStorage.getItem("marks")+ " pass is " +localStorage.getItem("pass"));    

    return result;
}

function calculateMarks(ans12,ans21,ans22,ans23,ans24,ans31,ans41,ans51){
    var marks = 0;
    //assigning correct answers to variables

    var ans3 = ("Registration");
    var ans4 = ("Analog voice calls are converted into packets of data.");
    var ans5 = ("When error is small");

    //Assigning marks to each question

    if(ans12){
        marks += 2;
    }

    if(ans21){
        marks += 1;
    }

    if(ans22){
        marks -= 1;
    }
    
    if(ans23){
        marks += 1;
    }

    if(ans24){
        marks -= 1;
    }

    if(ans31 == ans3){
        marks += 2;
    }

    if(ans41 == ans4){
        marks += 2;
    }

    if(ans51 == ans5){
        marks += 2;
    }

    return marks;


}

//To validate the questions so that it shows dialog box if it is not as per requirement. 

function validate(){
    
    var errMsg = "";
    var result = true;
    
    var ans12 = document.getElementById("two").checked;
    var ans21 = document.getElementById("Skype").checked;
    var ans22 = document.getElementById("Google").checked;
    var ans23 = document.getElementById("Teamspeak").checked;
    var ans24 = document.getElementById("Vibes").checked;
    var ans31 = document.getElementById("droplist").value;
    var ans41 = document.getElementById("description").value;
    var ans51 = document.getElementById("answer").value;

    var first_name = document.getElementById("first_name").value;
    var last_name = document.getElementById("last_name").value;
    var stdnt_ID = document.getElementById("stdnt_ID").value;

    
    var Skype = document.getElementById("Skype").checked;
    var Google = document.getElementById("Google").checked;
    var Teamspeak = document.getElementById("Teamspeak").checked;
    var Vibes = document.getElementById("Vibes").checked;

    if (!Skype && !Google && !Teamspeak && !Vibes){
        errMsg += "Please select atleast one option.\n";
        result = false;
    }

    if (document.getElementById("droplist").value == "none"){
        errMsg = errMsg + "You must select one option.\n";
        result = false;
    }

    var description = document.getElementById("description").value;
    if (description == ""){
        errMsg += "Please fill out the textarea.\n";
        result = false;
    }

    //To calculate marks for the given quiz.

    var marks = calculateMarks(ans12,ans21,ans22,ans23,ans24,ans31,ans41,ans51);
        if (marks < 1){
        result = false;
        alert("Your marks are less than 0 (" + marks + "). Please check your answers.");
     }


    
    if ( errMsg != ""){
        alert(errMsg);
    }

    
    if(result){

        result = storeMarks(first_name, last_name, stdnt_ID, marks, result);
    }
    return result;

}  
   
function DisplayQuiz(){

    document.getElementById("quizform").style.visibility ="visible";
}

function init(){

    document.getElementById("quizform").style.visibility = "hidden";
    var quizForm = document.getElementById("quizform");   
    quizForm.onsubmit = validate;
    //window.localStorage.clear(); 

    
}



window.addEventListener("load",init);