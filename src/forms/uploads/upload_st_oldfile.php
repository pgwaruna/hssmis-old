<?php
session_start();
if((isset($_SESSION['login'])=="TRUE")&&($_SESSION['role']=="administrator")){
?>
<a href="../../index.php?view=admin&admin=20">Back</a><br>
<form enctype="multipart/form-data" action="upload_st_old.php"' method="POST">
<?php
include '../../admin/config.php';


mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);


echo"Enter Previous Academic Year : ";
echo"<select name=oldacyear>";

$queacc="select * from acc_year order by acedemic_year DESC";
$quacc=mysql_query($queacc);
while($qacc=mysql_fetch_array($quacc)){
$acc_ye=$qacc['acedemic_year'];
echo"<option value='$acc_ye'>$acc_ye</option>";
}
echo"</select><br>";

echo"Enter Previous Selester : ";
echo"<select name=oldseme>";
echo"<option value='1'>One</option>";
echo"<option value='2'>Two</option>";
echo"</select><br>";


?>



<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" value="Upload File" />
</form>

<?php
}
else{
echo "You Have Not Permission To Access This Area!";}
?>

