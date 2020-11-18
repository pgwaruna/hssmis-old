<?php
include'./admin/config.php';
$sub_18=$_GET['sub'];
							
						echo "Course unit Attendece view and Modification <hr class=bar><br>";
						
						// Modifying Eligible of Faculty
						$id_18=$_GET['id'];
						if($task=='eligble'){
						$con18_2=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						$query_18_2="update attendence set eligibility=1 where course='$sub_18' and id='$id_18'";
						$cha=mysql_query($query_18_2);
						mysql_close($con18_2);				
						}
						
						
						// View Attendence of subject
						if($task=='attend'){
						
						echo "<br><br>Modify Subject ".strtoupper($sub_18)." Attendence";
						$con18_3=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						$query18_3="select a.id, a.course, a.student, a.eligibility from attendence a, courseunit c where a.course=c.code and a.course='$sub_18'";
						$att_8=mysql_query($query18_3);
						echo '<br><br><table border="1"  bordercolor="#993366"><tr><th>code</th><th>Student</th><th>Eligibility</th><th>Accept reasons</th></tr>';
						while($data=mysql_fetch_array($att_8)){
						echo '<tr>';
						echo "<td>".strtoupper($data['course'])."<td>".$data['student']."<td>";
						if(($data['eligibility'])==1){
						echo "Eligible";
						}
						elseif(($data['eligibility'])==0){
						echo "Not Eligible";
						}
						echo '<td><a href=index.php?view=admin&admin=18&sub='.$sub_18.'&task=eligble&id='.$data['id'].'>Accept</a></tr>';
						}
						echo '</table>';
						echo '<br><a href="index.php?view=admin&admin=18"> Go to Back page ( Course list )</a>';

						mysql_close($con18_3);
						}
						
						else{
						// Selecting Courses
						$con18_1=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						
						$query_18_8="select distinct semister from level";
						$attF=mysql_query($query_18_8);
						while($find_semi=mysql_fetch_array($attF)){
						$find_S=$find_semi['semister'];
						}
						
						$query_18_1="select code, name from courseunit where semister='$find_S' and availability=1 order by code,name";
						$att=mysql_query($query_18_1);
						echo "<font color=#006699>You have following subjects to modify attendence</font><table border=0>";
						while($attdata=mysql_fetch_array($att)){
						echo '<tr class="trbgc"><td align="center" ><a href="index.php?view=admin&admin=18&sub='.$attdata['code'].'&task=attend"> '.strtoupper($attdata['code'])."</a><td>".$attdata['name'];
						}
						mysql_close($con18_1);
						echo "</table>";
						}

?>
