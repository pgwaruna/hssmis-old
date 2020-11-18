<?php
session_start();
if(isset($_SESSION['login'])=="truefohssmis"){
?>



<?php
//error_reporting(0);
//..................Edit by Iranga..................
//.................to get compleated attendence sheet progress...........
echo"<a href='index.php?view=admin&admin=36'><img border='0' src='images/small/back.png'></a>";

include 'admin/config.php';
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}

$query1_1="select semister from call_registration";
$prev=mysql_query($query1_1);
while($predata=mysql_fetch_array($prev)){
$semi=$predata['semister'];
}

$att="select l.course, count(l.lecture_id) as lec_No, c.department from lecture l, courseunit c where l.course=c.code and (c.semister=$semi or c.semister=3) and l.acc_year='$acy' group by l.course";
$att_p=mysql_query($att);


echo "<table border='0' style='font-size:12px'>";
echo "<tr bgcolor='#E1E1F4'><th><font color='blue'>Course Unit<th><font color='blue'>No Of Lecture IDs<th><font color='blue'>Department<th><font color='blue'>Total Registered Student<th><font color='blue'>Attendance Progress<br>(<font color=#56788a> Date...Time...<font color='blue'>Type</font>--</font><font color=#a860c6>Total Participate Student--<font color='red'>Presentage</font>)<th><font color='blue'>Average Presentage</th></tr>";

while ($ap=mysql_fetch_array($att_p))
{
$cu=$ap['course'];
$ids=$ap['lec_No'];
echo "<tr bgcolor='#E1E1F4'><td><font color='#074464'><b>".$cu."</b></font><td align='center' ><font color='#2b5ebc'>".$ids."</font><td><font color='#2b5ebc'>".$ap['department']."</font>";


		
$chart="select count(student) as tot  from registration where course='$cu' and confirm='1'and acedemic_year='$acy'"; //total no of student
//echo$chart;
$tot=mysql_query($chart);
$totofCource;
while ($to=mysql_fetch_array($tot)){
echo "<td align='center'><font color='#2b5ebc'>".$to['tot']."</font><td>";
$totofCource=$to['tot'];
}
$lec="select * from lecture where course='$cu' and acc_year='$acy'" ;//lecture ids
$l_id=mysql_query($lec);
$av=0;
while ($le=mysql_fetch_array($l_id)){
$l=$le['lecture_id'];

$date=$le['date'];
$dt= explode("-", $date);
$dm=$dt[1];
$dd=$dt[2];

$time=$le['time'];
$tm=explode(":", $time);
$th=$tm[0];
$tmi=$tm[1];

$type=$le['type'];
if($type=='lecture')
{$tp="L";}
elseif($type=='practical')
{$tp="P";}
elseif($type=='tute')
{$tp="T";}
else
{$tp="X";}

$nu=$le['no_id'];
echo "<font color=#56788a> {".$dm."-".$dd.",".$th.":".$tmi."-<font color='blue'>".$tp."</font>}</font>";

$st_pt="select count(status)as no from participation where lect_id='$l'";//no of student participation
$st=mysql_query($st_pt);

while ($s=mysql_fetch_array($st)){
$sn=$s['no'];
//echo "<td>";
if ($totofCource!=0){
$pe=($sn/$totofCource)*100;
$avp=($pe+$av);
$av=$avp;
}
else{
$pe=0;
$avp=0;
$av=0;


}



}
echo "-<font color=#a860c6>".$sn."</font>--<font color='red'>".round($pe,1)."%</font>  |";
if($ids!=0){
$av_pr=$av/$ids;
}
else{
$av_pr=0;
}
}
echo "<td align='center'><font color='#3b15e0'><b>".round($av_pr,2)."%</b></font>";

echo "</tr>";





}//main while
echo "</font></table>";

?>



<?php
}
else{
echo "You Have Not Permission To Access This Area!";}
?>



