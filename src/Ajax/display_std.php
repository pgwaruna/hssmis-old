<?php

	$course2=$_GET['course5'];
	$lid=$_GET['lid'];
	
     include '../admin/config.php';
     $con2_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);
//...............edit by iranga....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
//.................................................

$fmviweque="rumisdb.fohssmisStudents fs";
$query1="SELECT distinct r.student as std FROM registration r, $fmviweque WHERE r.course = '$course2'
 and r.acedemic_year='$acy' and r.confirm='1' and concat('sc',r.student)=fs.user_name and r.student not in (SELECT student FROM participation where lect_id = '$lid') order by r.student";
$prev1=mysql_query($query1);
	
echo '<h4>List of Absent Students For This Lecture</h4>';
				
require_once('../classes/globalClass.php');	
$k=new settings();
if(mysql_num_rows($prev1)!=0){
    $mrw=1;
echo '<table border="1" cellspacing="3" cellpadding="0" bordercolor="#000000" bgcolor="#FDFFFF" style="border-collapse: collapse">';		
while($iddata3=mysql_fetch_array($prev1)){

echo '<tr><td align=center>'.$mrw;
echo '<td width="260px">&nbsp;&nbsp;'.$semi=$k->getName($iddata3['std']);
echo '&nbsp;&nbsp;<td width="200px" align=center>SC/'.$semi=$k->getBatch($iddata3['std']).'/'.$iddata3['std'];
$stu2=$iddata3['std'];
?>
<td width="220px" align="center">&nbsp;&nbsp;&nbsp;<input type="submit" value="Add Medical" onclick="this.disabled=true;medical('<?php echo $stu2; ?>','<?php echo $lid; ?>')">
<?php
echo '<img style="visibility: hidden" id="'.$stu2.'-img" src="images/ajax-loader.gif">';
echo '<div id="'.$stu2.'-div"></div>';
$mrw++;
}
}
else{
    echo"<font color=red>Sorry! No Absent Student Found for This Lecture</font>";
}


//sleep(1);
?>
