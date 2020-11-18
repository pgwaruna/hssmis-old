<?php
$oldacyear=$_POST['oldacyear'];
$oldseme=$_POST['oldseme'];


$target_path = "Excel_Upload/Upload_st_old/";


$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 


if($dd=move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
{	
	$filename=basename( $_FILES['uploadedfile']['name']);
	chmod($target_path, 0777);
		
	echo " The file ".$filename." has been uploaded<br> ";
		
	//echo "uploads/".$target_path."<br>";
			
	include 'Excel_Upload/Regi_Old_Detail_UP.php';
} 
else
{
echo "There was an error uploading the file, please try again!";
}
?>



