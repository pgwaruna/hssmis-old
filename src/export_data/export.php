<?php
error_reporting(0);

include '../admin/config.php';
$conpra=mysql_connect($host,$user,$pass) or die("Unable to connect Database");
mysql_select_db($db);
$sub=$_GET['sub'];
$sgp=$_GET['sgp'];

//..........create csv file
//$id_save=$sub."-".$sgp."-".date("Y-m-d-H-i-s");
$id_save=$sub."-".$sgp;
$myFile = "../export_data/pract/".$id_save.".csv";


//.............get acc_year.........

$queacc="select * from acc_year where current='1'";
$quacc=mysql_query($queacc);
while($qacc=mysql_fetch_array($quacc)){
$acc_ye=$qacc['acedemic_year'];
}
//.........................................

//...........get semester..........
$queprac="select * from call_registration";
$quprac=mysql_query($queprac);
while($qup=mysql_fetch_array($quprac)){
$seme=$qup['semister'];
}
//.........................................
//.....write toptic................
unlink($myFile);
$fh = fopen("$myFile", "c") or die("can't open file");
$header="Name list of Course Unit ".$sub." and group ".$sgp." According to ".$acc_ye." Academic Year.\n\n";
fwrite($fh, $header);

$queprint="select * from Prac_registration where status='Confirmed' and prac_group='$sgp' and subject='$sub' and acc_year='$acc_ye' and semester='$seme'";
//echo$queprint;
$quprint=mysql_query($queprint);

while($qprint=mysql_fetch_array($quprint)){
$sno=$qprint['student'];
$subj=$qprint['subject'];
$prgrp=$qprint['prac_group'];

$queryprc="select s.batch from level l,student s where s.year=l.year and s.id='$sno'";
$datais=mysql_query($queryprc);
while($ldata=mysql_fetch_array($datais)){
	
	$batch1=$ldata['batch'];
					}
//..........write st number...................
$header1="SC/".$batch1."/".$sno.",";
fwrite($fh, $header1);


$quname="select l_name,initials from users where user='$sno'";
$qname=mysql_query($quname);
while($name=mysql_fetch_array($qname)){
$lname=$name['l_name'];
$inis=$name['initials'];
}
//..........write name with inis. .................
$header2=$lname." ".$inis.",";
fwrite($fh, $header2);


//..................write group....................
$header3=$sgp."\n";
fwrite($fh, $header3);

}
chmod($myFile, 0777);
fclose($fh);

//$file=$myFile;
//include'../export_data/pract/download.php';
 
//echo '<a href="../export_data/pract/download.php?file='.$id_save.'.csv" ><img border="0" src="../images/small/old-ooo-template.png"></a>';



?>




