<?php
include_once 'tablegenerator.php';

$params = parse_ini_file("config.ini", true);

$data = new Data($params);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>TA - Test Assessment</title>

<!--link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"-->
<script type="text/javascript" src="bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type='text/javascript' src="jquery/jquery-1.8.3.js"></script>
<script src="js/bootstrap-myfile-min.js"> </script>
<script src="js/bootstrap-myfile.js"> </script>			
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css">
	
<script>


$(document).ready(function() {
	
	$(':file').myfile({
		 classText: 'input-xxlarge',
		 textField: 'false',
		 buttonText: 'Select a file',
		 classButton: 'btn btn-info'
	});

	$("#clear").click(function(){
        $("#body").hide();
	});
	
});

</script>
			<style>
				 body{
						padding: 15px;
				 }
			</style>
</head>
<body>
<h1 align="center">Test Assessment</h1>
<h3 align="center">Sorting Service</h3>
<hr>
<form action="" method="post">
<div class="inputFile">
    <span>Select a file to sorting</span>
    <input type="file" name="arquivo" id="arquivo"/>            	   
    <input class="btn btn-primary" type="submit" name="formSave" id="load" value="Load Data"/>
</div>

</form>
<div id="body">
<?php 

if (isset($_POST["formSave"])){

	if ($_POST["formSave"]) {
		$arquivo = $_POST["arquivo"];
		
		if($arquivo != "")
		{
			echo '<hr><h5>Data File Loaded</h5>';
			echo $data->showDataFile($arquivo); 
			echo '<h5>Data File Sorted</h5>';
			echo $data->showSortedDataFile();
		}
	}
}
?>
</div>
</body>
</html>

