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
echo$qpers['role_id'];
$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="30"){
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


















<script type="text/javascript" src="./Ajax/att_edit.js"></script>
<script type="text/javascript" src="./Ajax/lect_mod.js"></script>
<!--//////////////////////////////////////insert by iranga for prct grp////////////////////////////////////-->	
<script type="text/javascript" src="./Ajax/displayGrp.js"></script>
<!--//////////////////////////////////////insert by iranga for prct grp////////////////////////////////////-->	




<head>

<script language="javascript" src="style/calendar/calendar.js"></script>


<?php
include'./admin/config.php';
require_once('classes/attClass.php');	

//////////////edit by iranga ////////////////////////////////////////////////////
require_once('./classes/globalClass.php');
$vr30=new settings();
/////////////////////////////////////////////////////////////////////////////////	

$role=$_SESSION['role'];									
$dept_id=$_SESSION['section'];
$rltduser=$_SESSION['user_id'];	

echo "Edit Daily Attendence <hr class=bar>";

mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
//...............edit by iranga....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
//.................................................


if( (($_GET['task12'])!='modifyData') && (!(isset($_GET['id']))) && (!(isset($_GET['modify_id']))) && (!(isset($_GET['remove_id']))) ){
$dept_17=$_SESSION['section'];									
$lec_id=$_SESSION['user_id'];
						
$con21_1=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
	


$query_21_8="select distinct semister from level";
$attL=mysql_query($query_21_8);
while($find_semiL=mysql_fetch_array($attL)){
$find_L=$find_semiL['semister'];
}

//////////////------------------------------------------------------------------------------------------------------------------------/////////////////

if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
$query_21_1="select code, name from courseunit where availability=1 and (semister=$find_L or semister=3) order by code,name";
                                                                    }
elseif(($role=="general")||($role=="office")){
$query_21_1="select code, name from courseunit where department='$dept_id'  and availability=1 and (semister=$find_L or semister=3)  order by code,name";
}
else{
$query_21_1="select code, name from courseunit where (coordinator='$rltduser' or lecturers LIKE '%[$rltduser]%')   and availability=1 and (semister=$find_L or semister=3)  order by code,name";	
}

//////////////------------------------------------------------------------------------------------------------------------------------/////////////////


$att=mysql_query($query_21_1);
echo "You have following subjects to edit Attendence";
if(mysql_num_rows($att)!=0){
	$cutbl=1;	
echo"<table><th>#<th>Course Unit<th>Course Name";
while($attdata=mysql_fetch_array($att)){
         $allcose=$attdata['code'];
    
 		$coursegetchr=trim($allcose);
                 
  $fulcode3=strtoupper($coursegetchr);         
    
    
    
echo '<tr align="center"  class="trbgc" height="25px"><td>'.$cutbl.'<td><a href="index.php?view=admin&admin=30&sub='.$attdata['code'].'&task12=modifyData">'.$fulcode3."</a><td align=left> &nbsp;".ucfirst($attdata['name']);
$cutbl++;
}
mysql_close($con21_1);
echo "</table>";
}
else{
    echo"Sorry! can not find course units for this semester";
}
}
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
/////////////////PART 2////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
 
 if(($_GET['task12'])=='modifyData'){
 echo"<a href='index.php?view=admin&admin=30'>&nbsp;<img border='0' src='images/small/back.png'><br>&nbsp;Go Back&nbsp;</a><br><br>";
 echo $_GET['sub']." - Entered Lecture Sessions<br /><br />";
 $subject=$_GET['sub'];
 
$con_30=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
			
$query_31="SELECT lecture_id, type, date, hours, att_group, time FROM lecture WHERE course = '$subject' and  acc_year='$acy' order by date,time,lecture_id";

    $oce1=mysql_query($query_31);
    if(mysql_num_rows($oce1)!=0){
    echo '<table border="0" width=80%><tr><th> L ID <th> Type<th> Date <th> Time <th> Hours <th>Group <th> Change<th> Modify <th> Remove';
    while($data2=mysql_fetch_array($oce1)){
	echo '<tr class=trbgc><td align=center>'.$data2['lecture_id'];
	echo '<td align=center>'.ucfirst($data2['type']).'<td align=center>';
	echo $data2['date'].'<td align=center>';
	echo $data2['time'].'<td align=center>'.$data2['hours'];
	if($data2['att_group']!="nogrp"){
	echo"<td align=center>".$data2['att_group'];
									}
	else{
	echo"<td align=center>-";
		}
	echo '<td align=center><a href="index.php?view=admin&admin=30&id='.$data2['lecture_id'].'">Chg. Att. </a>' ;
	echo '<td align=center><a href="index.php?view=admin&admin=30&modify_id='.$data2['lecture_id'].'">Mod. </a>' ;
    echo '<td align=center><a href="index.php?view=admin&admin=30&remove_id='.$data2['lecture_id'].'">Remove </a>' ;

	
	}

    echo '</table>';
    }
    else{
        echo"<font color=red>Sorry! No any Lecture Sessions found for this course unit</font>";
    }
 }

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$lect_edit=$_GET['modify_id'];

