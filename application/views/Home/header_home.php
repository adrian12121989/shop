<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!-- Inserting the jquery -->
			
		<link rel = "stylesheet" href = '<?php echo base_url("ui/jquery-ui.css")?>' />
		
  <script language="javascript" type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
   <script language="javascript" type="text/javascript" src="<?php echo base_url('ui/jquery-ui.js'); ?>"></script>
		<script src = '<?php echo base_url("ui/jquery-ui.js");?>'></script>
  
  <script language="javascript" type="text/javascript" src="<?php echo base_url('js/script.js'); ?>"></script>
 
 <link href="<?php echo base_url('bootstrap/css/theme.css');?>" rel="stylesheet">
<script>
$(function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  });
</script>
</head>
<body role="document">
<!-- END header.php -->
<div class="" role="main" style="border: 6px solid green; width:auto">
	<h6></h6>

