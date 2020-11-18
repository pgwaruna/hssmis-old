<?php
session_start();
if((isset($_SESSION['login'])=="TRUE")&&($_SESSION['role']=="administrator")){
?>


<a href="../../index.php?view=admin&admin=20">Back</a>
<form enctype="multipart/form-data" action="upload_student.php"' method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" value="Upload File" />
</form>
<?php
}
else{
echo "You Have Not Permission To Access This Area!";}
?>

