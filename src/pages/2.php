<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){


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
if($qpers['id']=="2"){
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



<script type="text/javascript" src="Ajax/comb_edit.js"></script>

<?php

echo "Subject Combination Modification <hr class='bar'><br>";
	
	$std_3=$_POST['std_2'];
		$std_2="hs".$std_3;

	
	$std_y=$_POST['std_y'];
	require_once('./classes/globalClass.php');
	$vr2=new settings();
	$level_st=$vr2->getLevel($std_2);
	$semi_st=$vr2->getSemister();
	$acc=$vr2->getAcc();
	
	//echo "Register courses for ";
	$ac_1=$acc;
	$semi_1=$semi_st;
	//echo $ac_1." Acedemic year and ";
	//echo $semi_1." Semester<br><br>";
	
	

	
	
	
	// Student Post Registration
	include 'forms/form_2.php';
	echo "<br>";
	



	//adding Data to the Database
	if($task=='post_register'){
	
	//////////////////////////////////////////////////////////////////////////////////////
	$getdue=$_GET['due'];
	if($getdue=="cngcmb"){
		$getcngsub1=$_POST['comb_cngsub1'];
		$getcngsub2=$_POST['comb_cngsub2'];		
		$getcngsub3=$_POST['comb_cngsub3'];	
		if(($getcngsub1==0)||($getcngsub2==0)||($getcngsub3==0)){
			echo"<br><font color=red>Please select the main subjects.</font>";
		}
		else{
		
			$setfulcmb="[$getcngsub1]+[$getcngsub2]+[$getcngsub3]";
		
		$queupsubcng="update student set combination='$setfulcmb' where id='$std_2' and batch='$std_y'";
		$quupsubcng=mysql_query($queupsubcng);
		if($quupsubcng){
			echo"<br><font color=blue>Subject changes are successfully appied !</font>";
		}
		else{
			echo"<br><font color=red>Sorry ! Can not apply. Please try again</font>";
		}
		
		}
		echo"<br><br>";
	}
	//////////////////////////////////////////////////////////////////////////////////////
					
	//////////////////////////////////////////////////
	/////////////////////////////////////////////////
	//////////////////////////////////////////////////
	///  User        Listing /////////////////////////
	//////////////////////////////////////////////////
	//////////////////////////////////////////////////	
			
	$query8_4="select s.id, s.l_name, s.initials,s.combination ,l.year, s.stream, l.level from student s, level l where s.id='$std_2' and s.year=l.year and l.year=s.year and s.batch='$std_y'";
	//echo$query8_4;
	$std_detail=mysql_query($query8_4);
	if(mysql_num_rows($std_detail)==0){
		echo"<br><font color=red>Sorry! Can not find Information.</font>";
	}
	else{
	while($data=mysql_fetch_array($std_detail)){
	echo "<font color=#656532><form method=post action='./index.php?view=admin&admin=2&task=post_register&due=cngcmb'>";
	echo"<table cellpadding='4' class=bgc border=0><tr><td rowspan='4' width=20%  align=center>";
	$stpic=$data['id'].".jpg";
			
						$picname="./../rumis/picture/user_pictures/student_std_pics/fohssmis_pic/$stpic";

						if(file_exists($picname)){
							echo"<image src='$picname' class='stretch' alt='' width=100px height=110px>";
								}
						else{
							echo "<img src=../../rumis/picture/user_pictures/student_std_pics/SCI_Fac_no_picture.png class='stretch' alt='' width=100px height=110px>";
									}
	
	
	


	$getcmbchngstno=substr($data['id'],2);
	
	echo "</td><td>Index No <td>: HS/".$data['year']."/".$getcmbchngstno;
	
	echo"<input type=hidden name='std_2' value='$std_3'><input type=hidden name='std_y' value='$std_y'>";
	
	echo "<tr><td>Name <td>: ".$data['l_name']." ".$data['initials'];
	echo "<tr><td>Level <td>: ".$data['level']."000";
	echo "<tr><td>Present Subjects<td>: ";
	///////////////////////////////////////////////////////////////////////////////
	
	$stcmb=$data['combination'];

	if($stcmb!="0"){
				$cmbval=explode("+",$stcmb);

	$rmopbckt=explode("[",$cmbval[0]);
		$rmclbkt=explode("]",$rmopbckt[1]);
	$puresubid1=$rmclbkt[0];

	$rmopbckt2=explode("[",$cmbval[1]);
		$rmclbkt2=explode("]",$rmopbckt2[1]);
	$puresubid2=$rmclbkt2[0];	
	
	$rmopbckt3=explode("[",$cmbval[2]);
		$rmclbkt3=explode("]",$rmopbckt3[1]);
	$puresubid3=$rmclbkt3[0];	
	
	
	
		$cnfcmsubone=$vr2->getmainsubject($puresubid1);
		$cnfcmsubtwo=$vr2->getmainsubject($puresubid2);		
		$cnfcmsubthree=$vr2->getmainsubject($puresubid3);

		$fullcnfcmb=$cnfcmsubone." / ".$cnfcmsubtwo." / ".$cnfcmsubthree;
		
		echo"<b>$fullcnfcmb</b>";
	}
	else{
		echo"-";
	}
	
	
	///////////////////////////////////////////////////////////////////////////////
	echo "<tr><td colspan=3 align=center>Modification of Subject combination";
	
	
	echo "<tr><td colspan=3 align=center>";	
	
///////888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888////////

$quegetmnsub="select * from main_subjects where status=1 order by sub_name";
//echo$quegetmnsub;	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	echo'<select name="comb_cngsub1" ><option value=0>Select Subject</option>';
	$qugetmnsub=mysql_query($quegetmnsub);
	while($qgetmnsub=mysql_fetch_array($qugetmnsub)){
		$getmnsub=$qgetmnsub['sub_name'];
		$getmnsubid=$qgetmnsub['sub_id'];

			echo"<option value=$getmnsubid>$getmnsub</option>";
				
	}	
	echo"</select>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	echo'+<select name="comb_cngsub2" ><option value=0>Select Subject</option>';
	$qugetmnsub2=mysql_query($quegetmnsub);
	while($qgetmnsub2=mysql_fetch_array($qugetmnsub2)){
		$getmnsub2=$qgetmnsub2['sub_name'];
		$getmnsubid2=$qgetmnsub2['sub_id'];

			echo"<option value=$getmnsubid2>$getmnsub2</option>";
				
	}	
	echo"</select>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	echo'+<select name="comb_cngsub3" ><option value=0>Select Subject</option>';
	$qugetmnsub3=mysql_query($quegetmnsub);
	while($qgetmnsub3=mysql_fetch_array($qugetmnsub3)){
		$getmnsub3=$qgetmnsub3['sub_name'];
		$getmnsubid3=$qgetmnsub3['sub_id'];

			echo"<option value=$getmnsubid3>$getmnsub3</option>";
			
	}	
	echo"</select>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	
	
	
	
	
	
	
	
	
	
	
	
///////888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888////////	

	echo "<tr><td colspan=3 align=center>";
		
		?><!-- php end -->
		<input type="submit" value="Apply Subject changes">
	
		
	<?php 			
	echo '</table></form></font>';

	}
	}
	

	
	
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

