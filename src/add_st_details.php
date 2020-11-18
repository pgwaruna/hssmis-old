<?php
echo "Add Student Registration Details <hr color=#E1E1F4 width=95%><br>";


						// Add Registration Details from CSV File
						
						echo '<form method="POST" action="index.php?view=admin&admin=99&action=upload">';
						//echo '<input type="text" name="file" size="32"><br><br>CSV file path paste here &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Submit" name="submit"><br><br>';
						//echo '</form>';
						
						$action=$_GET['action'];
						$file=$_POST['st_de_file'];

						if(($action=='upload')&&(isset($_POST['submit']))){
						$con9_3=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						$query_9_1="LOAD DATA LOCAL INFILE '$file' INTO TABLE results fields terminated by ',' ignore 1 lines";
						$prev=mysql_query($query_9_1);	
						if($prev){
						echo "Results added Success<br><br>";
						}	
						mysql_close($con9_3);
						}
						


?>
