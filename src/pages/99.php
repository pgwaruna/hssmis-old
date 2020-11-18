<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){

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

$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="99"){
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




<?php

echo"Manage Mentors and Mentoring Student";
echo"<hr class=bar>";



//.................................................
echo"<br>[ <a href='./forms/uploads/upload_mentorfile.php'>Click here to add Students for Mentor</a> ]<br>";
echo"<img src=./picture/asgn_mntr.jpg ><br><br><br>";


//................................................









//.................................................
echo"<br>[ <a href='./forms/uploads/upload_mentorinfo_file.php'>Click here to add Mentor's Information</a> ]<br>";


echo"<img src=./picture/mntinfo.jpg width=95%><br><br><br>";
//................................................








?>





<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>
