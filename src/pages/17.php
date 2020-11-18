<?php
include'./admin/config.php';
	$dept_17=$_SESSION['sec'];
	$sub_17=$_GET['sub'];
					
	echo "Course unit Attendence ".$dept_17." Department <hr color=#E1E1F4 width=95%><br>";
						
	// Selecting Courses
						$con17_1=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						
						$query_17_8="select distinct semister from level";
						$attFD=mysql_query($query_17_8);
						while($find_semiD=mysql_fetch_array($attFD)){
						$find_SD=$find_semiD['semister'];
						}
						

						
						$query_17_1="select code, name from courseunit where department='$dept_17' and semister='$find_SD'";
						$att=mysql_query($query_17_1);
						echo "<font color=#006699>You have following subjects to modify attendence</font><table>";
						while($attdata=mysql_fetch_array($att)){
						echo '<tr align="left"><td><a href="index.php?view=admin&admin=17&sub='.$attdata['code'].'&task=attend">'.strtoupper($attdata['code'])."</a><td>".$attdata['name'];
						}
						mysql_close($con17_1);
						echo "</table>";
						
						
						// Modifying Eligible of Depertment
						$id_17=$_GET['id'];
						if($task=='eligble'){
						$con17_2=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						$query_17_2="update attendence set eligibility=1 where course='$sub_17' and id='$id_17'";
						$cha=mysql_query($query_17_2);
						mysql_close($con17_2);				
						}
						
						
						// View Attendence of subject
						if($task=='attend'){
						
						echo "<br><br>Modify Subject ".strtoupper($sub_17)." Attendence";
						$con17_3=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						$query17_3="select a.id, a.course, a.student, a.eligibility from attendence a, courseunit c where a.course=c.code and c.department='$dept_17' and a.course='$sub_17'";
						$att_7=mysql_query($query17_3);
						echo '<br><br><table border="1"  bordercolor="#993366"><tr><th>code</th><th>Student</th><th>Eligibility</th><th>Accept reasons</th></tr>';
						while($data=mysql_fetch_array($att_7)){
						echo '<tr>';
						echo "<td>".strtoupper($data['course'])."<td>".$data['student']."<td>";
						if(($data['eligibility'])==1){
						echo "Eligible";
						}
						elseif(($data['eligibility'])==0){
						echo "Not Eligible";
						}
						echo '<td><a href=index.php?view=admin&admin=17&sub='.$sub_17.'&task=eligble&id='.$data['id'].'>Accept</a></tr>';
						}
						echo '</table>';
						mysql_close($con17_3);

						}

?>