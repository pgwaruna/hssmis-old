<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){
include'../connection/connection.php';

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole) or die(mysql_error());

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
if($qpers['id']=="40"){
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


<style type="text/css">
@import url('../style/default.css');
</style>



<?php
echo"<div id='a'align='center' width='770px'>"; 
echo "<h3>Group Registration Details";
echo"<div align='right'>";
echo"<form name='reset' method='POST' action=pract.php?task=reset>";
echo"<input type='submit' value='Master Reset'>";
echo"</form>";
echo"</div>";
echo"<a href='../index.php?view=admin&admin=40'>Go Back</a></h3>";



$task=$_GET['task'];
$sub=$_GET['sub'];
$pgrop=$_GET['dgp'];

$due=$_GET['due'];




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
///////////////................master deleteing prosses....................//////////////////
							if($task=="mreset")
							{
							$mrcode=$_POST['pwd'];
							$can=$_POST['cancel'];
							if($mrcode=="SC/2003/5291")
								{
								$que_dl_pr_s="delete from practical_session where acc_year='$acc_ye' and semester='$seme'";
								mysql_query($que_dl_pr_s);
								$que_dl_pr_r="delete from Prac_registration where acc_year='$acc_ye' and semester='$seme'";
								mysql_query($que_dl_pr_r);

								echo"<br><h3><font color=red>*** Deleted All Practical Details Successfully. ***</font></h3>";
								}
							else
								{
								echo" <br><h3><font color=red>Incorrect Master Reset Code...!</font></h3><br>";
								}

								if($can=="Cancel")
								{
								echo"<br>Canceled Master Reset Prosses....<br>";
								}
							}

////////////////////////////////////////////////////////////////////////////////////////////////////

//.........get subject................
$dissub="select distinct subject from practical_session where acc_year='$acc_ye'";
$disub=mysql_query($dissub);
echo"<table border='0'>";
echo"<tr class=trbgc>";
while($dsub=mysql_fetch_array($disub)){
$dsu=$dsub['subject'];
echo"<td><a href='pract.php?task=check&sub=$dsu'> ".$dsu."</a></td> ";
}
echo"</tr></table>";
//......................................

//.........Export data..................................

if($due=="gmember"){
error_reporting(0);

//..........create csv file.......
//$id_save=$sub."-".$sgp."-".date("Y-m-d-H-i-s");
$id_save=$sub."-".$pgrop."-".$acc_ye;
$fname=$id_save.".csv";
$myFile = "../export_data/pract/".$id_save.".csv";

//..............get level,name accordin to subject code///
$que_lev="select level,name from courseunit where code='$sub'";
$qu_lev=mysql_query($que_lev);
while($q_lev=mysql_fetch_array($qu_lev)){
	$su_lev=$q_lev['level'];
	$c_name=$q_lev['name'];
}
//...............................

//.............get date time venue accordin subject and group...............
$que_DTV="select date,time,Venue,hours from practical_session where subject='$sub' and grouptype='$pgrop' and acc_year='$acc_ye'";
$qu_DTV=mysql_query($que_DTV);
while($q_DTV=mysql_fetch_array($qu_DTV)){
	$sdate=$q_DTV['date'];
	$stime=$q_DTV['time'];
	$sven=$q_DTV['Venue'];
	$shor=$q_DTV['hours'];
}
//.................................
//.....write toptic................
unlink($myFile);
$fh = fopen("$myFile", "a") or die("can't open file");
$headert1="B.Sc  General  Degree Level ".$su_lev." and (Semester ".$seme.")  Examination -".date("Y")."\n";
fwrite($fh, $headert1);

$headert2=$sub."-".$c_name." (Practical)\n";
fwrite($fh, $headert2);

$headert3="Group ".$pgrop."\n";
fwrite($fh, $headert3);

$headert4="Date : ".$sdate."    Venue : ".$sven."\n\n";
fwrite($fh, $headert4);

$tm=$stime+$shor;
$headert5="Time : ".$stime."\n";
fwrite($fh, $headert5);

$headert6="Student No,";
fwrite($fh, $headert6);
$headert7="Name with initials\n";
fwrite($fh, $headert7);


$queprint="select * from Prac_registration where status='Confirmed' and prac_group='$pgrop' and subject='$sub' and acc_year='$acc_ye' and semester='$seme'";
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


$quname="select l_name,initials from $rmsdb.fohssmis where user='sc$sno'";
$qname=mysql_query($quname);
while($name=mysql_fetch_array($qname)){
$lname=$name['l_name'];
$inis=$name['initials'];
}
//..........write name with inis. .................
$header2=$lname." ".$inis.",\n";
fwrite($fh, $header2);


/*//..................write group....................
$header3=$pgrop."\n";
fwrite($fh, $header3);*/

}
chmod($myFile, 0777);
fclose($fh);



//...........................//....................

//.............display practical details................

echo"<br>";

echo"<h3>Subject ".$sub." and Group ".$pgrop."</h3>";
//echo$due.$sub.$pgrop;
echo"<table border='0' id='myTable'>";
echo"<tr><td align='center'><a href='javascript:window.print();'><img border='0' src='../images/small/document-print.png' width='48' height='48'><br>Print </a><td colspan='2' align='center' ><a href='../export_data/pract/download.php?file=$fname'><img border='0' src='../images/small/old-ooo-template.png'><br>Export Data</a></td></tr>";
echo"<tr><td colspan='3' align='center'><br>";
echo$headert1."<br>";
echo$headert2."<br>";
echo$headert3."<br>";
echo$headert4."<br>";
echo$headert5."<br>";
echo"</td></tr>";
echo"<tr><th align='center'>Student No<th align='center'>Name with initials</th></tr>";
$queprint="select * from Prac_registration where status='Confirmed' and prac_group='$pgrop' and subject='$sub' and acc_year='$acc_ye' and semester='$seme'";
$quprint=mysql_query($queprint);
//echo$queprint;
if(mysql_num_rows($quprint)!=0){
while($qprint=mysql_fetch_array($quprint)){
$sno=$qprint['student'];
$subj=$qprint['subject'];
$prgrp=$qprint['prac_group'];

$queryprc="select s.batch from level l,student s where s.year=l.year and s.id='$sno'";
$datais=mysql_query($queryprc);
while($ldata=mysql_fetch_array($datais)){
	
	$batch1=$ldata['batch'];
					}

echo"<tr class='trbgc'><td align='center'>SC/".$batch1."/".$sno."</td>";

$quname="select l_name,initials from $rmsdb.fohssmis where user='sc$sno'";
$qname=mysql_query($quname);
while($name=mysql_fetch_array($qname)){
$lname=$name['l_name'];
$inis=$name['initials'];
}
echo"<td>".$lname." ".$inis."</td></tr>";
//echo"<td align='center'>".$prgrp."</td></tr>";
}
}
else{
    echo"<tr class=trbgc><td align=center colspan=2>Sorry! There are no confirmed Student for this group";
}
echo"</table>";


}
//.............................






