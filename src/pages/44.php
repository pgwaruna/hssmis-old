<?php
session_start();
if(($_SESSION['login'])=="truefohssmis"){

?>




<?php
echo"change degree medium Process stoped";

/*echo" Change the Medium of Degree [Only for Level 2 Student]";
echo '<hr class=bar>';




include'./admin/config.php';
$task=$_GET['task'];
$medim=$_POST['medium'];
$stno=$_SESSION['user_id'];

mysql_connect($host,$user,$pass) or die("Unable to connect database");
mysql_select_db($db);


if($task=="chngmed"){

$quechgmedi="update student set medium='$medim' where id='$stno'";
//echo$quechgmedi."<br>";
mysql_query($quechgmedi);

echo"<font size='3px'>Succesfully Medium Changed to $medim. </font><br><br>";

}


$quegetmedium="select medium, year from student where id='$stno'";
$qugetmedium=mysql_query($quegetmedium);

while($qgetmedium=mysql_fetch_array($qugetmedium)){
$getmedium=$qgetmedium['medium'];
$styear=$qgetmedium['year'];
}
if(mysql_num_rows($qugetmedium)!='0'){

$quegtyr="select level from level where year=$styear";
$qugtyr=mysql_query($quegtyr);
while($qgtyr=mysql_fetch_array($qugtyr)){
$gtyr=$qgtyr['level'];
}
if($gtyr=='2'){

echo"( Deadline :<font color='red'>10th June 2015</font> )<br>";

if($getmedium=="select"){
$getmedium2="Not Selected";
}
else{
$getmedium2=$getmedium;
}


echo"Your current medium is <font color='red'>[$getmedium2]</font><br><br>";

echo"<form method='POST' action='index.php?view=admin&admin=44&task=chngmed'>";
echo"Select Your Choice: ";
echo"<select name='medium'>";
echo"<option value='Sinhala'>Sinhala</option>";
echo"<option value='English'>English</option>";
echo"</select>";
echo"<input type='submit' value='Submit'></form>";
echo '<hr class=bar><br>';
}
else{
echo"You have no permission to change medium.";
echo '<hr class=bar><br>';
}

}


else{
echo"You have no permission to change medium.";
echo '<hr class=bar><br>';
}


*/

?>




<?php
}	
else{
echo "You Have Not Permission To Access This Area!1";
}
?>
