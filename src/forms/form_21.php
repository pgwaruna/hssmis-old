<?php

$con21_9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

$query_21_e="select distinct course, date, hours from lecture where lecture_id= '$id'";
$ocee=mysql_query($query_21_e);
while($raw1=$data_21_8=mysql_fetch_array($ocee)){
echo '<br><font color="brown">Add Attendence for '.$raw1['course'].' @ '.$raw1['date'].' / ( 0'.$raw1['hours'].' Hours Lecture ) </font><br><br>';
}




$query_21_8="select distinct r.student, s.l_name, s.year, s.initials from registration r, lecture l, student s where s.id=r.student and l.lecture_id = '$id' and l.course=r.course ";
$oce=mysql_query($query_21_8);

echo '<br> Select and Submit Data from list Below | Lecture ID = '.$id.'<hr color=#E1E1F4 width=95%>';						
$i=1;
while($data_21_8=mysql_fetch_array($oce)){
echo '<form method="POST" action="index.php?view=admin&admin=21&task2=dailyAtt&submiting=ok&data=input&id='.$id.'">';
echo '<p align=left>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
echo '<font color="#800000">SC/'.$data_21_8['year'].'/'.$data_21_8['student'].'&nbsp;&nbsp;'.$data_21_8['l_name'].'&nbsp;&nbsp;'.$data_21_8['initials'].'</font>';
echo ' ( Present ) <input type="checkbox" checked="checked" name="'.$i.'" value="'.$data_21_8['student'].'">';

echo '</p>';
$i++;
}
$count_value=$i;
echo '<input type="hidden" name="count_val" value="'.$count_value.'">';
echo '<input type="hidden" name="lect_id" value=" '.$id.' ">';

echo '&nbsp;<br><input type="submit" value="Add Attendence" name="att_submit">';
echo '</p></form>';
mysql_close($con21_9);
?>