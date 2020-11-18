<?php
session_start();
if((($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){

?>


<style type="text/css">
@media print {
input#btnPrint {
display: none;
}
}
</style>
<style type="text/css">
@import url('../style/default.css');
</style>




<?php
echo"<div id='a'>";

echo"<table border='0' width='100%'><tr><td align='left' valign='top'>";
echo"<form method='POST' action='../index.php?view=admin&admin=43'>";
echo"<input type='submit' value='Back' id='btnPrint'>";
echo"</form>";
echo"</td><td align='right' valign='top'>";
echo "<input type='button' id='btnPrint' onclick='window.print();' value='Print Page' /></td></tr></table>";

include'../admin/config.php';

mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);


$queyear="select year from level where level='2'";
$quyear=mysql_query($queyear);
while($qyear=mysql_fetch_array($quyear)){
$secondyear=$qyear['year'];
}

$quechkmedium="SELECT * FROM student WHERE medium<>'select' and year=$secondyear order by medium,id";
$quchkmedium=mysql_query($quechkmedium);

$i=1;
if(mysql_num_rows($quchkmedium)!=0){
echo"<table border='1' width='100%'><tr>";
echo"<th>No</th><th>Student Number</th><th>Name with initials</th><th>Degree Medium</th></tr>";
while($qchkmedium=mysql_fetch_array($quchkmedium)){

$id=$qchkmedium['id'];
$l_name=$qchkmedium['l_name'];
$initials=$qchkmedium['initials'];
$batch=$qchkmedium['batch'];
$medium=$qchkmedium['medium'];

echo"<tr><td align='center'>$i</td><td align='center'>SC/$batch/$id</td><td>$l_name $initials</td><td align='center'>$medium</td></tr>";
$i++;
}
echo"</table>";
}
else{
    echo"<p align=center>Sorry! No Student name found.</p>";
}
echo"</div>";
?>



<?php

}	
else{

echo "You Have Not Permission To Access This Area!";}

?>
