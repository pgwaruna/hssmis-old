<script type="text/javascript"> 

var win=null;
function viewWindow(mypage1,myname,w,h,scroll,pos){
if(pos=="random"){LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
if(pos=="center"){LeftPosition=(screen.width)?(screen.width-w)/2:100;TopPosition=(screen.height)?(screen.height-h)/2:100;}
else if((pos!="center" && pos!="random") || pos==null){LeftPosition=0;TopPosition=20}
settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
win=window.open(mypage1,myname,settings);}
</script>

<?php
include'./admin/config.php';	
$dept_id=$_SESSION['section'];
if($_GET['task8']!=attendence)	{		

									
$con21_1=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
			
$query_21_8="select distinct semister from level";
$attL=mysql_query($query_21_8);
while($find_semiL=mysql_fetch_array($attL)){
$find_L=$find_semiL['semister'];
}

if($find_L==1)
$query_21_1="select code, name, department from courseunit where (semister=1 or semister=3) and availability=1 order by code,name";
elseif($find_L==2)
$query_21_1="select code, name, department from courseunit where (semister=2 or semister=3) and availability=1 order by code,name";
$att=mysql_query($query_21_1);
echo "<font>You have following subjects view Attendence </font>";
echo '<hr class=bar><table>';
while($attdata=mysql_fetch_array($att)){
echo '<tr class="trbgc"><td align="left"><a href="index.php?view=admin&admin=34&attdisp=displayatt&sub='.$attdata['code'].'&task8=attendence" ';
?>
onclick="viewWindow(this.href,'mywin','860','600','yes','center');return false";
<?php 
echo ">".strtoupper($attdata['code'])."</a><td>".$attdata['name'];
}
mysql_close($con21_1);
echo "</table>";
}
		
	
						

// View attendences Available
$task8=$_GET['task8'];
if($task8=='attendence'){

echo "View Registered Students <hr class=bar>";
echo '<p>Close This Window <a href="javascript:window.close()"><img border="0" src="images/small/emblem-nowrite.png"></a>';						
	
$sub_21=$_GET['sub'];

echo "<br><font color=red>Current Registration of ".$sub_21." Course Unit</font><br />";

////////////////////////////
////////////////////////////


	$con9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
	
	
	echo '<table>';

/////////////////////////

	$query_21_8="select distinct r.student, s.l_name, s.initials, s.year from registration r, student s where s.id=r.student and r.course = '$sub_21' and r.confirm=1 order by r.student";
  	$oce=mysql_query($query_21_8);
	while($data2=mysql_fetch_array($oce)){
		$stno4vw=$data2['student'];
		$lstdigts= substr("$stno4vw",2);
		
	echo '<tr class="trbgc">';
	echo "<td>".$data2['l_name']." ".$data2['initials']."<td>HS/".$data2['year']."/".$lstdigts;
	$student_select=$data2['student'];
	/// Student Registration Information
	
	
		
	// End Student Registration Information	
	
	}
	
	
	echo "</table>";


    $query_21_9="select count(distinct r.student) from registration r, student s where s.id=r.student and r.course = '$sub_21' and r.confirm=1";
  	$oce2=mysql_query($query_21_9);
	while($data3=mysql_fetch_array($oce2)){
    echo '<br /> <font color="green">Number of Students Register : <b>';
    echo $student_select=$data3['count(distinct r.student)'];
    echo '</b></font>';
    }





////////////////////////////
////////////////////////////
}
						
						
						

?>