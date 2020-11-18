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
if($qpers['id']=="64"){
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

echo"All Registration Details of All Student";
echo"<hr class=bar>";


echo"<form method=post action=./index.php?view=admin&admin=64&task=viewrg>";
echo"Select Registration Year to Check Details";
echo"<select name=regyear>";

$quegtyear="select distinct(year) from student";
$qugtyear=mysql_query($quegtyear);
while($qgtyear=mysql_fetch_array($qugtyear)){
		$gtyear=$qgtyear['year'];
	echo"<option value=$gtyear>$gtyear</option>";
						}
echo"</select>";
echo"<input type=submit value=Search></form>";




if($task=="viewrg"){
$regyear=$_POST['regyear'];


$quegtall="select s.batch, s.id, r.course, c.core,c.credits, c.semister, c.level,c.type, r.degree from student s,registration r, courseunit c where s.id=r.student and r.confirm=1 and r.course=c.code  and s.year=$regyear order by  s.id,r.course";


$qugtall=mysql_query($quegtall);
$i=1;
echo"<table border=0 width=80%><th>No<th> Student no<th>Course<th>Core<th>Credits<th>Semester<th>Level<th>Type<th>Degree Status";
while($qgtall=mysql_fetch_array($qugtall)){
	$sbt=$qgtall['batch'];
	$sno=$qgtall['id'];
	$scos=$qgtall['course'];
	$core=$qgtall['core'];
	$credits=$qgtall['credits'];
	$seme=$qgtall['semister'];
	$levl=$qgtall['level'];
	$type=$qgtall['type'];
	$sgst=$qgtall['degree'];
	if($sgst==1){
		$sgst2="Degree";
			}
	else{$sgst2="Non Degree";
		}

echo"<tr class=trbgc align=center><td>$i<td>SC/$sbt/$sno<td>$scos<td>$core<td>$credits<td>$seme<td>$levl<td>$type<td>$sgst2</tr>";
$i++;


						}
echo"</table>";
}
?>











<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>
