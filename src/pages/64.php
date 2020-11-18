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

echo"All Registration Details of Student";
echo"<hr class=bar>";


echo"<form method=post action=./index.php?view=admin&admin=64&task=viewrg>";
echo"<table><tr class=trbgc><td align=center>";
echo"Select Stream ";
echo"<select name=Strm>";
echo"<option value='all'>All Stream</option>";
echo"<option value='phy'>Phy. Science</option>";
echo"<option value='bio'>Bio. Science</option>";
echo"<option value='bcs'>BC. Science</option>";
echo"</select><br>";
echo"Select Registration Year ";

echo"<select name=regyear>";



$quegtyear="select distinct(year) from student";
$qugtyear=mysql_query($quegtyear);
while($qgtyear=mysql_fetch_array($qugtyear)){
		$gtyear=$qgtyear['year'];
	echo"<option value=$gtyear>$gtyear</option>";
						}
echo"</select>";
echo"<br><input type=submit value=Search></form>";
echo"</tr></table>";



if($task=="viewrg"){
$Strm=$_POST['Strm'];
$regyear=$_POST['regyear'];




if($Strm=="all"){
$quegtall="select s.batch, s.id, s.stream, r.course, c.core,c.credits, c.semister, c.level,c.type, r.degree from student s,registration r, courseunit c where s.id=r.student and r.confirm=1 and r.course=c.code  and s.year=$regyear order by  s.id,r.course";
		}
else{
$quegtall="select s.batch, s.id, s.stream, r.course, c.core,c.credits, c.semister, c.level,c.type, r.degree from student s,registration r, courseunit c where s.id=r.student and r.confirm=1 and r.course=c.code  and s.year=$regyear and s.stream='$Strm' order by  s.id,r.course";
}

//echo$quegtall;

$qugtall=mysql_query($quegtall);
$i=1;
if(mysql_num_rows($qugtall)!=0){
echo"<table border=0 width=80%><th>No<th> Student no<th>Stream<th>Course<th>Core<th>Credits<th>Semester<th>Level<th>Type<th>Degree Status";
while($qgtall=mysql_fetch_array($qugtall)){
	$sbt=$qgtall['batch'];
	$sno=$qgtall['id'];
	$stream=$qgtall['stream'];
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

	$quegetactvst="select SSID from $rmsdb.fohssmisStudents where  user_name='sc$sno'";
	$qugetactvst=mysql_query($quegetactvst);
		if(mysql_num_rows($qugetactvst)!=0){
		echo"<tr class=trbgc align=center><td>$i<td>SC/$sbt/$sno<td>".strtoupper($stream)."<td>$scos<td>$core<td>$credits<td>$seme<td>$levl<td>$type<td>$sgst2</tr>";
		$i++;
							}




						}
echo"</table>";
}
else{
echo"<font color=red>Sorry! Can not find information.</font>";
}
}


echo"<hr class=bar>";

echo"<font size=3px>Bulk Rigistration Details of Students</font>";



echo"<form method=post action=./forms/form_64.php>";
echo"<table><tr class=trbgc><td align=center>";
echo"Select Stream ";
echo"<select name=blkStrm>";
echo"<option value='all'>All Stream</option>";
echo"<option value='phy'>Phy. Science</option>";
echo"<option value='bio'>Bio. Science</option>";
echo"<option value='bcs'>BC. Science</option>";
echo"</select><br>";
echo"Select Registration Year ";

echo"<select name=blkregyear>";



$quegtyear="select distinct(year) from student";
$qugtyear=mysql_query($quegtyear);
while($qgtyear=mysql_fetch_array($qugtyear)){
		$gtyear=$qgtyear['year'];
	echo"<option value=$gtyear>$gtyear</option>";
						}
echo"</select>";
echo"<br><input type=submit value=Find></form>";
echo"</tr></table>";

//special
//if($roleid==3){
    echo"<hr class=bar>";
    echo"<font size=3px>Bulk Rigistration Details of Special Students</font>";
    echo"<form method=post action=./forms/form_64_a.php>";
    echo"<table><tr class=trbgc><td align=center>";
    echo"Select Stream ";
    echo"<select name=blkStrmSp>";
    echo"<option value='bot'>Botany</option>";
    echo"<option value='che'>Chemistry</option>";
    echo"<option value='com'>Computer Science</option>";
    echo"<option value='mat'>Mathematics</option>";
    echo"<option value='phy'>Physics</option>";
    echo"<option value='zoo'>Zoology</option>";
    echo"</select><br>";
    echo"Select Registration Year ";

    echo"<select name=blkregyear>";


    $quegtyear="select distinct(year) from student";
    $qugtyear=mysql_query($quegtyear);
    while($qgtyear=mysql_fetch_array($qugtyear)){
            $gtyear=$qgtyear['year'];
        echo"<option value=$gtyear>$gtyear</option>";
                            }
    echo"</select>";
    echo"<br><input type=submit value=Find></form>";
    echo"</tr></table>";
   // }



















?>











<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>
