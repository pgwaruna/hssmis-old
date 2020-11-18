<?php

echo "Adding Course Units to the F O S M I S <hr class=bar><br>";
						
						
	// Add multiple courseunits from CSV File
	echo "Adding Multiple Course Units <br>";
	echo '<form method="POST" action="index.php?view=admin&admin=24&action=upload">';
	echo '<input type="text" name="file" size="32"><br>CSV file path paste here &nbsp;&nbsp;&nbsp;&nbsp;<BR><input type="submit" value="Submit" name="submit"><br><br>';
	echo '</form>';
		
	$action=$_GET['action'];
	$file=$_POST['file'];

	if(($action=='upload')&&(isset($_POST['submit']))){

	$query_20_1="LOAD DATA LOCAL INFILE '$file' INTO TABLE courseunit fields terminated by ',' ignore 3 lines";
	$prev=mysql_query($query_20_1);	
	if($prev){
	echo "Course Units Added to the Database";
	}	

	}
						
						
						
?>