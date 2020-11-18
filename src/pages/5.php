<?php

echo "Current Academic Session Management<hr class=bar><br>";
//$con7=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
//mysql_select_db($db);
						

//////////// Current Semester Notify

if(($task=='current')&&(isset($_POST['submit']))){

$acc_year_cur=$_POST['acc_year_cur'];
$sem_5=$_POST['sem_5'];
$semi_up1=mysql_query("update level set semister='$sem_5'");
$semi_up2=mysql_query("update acc_year set current=0 where current=1");
$semi_up3=mysql_query("update acc_year set current=1 where acedemic_year='$acc_year_cur'");

if($semi_up1){
//echo 'Semester Updated...';
}
}


//////////// End Current Semester /////////////


///////// Level Updating /////////////////


if(($task=='year')&&(isset($_POST['submit']))){
$sem_5=1;
$level1_5=$_POST['level1_5'];
$level2_5=$_POST['level2_5'];
$level3_5=$_POST['level3_5'];
$level4_5=$_POST['level4_5'];
$level0_5=$_POST['level0_5'];

					
$a=mysql_query('delete from level');
$b=mysql_query("insert into level values('$level1_5','$sem_5',1)");
$c=mysql_query("insert into level values('$level2_5','$sem_5',2)");
$d=mysql_query("insert into level values('$level3_5','$sem_5',3)");
$e=mysql_query("insert into level values('$level4_5','$sem_5',4)");
$a=mysql_query("insert into level values('$level0_5',$sem_5,0)");

}



/////// End Level Updating /////////



						
// Increase Current Session
						
if(($task=='semister')&&(isset($_POST['submit']))){

$acc_year_val=$_POST['acc_year_val'];
$st_date=$_POST['st_date'];
$en_date=$_POST['en_date'];
$current=$_POST['current_acc'];

$e=mysql_query("insert into acc_year values('$acc_year_val','$st_date','$en_date','$current')");

}


						
////// Display Available Level Session
								
$query5_2="select * from level";
$level_details=mysql_query($query5_2);
echo '<table border="0"align="center"><tr><th>Starting Year<th>Current Level<th>Semester</tr>';
while($data=mysql_fetch_array($level_details)){
echo "<tr class=trbgc><td align=center>".$data['year']."<td align=center>".$data['level']."<td align=center>".$data['semister'];
echo "</tr>";
}
echo "</table><br />";
						

////// Display Accademic Session

$query5_3="select * from acc_year order by acedemic_year DESC";
$acc_details=mysql_query($query5_3);
echo '<table border="0" align="center"><tr><th>Academic  Year<th>Starting Date<th>Ending Date<th>Status</tr>';
while($data2=mysql_fetch_array($acc_details)){
echo "<tr class=trbgc><td align=center>".$data2['acedemic_year']."<td align=center>".$data2['starting_date']."<td align=center>".$data2['ending_date']."<td align=center>";
if($data2['current']==0){
echo "Finished";
}
elseif($data2['current']==1){
echo "Currently Running";
}
elseif($data2['current']==2){
echo "Next or Future";
}
echo "</tr>";
}
echo "</table><br />";
echo "<hr class=bar>Create New Academic  Sessions<hr class=bar><br>";

include 'forms/form_5b.php';

echo "<hr class=bar> Current Academic  Semester <hr class=bar><br>";

include 'forms/form_5a.php';

echo "<hr class=bar> Current Level of Students <hr class=bar><br>";

include 'forms/form_5c.php';


						
?>