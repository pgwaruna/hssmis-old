<head><script>
<!-- 	
<!-- Begin
function AllCheck(chkbx)
{

	for (i = 0; i < chkbx.length; i++)
	chkbx[i].checked = true ;
}

function AllUnCheck(chkbx)
{
for (i = 0; i < chkbx.length; i++)
	chkbx[i].checked = false ;
}
//  End -->
</script></head>







<?php
$id=$_GET['id'];
$con21_9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

//...............edit by iranga....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
//.................................................	



$query_21_e="select distinct course, date, hours from lecture where lecture_id= '$id'";
$ocee=mysql_query($query_21_e);
while($raw1=$data_21_8=mysql_fetch_array($ocee)){
echo '<br><font color="brown">Add Attendence for '.$raw1['course'].' @ '.$raw1['date'].' / ( 0'.$raw1['hours'].' Hours Lecture ) </font><br><br>';
}


$fmviweque="rumisdb.fohssmisStudents fs";

$query_21_8="select distinct r.student, s.l_name, s.year,s.batch, s.initials from registration r, lecture l, student s, $fmviweque where s.id=r.student and l.lecture_id = '$id' and l.course=r.course and r.acedemic_year='$acy'  and r.confirm='1' and r.student=fs.user_name order by r.student";
$oce=mysql_query($query_21_8);

echo '<br> Select and Submit Data from list Below | Lecture ID = '.$id.'<hr class=bar>';						
$i=1;



echo '<form   name="attform"  method="POST" action="index.php?view=admin&admin=28&attdisp=displayatt&task2=dailyAtt&submiting=ok&data=input&id='.$id.'">';




?>

<!--<input type="button" name="Check_All" value="Check All" onClick="AllCheck(document.attform.name_list)">
<input type="button" name="Un_CheckAll" value="Uncheck All" onClick="AllUnCheck(document.attform.name_list)">	
-->

<?php


echo '<table border="1" color="#A550B2" cellspacing="0" cellpadding="1">';
echo"<tr><th>#<th>Name with Initials<th>Student Number<th>Status</tr>";
while($data_21_8=mysql_fetch_array($oce)){
echo '<tr align=center><td>'.$i.'<td align=left>&nbsp;'.$data_21_8['l_name'].'&nbsp;'.$data_21_8['initials'].'<td align=center>';

$tmpstno=$data_21_8['student'];
	$stprmtnum=$vr28->getStudentNumber($tmpstno); 
	
		echo$stprmtnum;

echo '<td> <input type="checkbox"  id="name_list" name="'.$i.'" value="'.$data_21_8['student'].'">';

$i++;
}
$count_value=$i;
echo '<tr><input type="hidden" name="count_val" value="'.$count_value.'">';
echo '<input type="hidden" name="lect_id" value=" '.$id.' ">';

echo '<td height="30px" colspan="4"><center><input type="submit" value="Submit List into Database" name="att_submit"></center>';
echo '</form>';
echo '</table>';
mysql_close($con21_9);
?>
