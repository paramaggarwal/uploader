<html>
<head>
<title>Resume Uploader</title>
</head>
<body>

<h2>Resume Uploader</h2>

<?php

$dir = "./secret23752938475/"; 

if ( $_POST["file"] == 1 ) {

if ($_FILES["file"]["error"] > 0)  {

	echo "<span style='color: red;'><h1>Failed.</h1></span>";
  	echo "<h1>Error: " . $_FILES["file"]["error"] . "</h1>";

} else if ( $_FILES["file"]["type"] != "application/pdf"   ) {

	echo "<span style='color: red;'><h1>Upload failed.</h1></span>";
	echo "<h1>Hey! " . $_FILES["file"]["name"] . " is not a PDF file. Please resubmit as PDF!</h1>";

} else if ( strpos( $_FILES["file"]["name"] , "200") == false   ) {

	echo "<span style='color: red;'><h1>Upload failed.</h1></span>";
	echo "<h1>Hey! " . $_FILES["file"]["name"] . " is not an enrollment number.<br>";
	echo "Please rename the file as your enrollment number and resubmit.</h1>";

} else  {
  //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  //echo "Type: " . $_FILES["file"]["type"] . "<br />";
  //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  //echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br />";

if (file_exists( $dir . $_FILES["file"]["name"])) {

	echo "<h1>" . $_FILES["file"]["name"] . " already exists. </h1>";

} else {
      
	move_uploaded_file($_FILES["file"]["tmp_name"], $dir . $_FILES["file"]["name"]);
	echo "<h1>" . $_FILES["file"]["name"] . " has been successfully stored. </h1>";
}

}
}

?>




<h3>Please name your file as your enrollment number so that it is unique. PDF only!</h3>
<br >
<form action="./" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="hidden" name="file" value="1" /> 
<input type="file" name="file" id="file" /> 
<input type="submit" name="submit" value="Submit" />
</form>

<hr>

<?php

$files = scandir($dir); 

foreach($files as $key => $value) { 
	if ( strpos($value, ".doc") != false ) {
	    echo "<span style='color: red;'><b>";
		echo $value;
		echo "</b></span> - <small>Resubmit as PDF.</small>";
		echo "<br>";
	}
}

echo "<br>";

foreach($files as $key => $value) {
	if ( strpos($value, ".doc") == false ) { 
		if ( strpos($value, "200") == false ) {
				if ( ($value != ".") && ($value != "..") ){
	  	 		 	echo "<span style='color: red;'><b>";
					echo $value;
					echo "</b></span> - <small>Resubmit after renaming as enrollment number.</small>";
					echo "<br>";
				}
		}
	}
}

echo "<br><b>Files successfully accepted:</b><br><br>";

foreach($files as $key => $value) { 
	if ( strpos($value, ".doc") == false ) {
		if ( strpos($value, "200") != false ) {
	    	if ( ($value != ".") && ($value != "..") ){
			echo "<small>" . $value . "<br></small>";
			}
		}
	}
}
?>

</body>
</html>
