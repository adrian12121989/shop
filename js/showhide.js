/**
* File: js/showhide.js
* Author: design1online.com, LLC
* Purpose: toggle the visibility of fields depending on the value of another field
**/
//autocomplete testing
$(document).ready(function(){	
			$("#propertyddd").datepicker();
});

$(document).ready(function(){
  $("#property").autocomplete({
    source: "Home/search_property" // path to the get_birds method
  });
});

$(document).ready(function() {
    toggleFields(); //call this first so we start out with the correct visibility depending on the selected form values
   //this will call our toggleFields function every time the selection value of our underAge field changes
    $("#fcategory").change(function() { toggleFields(); });
    
    // $("#income").change(function() { toggleFieldsLevel(); });

});

$(document).ready(function() {
    toggleFieldsLevel(); //call this first so we start out with the correct visibility depending on the selected form values
   //this will call our toggleFields function every time the selection value of our underAge field changes
    
     $("#Income").change(function() { toggleFieldsLevel(); });

});

$(document).ready(function() {
    toggleFieldsCourse(); //call this first so we start out with the correct visibility depending on the selected form values
   //this will call our toggleFields function every time the selection value of our underAge field changes
    
     $("#Exp").change(function() { toggleFieldsCourse(); });

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

$(document).ready(function() {
    toggleFieldsCall(); //call this first so we start out with the correct visibility depending on the selected form values
   //this will call our toggleFields function every time the selection value of our underAge field changes
    
     $("#call").change(function() { toggleFieldsCall(); });

});

//generating the report date range
$(document).ready( function() {
	$("#from").datepicker({ dateFormat: 'yy-mm-dd' });	
	});

$(document).ready( function() {
	$("#to").datepicker({ dateFormat: 'yy-mm-dd' });	
	});

//hide and show the expenditures in device
$(document).ready( function () {
	togglefieldsdev();
	$("#category").change(function() {togglefieldsdev(); });
	});
$(document).ready(function() {
	toggleFieldsname();
	$("#category").change(function() {toggleFieldsname();} );
	});
$(document).ready( function(){
	toggleFieldspayee();
	$("#category").change(function() {toggleFieldspayee();});
	});
$(document).ready( function () {
	toggleFieldspays()
	$("#category").change(function() {toggleFieldspays();});
	});
$(document).ready(function() {
	toggleFieldspaysec();
$("#category").change(function() {toggleFieldspaysec();});
	});
$(document).ready(function(){
	toggleFieldspaysel();
	$("#category").change(function() {toggleFieldspaysel();});
	});
//this toggles the visibility of our parent permission fields depending on the current selected value of the underAge field

function toggleFieldsCall()
{
    if ($("#call").val() == 'Yes')
        $("#now").show();
    else
        $("#now").hide();
}

function toggleFieldsFile()
{
    if ($("#file").val() == 'other')
        $("#changefile").show();
    else
        $("#changefile").hide();
}


function toggleFields()
{
    if ($("#fcategory").val() == 'income category') {
        $("#income").show();
        $("#payer").show();
	}
    else {
        $("#income").hide();
        $("#payer").hide();
	}
        
        if ($("#fcategory").val() == 'exp category') {
        $("#exp").show();
        $("#payee").show();
	}
    else {
        $("#exp").hide();
        $("#payee").hide();
	}
}

function toggleFieldsLevel()
{
    if ($("#Income").val() == "Payment of Debts")
        $("#staff").show();
    else
        $("#staff").hide();
        
    if ($("#Income").val() == "other")
        $("#otherIncome").show();
    else
        $("#otherIncome").hide();
}

function toggleFieldsCourse()
{
    if ($("#Exp").val() == "Loan grating")
         $("#staff").show();
    else
        $("#staff").hide();
        
      if ($("#Exp").val() == "other")
         $("#otherExp").show();
    else
        $("#otherExp").hide();
}

function toggleFieldsCountry()
{
    if ($("#qcountry").val() == "other")
        $("#countrynew").show();
    else
        $("#countrynew").hide();
}

function togglefieldsdev(){
	if($("#category").val() == "Salary"){
		$("#empexp").show();
	}
	else{
		$("#empexp").hide();
	}
	 if($("#category").val() == "Other"){
		$("#specificexp").show();
		
		}else{
			$("#specificexp").hide();
	} 
	 
	if($("#category").val() == "Other"){
		$("#payeeexp").show();
		
		}else{
			$("#payeeexp").hide();
	} 
}

function toggleFieldsname(){
	if($("#category").val() == "Salary"){
		$("#lnameexp").show();
		
		}else{
			$("#lnameexp").hide();
	}
}


function toggleFieldspays(){
	if($("#category").val() == "Other"){
		
		$("#specificexppayee").show();
		
		}else{
		$("#specificexppayee").hide();	
	}
}




