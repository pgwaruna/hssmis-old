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
//echo$qpers['id'];
$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="42"){
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
/////////////////////////////////////////////////////////////////////
//student's combination confirmation and call combination prosse/////
/////////////////////////////////////////////////////////////////////
$task=$_GET['task'];
///....call combinations variables...................
$nxacyaer=$_POST['cscmb'];
$cmbeddt=$_POST['enddate'];
$cmbstat=$_POST['status'];
//..................................................
//..........combination confirmations variables..........
$cfmstud=$_POST['disstud'];
$cfmcmb=$_POST['ccmb'];
$cfstat=$_POST['sbcmb'];
$gbtyear=$_POST['btyear'];

//.......................


$quebtyear="select * from acc_year where current='1'";
$qubtyear=mysql_query($quebtyear);
while($qbtyear=mysql_fetch_array($qubtyear)){
$btyear=$qbtyear['acedemic_year'];
$btyr=explode("_",$btyear);
$cbtyr=$btyr[0];
$nxbtyr=$btyr[1];
$olbtyr=$cbtyr-1;
}

if($task=="cmbend"){
//........start ot stop call combinations...................
$quecmbifdel="delete from call_combination";
mysql_query($quecmbifdel);

$quecmbins="insert into call_combination(acc_year, closing_date, status) values('$nxacyaer','$cmbeddt','$cmbstat')";
mysql_query($quecmbins);
}



echo"Start Subject Combination Registration Unit";
echo"<hr class=bar>";
//....display call combination status........................
echo "<form id='form1' method='POST' action='./index.php?view=admin&admin=42&task=cmbend'>";
echo"Next Academic Year : <select name='cscmb'>";
	
	     $query5_a="select acedemic_year from acc_year where current=1 or current=2";
	     $five_a=mysql_query($query5_a);
	 while($data5=mysql_fetch_array($five_a)){
	 echo "<option value=".$data5['acedemic_year']." selected>";
	 $acc_parts=explode("_",$data5['acedemic_year']);
	 echo $acc_parts[0]." - ".$acc_parts[1];
	 echo "</option>";
	 }
echo"</select>";
echo "<br>Combination Rgistration Closing Date : ";
echo"<span id='date1'><input type='text' name='enddate' size='20'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Closing Date</font></span>";
echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";
echo"<select name='status'>";
echo"<option value='1'>Start</option>";
echo"<option value='0'>Stop</option>";
echo"</select>";
echo"<input type='submit' value='Submit'>";
echo "</form><br>";


$quecmbinf="select * from call_combination";
$qucmbinf=mysql_query($quecmbinf);
while($qcmbinf=mysql_fetch_array($qucmbinf)){
$gtay=$qcmbinf['acc_year'];
$gtdt=$qcmbinf['closing_date'];
$gtst=$qcmbinf['status'];
}

echo"<table border='0'><tr>";
echo"<th>Accdemic Year</th><th>Closing Date</th><th>Status</th></tr>";
echo"<tr bgcolor='#dbc5de'><td align='center'>$gtay</td><td align='center'>$gtdt</td><td align='center'>";
if($gtst=='1'){
echo"Start</td>";
}
else{
echo"Stop</td></tr>";
}
echo"</table><br>";

echo"<hr color=#E1E1F4 width=95%>";
/*
//..................................

/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
///...............confrim student's combinations..............///
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////

//......when admin confirmed database update query................
if($task=="confirm"){
$cbvl_n_prt=explode(".",$cfmcmb);
$cbnvl=$cbvl_n_prt[0];
$cbprt=$cbvl_n_prt[1];
//....get combinaton value...............
$gtcbvl=explode("/",$cbnvl);
$cbvalue=$gtcbvl[1];
//....................................

///get student scream.............................
$quesrem="select occupation from users where user=$cfmstud";
$qusrem=mysql_query($quesrem);
while($qsrem=mysql_fetch_array($qusrem)){
$occu=$qsrem['occupation'];
}
//...........................		

$nmex=explode("_",$occu);
$strem=$nmex[0];

//...........................
//get student name with initials...........
$quename="select l_name, initials from users where user='$cfmstud'";
//echo$quename;
$quname=mysql_query($quename);
while($qname=mysql_fetch_array($quname)){
$lsname=$qname['l_name'];
$initial=$qname['initials'];
}

$queudoths="update request_combination set status='Register' where stno='$cfmstud'";
mysql_query($queudoths);
$Queudcmb="update request_combination set status='Confirmed' where stno='$cfmstud' and combination='$cbnvl' and priority='$cbprt'";
mysql_query($Queudcmb);
//echo$gbtyear;
//echo$strem;
//echo$cbvalue;

$quecmbtostu="insert into student(id, l_name, initials, year, stream, combination, batch,medium)values('$cfmstud', '$lsname', '$initial', '$cbtyr', '$strem', '$cbvalue', '$gbtyear','select')";
//echo$quecmbtostu;
mysql_query($quecmbtostu);
$queusrchk="update users set section='checked' where user=$cfmstud";
$quusrchk=mysql_query($queusrchk);

}
//.................................................................
//......when admin confirm canceled database update query................
if($task=="cancel"){
$cbvl_n_prt=explode(".",$cfmcmb);
$cbnvl=$cbvl_n_prt[0];
$cbprt=$cbvl_n_prt[1];

$Queudcmb="update request_combination set status='Register' where stno='$cfmstud' and combination='$cbnvl' and priority='$cbprt'";
mysql_query($Queudcmb);
//echo$Queudcmb;

$quedelst="delete from student where id='$cfmstud'";
mysql_query($quedelst);

$queusrchk="update users set section='Other' where user=$cfmstud";
$quusrchk=mysql_query($queusrchk);

}
//........................................................................


echo"Check Student's Course Combinations.";
echo"<hr color=#E1E1F4 width=95%>";
echo"Student's Combination List of  .$gtay. Accademic Year.";

echo"<table border='0'><tr>";
echo"<th>Student No</th><th>Course Combination & Priority </th><th>Status</th><th>Batch Year</th> ";


$quegtst="select distinct stno from request_combination order by stno";
$qugtst=mysql_query($quegtst);
while($qgtst=mysql_fetch_array($qugtst)){
$gtstno=$qgtst['stno'];

$queckcb="select * from request_combination where stno='$gtstno' and status='Confirmed'";
$quckcb=mysql_query($queckcb);

if(mysql_num_rows($quckcb)=='0'){
echo"<tr bgcolor='#dbc5de'>";
echo"<form method='POST' action='./index.php?view=admin&admin=42&task=confirm'>";
echo"<td align='center'>$gtstno<input type='hidden' name='disstud' value='$gtstno'></td><td align='center'>";

echo"<select name='ccmb'>";

$quecfmcmb="select * from request_combination where stno='$gtstno' order by priority";
$qucfmcmb=mysql_query($quecfmcmb);
while($qcfmcmb=mysql_fetch_array($qucfmcmb)){

$disid=$qcfmcmb['id'];
$disstno=$qcfmcmb['stno'];
$disay=$qcfmcmb['acc_year'];

$discmb=$qcfmcmb['combination'];
$expcmb=explode("/",$discmb);
$scmb=$expcmb[0];
$scmbvl=$expcmb[1];

$disprt=$qcfmcmb['priority'];
$dissta=$qcfmcmb['status'];

if($disprt=='1'){
echo"<option value='$discmb.$disprt' selected >$scmb&nbsp;&nbsp;&nbsp;-$disprt</option>";
}
else{
echo"<option value='$discmb.$disprt'>$scmb&nbsp;&nbsp;&nbsp;-$disprt</option>";
	}
}
echo"</select>";

echo"</td><td align='center'><input type='submit' value='Confirm' name='sbcmb'></td>";
echo"<td align='center'><select name='btyear'>";
echo"<option value=$olbtyr>$olbtyr</option>";
echo"<option value=$cbtyr selected>$cbtyr</option>";
echo"<option value=$nxbtyr>$nxbtyr</option>";
echo"</select></td></tr>";
echo"</form>";
}
else{
while($qckcb=mysql_fetch_array($quckcb)){
$disid=$qckcb['id'];
$disstno=$qckcb['stno'];
$disay=$qckcb['acc_year'];

$discmb=$qckcb['combination'];
$expcmb=explode("/",$discmb);
$scmb=$expcmb[0];
$scmbvl=$expcmb[1];

$disprt=$qckcb['priority'];
$dissta=$qckcb['status'];
echo"<tr bgcolor='#b3d0e0'>";
echo"<form method='POST' action='./index.php?view=admin&admin=42&task=cancel'>";
echo"<td align='center'>$gtstno<input type='hidden' name='disstud' value='$gtstno'></td><td align='center'>";
echo"<input type='hidden' name='ccmb' value='$discmb.$disprt'>".$scmb."&nbsp;&nbsp;&nbsp;-".$disprt;
echo"</td><td align='center' colspan='2'><input type='submit' value='Cancel' name='sbcmb'></td></tr>";
//echo"&nbsp</td></tr>";
echo"</form>";
}
}



}
echo"</table>";


*/
?>

<?php
}
}	
else{

echo "You Have Not Permission To Access This Area!";}
?>







