<?PHP
 // Define the path to file
 $file = $_GET['file'];


 if(!file)
 {
     // File doesn't exist, output error
     die('file not found');
	 ?>
     
     <script type="text/javascript">
	 alert("File Not Available");
	 </script>
     
     
     <?php
 }
 else
 {
    // Set headers
     header("Cache-Control: public");
     header("Content-Description: File Transfer");
     header("Content-Disposition: attachment; filename=$file");
     header("Content-Type: application/zip");
     header("Content-Transfer-Encoding: binary");
    
     // Read the file from disk
     //readfile($file);
$fp=fopen($file,'r');
fpassthru($fp);
fclose($fp);

 
 }
 ?>
