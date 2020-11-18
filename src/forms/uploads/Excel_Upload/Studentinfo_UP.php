<?php

 
include  '../../admin/config.php';


mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);



require_once 'Excel/reader.php';

// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();

// Set output Encoding.
$data->setOutputEncoding('CP1251');

$data->read($target_path);
//$data->read($_FILES['uploadedfile']['name']);

error_reporting(E_ALL ^ E_NOTICE);

for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) 
{
	$index=$data->sheets[0]['cells'][$i][2];
	$str_exp = explode("/", $index);
	$scre=$str_exp[0];
	$num=$str_exp[2];
		$st_tem_no=$scre.$num;// student temp no

	$pindex=$data->sheets[0]['cells'][$i][3];// student perm no
	$pstr_exp = explode("/", $pindex);
	$pnum=$pstr_exp[2];


	$fulname=$data->sheets[0]['cells'][$i][4];
	$name_exp=explode("-",$fulname);

		$lname=$name_exp[0];
		$init=$name_exp[1];
		$occu="student";
		$pwd="AES_ENCRYPT('123456',1000)";
		$role="student";
		$email=$st_tem_no."@student.ruh.ac.lk";
		$sec="Other";
	
//echo$st_tem_no." ".$lname."--".$init."<br>";
$queinsnews="insert into users(l_name, initials, occupation, user, pass, role, email, section) values ('$lname', '$init', '$occu', '$st_tem_no', $pwd, '$role', '$email', '$sec')";//data insert to users table with tempory number
mysql_query($queinsnews);
//echo$queinsnews;

/*//check all users in users table

$quecheck="select * from users where user='$pnum'";
//echo$quecheck;
$qucheck=mysql_query($quecheck);
if(mysql_num_rows($qucheck)==0){
echo$pnum."--".$st_tem_no."--".$lname."--".$init."<br>";
//echo mysql_num_rows($qucheck);
}
else{
while($qcheck=mysql_fetch_array($qucheck)){
$user=$qcheck['user'];
$lname=$qcheck['l_name'];
$ini=$qcheck['initials'];
}

//echo$user;*/

}



}
echo"Student Users added successfully<br>";

?>