if(isset($lect_edit)){	

    $k=new attendence();
	echo $sub=$k->getSubject($lect_edit);
	echo ' ';
	echo "&nbsp;|&nbsp;Date : ".$k->getLectDate($lect_edit)."&nbsp;|&nbsp;&nbsp;Time : ".$k->getLectTime($lect_edit)."&nbsp;|&nbsp;&nbsp;Type : ".$k->getLectType($lect_edit)."&nbsp;|&nbsp;&nbsp;Hours : ".$k->getLectHours($lect_edit);
	echo '<br /> Total Present Students :  <font color=red> || '.$k->countPre($lect_edit).'  ||</font> Number of Registered Students : <font color=green>'.$k->countStd($sub,$acy).'</font></br >';
	//echo '</br >';
    $lecture_date=explode('-',$k->getLectDate($lect_edit));
	echo "<a href='index.php?view=admin&admin=30&sub=$sub&task12=modifyData'><img border='0' src='images/small/back.png'><br>&nbsp;Go Back&nbsp;</a><br><br>";
?>



</head>

<div id="modify_lect_info" align="center">


<table border="0" width="34%">
<tr>
		<td rowspan="3" width="26%" align="center">


	<?php

require_once('style/calendar/classes/tc_calendar.php');

	  $myCalendar = new tc_calendar("date2");
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate($lecture_date[2],$lecture_date[1],$lecture_date[0]);
	  $myCalendar->setPath("style/calendar/");
	  $myCalendar->setYearInterval(2010, 2012);
	  $myCalendar->dateAllow('2010-12-01', date("Y-m-d"), false);
	  $myCalendar->startMonday(true);
	  //$myCalendar->disabledDay("Sat");
	  //$myCalendar->disabledDay("sun");
	  $myCalendar->writeScript();


  
	  ?>
	
	
	
	</td>
		<td rowspan="2" width="16%" align="center"> 
		<p align="center"> <select size="10" name="time" id="time">
	<option value="08:00">08:00 AM</option>
	<option value="09:00" selected>09:00 AM</option>
	<option value="10:00">10:00 AM</option>
	<option value="11:00">11:00 AM</option>
	<option value="12:00">12:00 PM</option>
	<option value="13:00">13:00 PM</option>
	<option value="14:00">14:00 PM</option>
	<option value="15:00">15:00 PM</option>
	<option value="16:00">16:00 PM</option>
	<option value="17:00">17:00 PM</option>
	</select></td>
		<td width="17%" align="center"> 
	<select size="4" name="hours" id="hours">
	<option value="1">1 Hours</option>
	<option value="2" selected>2 Hours</option>
	<option value="3">3 Hours</option>
	<option value="4">4 Hours</option>
	</select></td>
		<tr>
		<td width="17%" align="center"> 
	<select size="6" name="type2" id="type2" onclick="displayGrp2()">
	<option selected value="lecture">Lecture</option>
	<option value="tute">Tutorial</option>
	<option value="practical">Practical</option>
	<option value="assignment">Assignment</option>
	<option value="field">Field Visit</option>
	<option value="other">Other</option>
	</select></td>
	
	<!--//////////////////////////////////////insert by iranga for prct grp////////////////////////////////////-->	
	<td align="center">	
	<img style='visibility: hidden' id='loadergp' src='images/ajax-loader.gif'>
	<div id="dispgrp" name="dispgrp">
		<select size="1" name="swgrp" id="swgrp" >
		<option value="nogrp" selected >No Group</option>
	</select>
	</div>
	</td>
<!--//////////////////////////////////////insert by iranga for prct grp////////////////////////////////////-->	
	
	
	
	
	
	
	
	
		<tr>
		<td width="63%" align="center" colspan="2"> <input type=hidden id="subject_name" name="subject_name" value=<?php echo $sub_21; ?> >
		<input type="button" id="button_mod" name="button_mod" value="Modify Lecture ID" onclick=this.disabled=true;modify(<?php echo $lect_edit; ?>)>
	<img style='visibility: hidden' id='loader2' src='images/ajax-loader.gif'>
	

	
</td>
		<tr><td colspan=3>	
</table>









</div>










<?php


}


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////


