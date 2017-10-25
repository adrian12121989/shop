/**
* File: js/showhide.js
* Author: design1online.com, LLC
* Purpose: toggle the visibility of fields depending on the value of another field
**/

$(document).ready(function() {
    toggleFields(); //call this first so we start out with the correct visibility depending on the selected form values
   //this will call our toggleFields function every time the selection value of our underAge field changes
    $("#pcountry").change(function() { toggleFields(); });
    
    // $("#level_edu").change(function() { toggleFieldsLevel(); });

});

$(document).ready(function() {
    toggleFieldsLevel(); //call this first so we start out with the correct visibility depending on the selected form values
   //this will call our toggleFields function every time the selection value of our underAge field changes
    
     $("#level_edu").change(function() { toggleFieldsLevel(); });

});

$(document).ready(function() {
    toggleFieldsCourse(); //call this first so we start out with the correct visibility depending on the selected form values
   //this will call our toggleFields function every time the selection value of our underAge field changes
    
     $("#pcourse").change(function() { toggleFieldsCourse(); });

});

$(document).ready(function() {
    toggleFieldsCountry(); //call this first so we start out with the correct visibility depending on the selected form values
   //this will call our toggleFields function every time the selection value of our underAge field changes
    
     $("#qcountry").change(function() { toggleFieldsCountry(); });

});

$(document).ready(function() {
    toggleFieldsFile(); //call this first so we start out with the correct visibility depending on the selected form values
   //this will call our toggleFields function every time the selection value of our underAge field changes
    
     $("#file").change(function() { toggleFieldsFile(); });

});

//this toggles the visibility of our parent permission fields depending on the current selected value of the underAge field
function toggleFieldsFile()
{
    if ($("#file").val() == 'other')
        $("#changefile").show();
    else
        $("#changefile").hide();
}


function toggleFields()
{
    if ($("#pcountry").val() == 'other')
        $("#countrymention").show();
    else
        $("#countrymention").hide();
}

function toggleFieldsLevel()
{
    if ($("#level_edu").val() == "ACSEE" || $("#level_edu").val() == 'CSEE')
        $("#index").show();
    else
        $("#index").hide();
}

function toggleFieldsCourse()
{
    if ($("#pcourse").val() == "other")
        $("#coursemention").show();
    else
        $("#coursemention").hide();
}

function toggleFieldsCountry()
{
    if ($("#qcountry").val() == "other")
        $("#countrynew").show();
    else
        $("#countrynew").hide();
}



