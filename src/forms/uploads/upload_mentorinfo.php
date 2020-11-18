<?php
$target_path = "Excel_Upload/Mentors_Info/";


$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 


if($dd=move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
{	
	$filename=basename( $_FILES['uploadedfile']['name']);
	chmod($target_path, 0777);
		
	echo "<font=color=blue> The file ".$filename." has been uploaded</font><br><br> ";
		
	//echo "uploads/".$target_path."<br>";
			
	include 'Excel_Upload/mentors_data_UP.php';
} 
else
{
echo "<font=color=red>There was an error uploading the file, please try again!</font>";
}
?>