$lect_rm_edit=$_GET['remove_id'];

if(isset($lect_rm_edit)){	

    $k=new attendence();
	
	echo $sub=$k->getSubject($lect_rm_edit);
	echo ' ';
	echo "&nbsp;|&nbsp;Date : ".$k->getLectDate($lect_rm_edit)."&nbsp;|&nbsp;&nbsp;Type : ".$k->getLectType($lect_rm_edit)."&nbsp;|&nbsp;&nbsp;Time : ".$k->getLectTime($lect_rm_edit)."&nbsp;|&nbsp;&nbsp;Hours : ".$k->getLectHours($lect_rm_edit);
	echo '<br /> Total Present Students :  <font color=red> || '.$k->countPre($lect_rm_edit).'  ||</font> Number of Registered Students : <font color=green>'.$k->countStd($sub,$acy).'</font></br >';
	echo '</br >';
	
	echo "<a href='index.php?view=admin&admin=30&sub=$sub&task12=modifyData'><img border='0' src='images/small/back.png'><br>&nbsp;Go Back</a><br>";
?>

<div id="remove_lect_info">
&nbsp;<p><font color="#FF0000"><span style="font-size: 15pt">Are You Sure that 
you remove Lecture ID and All entered Attendances ?</span></font><br>
</p>
<form id="remove_lect">

	&nbsp;<input type="button" id="button_rem" value="Remove Everything" onclick="remove2(<?php echo $lect_rm_edit; ?>)">
	<img style='visibility: hidden' id='loader2' src='./images/ajax-loader.gif'>
</form>

</div>


<p>&nbsp;</p>
<p>Note :&nbsp; If you not wish to remove lecture ID and all entered 
attendances, Go to back page. </p>



<?php


}


///////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////




					
	
$k=new attendence();
$back=$_GET['back'];

$lect_id_edit=$_GET['id'];

