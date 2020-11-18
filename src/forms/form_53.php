<?php
//error_reporting(0);
session_start();
if((($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){

include'../connection/connection.php';

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole);

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}

$quepers="SELECT id FROM permission WHERE role_id=$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
    
if($qpers['id']=="53"){
$pem="TRUE";
}

}
}
else
{
echo "You Have Not Permission To Access This Area!";
}

if($pem=="TRUE")
{
?>





<head>
<script type="text/javascript">
function check(r)
{
	 
	if (r.upfltitle.value==""){
 	alert("Please Enter a Title for this Notice according to upload file.");
	r.upfltitle.focus();
 	return false;}
	 
 	
	  
 }
</script>



</head>


<form enctype="multipart/form-data" action="./index.php?view=admin&admin=53&task=upnote" method="POST">
Enter Title: <input type="text" name="upfltitle"><font color="red">[ Please don't use the fullstop mark (<b>.</b>) with in the Title ]</font><br>
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" value="Upload File" onclick="return check(this.form)" />
</form>

<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>