if($task=="check")
{
$sbj=$_POST['sub'];
$prgpd=$_POST['dgp'];
$stnd=$_POST['stnd'];
$dated=$_POST['dated'];

//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
///...... update to confirm prosses.................
if($due=="confirm"){
$que_update="update Prac_registration set status='Confirmed' where student='$stnd' and subject='$sbj' and prac_group='$prgpd' and acc_year='$acc_ye' and semester='$seme' and date='$dated'";
//echo $que_update;
mysql_query($que_update);

$sub=$sbj;
$pgrop=$prgpd;
}
//..............removeng prosses........................
if($due=="remove"){

$que_remove="update Prac_registration set status='Register' where student='$stnd' and subject='$sbj' and prac_group='$prgpd' and acc_year='$acc_ye' and semester='$seme' and date='$dated'";
//echo $que_remove;
mysql_query($que_remove);
$sub=$sbj;
$pgrop=$prgpd;
}


//.....confirm details.............................





//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////


echo"<br>Group Sessions of ".$sub.".";

echo"<table border='0'><tr class=trbgc>";
$disgp="select grouptype from practical_session where subject='$sub' and acc_year='$acc_ye' order by grouptype";
$digp=mysql_query($disgp);
//.........get practical groups....................
while($dgp=mysql_fetch_array($digp)){
$dgp=$dgp['grouptype'];
echo "<td align='center'><a href='pract.php?task=check&sub=$sub&dgp=$dgp'>Click here to show Group ".$dgp."<br><br><a href='pract.php?due=gmember&sub=$sub&dgp=$dgp' >Export</a></a></td>";

}
echo"</tr></table><br>";
//..................................
//...........display group details.....................

$disdt="Select * from Prac_registration where subject='$sub' and acc_year='$acc_ye' and semester='$seme' and prac_group='$pgrop' order by choice";
//echo$disdt;
$dsdt=mysql_query($disdt);
if(mysql_num_rows($dsdt)!=0){
echo"<table border='0'>";
echo"<tr ><th>Student No<th>Date<th>Time<th>Hours<th>Choice<th>Current Status<th>Submit as</th></tr>";
echo"<font color='red'>Group ".$pgrop." Details</font>";
while($ddt=mysql_fetch_array($dsdt)){
$stn=$ddt['student'];
$acy=$ddt['acc_year'];
$sem=$ddt['semester'];
$sj=$ddt['subject'];
$pgp=$ddt['prac_group'];
$dt=$ddt['date'];
$tm=$ddt['time'];
$hs=$ddt['hours'];
$ch=$ddt['choice'];
$stat=$ddt['status'];
//..........get sudent's batch year.........
$queryprc="select s.batch from level l,student s where s.year=l.year and s.id='$stn'";
$datais=mysql_query($queryprc);

while($ldata=mysql_fetch_array($datais)){
	
	$batch=$ldata['batch'];
					}
//...............................................
echo"<tr class=selectbg align=center><td>SC/".$batch."/".$stn."</td><td>$dt</td><td>$tm</td><td>$hs</td>";
if($stat=="Register"){

$queconf="select * from Prac_registration where subject='$sub' and student='$stn' and status='Confirmed' and acc_year='$acc_ye'";
$qeconf=mysql_query($queconf);
if (mysql_num_rows($qeconf)!='0'){
	while($qcon=mysql_fetch_array($qeconf)){
	$congp=$qcon['prac_group'];
	$cofst=$qcon['student']; 
	$concho=$qcon['choice'];
		}
		if($congp!=$pgp){
		echo"<td>Confirmed choice- ".$concho."</td><td>";
		echo"<font color=blue>Confirmed Group- ".$congp." </font><td>No Submit";
				}
		else{
		echo"<td>$ch</td><td><font color=red>Registered</font></td><form method=POST action='./pract.php?task=check&due=confirm'><td>";
		//echo"<a href='pract.php?task=check&sub=$sub&dgp=$pgrop&due=confirm&stnd=$stn&dated=$dt'>Confirm</a>";
		/////////////////////////////////////////////////////////////////////////////
		
		echo"<input type=hidden name=sub value='$sub'>";
		echo"<input type=hidden name=dgp value='$pgrop'>";
		echo"<input type=hidden name=stnd value='$stn'>";
		echo"<input type=hidden name=dated value='$dt'>";
		echo"<input type=submit value='Confirm'>";
		
		/////////////////////////////////////////////////////////////////////////////
		    }

}

else{
echo"<td>$ch</td><td><font color=red>Registered</font></td><form method=POST action='./pract.php?task=check&due=confirm'><td align=center>";
//echo"<a href='pract.php?task=check&sub=$sub&dgp=$pgrop&due=confirm&stnd=$stn&dated=$dt'>Confirm</a></td></tr>";
		/////////////////////////////////////////////////////////////////////////////
		
		echo"<input type=hidden name=sub value='$sub'>";
		echo"<input type=hidden name=dgp value='$pgrop'>";
		echo"<input type=hidden name=stnd value='$stn'>";
		echo"<input type=hidden name=dated value='$dt'>";

		echo"<input type=submit value='Confirm'>";

		/////////////////////////////////////////////////////////////////////////////


    }

		    }


elseif($stat=="Confirmed"){
echo"<td>$ch</td><td><font color=blue>Confirmed</font></td><form method=POST action='./pract.php?task=check&due=remove'><td align=center>";
//echo"<a href='pract.php?task=check&due=remove&sub=$sub&dgp=$pgrop&stnd=$stn&dated=$dt'>Remove</a>";
/////////////////////////////////////////////////////////////////////////////
		//echo"<form method=POST action='./pract.php?task=check&due=remove'>";
		echo"<input type=hidden name=sub value='$sub'>";
		echo"<input type=hidden name=dgp value='$pgrop'>";
		echo"<input type=hidden name=stnd value='$stn'>";
		echo"<input type=hidden name=dated value='$dt'>";
		echo"<input type=submit value='Remove'>";
		//echo"</form>";
		/////////////////////////////////////////////////////////////////////////////



	
			  }
echo"</td></form></tr>";
//echo$stn.$acy.$sem.$sj.$pgp.$dt.$tm.$hs.$ch.$stat."<br>";
	}	
echo"</table><br>";
}
else{
if($pgrop!=null){
echo"<font color=red>Sorry! There are no student found in this group.<br><br>";
}
}

				}







///...................master reset......................
if($task=="reset"){

echo"<br><h3>Do you really want Delete All Practical Details ? </h3><br>";
echo"<form name='yes' method='POST' action='pract.php?task=gcode&conf=confrm'>";
echo"<input type='submit' name='cbox' value='  YES  '>";
echo"<input type='submit' name='cbox' value='  NO  '>";
echo"</form>";
	

}
/// disp confremation massage..................
if($task=="gcode")
{
$conf=$_GET['conf'];
if($conf="confrm"){
	$cbox=$_POST['cbox'];
		if($cbox=="  YES  "){
			echo"<form name='mas_re' method='POST' action='pract.php?task=mreset'>";
			echo"<br><h3>Enter Master Reset Code:</h3> <input type='password' name='pwd' id='pwd'><input type='submit' name='recode' id='recode' value='Send'><input type='submit' name='cancel' id='cancel' value='Cancel'>";	
			echo"</form>";
				    }
		
	

		}
}
echo"</div>";
?>



<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>





