<?php
$target_path = "Excel_Upload/Student_Data/";

/*$my_t=getdate(date("U"));
$dat=$my_t[month].$my_t[mday].$my_t[year];
if ($handle = opendir($target_path)) {
    //echo "Directory handle: $handle\n";
    //echo "Files:\n";

    
    while (false !== ($file = readdir($handle))) {
        //echo $file.$dat;
	$nnnmw=$file.$dat;
	//rename($file,$nnnmw);
	rename($target_path."\\".$file, $target_path."\\".$nnnmw); 
    }
}
*/
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 


if($dd=move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
{	
	$filename=basename( $_FILES['uploadedfile']['name']);
	chmod($target_path, 0777);
		
	echo " The file ".$filename." has been uploaded<br> ";
		
	//echo "uploads/".$target_path."<br>";
		
	include 'Excel_Upload/Studentinfo_UP.php';
} 
else
{
echo "There was an error uploading the file, please try again!";
}
?>