if(isset($lect_id_edit)){	
	///////////////////////////////////////////////
	//////////// Get Subject ID from lect id //////
	///////////////////////////////////////////////
	

	$k=new attendence();
	echo $sub=$k->getSubject($lect_id_edit);
	echo ' -';
	echo "&nbsp;|&nbsp;Date : ".$k->getLectDate($lect_id_edit)."&nbsp;|&nbsp;&nbsp;Time : ".$k->getLectTime($lect_id_edit)."&nbsp;|&nbsp;&nbsp;Type : ".$k->getLectType($lect_id_edit)."&nbsp;|&nbsp;&nbsp;Hours : ".$k->getLectHours($lect_id_edit);
	echo '<br /><br /><table border="0"><tr><td>';
	
	echo 'Total Present Students :  <td width=100px><font color=red><div id="count_now"> || '.$k->countPre($lect_id_edit).' || </div></font>';

	if($back=="f28"){
	echo "<td rowspan='2' width=120px align='center'><a href='javascript:window.close()'><img border='0' src='images/small/emblem-nowrite.png'></a>";
	echo '<td rowspan="2" width=120px align="center"><a href="#" onclick="window.location.reload()"><img border="0" src="images/small/edit-redo.png"></a>';
	echo '<tr><td> Number of Registered Students : <td><font color=green>'.$k->countStd($sub,$acy).'</font><tr><td>&nbsp;<td>&nbsp;<td align="center">Close This Window<td align="center"> Reload This Page</table >';
	echo "<hr class=bar><br />";
			}
	else{
	echo "<td rowspan='2' width=120px align='center'><a href='index.php?view=admin&admin=30&sub=$sub&task12=modifyData'><img border='0' src='images/small/back.png'></a>";
	echo '<td rowspan="2" width=120px align="center"><a href="#" onclick="window.location.reload()"><img border="0" src="images/small/edit-redo.png"></a>';
	echo '<tr><td> Number of Registered Students : <td><font color=green>'.$k->countStd($sub,$acy).'</font><tr><td>&nbsp;<td>&nbsp;<td align="center"> Go Back<td align="center"> Reload This Page</table >';
	echo "<hr class=bar><br />";

}
    

						
	
	///////////////////////////////////////////////
	///////////////////////////////////////////////
	///////////////////////////////////////////////
	
	
	
	echo '<table bordercolor="#006600" border="1">';
    $fmviweque="$rmsdb.fohssmisStudents fs";
	$query_21_8="select distinct r.student, concat(s.l_name,s.initials) as s_name, s.batch from registration r, student s, $fmviweque where s.id=r.student and r.course = '$sub' and r.acedemic_year='$acy' and r.confirm='1' and r.student=fs.user_name  order by r.student";
  
  	$oce=mysql_query($query_21_8);
  	$c=1;
	echo"<tr><th>#<th>Name with Initials<th>Student Number<th>Status</tr>";
	while($data2=mysql_fetch_array($oce)){
	echo '<tr>';
	echo "<td>".$c."<td>".$data2['s_name']."<td align=center>";
	$tmpstno3=$data2['student'];
		$stprmtnum3=$vr30->getStudentNumber($tmpstno3); 
	
		echo$stprmtnum3;
	
	
	//SC/".$data2['batch']."/".strtoupper($data2['student']);
	
	$student_select=$data2['student'];
	$c++;
	
	//////////////////////////////////////////////////
	//////////////////////////////////////////////////
	//////////////////////////////////////////////////
	echo '<td>';
	///echo '&nbsp;&nbsp;';
	//echo '<div id=".$lect_id_edit.'-att-'.$student_select.">';
    $status5=$k->getAtt($lect_id_edit, $student_select);
	if($status5=='2'){
	echo '<img src=images/med.png><font color=#green>Medical</font>';
	}
	elseif(
	$status5=='3'){
	echo '<img src=images/excu.png><font color=#green>Excuse</font>';
	}


	else{
	echo '<div id="'.$lect_id_edit.'-att-'.$student_select.'">'.$status5=$k->getAtt($lect_id_edit, $student_select);
	if(($status5==0)|| ($status5==1)){
	echo '&nbsp;&nbsp;<img src="images/conf.png" id="'.$lect_id_edit.'-img-'.$student_select.'" onclick=changeAtt('.$lect_id_edit.',"'.$student_select.'",'.$status5.')></div>';
	}
	}
   // echo '</div>';
    //////////////////////////////////////////////////
    //////////////////////////////////////////////////
    //////////////////////////////////////////////////


	
	
	// End Student Registration Information	
	
	}
	echo '</table>';
	
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

